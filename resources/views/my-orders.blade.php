@extends('layouts.dashboard')

@section('title', 'My Orders - ElitePC')

@section('content')
<section>
    <div style="margin-bottom: 4rem;">
        <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">My <span class="text-gradient">Orders</span></h1>
        <p style="opacity: 0.5;">Tracking your hardware purchases and fulfillment status.</p>
    </div>

    <div class="glass-card" style="padding: 2.5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem;">Acquisition History</h3>
            <div class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; opacity: 0.5;">REAL-TIME TRACKING</div>
        </div>
        
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0 1rem; text-align: left; min-width: 900px;">
                <thead>
                    <tr style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; text-transform: uppercase;">
                        <th style="padding: 1rem 1.5rem;">ORDER REFERENCE</th>
                        <th style="padding: 1rem 1.5rem;">HARDWARE COMPONENTS</th>
                        <th style="padding: 1rem 1.5rem;">INVESTMENT</th>
                        <th style="padding: 1rem 1.5rem;">FULFILLMENT</th>
                        <th style="padding: 1rem 1.5rem;">TIMESTAMP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr class="glass" style="border-radius: 20px; transition: 0.3s;" onmouseover="this.style.transform='translateY(-3px)'" onmouseout="this.style.transform='translateY(0)'">
                        <td style="padding: 2rem 1.5rem; font-weight: 900; color: var(--primary); font-family: 'Outfit'; font-size: 1.1rem; border-radius: 20px 0 0 20px;">#EPC-{{ $order->id }}</td>
                        <td style="padding: 2rem 1.5rem;">
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                @foreach($order->items as $item)
                                    <div style="display: flex; align-items: center; gap: 0.8rem;">
                                        <div style="width: 8px; height: 8px; background: var(--secondary); border-radius: 50%;"></div>
                                        <span style="font-weight: 700; font-size: 0.95rem;">{{ $item->product->name }}</span>
                                        <span style="opacity: 0.5; font-weight: 800; font-size: 0.7rem;">x{{ $item->quantity }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                        <td style="padding: 2rem 1.5rem; font-weight: 900; font-size: 1.2rem; font-family: 'Outfit';">${{ number_format($order->total_amount, 2) }}</td>
                        <td style="padding: 2rem 1.5rem;">
                            @php
                                $statusColors = [
                                    'pending' => ['#f59e0b', 'rgba(245, 158, 11, 0.1)'],
                                    'paid' => ['#10b981', 'rgba(16, 185, 129, 0.1)'],
                                    'shipped' => ['#3b82f6', 'rgba(59, 130, 246, 0.1)'],
                                    'completed' => ['#8b5cf6', 'rgba(139, 92, 246, 0.1)'],
                                    'cancelled' => ['#ef4444', 'rgba(239, 68, 68, 0.1)']
                                ];
                                $config = $statusColors[$order->status] ?? ['#94a3b8', 'rgba(148, 163, 184, 0.1)'];
                            @endphp
                            <span style="font-weight: 800; font-size: 0.7rem; color: {{ $config[0] }}; text-transform: uppercase; letter-spacing: 1px; background: {{ $config[1] }}; padding: 0.5rem 1.2rem; border-radius: 50px; border: 1px solid {{ $config[0] }}44;">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td style="padding: 2rem 1.5rem; opacity: 0.5; font-weight: 700; border-radius: 0 20px 20px 0;">{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                    @if($orders->isEmpty())
                    <tr>
                        <td colspan="5" style="padding: 8rem; text-align: center;">
                            <div style="opacity: 0.2; font-size: 4rem; margin-bottom: 1.5rem;">📦</div>
                            <p style="opacity: 0.5; font-size: 1.1rem; font-weight: 700;">No acquisitions recorded in your history.</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
