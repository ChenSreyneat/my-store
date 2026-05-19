@extends('layouts.main')

@section('title', 'Register - ElitePC')

@section('content')
<section style="min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 6rem 1rem 4rem 1rem; position: relative;">
    <div style="position: absolute; bottom: 10%; right: 10%; width: 300px; height: 300px; background: var(--secondary); filter: blur(150px); opacity: 0.1; border-radius: 50%;"></div>

    <div class="animate-fade-in" style="width: 100%; max-width: 500px; position: relative; z-index: 2; margin: 0 auto;">
        <!-- Card Container -->
        <div style="background: #f3f4f6; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
            
            <!-- Header -->
            <div style="background: #6b7280; padding: 1.25rem 1.5rem; display: flex; justify-content: center; align-items: center;">
                <h2 style="color: #ffffff; font-size: 1.15rem; font-weight: 600; margin: 0; font-family: 'Inter', sans-serif;">Create Account</h2>
            </div>

            <!-- Body -->
            <div style="padding: 2rem;">
                <form action="{{ route('register') }}" method="POST" style="display: flex; flex-direction: column; gap: 1.2rem;">
                    @csrf
                    
                    <!-- Name -->
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #4b5563; margin-bottom: 0.4rem; text-transform: none; letter-spacing: normal;">Full Name</label>
                        <div style="position: relative;">
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" required style="width: 100%; background: #ffffff !important; border: 1px solid #d1d5db !important; border-radius: 6px !important; padding: 0.75rem 2.5rem 0.75rem 1rem !important; color: #111827 !important; font-size: 0.95rem !important; outline: none; box-sizing: border-box; transition: 0.2s;" onfocus="this.style.borderColor='#007bff' !important" onblur="this.style.borderColor='#d1d5db' !important">
                            <svg style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        @error('name')
                            <span style="color: #ef4444; font-size: 0.75rem; margin-top: 0.4rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

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

                    <!-- Account Type Selection -->
                    <div>
                        <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #4b5563; margin-bottom: 0.4rem; text-transform: none; letter-spacing: normal;">Account Type</label>
                        <div style="position: relative;">
                            <select name="account_type" required style="width: 100%; background: #ffffff !important; border: 1px solid #d1d5db !important; border-radius: 6px !important; padding: 0.75rem 2.5rem 0.75rem 1rem !important; color: #111827 !important; font-size: 0.95rem !important; outline: none; box-sizing: border-box; transition: 0.2s; appearance: none; cursor: pointer;" onfocus="this.style.borderColor='#007bff' !important" onblur="this.style.borderColor='#d1d5db' !important">
                                <option value="user">Customer (Just visiting and buy)</option>
                                <option value="owner">Store Owner (Sell on ElitePC)</option>
                            </select>
                            <svg style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); color: #9ca3af; pointer-events: none;" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </div>
                        @error('account_type')
                            <span style="color: #ef4444; font-size: 0.75rem; margin-top: 0.4rem; display: block;">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Row -->
                    <div class="responsive-grid grid-2" style="gap: 1.2rem;">
                        <!-- Password -->
                        <div style="display: flex; flex-direction: column;">
                            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #4b5563; margin-bottom: 0.4rem; text-transform: none; letter-spacing: normal;">Password</label>
                            <div style="position: relative;">
                                <input type="password" id="register-password" name="password" placeholder="Enter password" required style="width: 100%; background: #ffffff !important; border: 1px solid #d1d5db !important; border-radius: 6px !important; padding: 0.75rem 2.5rem 0.75rem 1rem !important; color: #111827 !important; font-size: 0.95rem !important; outline: none; box-sizing: border-box; transition: 0.2s;" onfocus="this.style.borderColor='#007bff' !important" onblur="this.style.borderColor='#d1d5db' !important">
                                <button type="button" onclick="togglePassword('register-password', this)" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; width: 18px; height: 18px;">
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

                        <!-- Confirm -->
                        <div style="display: flex; flex-direction: column;">
                            <label style="display: block; font-size: 0.85rem; font-weight: 500; color: #4b5563; margin-bottom: 0.4rem; text-transform: none; letter-spacing: normal;">Confirm</label>
                            <div style="position: relative;">
                                <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="Confirm password" required style="width: 100%; background: #ffffff !important; border: 1px solid #d1d5db !important; border-radius: 6px !important; padding: 0.75rem 2.5rem 0.75rem 1rem !important; color: #111827 !important; font-size: 0.95rem !important; outline: none; box-sizing: border-box; transition: 0.2s;" onfocus="this.style.borderColor='#007bff' !important" onblur="this.style.borderColor='#d1d5db' !important">
                                <button type="button" onclick="togglePassword('register-password-confirm', this)" style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: #9ca3af; cursor: pointer; padding: 0; display: flex; align-items: center; justify-content: center; width: 18px; height: 18px;">
                                    <svg class="eye-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button type="submit" style="background: #007bff; color: #ffffff; border: none; border-radius: 6px; padding: 0.85rem; font-size: 1rem; font-weight: 600; cursor: pointer; transition: 0.2s; margin-top: 0.5rem; width: 100%; box-shadow: 0 4px 6px rgba(0, 123, 255, 0.2);" onmouseover="this.style.background='#0056b3'" onmouseout="this.style.background='#007bff'">Sign Up</button>

                    <!-- Login Link -->
                    <div style="text-align: center; margin-top: 1rem; font-size: 0.85rem; color: #6b7280;">
                        Already have an account? <a href="{{ route('login') }}" style="color: #007bff; text-decoration: none; font-weight: 500;">Sign in here</a>
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
