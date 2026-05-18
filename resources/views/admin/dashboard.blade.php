@extends('layouts.dashboard')

@section('title', 'Admin Dashboard - ElitePC')

@section('content')
<section style="padding-bottom: 5rem;">
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">Platform <span class="text-gradient">Control</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Full-spectrum telemetry of the ElitePC ecosystem across all nodes.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            ROOT ACCESS: GRANTED
        </div>
    </div>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 2.5rem; margin-bottom: 5rem;">
        @foreach($stats as $key => $value)
        <div class="glass-card" style="padding: 2.5rem; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: var(--primary); opacity: 0.1; filter: blur(40px); border-radius: 50%;"></div>
            <div style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 1.5rem;">{{ $key }}</div>
            <div style="display: flex; align-items: flex-end; gap: 1rem;">
                <div style="font-size: 3.5rem; font-weight: 900; font-family: 'Outfit'; line-height: 1;">{{ $value }}</div>
            </div>
        </div>
        @endforeach
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 3rem;">
        <!-- Platform Health -->
        <div class="glass-card" style="padding: 3rem;">
            <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; margin-bottom: 3rem;">Platform Infrastructure</h3>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
                <a href="{{ route('admin.stores') }}" class="glass" style="padding: 2rem; border-radius: 24px; text-decoration: none; transition: 0.3s; border-color: rgba(99, 102, 241, 0.2);">
                    <div style="font-weight: 800; font-size: 1.1rem; color: var(--text); margin-bottom: 0.5rem;">Store Network</div>
                    <p style="font-size: 0.85rem; opacity: 0.5;">Manage architectural nodes and merchant authorization.</p>
                </a>
                <a href="{{ route('admin.users') }}" class="glass" style="padding: 2rem; border-radius: 24px; text-decoration: none; transition: 0.3s; border-color: rgba(99, 102, 241, 0.2);">
                    <div style="font-weight: 800; font-size: 1.1rem; color: var(--text); margin-bottom: 0.5rem;">User Ecosystem</div>
                    <p style="font-size: 0.85rem; opacity: 0.5;">Monitor operative registration and security protocols.</p>
                </a>
                <a href="{{ route('admin.categories') }}" class="glass" style="padding: 2rem; border-radius: 24px; text-decoration: none; transition: 0.3s; border-color: rgba(99, 102, 241, 0.2);">
                    <div style="font-weight: 800; font-size: 1.1rem; color: var(--text); margin-bottom: 0.5rem;">Catalog Logic</div>
                    <p style="font-size: 0.85rem; opacity: 0.5;">Define hardware taxonomies and product hierarchies.</p>
                </a>
                <a href="{{ route('admin.payment_accounts') }}" class="glass" style="padding: 2rem; border-radius: 24px; text-decoration: none; transition: 0.3s; border-color: rgba(99, 102, 241, 0.2);">
                    <div style="font-weight: 800; font-size: 1.1rem; color: var(--text); margin-bottom: 0.5rem;">Financial Nodes</div>
                    <p style="font-size: 0.85rem; opacity: 0.5;">Calibrate Bakong endpoints and settlement gateways.</p>
                </a>
            </div>
        </div>

        <!-- Quick Operations -->
        <div style="display: flex; flex-direction: column; gap: 2.5rem;">
            <div class="glass-card" style="padding: 3rem; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%);">
                <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; margin-bottom: 2rem;">Quick Operations</h3>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <a href="{{ route('admin.reports') }}" class="btn btn-primary" style="justify-content: center; padding: 1.2rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Generate Intelligence Report
                    </a>
                    <a href="{{ route('admin.orders') }}" class="btn btn-outline" style="justify-content: center; padding: 1.2rem;">Monitor Global Traffic</a>
                </div>
            </div>

            <div class="glass-card" style="padding: 2.5rem; border-color: rgba(16, 185, 129, 0.3);">
                <div style="display: flex; align-items: center; gap: 1rem; color: #10b981; margin-bottom: 1.5rem;">
                    <div style="width: 12px; height: 12px; background: #10b981; border-radius: 50%; box-shadow: 0 0 15px #10b981;"></div>
                    <span style="font-weight: 800; font-size: 0.8rem; letter-spacing: 2px;">SYSTEM STATUS: NOMINAL</span>
                </div>
                <p style="font-size: 0.9rem; opacity: 0.6; line-height: 1.6;">All architectural sub-systems are performing within optimal parameters. Global order throughput is stable.</p>
            </div>
        </div>
    </div>
</section>
@endsection
