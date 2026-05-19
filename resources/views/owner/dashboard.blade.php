@extends('layouts.dashboard')

@section('title', 'Operations Hub - ElitePC')

@section('content')
<section style="padding-bottom: 5rem;">
    <!-- Strategic Header -->
    <div style="margin-bottom: 6rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(3rem, 7vw, 4.5rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -3px; line-height: 1; margin-bottom: 1.5rem;">Operations <span class="text-gradient">Command</span></h1>
            <p style="opacity: 0.6; font-size: 1.2rem; font-weight: 600; max-width: 600px;">Full-spectrum telemetry of your merchant node, inventory logistics, and acquisition status.</p>
        </div>
        <div class="glass" style="padding: 0.8rem 2rem; border-radius: 50px; font-size: 0.85rem; font-weight: 800; color: var(--primary); letter-spacing: 2px; border-color: rgba(99, 102, 241, 0.3);">
            NODE ID: #EPC-{{ Auth::user()->store_id }}
        </div>
    </div>
    
    <!-- Primary Telemetry Matrix -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(265px, 1fr)); gap: clamp(1rem, 2.5vw, 3rem); margin-bottom: 6rem;">
        <div class="glass-card" style="padding: 3rem; position: relative; overflow: hidden; border-radius: 40px;">
            <div style="position: absolute; top: -30px; right: -30px; width: 150px; height: 150px; background: var(--primary); opacity: 0.1; filter: blur(50px); border-radius: 50%;"></div>
            <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 900; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 2rem;">HARDWARE INVENTORY</div>
            <div style="display: flex; align-items: flex-end; gap: 1.5rem;">
                <div style="font-size: 4.5rem; font-weight: 900; font-family: 'Outfit'; line-height: 1; letter-spacing: -2px;">{{ $stats['products'] }}</div>
                <div style="color: #10b981; font-weight: 800; font-size: 1rem; margin-bottom: 0.8rem; display: flex; align-items: center; gap: 0.5rem;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3.5"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline><polyline points="17 6 23 6 23 12"></polyline></svg>
                    ACTIVE
                </div>
            </div>
        </div>

        <div class="glass-card" style="padding: 3rem; position: relative; overflow: hidden; border-radius: 40px;">
            <div style="position: absolute; top: -30px; right: -30px; width: 150px; height: 150px; background: #10b981; opacity: 0.1; filter: blur(50px); border-radius: 50%;"></div>
            <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 900; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 2rem;">TOTAL ACQUISITIONS</div>
            <div style="display: flex; align-items: flex-end; gap: 1.5rem;">
                <div style="font-size: 4.5rem; font-weight: 900; font-family: 'Outfit'; line-height: 1; letter-spacing: -2px;">{{ $stats['orders'] }}</div>
                <div style="color: #10b981; font-weight: 800; font-size: 1rem; margin-bottom: 0.8rem;">ORDERS</div>
            </div>
        </div>

        <div class="glass-card" style="padding: 3rem; position: relative; overflow: hidden; border-radius: 40px;">
            <div style="position: absolute; top: -30px; right: -30px; width: 150px; height: 150px; background: #f59e0b; opacity: 0.1; filter: blur(50px); border-radius: 50%;"></div>
            <div style="opacity: 0.5; font-size: 0.8rem; font-weight: 900; text-transform: uppercase; letter-spacing: 3px; margin-bottom: 2rem;">STOCK AGGREGATE</div>
            <div style="display: flex; align-items: flex-end; gap: 1.5rem;">
                <div style="font-size: 4.5rem; font-weight: 900; font-family: 'Outfit'; line-height: 1; letter-spacing: -2px;">{{ $stats['stock'] }}</div>
                <div style="color: #f59e0b; font-weight: 800; font-size: 1rem; margin-bottom: 0.8rem;">UNITS</div>
            </div>
        </div>
    </div>

    <!-- Operations & Logistics -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(285px, 1fr)); gap: clamp(1.5rem, 3.5vw, 4rem);">
        <!-- Recent Logistics Feed -->
        <div class="glass-card" style="padding: clamp(1.5rem, 5vw, 4rem); border-radius: 48px;">
            <div style="margin-bottom: 4rem;" class="flex-wrap-md">
                <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 2rem; letter-spacing: -1px;">Recent <span class="text-gradient">Acquisitions</span></h3>
                <a href="{{ route('owner.orders') }}" class="glass" style="padding: 0.8rem 1.5rem; border-radius: 12px; font-weight: 800; font-size: 0.8rem; text-decoration: none; letter-spacing: 1px; color: var(--primary);">VIEW ALL LOGS</a>
            </div>
            
            <div style="display: flex; flex-direction: column; gap: 2rem;">
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
                <div class="glass" style="padding: 2rem 2.5rem; border-radius: 28px; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1.5rem; transition: 0.3s; cursor: default;" onmouseover="this.style.background='rgba(255,255,255,0.03)'" onmouseout="this.style.background='transparent'">
                    <div style="display: flex; align-items: center; gap: 2rem; flex-wrap: wrap;">
                        <div style="width: 56px; height: 56px; background: rgba(255,255,255,0.05); border-radius: 16px; display: flex; align-items: center; justify-content: center; font-weight: 900; color: var(--primary); font-size: 1.1rem; border: 1px solid var(--glass-border);">
                            #{{ $order->id }}
                        </div>
                        <div>
                            <div style="font-weight: 900; font-size: 1.2rem; letter-spacing: -0.5px;">{{ $order->user->name }}</div>
                            <div style="font-size: 0.8rem; opacity: 0.5; font-weight: 700; text-transform: uppercase; margin-top: 0.3rem;">ACQUIRED {{ $order->created_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div style="text-align: right; min-width: 100px;">
                        <div style="font-weight: 900; font-family: 'Outfit'; color: var(--primary); font-size: 1.4rem; letter-spacing: -1px;">${{ number_format($ownerSubtotal, 2) }}</div>
                        <span style="display: inline-block; padding: 0.3rem 1rem; border-radius: 50px; font-size: 0.7rem; font-weight: 900; margin-top: 0.6rem; border: 1px solid {{ $order->status === 'paid' ? '#10b981' : '#f59e0b' }}; color: {{ $order->status === 'paid' ? '#10b981' : '#f59e0b' }};">
                            {{ strtoupper($order->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div style="text-align: center; padding: 5rem; opacity: 0.3; font-weight: 700; letter-spacing: 1px;">NO RECENT TELEMETRY DETECTED</div>
                @endforelse
            </div>
        </div>

        <!-- System Controls -->
        <div style="display: flex; flex-direction: column; gap: 3rem;">
            <div class="glass-card" style="padding: clamp(2rem, 5vw, 4rem); border-radius: 48px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, transparent 100%);">
                <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; margin-bottom: 2.5rem; letter-spacing: -0.5px;">Quick Actions</h3>
                <div style="display: flex; flex-direction: column; gap: 1.5rem;">
                    <a href="{{ route('owner.products') }}" class="btn btn-primary" style="justify-content: center; padding: 1.5rem; font-weight: 900; font-size: 1rem; border-radius: 20px; box-shadow: var(--primary-glow);">
                        <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        DEPLOY NEW HARDWARE
                    </a>
                    <a href="{{ route('owner.settings') }}" class="btn btn-outline" style="justify-content: center; padding: 1.5rem; font-weight: 900; font-size: 1rem; border-radius: 20px;">NODE CONFIGURATION</a>
                </div>
            </div>

            <div class="glass-card" style="padding: 3rem; border-radius: 40px; border-color: rgba(16, 185, 129, 0.4); background: rgba(16, 185, 129, 0.02);">
                <div style="display: flex; align-items: center; gap: 1.2rem; color: #10b981; margin-bottom: 2rem;">
                    <div style="width: 14px; height: 14px; background: #10b981; border-radius: 50%; box-shadow: 0 0 20px #10b981;"></div>
                    <span style="font-weight: 900; font-size: 0.9rem; letter-spacing: 3px;">NODE STATUS: OPTIMAL</span>
                </div>
                <p style="font-size: 1rem; opacity: 0.7; line-height: 1.7; font-weight: 500;">Hardware storefront is fully operational. All acquisition pipelines and inventory nodes are synchronized with the primary network.</p>
            </div>
        </div>
    </div>
</section>
@endsection
