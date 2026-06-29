@extends('layouts.dashboard')

@section('title', 'Payout Details - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <div style="margin-bottom: 3rem;">
        <a href="{{ route('admin.payouts') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; color: var(--text-dim); text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: color 0.3s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text-dim)'">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Back to Payout History
        </a>
    </div>

    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: flex-end;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Payout <span class="text-gradient">#PAY-{{ $payout->id }}</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Details for {{ $payout->store->name ?? 'Unknown Store' }} on {{ $payout->created_at->format('M d, Y h:i A') }}</p>
        </div>
        <div>
            <div style="font-size: 0.85rem; color: var(--text-dim); font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 0.3rem;">Total Settled</div>
            <div style="font-size: 2.2rem; font-weight: 900; font-family: 'Outfit'; color: var(--primary); line-height: 1;">${{ number_format($payout->amount, 2) }}</div>
        </div>
    </div>

    <!-- Payout Items Matrix -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Products Settled in this Payout</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Product ID</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Product Name</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: center;">Units Settled</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Total Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payout->items as $item)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 1.25rem 1.5rem; font-weight: 700; color: var(--text-dim);">
                        #PROD-{{ $item->product_id }}
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 800; font-size: 1rem; color: var(--text);">{{ $item->product->name ?? 'Deleted Product' }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; text-align: center;">
                        <span style="font-weight: 900; color: var(--text);">{{ $item->quantity }}</span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <span style="font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: #10b981;">${{ number_format($item->amount, 2) }}</span>
                    </td>
                </tr>
                @endforeach
                @if($payout->items->isEmpty())
                <tr>
                    <td colspan="4" style="padding: 6rem 1.5rem; text-align: center; color: var(--text-dim); font-weight: 700; font-size: 0.95rem;">NO PRODUCT DETAILS AVAILABLE</td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>
</section>
@endsection
