@extends('layouts.dashboard')

@section('title', 'My Reports - Owner')

@section('content')
<section>
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">Store <span class="text-gradient">Analytics</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Detailed performance tracking for your storefront inventory and sales.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            TELEMETRY: ACTIVE
        </div>
    </div>

    <!-- Quick Stats -->
    <div style="margin-bottom: 5rem;" class="grid-responsive">
        <div class="glass-card" style="padding: 2.5rem; border-radius: 32px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: var(--primary); opacity: 0.1; filter: blur(20px); border-radius: 50%;"></div>
            <div style="font-size: 0.75rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; letter-spacing: 2px; margin-bottom: 1rem;">Store Earnings</div>
            <div style="font-size: 2.5rem; font-weight: 900; font-family: 'Outfit';" class="text-gradient">${{ number_format($monthlyRevenue->sum('total'), 2) }}</div>
        </div>
        <div class="glass-card" style="padding: 2.5rem; border-radius: 32px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: #10b981; opacity: 0.1; filter: blur(20px); border-radius: 50%;"></div>
            <div style="font-size: 0.75rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; letter-spacing: 2px; margin-bottom: 1rem;">Inventory Size</div>
            <div style="font-size: 2.5rem; font-weight: 900; font-family: 'Outfit';">{{ Auth::user()->store->products()->count() }} <span style="font-size: 1rem; opacity: 0.4;">SKUs</span></div>
        </div>
        <div class="glass-card" style="padding: 2.5rem; border-radius: 32px; position: relative; overflow: hidden;">
            <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: #f59e0b; opacity: 0.1; filter: blur(20px); border-radius: 50%;"></div>
            <div style="font-size: 0.75rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; letter-spacing: 2px; margin-bottom: 1rem;">Recent Sales</div>
            <div style="font-size: 2.5rem; font-weight: 900; font-family: 'Outfit';">{{ $recentOrders->count() }}</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(285px, 1fr)); gap: clamp(1rem, 2.5vw, 3rem); margin-bottom: 4rem;">
        <!-- Monthly Earnings Chart -->
        <div class="glass" style="padding: 3rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Earnings Trend</h3>
            <canvas id="earningsChart" height="300"></canvas>
        </div>

        <!-- Top Selling Items -->
        <div class="glass" style="padding: 3rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">My Top Items</h3>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($topProducts as $tp)
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; overflow: hidden; background: var(--bg);">
                            <img src="{{ $tp->product->image_url ?: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=100' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 0.9rem;">{{ $tp->product->name }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.5;">{{ $tp->total_sold }} units</div>
                        </div>
                    </div>
                    <div style="font-weight: 800; color: var(--primary);">${{ number_format($tp->product->price * $tp->total_sold, 2) }}</div>
                </div>
                @endforeach
                @if($topProducts->isEmpty())
                    <p style="opacity: 0.5; text-align: center; padding: 2rem;">No sales data yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="glass desktop-only" style="padding: 3rem; border-radius: 40px; display: none;">
        <h3 style="margin-bottom: 2rem; font-weight: 800;">Recent Store Orders</h3>
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Order ID</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Customer</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Amount</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Status</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentOrders as $order)
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
                        <td style="padding: 1.5rem; font-weight: 700;">#{{ $order->id }}</td>
                        <td style="padding: 1.5rem;">{{ $order->user->name }}</td>
                        <td style="padding: 1.5rem; font-weight: 800;">${{ number_format($ownerSubtotal, 2) }}</td>
                        <td style="padding: 1.5rem;">
                            <span style="padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; background: {{ $order->status === 'paid' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(234, 179, 8, 0.1)' }}; color: {{ $order->status === 'paid' ? '#10b981' : '#eab308' }};">
                                {{ strtoupper($order->status) }}
                            </span>
                        </td>
                        <td style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem;">{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Stacked Card View -->
    <div class="mobile-only" style="display: none;">
        <div class="glass" style="padding: 2.5rem; border-radius: 40px; margin-bottom: 2rem;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Recent Store Orders</h3>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($recentOrders as $order)
                @php
                    $storeId = Auth::user()->store_id;
                    $ownerItems = $order->items->filter(function($item) use ($storeId) {
                        return $item->product->store_id == $storeId;
                    });
                    $ownerSubtotal = $ownerItems->sum(function($item) {
                        return $item->price * $item->quantity;
                    });
                @endphp
                <div class="glass-card" style="padding: 2rem; border-radius: 24px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.2rem;">
                        <span style="font-weight: 900; font-family: 'Outfit'; color: var(--primary);">#{{ $order->id }}</span>
                        <span style="opacity: 0.5; font-size: 0.75rem;">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                        <div>
                            <div style="font-weight: 800; font-size: 0.95rem;">{{ $order->user->name }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.4;">Customer</div>
                        </div>
                        <div style="text-align: right;">
                            <span style="padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.65rem; font-weight: 700; background: {{ $order->status === 'paid' ? 'rgba(16, 185, 129, 0.1)' : 'rgba(234, 179, 8, 0.1)' }}; color: {{ $order->status === 'paid' ? '#10b981' : '#eab308' }};">
                                {{ strtoupper($order->status) }}
                            </span>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.5px;">ACQUISITION VALUE</span>
                        <span style="font-weight: 900; font-family: 'Outfit'; font-size: 1.1rem; color: var(--primary);">${{ number_format($ownerSubtotal, 2) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        @media (min-width: 769px) {
            .desktop-only { display: block !important; }
            .mobile-only { display: none !important; }
        }
        @media (max-width: 768px) {
            .desktop-only { display: none !important; }
            .mobile-only { display: block !important; }
        }
    </style>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('earningsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
            datasets: [{
                label: 'Earnings ($)',
                data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                backgroundColor: '#6366f1',
                borderRadius: 10,
                barThickness: 30
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(255,255,255,0.05)' },
                    ticks: { color: 'rgba(255,255,255,0.5)' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: 'rgba(255,255,255,0.5)' }
                }
            }
        }
    });
</script>
@endsection
