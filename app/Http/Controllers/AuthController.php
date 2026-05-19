<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) return redirect()->route('admin.dashboard');
            if ($user->isOwner()) return redirect()->route('owner.dashboard');
            return redirect()->route('home');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $user = Auth::user();

            if ($user->isAdmin()) return redirect()->route('admin.dashboard');
            if ($user->isOwner()) return redirect()->route('owner.dashboard');
            
            return redirect()->route('home');
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->onlyInput('email');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->isAdmin()) return redirect()->route('admin.dashboard');
            if ($user->isOwner()) return redirect()->route('owner.dashboard');
            return redirect()->route('home');
        }
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'account_type' => 'required|in:user,owner',
        ]);

        $storeId = null;

        if ($request->account_type === 'owner') {
            $store = \App\Models\Store::create([
                'name' => $request->name . "'s Store",
                'email' => $request->email,
                'is_active' => true,
            ]);
            $storeId = $store->id;
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->account_type,
            'store_id' => $storeId,
        ]);

        if ($user->isOwner()) {
            return redirect()->route('login')->with('success', 'Store Owner account created successfully! Please sign in.');
        }

        Auth::login($user);
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        try {
            return \Laravel\Socialite\Facades\Socialite::driver('google')->redirect();
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Google Authentication is not configured on this server yet.');
        }
    }

    /**
     * Obtain the user information from Google.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = \Laravel\Socialite\Facades\Socialite::driver('google')->user();
            
            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                // Create a new user if they don't exist
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make(\Illuminate\Support\Str::random(24)),
                    'role' => 'user', // Default role
                    'profile_image' => $googleUser->getAvatar(),
                ]);
            }

            Auth::login($user);
            return redirect()->route('home');

        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Authentication failed or was cancelled.');
        }
    }
}
