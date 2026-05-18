@extends('layouts.dashboard')

@section('title', 'Platform Payments - Admin')

@section('content')
<div style="margin-bottom: 4rem;">
    <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Financial <span class="text-gradient">Overview</span></h1>
    <p style="opacity: 0.5;">Tracking all successful payments and platform revenue.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-bottom: 4rem;">
    <div class="glass" style="padding: 2.5rem; border-radius: 24px;">
        <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Gross Revenue</div>
        <div style="font-size: 2.5rem; font-weight: 800; color: #10b981;">${{ number_format($payments->sum('total_amount'), 2) }}</div>
    </div>
    <div class="glass" style="padding: 2.5rem; border-radius: 24px;">
        <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Successful Payments</div>
        <div style="font-size: 2.5rem; font-weight: 800;">{{ $payments->count() }}</div>
    </div>
    <div class="glass" style="padding: 2.5rem; border-radius: 24px;">
        <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Platform Fee (5%)</div>
        <div style="font-size: 2.5rem; font-weight: 800; color: var(--primary);">${{ number_format($payments->sum('total_amount') * 0.05, 2) }}</div>
    </div>
</div>

<div class="glass" style="padding: 3rem; border-radius: 40px; overflow-x: auto;">
    <h3 style="margin-bottom: 2rem; font-weight: 800;">Transaction Log</h3>
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Payment ID</th>
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Amount</th>
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Method</th>
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($payments as $payment)
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <td style="padding: 1.5rem; font-family: monospace; font-weight: 700;">{{ $payment->payment_id ?: 'MANUAL-PAY' }}</td>
                <td style="padding: 1.5rem; font-weight: 800; color: #10b981;">+ ${{ number_format($payment->total_amount, 2) }}</td>
                <td style="padding: 1.5rem; text-transform: uppercase; font-size: 0.85rem; font-weight: 700;">{{ $payment->payment_method }}</td>
                <td style="padding: 1.5rem; opacity: 0.6;">{{ $payment->updated_at->format('M d, H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
