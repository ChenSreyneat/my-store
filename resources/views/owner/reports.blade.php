@extends('layouts.dashboard')

@section('title', 'Reports - Owner')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif;">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.2;">
                Store Analytics 📊
            </h1>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Detailed performance tracking for your storefront inventory and sales.</p>
        </div>
    </div>

    <!-- Quick Stats -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        
        <!-- Store Earnings -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #eef2ff; color: #6366f1;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #1e293b; line-height: 1.1; margin-bottom: 0.2rem;">
                    ${{ number_format($monthlyRevenue->sum('total'), 2) }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Store Earnings</div>
            </div>
        </div>

        <!-- Inventory Size -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #ecfdf5; color: #10b981;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #1e293b; line-height: 1.1; margin-bottom: 0.2rem;">
                    {{ Auth::user()->store->products()->count() }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Active SKUs</div>
            </div>
        </div>

        <!-- Recent Sales -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #fff7ed; color: #f97316;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #1e293b; line-height: 1.1; margin-bottom: 0.2rem;">
                    {{ $recentOrders->count() }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Recent Sales</div>
            </div>
        </div>

    </div>

    <div class="grid-split" style="display: grid; grid-template-columns: 2fr 1fr; gap: 2rem; margin-bottom: 3rem;">
        <!-- Monthly Earnings Chart -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: flex; flex-direction: column;">
            <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Earnings Trend</h3>
            <div style="position: relative; width: 100%; height: 300px; flex: 1;">
                <canvas id="earningsChart"></canvas>
            </div>
        </div>

        <!-- Top Selling Items -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">My Top Items</h3>
            <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                @foreach($topProducts as $tp)
                <div style="display: flex; justify-content: space-between; align-items: center; padding-bottom: 1rem; border-bottom: 1px solid #f1f5f9;">
                    <div style="display: flex; align-items: center; gap: 1rem;">
                        <div style="width: 48px; height: 48px; border-radius: 12px; overflow: hidden; background: #f8fafc; display: flex; align-items: center; justify-content: center; border: 1px solid #e2e8f0;">
                            <img src="{{ $tp->product->image_url ?: 'https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=100' }}" style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 0.95rem; color: #1e293b;">{{ $tp->product->name }}</div>
                            <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.15rem;">{{ $tp->total_sold }} units</div>
                        </div>
                    </div>
                    <div style="font-weight: 800; color: #6366f1; font-size: 1.1rem;">${{ number_format($tp->product->price * $tp->total_sold, 2) }}</div>
                </div>
                @endforeach
                @if($topProducts->isEmpty())
                    <p style="color: #64748b; text-align: center; padding: 2rem; font-weight: 700;">No sales data yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Desktop Table View -->
    <div class="desktop-only" style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: none;">
        <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Recent Store Orders</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; min-width: 800px;">
                <thead>
                    <tr>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Order ID</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Customer</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Amount</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Status</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9; text-align: right;">Date</th>
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
                    <tr style="transition: background 0.3s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1.5rem; font-weight: 700; color: #1e293b; border-bottom: 1px solid #f1f5f9;">#{{ $order->id }}</td>
                        <td style="padding: 1.25rem 1.5rem; color: #1e293b; font-weight: 600; border-bottom: 1px solid #f1f5f9;">{{ $order->user->name }}</td>
                        <td style="padding: 1.25rem 1.5rem; font-weight: 800; color: #1e293b; border-bottom: 1px solid #f1f5f9;">${{ number_format($ownerSubtotal, 2) }}</td>
                        <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                            @php
                                $statusStyles = [
                                    'pending' => ['bg' => '#fef3c7', 'color' => '#d97706'],
                                    'paid' => ['bg' => '#d1fae5', 'color' => '#059669'],
                                    'shipped' => ['bg' => '#dbeafe', 'color' => '#2563eb'],
                                    'completed' => ['bg' => '#ede9fe', 'color' => '#7c3aed'],
                                    'cancelled' => ['bg' => '#fee2e2', 'color' => '#dc2626']
                                ];
                                $style = $statusStyles[$order->status] ?? ['bg' => '#f1f5f9', 'color' => '#64748b'];
                            @endphp
                            <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase; letter-spacing: 0.5px;">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.9rem; font-weight: 500; text-align: right; border-bottom: 1px solid #f1f5f9;">{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Mobile Stacked Card View -->
    <div class="mobile-only" style="display: none;">
        <div style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 2rem;">
            <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Recent Store Orders</h3>
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
                    $statusStyles = [
                        'pending' => ['bg' => '#fef3c7', 'color' => '#d97706'],
                        'paid' => ['bg' => '#d1fae5', 'color' => '#059669'],
                        'shipped' => ['bg' => '#dbeafe', 'color' => '#2563eb'],
                        'completed' => ['bg' => '#ede9fe', 'color' => '#7c3aed'],
                        'cancelled' => ['bg' => '#fee2e2', 'color' => '#dc2626']
                    ];
                    $style = $statusStyles[$order->status] ?? ['bg' => '#f1f5f9', 'color' => '#64748b'];
                @endphp
                <div style="background: #f8fafc; border-radius: 16px; padding: 1.5rem; border: 1px solid #f1f5f9;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                        <span style="font-weight: 800; color: #6366f1;">#{{ $order->id }}</span>
                        <span style="font-size: 0.75rem; color: #64748b; font-weight: 600;">{{ $order->created_at->format('M d, Y') }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #e2e8f0;">
                        <div>
                            <div style="font-weight: 700; font-size: 0.95rem; color: #1e293b;">{{ $order->user->name }}</div>
                            <div style="font-size: 0.75rem; color: #64748b; margin-top: 0.15rem;">Customer</div>
                        </div>
                        <div style="text-align: right;">
                            <span style="padding: 0.25rem 0.65rem; border-radius: 50px; font-size: 0.65rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase;">
                                {{ $order->status }}
                            </span>
                        </div>
                    </div>
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.5px; color: #64748b;">TOTAL AMOUNT</span>
                        <span style="font-weight: 800; font-size: 1.1rem; color: #1e293b;">${{ number_format($ownerSubtotal, 2) }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        @media (max-width: 992px) {
            .grid-split {
                grid-template-columns: 1fr !important;
            }
        }
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
    document.addEventListener("DOMContentLoaded", function() {
        const ctx = document.getElementById('earningsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthlyRevenue->pluck('month')) !!},
                datasets: [{
                    label: 'Earnings ($)',
                    data: {!! json_encode($monthlyRevenue->pluck('total')) !!},
                    backgroundColor: '#6366f1',
                    borderRadius: 8,
                    barThickness: 24
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
                        grid: { drawBorder: false, color: '#f1f5f9' },
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
