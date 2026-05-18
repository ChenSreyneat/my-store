@extends('layouts.dashboard')

@section('title', 'Global Orders - Admin')

@section('content')
<section>
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">Global <span class="text-gradient">Orders</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Monitoring all customer transactions across the entire platform.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            ORDER FLOW: STABLE
        </div>
    </div>

    <div class="glass" style="padding: 3rem; border-radius: 40px;">
        <h3 style="margin-bottom: 2rem; font-weight: 800;">Master Transaction History</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Order ID</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Customer</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Amount</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Status</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Date</th>
                    <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Store</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="border-bottom: 1px solid var(--glass-border);">
                    <td style="padding: 1.5rem; font-weight: 700;">#EPC-{{ $order->id }}</td>
                    <td style="padding: 1.5rem;">
                        <div style="font-weight: 600;">{{ $order->user->name }}</div>
                        <div style="font-size: 0.8rem; opacity: 0.5;">{{ $order->user->email }}</div>
                    </td>
                    <td style="padding: 1.5rem; font-weight: 800;">${{ number_format($order->total_amount, 2) }}</td>
                    <td style="padding: 1.5rem;">
                        @php
                            $statusColors = [
                                'pending' => '#f59e0b',
                                'paid' => '#10b981',
                                'shipped' => '#3b82f6',
                                'completed' => '#8b5cf6',
                                'cancelled' => '#ef4444'
                            ];
                            $color = $statusColors[$order->status] ?? '#94a3b8';
                        @endphp
                        <span style="font-weight: 800; font-size: 0.75rem; color: {{ $color }}; text-transform: uppercase; letter-spacing: 1px;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding: 1.5rem; opacity: 0.6;">{{ $order->created_at->format('M d, Y') }}</td>
                    <td style="padding: 1.5rem;">
                        <span style="font-weight: 600; color: var(--secondary);">{{ $order->items->first()->product->store->name ?? 'System' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div style="margin-top: 2rem;">
            {{ $orders->links() }}
        </div>
    </div>
</section>
@endsection
