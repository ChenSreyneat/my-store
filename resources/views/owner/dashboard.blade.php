@extends('layouts.dashboard')

@section('title', 'Store Overview - ElitePC')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif;">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.2;">
                Store Overview ✨
            </h1>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Welcome back! Here's what's happening with your store today.</p>
        </div>
        <div style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: #6366f1; background: #eef2ff; border: 1px solid #e0e7ff; box-shadow: 0 2px 10px rgba(99,102,241,0.1);">
            Store ID: #{{ Auth::user()->store_id }}
        </div>
    </div>
    
    <!-- Primary Metrics -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 4rem;">
        
        <!-- Hardware Inventory -->
        <div style="background: #ffffff; border-radius: 20px; padding: 1.8rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem; transition: 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.04)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.02)';">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #eef2ff; color: #6366f1;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #0f172a; line-height: 1;">
                    {{ $stats['products'] }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b; margin-top: 0.4rem;">Active Products</div>
            </div>
        </div>

        <!-- Total Orders -->
        <div style="background: #ffffff; border-radius: 20px; padding: 1.8rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem; transition: 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.04)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.02)';">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #ecfdf5; color: #10b981;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #0f172a; line-height: 1;">
                    {{ $stats['orders'] }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b; margin-top: 0.4rem;">Total Orders</div>
            </div>
        </div>

        <!-- Stock Aggregate -->
        <div style="background: #ffffff; border-radius: 20px; padding: 1.8rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem; transition: 0.3s;" onmouseover="this.style.transform='translateY(-3px)'; this.style.boxShadow='0 10px 25px rgba(0,0,0,0.04)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.02)';">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #fff7ed; color: #f97316;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line><line x1="15" y1="3" x2="15" y2="21"></line><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #0f172a; line-height: 1;">
                    {{ $stats['stock'] }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b; margin-top: 0.4rem;">Units in Stock</div>
            </div>
        </div>

    </div>

    <!-- Operations & Logistics -->
    <div style="display: grid; grid-template-columns: 1fr; gap: 2rem; @media(min-width: 992px) { grid-template-columns: 2fr 1fr; }">
        <!-- Recent Orders -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                <h3 style="font-weight: 800; font-size: 1.3rem; color: #1e293b; margin: 0;">Recent Orders</h3>
                <a href="{{ route('owner.orders') }}" style="text-decoration: none; padding: 0.6rem 1.2rem; font-size: 0.85rem; border-radius: 50px; font-weight: 700; color: #6366f1; background: #f8fafc; border: 1px solid #e2e8f0; transition: 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">View All</a>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 1rem;">
                @forelse($recentOrders as $order)
                @php
                    $storeId = Auth::user()->store_id;
                    $ownerItems = $order->items->filter(function($item) use ($storeId) {
                        return $item->product->store_id == $storeId;
                    });
                    $ownerSubtotal = $ownerItems->sum(function($item) {
                        return $item->price * $item->quantity;
                    });
                @endphp
                <div style="padding: 1.25rem 1.5rem; border-radius: 16px; display: flex; justify-content: space-between; align-items: center; gap: 1.5rem; background: #f8fafc; border: 1px solid #f1f5f9; transition: 0.3s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">
                    <div style="display: flex; align-items: center; gap: 1.25rem;">
                        <div style="width: 48px; height: 48px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: 800; color: #6366f1; font-size: 0.95rem; box-shadow: 0 2px 8px rgba(0,0,0,0.04);">
                            #{{ $order->id }}
                        </div>
                        <div>
                            <div style="font-weight: 700; font-size: 1rem; color: #1e293b; margin-bottom: 0.2rem;">{{ $order->user->name }}</div>
                            <div style="font-size: 0.8rem; color: #64748b; font-weight: 500;">Ordered {{ $order->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <div style="font-weight: 800; color: #0f172a; font-size: 1.15rem; margin-bottom: 0.4rem;">${{ number_format($ownerSubtotal, 2) }}</div>
                        @php
                            $statusStyles = [
                                'pending' => ['bg' => '#fef3c7', 'color' => '#d97706'],
                                'paid' => ['bg' => '#d1fae5', 'color' => '#059669'],
                                'shipped' => ['bg' => '#dbeafe', 'color' => '#2563eb'],
                                'completed' => ['bg' => '#ede9fe', 'color' => '#7c3aed'],
                                'cancelled' => ['bg' => '#fee2e2', 'color' => '#dc2626']
                            ];
                            $style = $statusStyles[$order->status] ?? ['bg' => '#f1f5f9', 'color' => '#475569'];
                        @endphp
                        <span style="display: inline-block; padding: 0.3rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>
                @empty
                <div style="text-align: center; padding: 3rem; background: #f8fafc; border-radius: 16px;">
                    <div style="font-size: 3rem; margin-bottom: 1rem; opacity: 0.5;">📋</div>
                    <div style="color: #64748b; font-weight: 600;">No recent orders found.</div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- System Controls -->
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
                <h3 style="font-weight: 800; font-size: 1.2rem; margin-bottom: 1.5rem; color: #1e293b; margin-top: 0;">Quick Actions</h3>
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <a href="{{ route('owner.products') }}" style="display: flex; align-items: center; justify-content: center; gap: 0.5rem; padding: 1rem; font-weight: 700; font-size: 0.95rem; border-radius: 50px; background: #6366f1; color: white; text-decoration: none; box-shadow: 0 4px 15px rgba(99,102,241,0.3); transition: 0.2s;" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1'">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        Add New Product
                    </a>
                    <a href="{{ route('owner.settings') }}" style="display: flex; align-items: center; justify-content: center; padding: 1rem; font-weight: 700; font-size: 0.95rem; border-radius: 50px; background: #f8fafc; color: #475569; text-decoration: none; border: 1px solid #e2e8f0; transition: 0.2s;" onmouseover="this.style.background='#f1f5f9'" onmouseout="this.style.background='#f8fafc'">Store Settings</a>
                </div>
            </div>

            <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #d1fae5; box-shadow: 0 4px 20px rgba(0,0,0,0.03); position: relative; overflow: hidden;">
                <div style="position: absolute; top: -20px; right: -20px; width: 100px; height: 100px; background: #ecfdf5; border-radius: 50%; opacity: 0.5;"></div>
                
                <div style="display: flex; align-items: center; gap: 0.8rem; color: #059669; margin-bottom: 1rem; position: relative; z-index: 1;">
                    <div style="width: 12px; height: 12px; background: #10b981; border-radius: 50%; box-shadow: 0 0 10px rgba(16,185,129,0.5);"></div>
                    <span style="font-weight: 800; font-size: 0.85rem; letter-spacing: 1px;">STORE ACTIVE</span>
                </div>
                <p style="font-size: 0.9rem; color: #475569; line-height: 1.6; font-weight: 500; margin: 0; position: relative; z-index: 1;">Your storefront is fully operational. Inventory and orders are syncing correctly.</p>
            </div>
        </div>
    </div>
</section>
@endsection
