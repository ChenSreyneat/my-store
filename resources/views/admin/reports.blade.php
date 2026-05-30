@extends('layouts.dashboard')

@section('title', 'Reports & Analysis - Admin')

@section('content')
<section style="padding-bottom: 5rem; background: var(--bg);">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 4rem; display: flex; justify-content: space-between; align-items: center;" class="header-stack">
        <div>
            <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; font-family: 'Outfit'; color: var(--text); letter-spacing: -1.5px; margin-bottom: 0.5rem; line-height: 1.2;">
                Business <span class="text-gradient">Intelligence</span>
            </h1>
            <p style="color: var(--text-dim); font-size: 1rem; font-weight: 500;">Real-time platform-wide data analysis and performance tracking.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: rgba(99,102,241,0.2); background: rgba(99,102,241,0.03);">
            REPORTS HUB
        </div>
    </div>

    <!-- Premium Stat Cards -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
        
        <!-- Total Revenue -->
        <div class="glass-card" style="padding: 1.75rem 2rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); display: flex; align-items: center; gap: 1.5rem; transition: var(--transition);">
            <div style="width: 54px; height: 54px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: rgba(99, 102, 241, 0.08); color: #6366f1;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1;">
                    ${{ number_format($monthlyRevenue->sum('total'), 2) }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Total Revenue</div>
            </div>
        </div>

        <!-- Successful Orders -->
        <div class="glass-card" style="padding: 1.75rem 2rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); display: flex; align-items: center; gap: 1.5rem; transition: var(--transition);">
            <div style="width: 54px; height: 54px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: rgba(16, 185, 129, 0.08); color: #10b981;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1;">
                    {{ $orderStats->where('status', 'paid')->first()->count ?? 0 }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Paid Orders</div>
            </div>
        </div>

        <!-- Pending Orders -->
        <div class="glass-card" style="padding: 1.75rem 2rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); display: flex; align-items: center; gap: 1.5rem; transition: var(--transition);">
            <div style="width: 54px; height: 54px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: rgba(245, 158, 11, 0.08); color: #f59e0b;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1; color: #eab308;">
                    {{ $orderStats->where('status', 'pending')->first()->count ?? 0 }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Pending Orders</div>
            </div>
        </div>

        <!-- Total Products -->
        <div class="glass-card" style="padding: 1.75rem 2rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); display: flex; align-items: center; gap: 1.5rem; transition: var(--transition);">
            <div style="width: 54px; height: 54px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: rgba(6, 182, 212, 0.08); color: #06b6d4;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.6rem; font-weight: 900; font-family: 'Outfit'; color: var(--text); line-height: 1.1;">
                    {{ \App\Models\Product::count() }}
                </div>
                <div style="font-size: 0.8rem; font-weight: 600; color: var(--text-dim); margin-top: 0.2rem;">Active Products</div>
            </div>
        </div>

    </div>

    <!-- Charts and Best Sellers -->
    <div class="grid-split" style="margin-bottom: 4rem;">
        <!-- Revenue Chart -->
        <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03); display: flex; flex-direction: column;">
            <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Revenue Growth</h3>
            <div style="position: relative; width: 100%; height: 300px; flex: 1;">
                <canvas id="revenueChart"></canvas>
            </div>
        </div>

        <!-- Top Products -->
        <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
            <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Best Sellers</h3>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($topProducts as $tp)
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid rgba(15, 23, 42, 0.03);">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; overflow: hidden; background: var(--bg); display: flex; align-items: center; justify-content: center; border: 1px solid rgba(15, 23, 42, 0.05);">
                            <img src="{{ ($tp->product->image_url ?? '') ?: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=100' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 0.95rem; color: var(--text);">{{ $tp->product->name ?? 'Deleted Product' }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-dim); margin-top: 0.15rem;">{{ $tp->total_sold }} units sold</div>
                        </div>
                    </div>
                    <div style="font-weight: 900; font-family: 'Outfit'; color: var(--primary); font-size: 1.1rem;">${{ number_format(($tp->product->price ?? 0) * $tp->total_sold, 2) }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Store Performance -->
    <div class="glass-card" style="padding: 2.5rem; background: #ffffff; border-color: rgba(15, 23, 42, 0.05); box-shadow: 0 10px 30px -10px rgba(15, 23, 42, 0.03);">
        <h3 style="margin-bottom: 2rem; font-weight: 900; font-family: 'Outfit'; color: var(--text);">Store Performance</h3>
        <div class="table-container">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05);">
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Store</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Inventory</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px;">Total Revenue</th>
                        <th style="padding: 1.25rem 1.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; text-align: right;">Growth</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($storePerformance as $store)
                    <tr style="border-bottom: 1px solid rgba(15, 23, 42, 0.05); transition: background 0.3s;" onmouseover="this.style.background='rgba(15, 23, 42, 0.01)'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="font-weight: 700; font-size: 1.05rem; color: var(--text);">{{ $store->name }}</div>
                            <div style="font-size: 0.75rem; color: var(--text-dim); margin-top: 0.2rem;">{{ $store->email }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: var(--text); font-weight: 600;">
                            <span style="font-weight: 800; color: var(--primary);">{{ $store->products_count }}</span> <span style="opacity: 0.6; font-size: 0.85rem;">items</span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem;">
                            <div style="font-weight: 900; font-family: 'Outfit'; color: #10b981; font-size: 1.1rem;">${{ number_format($store->revenue, 2) }}</div>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; text-align: right;">
                            <div style="display: inline-flex; align-items: center; gap: 1rem; width: 150px; justify-content: flex-end;">
                                @php $percent = $monthlyRevenue->sum('total') > 0 ? ($store->revenue / $monthlyRevenue->sum('total')) * 100 : 0; @endphp
                                <span style="font-size: 0.8rem; font-weight: 800; color: var(--text-dim);">{{ number_format($percent, 1) }}%</span>
                                <div style="width: 100px; height: 8px; background: var(--bg); border-radius: 10px; overflow: hidden; border: 1px solid rgba(15, 23, 42, 0.05);">
                                    <div style="width: {{ $percent }}%; height: 100%; background: linear-gradient(to right, var(--primary), var(--secondary));"></div>
                                </div>
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
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const revenueGrad = ctx.createLinearGradient(0, 0, 0, 300);
        revenueGrad.addColorStop(0, 'rgba(99, 102, 241, 0.2)');
        revenueGrad.addColorStop(1, 'rgba(99, 102, 241, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
                datasets: [{
                    label: 'Revenue ($)',
                    data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                    borderColor: '#6366f1',
                    backgroundColor: revenueGrad,
                    borderWidth: 4,
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#6366f1',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { drawBorder: false, color: 'rgba(15,23,42,0.04)' },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#64748b' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: 'Inter', size: 10 }, color: '#64748b' }
                    }
                }
            }
        });
    });
</script>
@endsection
