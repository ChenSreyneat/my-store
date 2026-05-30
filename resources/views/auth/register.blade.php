@extends('layouts.main')

@section('title', 'Register - ElitePC')

@section('content')
<section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 4rem 1rem; position: relative;">
    <div style="position: absolute; bottom: 10%; right: 10%; width: 300px; height: 300px; background: var(--secondary); filter: blur(150px); opacity: 0.1; border-radius: 50%;"></div>

    <div class="animate-fade-in" style="width: 100%; max-width: 500px; position: relative; z-index: 2; margin: 0 auto;">
        <!-- Card Container -->
        <div class="glass-card" style="padding: 0; overflow: hidden;">
            
            <!-- Header -->
            <div style="padding: 2rem 2rem 1rem 2rem; display: flex; justify-content: center; align-items: center;">
                <h2 style="margin: 0; font-family: 'Outfit', sans-serif;">Create <span class="text-gradient">Account</span></h2>
            </div>

            <!-- Body -->
            <div style="padding: 1rem 2rem 2.5rem 2rem;">
                <form action="{{ route('register') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                    @csrf
                    
                    <!-- Name -->
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Full Name</label>
                        <div style="position: relative;">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required>
                        </div>
                        @error('name')
                            <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Email address</label>
                        <div style="position: relative;">
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" required>
                        </div>
                        @error('email')
                            <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Account Type Selection -->
                    <div class="form-group" style="margin-bottom: 0;">
                        <label>Account Type</label>
                        <div style="position: relative;">
                            <select name="account_type" required style="appearance: none; cursor: pointer;">
                                <option value="user">Customer (Just visiting and buy)</option>
                                <option value="owner">Store Owner (Sell on ElitePC)</option>
                            </select>
                            <svg style="position: absolute; right: 1.25rem; top: 50%; transform: translateY(-50%); color: var(--text-dim); pointer-events: none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        @error('account_type')
                            <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Row -->
                    <div class="responsive-grid grid-2" style="gap: 1.5rem; margin-bottom: 0.5rem;">
                        <!-- Password -->
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Password</label>
                            <div style="position: relative;">
                                <input type="password" id="register-password" name="password" placeholder="Enter password" required style="padding-right: 2.5rem;">
                                <button type="button" onclick="togglePassword('register-password', this)" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-dim); cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; width: 18px; height: 18px;">
                                    <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem; display: block;">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm -->
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Confirm</label>
                            <div style="position: relative;">
                                <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="Confirm password" required style="padding-right: 2.5rem;">
                                <button type="button" onclick="togglePassword('register-password-confirm', this)" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-dim); cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; width: 18px; height: 18px;">
                                    <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn btn-primary" style="width: 100%; justify-content: center; padding: 1rem; font-size: 1rem;">Sign Up</button>

                    <!-- Login Link -->
                    <div style="text-align: center; margin-top: 1rem; font-size: 0.85rem; font-weight: 500;">
                        Already have an account? <a href="{{ route('login') }}" style="color: var(--primary); text-decoration: none; font-weight: 700;">Sign in here</a>
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
