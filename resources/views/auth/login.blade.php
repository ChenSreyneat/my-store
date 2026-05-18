@extends('layouts.main')

@section('title', 'Login - ElitePC')

@section('content')
<section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 4rem 1rem; position: relative;">
    <div style="position: absolute; top: 10%; left: 10%; width: 300px; height: 300px; background: var(--primary); filter: blur(150px); opacity: 0.1; border-radius: 50%;"></div>
    
    <div class="animate-fade-in" style="width: 100%; max-width: 450px; position: relative; z-index: 2;">
        <div class="glass" style="padding: clamp(2rem, 8vw, 4rem); border-radius: 40px; text-align: center;">
            <div style="width: 60px; height: 60px; background: var(--text-gradient); border-radius: 18px; margin: 0 auto 2rem auto; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 2rem;">E</div>
            <h1 style="font-size: clamp(2rem, 5vw, 2.5rem); font-weight: 800; margin-bottom: 0.5rem; font-family: 'Outfit';">Welcome <span class="text-gradient">Back</span></h1>
            <p style="opacity: 0.5; margin-bottom: 3rem;">Sign in to your elite account</p>

            <form action="{{ route('login') }}" method="POST" style="text-align: left; display: flex; flex-direction: column; gap: 1.5rem;">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; opacity: 0.7; margin-left: 0.5rem;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="background: var(--glass-bg); border: 1px solid {{ $errors->has('email') ? '#ef4444' : 'var(--glass-border)' }}; padding: 1.2rem; border-radius: 16px; color: var(--text); width: 100%; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'">
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-left: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; opacity: 0.7; margin-left: 0.5rem;">Password</label>
                    <input type="password" name="password" required style="background: var(--glass-bg); border: 1px solid {{ $errors->has('password') ? '#ef4444' : 'var(--glass-border)' }}; padding: 1.2rem; border-radius: 16px; color: var(--text); width: 100%; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'">
                    @error('password')
                        <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-left: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem; margin: 0.5rem 0;">
                    <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.85rem; opacity: 0.6; cursor: pointer;">
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#" style="font-size: 0.85rem; color: var(--primary); text-decoration: none; font-weight: 600;">Forgot Password?</a>
                </div>

                <button type="submit" class="btn btn-primary" style="padding: 1.2rem; font-size: 1.1rem; margin-top: 1rem; width: 100%;">Sign In</button>

                <!-- Tactical Divider -->
                <div style="display: flex; align-items: center; gap: 1rem; margin: 1.5rem 0; opacity: 0.3;">
                    <div style="flex: 1; height: 1px; background: var(--text);"></div>
                    <span style="font-size: 0.75rem; font-weight: 800; letter-spacing: 2px;">OR</span>
                    <div style="flex: 1; height: 1px; background: var(--text);"></div>
                </div>

                <!-- Google Authentication -->
                <a href="{{ route('auth.google') }}" class="btn" style="background: #fff; color: #111827; padding: 1.1rem; border-radius: 16px; font-weight: 700; display: flex; align-items: center; justify-content: center; gap: 1rem; border: 1px solid rgba(0,0,0,0.05); transition: 0.3s;" onmouseover="this.style.background='#f8fafc'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#fff'; this.style.transform='translateY(0)';">
                    <svg width="20" height="20" viewBox="0 0 24 24">
                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 12-4.53z" fill="#EA4335"/>
                    </svg>
                    Continue with Google
                </a>
            </form>

            <div style="margin-top: 3rem; opacity: 0.6; font-size: 0.9rem;">
                Don't have an account? <a href="{{ route('register') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">Register Now</a>
            </div>
        </div>
    </div>
</section>
@endsection
