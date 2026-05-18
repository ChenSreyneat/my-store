@extends('layouts.dashboard')

@section('title', 'Vendor Settlement - Admin')

@section('content')
<section style="padding-bottom: 5rem;">
    <!-- Strategic Header -->
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">Vendor <span class="text-gradient">Settlement</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Reconcile store earnings and verify financial protocol targets.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            TOTAL VENDORS: {{ $stores->count() }}
        </div>
    </div>

    <!-- Settlement Matrix -->
    <div class="glass-card" style="padding: 0; border-radius: 40px; overflow: hidden;">
        <div style="padding: 2.5rem 3.5rem; border-bottom: 1px solid var(--glass-border); background: rgba(255,255,255,0.02);">
            <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; letter-spacing: -0.5px;">Financial <span class="text-gradient">Reconciliation</span></h3>
        </div>
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.01); border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">STORE NODE</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">OPERATIVE (OWNER)</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">TOTAL REVENUE</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">PAYMENT PROTOCOL</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; text-align: right;">OPERATIONS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $store)
                <tr style="border-bottom: 1px solid var(--glass-border); transition: 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 2rem 3.5rem;">
                        <div style="font-weight: 800; font-size: 1.1rem; letter-spacing: -0.5px;">{{ $store->name }}</div>
                        <div style="font-size: 0.75rem; opacity: 0.4; font-weight: 700; margin-top: 0.3rem;">NODE ID: #ST-{{ $store->id }}</div>
                    </td>
                    <td style="padding: 2rem 3.5rem;">
                        <div style="font-weight: 700; font-size: 1rem;">{{ $store->owner->name ?? 'SYSTEM' }}</div>
                        <div style="font-size: 0.8rem; opacity: 0.5;">{{ $store->owner->email ?? 'N/A' }}</div>
                    </td>
                    <td style="padding: 2rem 3.5rem;">
                        <span style="font-weight: 900; font-family: 'Outfit'; font-size: 1.3rem; color: var(--primary);">${{ number_format($store->total_revenue, 2) }}</span>
                    </td>
                    <td style="padding: 2rem 3.5rem;">
                        @if($store->paymentAccount)
                            <div style="background: rgba(var(--primary-rgb), 0.1); border: 1px solid rgba(var(--primary-rgb), 0.2); padding: 0.8rem 1.2rem; border-radius: 12px; display: inline-block;">
                                <div style="font-size: 0.8rem; font-weight: 800; color: var(--primary);">{{ $store->paymentAccount->bank_name }}</div>
                                <div style="font-size: 0.7rem; opacity: 0.6; font-weight: 700; margin-top: 0.2rem;">{{ $store->paymentAccount->account_number }}</div>
                            </div>
                        @else
                            <span style="color: #ef4444; font-size: 0.8rem; font-weight: 800;">PROTOCOL UNLINKED</span>
                        @endif
                    </td>
                    <td style="padding: 2rem 3.5rem; text-align: right;">
                        <div style="display: flex; gap: 1rem; justify-content: flex-end;">
                            <form action="{{ route('admin.users.impersonate', $store->owner_id) }}" method="POST">
                                @csrf
                                <button type="submit" class="glass" style="padding: 0.8rem 1.5rem; border-radius: 12px; font-size: 0.75rem; font-weight: 900; color: var(--primary); border-color: rgba(99, 102, 241, 0.2); background: none; cursor: pointer;">AUDIT STORE</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @if($stores->isEmpty())
                <tr>
                    <td colspan="5" style="padding: 8rem; text-align: center; opacity: 0.3; font-weight: 800; letter-spacing: 2px;">NO VENDOR NODES DETECTED</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
</section>
@endsection
