@extends('layouts.dashboard')

@section('title', 'Payout History - Store Owner')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Store <span class="text-gradient">Payouts</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Historical log of all settlements transferred to your account.</p>
        </div>
    </div>

    <!-- Payout Matrix -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Settlement Records</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Payout ID</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Total Amount</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Date Settled</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payouts as $payout)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 1.25rem 1.5rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">
                        #PAY-{{ $payout->id }}
                    </td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <span style="font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: var(--primary);">${{ number_format($payout->amount, 2) }}</span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; color: var(--text-dim); font-size: 0.9rem; font-weight: 600;">
                        {{ $payout->created_at->format('M d, Y h:i A') }}
                    </td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <a href="{{ route('owner.payouts.show', $payout->id) }}" class="btn btn-outline" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 8px; font-weight: 700; color: var(--primary); border-color: rgba(99,102,241,0.2); text-decoration: none; display: inline-block;">View Details</a>
                    </td>
                </tr>
                @endforeach
                @if($payouts->isEmpty())
                <tr>
                    <td colspan="4" style="padding: 6rem 1.5rem; text-align: center; color: var(--text-dim); font-weight: 700; font-size: 0.95rem;">NO PAYOUT RECORDS DETECTED</td>
                </tr>
                @endif
            </tbody>
        </table>
        
        <div style="margin-top: 2rem;">
            {{ $payouts->links() }}
        </div>
    </div>
    </div>
</section>
@endsection
