@extends('layouts.dashboard')

@section('title', 'Vendor Settlement - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Vendor <span class="text-gradient">Settlement</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Reconcile store earnings and verify financial protocol targets.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            TOTAL VENDORS: {{ $stores->count() }}
        </div>
    </div>

    <!-- Settlement Matrix -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Financial Reconciliation Matrix</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Store Node</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Operative (Owner)</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Total Revenue</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Payment Protocol</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stores as $store)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 800; font-size: 1.05rem; color: var(--text);">{{ $store->name }}</div>
                        <div style="font-size: 0.75rem; color: var(--text-dim); font-weight: 700; margin-top: 0.2rem;">NODE ID: #ST-{{ $store->id }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 700; font-size: 1rem; color: var(--text);">{{ $store->owner->name ?? 'SYSTEM' }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 0.15rem;">{{ $store->owner->email ?? 'N/A' }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <span style="font-weight: 900; font-family: 'Outfit'; font-size: 1.2rem; color: var(--primary);">${{ number_format($store->total_revenue, 2) }}</span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        @if($store->paymentAccount)
                            <div style="background: rgba(99, 102, 241, 0.06); border: 1px solid rgba(99, 102, 241, 0.12); padding: 0.6rem 1rem; border-radius: 10px; display: inline-block;">
                                <div style="font-size: 0.8rem; font-weight: 800; color: var(--primary);">{{ $store->paymentAccount->account_id }}</div>
                                <div style="font-size: 0.7rem; color: var(--text-dim); font-weight: 700; margin-top: 0.15rem;">{{ $store->paymentAccount->account_name }} ({{ $store->paymentAccount->currency }})</div>
                            </div>
                        @else
                            <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 800; background: rgba(239, 68, 68, 0.08); color: #ef4444; letter-spacing: 0.5px;">PROTOCOL UNLINKED</span>
                        @endif
                    </td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        @if($store->owner)
                        <form action="{{ route('admin.users.impersonate', $store->owner->id) }}" method="POST" style="margin: 0; display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; font-weight: 700; color: var(--primary); border-color: rgba(99,102,241,0.2);">Audit Store</button>
                        </form>
                        @else
                        <span style="font-size: 0.8rem; color: var(--text-dim); font-weight: 700;">NO OWNER</span>
                        @endif
                    </td>
                </tr>
                @endforeach
                @if($stores->isEmpty())
                <tr>
                    <td colspan="5" style="padding: 6rem 1.5rem; text-align: center; color: var(--text-dim); font-weight: 700; font-size: 0.95rem;">NO VENDOR NODES DETECTED</td>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    </div>
</section>
@endsection
