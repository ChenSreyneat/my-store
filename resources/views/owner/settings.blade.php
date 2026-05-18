@extends('layouts.dashboard')

@section('title', 'Operations Control - Owner')

@section('content')
<section style="padding-bottom: 5rem;">
    <!-- Strategic Header -->
    <div style="margin-bottom: 6rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(3rem, 7vw, 4.5rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -3px; line-height: 1; margin-bottom: 1.5rem;">Operations <span class="text-gradient">Control</span></h1>
            <p style="opacity: 0.6; font-size: 1.2rem; font-weight: 600; max-width: 600px;">Calibrate your merchant node parameters and secure your operative profile credentials.</p>
        </div>
        <div class="glass" style="padding: 0.8rem 2rem; border-radius: 50px; font-size: 0.85rem; font-weight: 800; color: var(--primary); letter-spacing: 2px; border-color: rgba(99, 102, 241, 0.3);">
            NODE STATUS: ACTIVE
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 4rem;">
        <!-- Business Intelligence Matrix -->
        <div class="glass-card" style="padding: 4rem; border-radius: 48px;">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 4rem;">
                <h2 style="font-weight: 900; font-family: 'Outfit'; font-size: 2rem; display: flex; align-items: center; gap: 1.5rem; letter-spacing: -1px;">
                    <div style="width: 52px; height: 52px; background: var(--primary); border-radius: 16px; display: flex; align-items: center; justify-content: center; color: white; box-shadow: var(--primary-glow);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                    </div>
                    Business Node
                </h2>
                <span class="glass" style="padding: 0.6rem 1.2rem; border-radius: 50px; font-size: 0.75rem; font-weight: 900; opacity: 0.6; letter-spacing: 2px;">GLOBAL TELEMETRY</span>
            </div>

            <form action="{{ route('owner.settings.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 3rem;">
                @csrf
                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                    <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">OFFICIAL STORE IDENTITY</label>
                    <input type="text" name="name" value="{{ $store->name }}" required style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                </div>

                <div class="form-grid-admin">
                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                        <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">PUBLIC COMMS EMAIL</label>
                        <input type="email" name="email" value="{{ $store->email }}" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                        <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">SUPPORT LINE (PHONE)</label>
                        <input type="text" name="phone" value="{{ $store->phone }}" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                    <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6; color: var(--primary);">LINKED BAKONG ACCOUNT (FINANCIAL NODE)</label>
                    <select name="payment_account_id" style="width: 100%; background: var(--dark); border: 1px solid var(--primary); padding: 1.2rem; border-radius: 16px; color: white; font-weight: 700;">
                        <option value="">Select Payment Protocol</option>
                        @foreach($paymentAccounts as $account)
                        <option value="{{ $account->id }}" {{ $store->payment_account_id == $account->id ? 'selected' : '' }}>
                            {{ $account->bank_name }} - {{ $account->account_number }} ({{ $account->account_name }})
                        </option>
                        @endforeach
                    </select>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                    <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">PHYSICAL DEPLOYMENT (ADDRESS)</label>
                    <input type="text" name="address" value="{{ $store->address }}" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                    <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">MISSION STATEMENT (DESCRIPTION)</label>
                    <textarea name="description" style="min-height: 180px; resize: none; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%; line-height: 1.7;">{{ $store->description }}</textarea>
                </div>

                <div style="display: flex; justify-content: flex-end; margin-top: 2rem;" class="header-stack">
                    <button type="submit" class="btn btn-primary" style="padding: 1.5rem 5rem; border-radius: 20px; font-weight: 900; font-size: 1.1rem; box-shadow: var(--primary-glow); width: 100%;">SYNCHRONIZE NODE</button>
                </div>
            </form>
        </div>

        <!-- Personal Operative Matrix -->
        <div style="display: flex; flex-direction: column; gap: 4rem;">
            <div class="glass-card" style="padding: 4rem; border-radius: 48px;">
                <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; margin-bottom: 3rem; letter-spacing: -0.5px;">Operative Profile</h3>
                <form action="{{ route('profile.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2.5rem;">
                    @csrf @method('PATCH')
                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                        <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">IDENTITY NAME</label>
                        <input type="text" name="name" value="{{ Auth::user()->name }}" required style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                        <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6;">PRIMARY EMAIL</label>
                        <input type="email" value="{{ Auth::user()->email }}" disabled style="opacity: 0.5; cursor: not-allowed; background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1.2rem; border-radius: 16px; color: white; width: 100%;">
                    </div>
                    <button type="submit" class="btn btn-outline" style="width: 100%; padding: 1.4rem; border-radius: 20px; font-weight: 900; font-size: 1rem;">UPDATE CREDENTIALS</button>
                </form>
            </div>

            <div class="glass-card" style="padding: 4rem; border-radius: 48px; border-color: rgba(var(--secondary-rgb), 0.4); background: rgba(var(--secondary-rgb), 0.02);">
                <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; margin-bottom: 1.5rem; letter-spacing: -0.5px;">Elite Support</h3>
                <p style="opacity: 0.6; font-size: 1.05rem; line-height: 1.7; margin-bottom: 2.5rem; font-weight: 500;">Need architectural assistance with your merchant node? Our high-performance support team is active and ready for coordination.</p>
                <a href="{{ route('contact') }}" class="btn btn-outline" style="width: 100%; border-color: var(--secondary); color: var(--secondary); padding: 1.4rem; border-radius: 20px; font-weight: 900; font-size: 1rem; justify-content: center;">OPEN COMMS CHANNEL</a>
            </div>
        </div>
    </div>
</section>
@endsection
