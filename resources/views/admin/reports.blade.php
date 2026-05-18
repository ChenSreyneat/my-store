@extends('layouts.dashboard')

@section('title', 'Reports & Analysis - Admin')

@section('content')
<section>
    <div style="margin-bottom: 4rem;">
        <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">Business <span class="text-gradient">Intelligence</span></h1>
        <p style="opacity: 0.5;">Real-time platform-wide data analysis and performance tracking.</p>
    </div>

    <!-- Quick Stats -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 2rem; margin-bottom: 4rem;">
        <div class="glass" style="padding: 2rem; border-radius: 24px;">
            <div style="font-size: 0.8rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; margin-bottom: 0.5rem;">Total Revenue</div>
            <div style="font-size: 2rem; font-weight: 900;" class="text-gradient">${{ number_format($monthlyRevenue->sum('total'), 2) }}</div>
        </div>
        <div class="glass" style="padding: 2rem; border-radius: 24px;">
            <div style="font-size: 0.8rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; margin-bottom: 0.5rem;">Successful Orders</div>
            <div style="font-size: 2rem; font-weight: 900;">{{ $orderStats->where('status', 'paid')->first()->count ?? 0 }}</div>
        </div>
        <div class="glass" style="padding: 2rem; border-radius: 24px;">
            <div style="font-size: 0.8rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; margin-bottom: 0.5rem;">Pending Orders</div>
            <div style="font-size: 2rem; font-weight: 900; color: #eab308;">{{ $orderStats->where('status', 'pending')->first()->count ?? 0 }}</div>
        </div>
        <div class="glass" style="padding: 2rem; border-radius: 24px;">
            <div style="font-size: 0.8rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; margin-bottom: 0.5rem;">Total Products</div>
            <div style="font-size: 2rem; font-weight: 900;">{{ \App\Models\Product::count() }}</div>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 2fr 1.2fr; gap: 3rem; margin-bottom: 4rem;">
        <!-- Revenue Chart -->
        <div class="glass" style="padding: 3rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Revenue Growth</h3>
            <canvas id="revenueChart" height="300"></canvas>
        </div>

        <!-- Top Products -->
        <div class="glass" style="padding: 3rem; border-radius: 40px;">
            <h3 style="margin-bottom: 2rem; font-weight: 800;">Best Sellers</h3>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($topProducts as $tp)
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; overflow: hidden; background: var(--bg);">
                            <img src="{{ $tp->product->image_url ?: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=100' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 0.9rem;">{{ $tp->product->name }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.5;">{{ $tp->total_sold }} units sold</div>
                        </div>
                    </div>
                    <div style="font-weight: 800; color: var(--primary);">${{ number_format($tp->product->price * $tp->total_sold, 2) }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Store Performance -->
    <div class="glass" style="padding: 3rem; border-radius: 40px;">
        <h3 style="margin-bottom: 2rem; font-weight: 800;">Store Performance</h3>
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Store</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Inventory</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Total Revenue</th>
                        <th style="padding: 1.5rem; opacity: 0.5; font-size: 0.8rem; text-transform: uppercase;">Growth</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($storePerformance as $store)
                    <tr style="border-bottom: 1px solid var(--glass-border);">
                        <td style="padding: 1.5rem;">
                            <div style="font-weight: 700;">{{ $store->name }}</div>
                            <div style="font-size: 0.75rem; opacity: 0.5;">{{ $store->email }}</div>
                        </td>
                        <td style="padding: 1.5rem;">
                            <span style="font-weight: 700;">{{ $store->products_count }}</span> <span style="opacity: 0.5;">items</span>
                        </td>
                        <td style="padding: 1.5rem;">
                            <div style="font-weight: 800; color: #10b981;">${{ number_format($store->revenue, 2) }}</div>
                        </td>
                        <td style="padding: 1.5rem;">
                            <div style="width: 100px; height: 8px; background: var(--bg); border-radius: 10px; overflow: hidden;">
                                @php $percent = $monthlyRevenue->sum('total') > 0 ? ($store->revenue / $monthlyRevenue->sum('total')) * 100 : 0; @endphp
                                <div style="width: {{ $percent }}%; height: 100%; background: var(--primary);"></div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
            datasets: [{
                label: 'Revenue ($)',
                data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                borderWidth: 4,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#6366f1',
                pointRadius: 6
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
