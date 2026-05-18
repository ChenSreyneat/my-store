@extends('layouts.dashboard')

@section('title', 'Platform Settings - Admin')

@section('content')
<section>
    <div style="margin-bottom: 4rem;">
        <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Admin <span class="text-gradient">Settings</span></h1>
        <p style="opacity: 0.5;">Global configuration and personal account management.</p>
    </div>

    <div style="display: grid; grid-template-columns: 1.5fr 1fr; gap: 3rem;" class="dynamic-form">
        <!-- Personal Admin Profile -->
        <div class="glass" style="padding: 3.5rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">My Administrative Account</h3>
            <form action="{{ route('profile.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2rem;">
                @csrf
                @method('PATCH')
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Full Name</label>
                    <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="background: rgba(255,255,255,0.05); border: 1px solid {{ $errors->has('name') ? '#ef4444' : 'var(--glass-border)' }}; padding: 1rem; border-radius: 12px; color: white;">
                    @error('name')
                        <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 700; opacity: 0.7;">Administrative Email</label>
                    <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" required style="background: rgba(255,255,255,0.05); border: 1px solid {{ $errors->has('email') ? '#ef4444' : 'var(--glass-border)' }}; padding: 1rem; border-radius: 12px; color: white;">
                    @error('email')
                        <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary" style="padding: 1rem 2rem; align-self: flex-start;">Update Admin Profile</button>
            </form>
        </div>

        <!-- System Configuration -->
        <div class="glass" style="padding: 3rem; border-radius: 40px; height: fit-content;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Platform Config</h3>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                    <span style="opacity: 0.6;">Commission Fee</span>
                    <span style="font-weight: 800; color: var(--primary);">5.00%</span>
                </div>
                <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                    <span style="opacity: 0.6;">System Status</span>
                    <span style="font-weight: 800; color: #10b981;">HEALTHY</span>
                </div>
                <button class="btn btn-outline" style="margin-top: 1rem; color: #ef4444; border-color: rgba(239,68,68,0.2); width: 100%;">Flush System Cache</button>
            </div>
        </div>
    </div>
</section>
@endsection
