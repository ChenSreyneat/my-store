@extends('layouts.main')

@section('title', 'Login - ElitePC')

@section('content')
<section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 4rem 1rem; position: relative;">
    <div style="position: absolute; top: 10%; left: 10%; width: 300px; height: 300px; background: var(--primary); filter: blur(150px); opacity: 0.1; border-radius: 50%;"></div>
    
    <div class="animate-fade-in" style="width: 100%; max-width: 450px; position: relative; z-index: 2; margin: 0 auto;">
        <!-- Card Container -->
        <div style="background: #f3f4f6; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            
            <!-- Header -->
            <div style="background: #6b7280; padding: 1.25rem 1.5rem; display: flex; justify-content: center; align-items: center;">
                <h2 style="color: #ffffff; font-size: 1.15rem; font-weight: 600; margin: 0; font-family: 'Inter', sans-serif;">Welcome Back!</h2>
            </div>

            <!-- Body -->
            <div style="padding: 2rem;">
                <form action="{{ route('login') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.2rem;">
                    @csrf
                    
                    <!-- Email -->
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #4b5563; margin-bottom: 0.4rem; text-transform: none; letter-spacing: normal;">Email address</label>
                        <div style="position: relative;">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required style="width: 100%; background: #ffffff !important; border: 1px solid #d1d5db !important; border-radius: 6px !important; padding: 0.75rem 2.5rem 0.75rem 1rem !important; color: #111827 !important; font-size: 0.95rem !important; outline: none; box-sizing: border-box; transition: 0.2s;" onfocus="this.style.borderColor='#007bff' !important" onblur="this.style.borderColor='#d1d5db' !important">
                            <svg style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                <polyline points="22,6 12,13 2,6"></polyline>
                            </svg>
                        </div>
                        @error('email')
                            <span style="color: #ef4444; font-size: 0.75rem; margin-top: 0.4rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #4b5563; margin-bottom: 0.4rem; text-transform: none; letter-spacing: normal;">Password</label>
                        <div style="position: relative;">
                            <input type="password" id="login-password" name="password" placeholder="Enter your password" required style="width: 100%; background: #ffffff !important; border: 1px solid #d1d5db !important; border-radius: 6px !important; padding: 0.75rem 2.5rem 0.75rem 1rem !important; color: #111827 !important; font-size: 0.95rem !important; outline: none; box-sizing: border-box; transition: 0.2s;" onfocus="this.style.borderColor='#007bff' !important" onblur="this.style.borderColor='#d1d5db' !important">
                            <button type="button" onclick="togglePassword('login-password', this)" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; width: 18px; height: 18px;">
                                <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                    <circle cx="12" cy="12" r="3"></circle>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <span style="color: #ef4444; font-size: 0.75rem; margin-top: 0.4rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Remember / Forgot -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 0.5rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; color: #4b5563; cursor: pointer; text-transform: none; letter-spacing: normal; font-weight: 400; margin: 0;">
                            <input type="checkbox" name="remember" style="width: auto !important; margin: 0; padding: 0;"> Remember me
                        </label>
                        <a href="#" style="font-size: 0.85rem; color: #007bff; text-decoration: none; font-weight: 500;">Forgot password?</a>
                    </div>

                    <!-- Submit -->
                    <button type="submit" style="background: #007bff; color: #ffffff; border: none; border-radius: 6px; padding: 0.85rem; font-size: 1rem; font-weight: 600; cursor: pointer; transition: 0.2s; margin-top: 0.5rem; width: 100%; box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);" onmouseover="this.style.background='#0056b3'" onmouseout="this.style.background='#007bff'">Sign In</button>

                    <!-- Divider -->
                    <div style="display: flex; align-items: center; gap: 1rem; margin: 1rem 0;">
                        <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                        <span style="font-size: 0.8rem; color: #9ca3af;">or continue with</span>
                        <div style="flex: 1; height: 1px; background: #e5e7eb;"></div>
                    </div>

                    <!-- Socials -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <a href="{{ route('auth.google') }}" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; border: 1px solid #e5e7eb; border-radius: 6px; padding: 0.75rem; color: #374151; text-decoration: none; font-size: 0.9rem; font-weight: 500; background: #ffffff; transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='#ffffff'">
                            <svg width="18" height="18" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"/>
                            </svg>
                            Google
                        </a>
                        <a href="#" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; border: 1px solid #e5e7eb; border-radius: 6px; padding: 0.75rem; color: #374151; text-decoration: none; font-size: 0.9rem; font-weight: 500; background: #ffffff; transition: 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='#ffffff'">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="#1877f2">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                            Facebook
                        </a>
                    </div>

                    <!-- Register Link -->
                    <div style="text-align: center; margin-top: 1rem; font-size: 0.85rem; color: #6b7280;">
                        Don't have an account? <a href="{{ route('register') }}" style="color: #007bff; text-decoration: none; font-weight: 500;">Register now</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
function togglePassword(inputId, button) {
    const input = document.getElementById(inputId);
    const icon = button.querySelector('.eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
    }
}
</script>
@endsection
