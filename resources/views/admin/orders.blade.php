@extends('layouts.dashboard')

@section('title', 'Global Orders - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Global <span class="text-gradient">Orders</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Monitoring all customer transactions across the entire platform.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            ORDER FLOW: ACTIVE
        </div>
    </div>

    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Master Transaction History</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 800px;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Order ID</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Customer</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Amount</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Status</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Date</th>
                    <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Store</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1rem; color: var(--text);">#EPC-{{ $order->id }}</td>
                    <td style="padding: 1.25rem 1.5rem;">
                        <div style="font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $order->user->name ?? 'Guest/Deleted' }}</div>
                        <div style="font-size: 0.8rem; color: var(--text-dim); margin-top: 0.2rem;">{{ $order->user->email ?? 'N/A' }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: var(--text);">${{ number_format($order->total_amount, 2) }}</td>
                    <td style="padding: 1.25rem 1.5rem;">
                        @php
                            $statusStyles = [
                                'pending' => ['bg' => 'rgba(245, 158, 11, 0.08)', 'color' => '#f59e0b'],
                                'paid' => ['bg' => 'rgba(16, 185, 129, 0.08)', 'color' => '#10b981'],
                                'shipped' => ['bg' => 'rgba(59, 130, 246, 0.08)', 'color' => '#3b82f6'],
                                'completed' => ['bg' => 'rgba(139, 92, 246, 0.08)', 'color' => '#8b5cf6'],
                                'cancelled' => ['bg' => 'rgba(239, 68, 68, 0.08)', 'color' => '#ef4444']
                            ];
                            $style = $statusStyles[$order->status] ?? ['bg' => 'rgba(148, 163, 184, 0.08)', 'color' => '#94a3b8'];
                        @endphp
                        <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; color: var(--text-dim); font-size: 0.9rem; font-weight: 500;">{{ $order->created_at->format('M d, Y') }}</td>
                    <td style="padding: 1.25rem 1.5rem; text-align: right;">
                        <span style="font-weight: 600; color: var(--secondary); font-size: 0.95rem;">{{ $order->items->first()?->product?->store?->name ?? 'System' }}</span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        </div>
        <div style="margin-top: 2rem;">
            {{ $orders->withQueryString()->links() }}
        </div>
    </div>
</section>
@endsection
