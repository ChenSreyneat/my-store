@extends('layouts.dashboard')

@section('title', 'Earnings Account - Owner')

@section('content')
<div style="margin-bottom: 4rem;">
    <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Earnings <span class="text-gradient">Account</span></h1>
    <p style="opacity: 0.5;">Managing your store's financial performance and revenue.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: clamp(1rem, 2vw, 2rem); margin-bottom: 4rem;">
    <div class="glass" style="padding: 2.5rem; border-radius: 24px;">
        <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Total Store Earnings</div>
        <div style="font-size: 2.5rem; font-weight: 800; color: #10b981;">${{ number_format($totalEarnings, 2) }}</div>
    </div>
    <div class="glass" style="padding: 2.5rem; border-radius: 24px;">
        <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Pending Payouts</div>
        <div style="font-size: 2.5rem; font-weight: 800; color: var(--secondary);">$0.00</div>
    </div>
    <div class="glass" style="padding: 2.5rem; border-radius: 24px;">
        <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 700; text-transform: uppercase; margin-bottom: 0.5rem;">Total Sales Count</div>
        <div style="font-size: 2.5rem; font-weight: 800;">{{ $orders->count() }}</div>
    </div>
</div>

<div class="glass" style="padding: 3rem; border-radius: 40px; overflow-x: auto;">
    <h3 style="margin-bottom: 2rem; font-weight: 800;">Recent Successful Sales</h3>
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Order ID</th>
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Customer</th>
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Amount</th>
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Date</th>
                <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            @php
                $storeId = Auth::user()->store_id;
                $ownerItems = $order->items->filter(function($item) use ($storeId) {
                    return $item->product->store_id == $storeId;
                });
                $ownerSubtotal = $ownerItems->sum(function($item) {
                    return $item->price * $item->quantity;
                });
            @endphp
            <tr style="border-bottom: 1px solid var(--glass-border);">
                <td style="padding: 1.5rem; font-weight: 700;">#EPC-{{ $order->id }}</td>
                <td style="padding: 1.5rem;">{{ $order->user->name }}</td>
                <td style="padding: 1.5rem; font-weight: 800; color: #10b981;">+ ${{ number_format($ownerSubtotal, 2) }}</td>
                <td style="padding: 1.5rem; opacity: 0.6;">{{ $order->updated_at->format('M d, Y') }}</td>
                <td style="padding: 1.5rem;">
                    <span style="font-weight: 800; font-size: 0.75rem; color: #10b981;">COMPLETED</span>
                </td>
            </tr>
            @endforeach
            @if($orders->isEmpty())
            <tr>
                <td colspan="5" style="padding: 5rem; text-align: center; opacity: 0.5;">No successful transactions yet.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
@endsection
