@extends('layouts.main')

@section('title', 'Register - ElitePC')

@section('content')
<section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 4rem 1rem; position: relative;">
    <div style="position: absolute; bottom: 10%; right: 10%; width: 300px; height: 300px; background: var(--secondary); filter: blur(150px); opacity: 0.1; border-radius: 50%;"></div>

    <div class="animate-fade-in" style="width: 100%; max-width: 500px; position: relative; z-index: 2;">
        <div class="glass" style="padding: clamp(2rem, 8vw, 4rem); border-radius: 40px; text-align: center;">
            <div style="width: 60px; height: 60px; background: var(--text-gradient); border-radius: 18px; margin: 0 auto 2rem auto; display: flex; align-items: center; justify-content: center; color: white; font-weight: 800; font-size: 2rem;">E</div>
            <h1 style="font-size: clamp(2rem, 5vw, 2.5rem); font-weight: 800; margin-bottom: 0.5rem; font-family: 'Outfit';">Join the <span class="text-gradient">Elite</span></h1>
            <p style="opacity: 0.5; margin-bottom: 3rem;">Create your premium hardware account</p>

            <form action="{{ route('register') }}" method="POST" style="text-align: left; display: flex; flex-direction: column; gap: 1.2rem;">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; opacity: 0.7; margin-left: 0.5rem;">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required style="background: var(--glass-bg); border: 1px solid {{ $errors->has('name') ? '#ef4444' : 'var(--glass-border)' }}; padding: 1rem; border-radius: 14px; color: var(--text); width: 100%; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'">
                    @error('name')
                        <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-left: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 0.85rem; font-weight: 700; opacity: 0.7; margin-left: 0.5rem;">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}" required style="background: var(--glass-bg); border: 1px solid {{ $errors->has('email') ? '#ef4444' : 'var(--glass-border)' }}; padding: 1rem; border-radius: 14px; color: var(--text); width: 100%; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'">
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-left: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>

                <div class="responsive-grid grid-2" style="gap: 1.2rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; opacity: 0.7; margin-left: 0.5rem;">Password</label>
                        <input type="password" name="password" required style="background: var(--glass-bg); border: 1px solid {{ $errors->has('password') ? '#ef4444' : 'var(--glass-border)' }}; padding: 1rem; border-radius: 14px; color: var(--text); width: 100%; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'">
                        @error('password')
                            <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-left: 0.5rem;">{{ $message }}</span>
                        @enderror
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-size: 0.85rem; font-weight: 700; opacity: 0.7; margin-left: 0.5rem;">Confirm</label>
                        <input type="password" name="password_confirmation" required style="background: var(--glass-bg); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 14px; color: var(--text); width: 100%; outline: none; transition: 0.3s;" onfocus="this.style.borderColor='var(--primary)'">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" style="padding: 1.2rem; font-size: 1.1rem; margin-top: 1rem; width: 100%;">Create Account</button>
            </form>

            <div style="margin-top: 3rem; opacity: 0.6; font-size: 0.9rem;">
                Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">Login Here</a>
            </div>
        </div>
    </div>
</section>
@endsection
