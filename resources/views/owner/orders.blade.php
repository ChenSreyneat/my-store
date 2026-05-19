@extends('layouts.dashboard')

@section('title', 'Logistics & Orders - Owner')

@section('content')
<section style="padding-bottom: 5rem;">
    <!-- Strategic Header -->
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">Acquisition <span class="text-gradient">Logistics</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Monitor platform-wide hardware acquisitions and manage fulfillment protocols.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">
            TOTAL ORDERS: {{ $orders->count() }}
        </div>
    </div>

    @if($editingOrder)
        <!-- Fulfillment Calibration Console -->
        <div class="glass-card" style="padding: 3.5rem; border-radius: 40px; margin-bottom: 4rem; border-color: var(--secondary); background: rgba(var(--secondary-rgb), 0.05);">
            <h3 style="margin-bottom: 2.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; letter-spacing: -0.5px; color: var(--secondary);">Calibrate Fulfillment #EPC-{{ $editingOrder->id }}</h3>
            <form action="{{ route('owner.orders.update', $editingOrder->id) }}" method="POST" style="display: flex; gap: 2.5rem; align-items: end; flex-wrap: wrap;">
                @csrf
                @method('PUT')
                
                <div style="display: flex; flex-direction: column; gap: 0.8rem; flex: 1; min-width: 300px;">
                    <label style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.6; color: var(--secondary);">FULFILLMENT STATUS</label>
                    <select name="status" required style="background: rgba(255,255,255,0.05); border: 1px solid rgba(var(--secondary-rgb), 0.3); padding: 1.2rem; border-radius: 16px; color: var(--text); width: 100%; cursor: pointer;">
                        <option value="pending" {{ $editingOrder->status == 'pending' ? 'selected' : '' }}>Pending Protocol</option>
                        <option value="paid" {{ $editingOrder->status == 'paid' ? 'selected' : '' }}>Payment Verified</option>
                        <option value="shipped" {{ $editingOrder->status == 'shipped' ? 'selected' : '' }}>Hardware Dispatched</option>
                        <option value="completed" {{ $editingOrder->status == 'completed' ? 'selected' : '' }}>Acquisition Finalized</option>
                        <option value="cancelled" {{ $editingOrder->status == 'cancelled' ? 'selected' : '' }}>Protocol Aborted</option>
                    </select>
                </div>
                <div style="display: flex; gap: 1.5rem;">
                    <button type="submit" class="btn" style="padding: 1.2rem 3rem; background: var(--secondary); color: white; border: none; border-radius: 16px; font-weight: 900;">UPDATE LOGISTICS</button>
                    <a href="{{ route('owner.orders') }}" class="btn btn-outline" style="padding: 1.2rem 3rem; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-weight: 800;">CANCEL</a>
                </div>
            </form>
        </div>
    @endif

    <!-- Desktop Table View -->
    <div class="glass-card desktop-only" style="padding: 0; border-radius: 40px; overflow: hidden; display: none;">
        <div style="padding: 2.5rem 3.5rem; border-bottom: 1px solid var(--glass-border); background: rgba(255,255,255,0.02);">
            <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; letter-spacing: -0.5px;">Transaction <span class="text-gradient">Archive</span></h3>
        </div>
        <div class="table-responsive">
            <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background: rgba(255,255,255,0.01); border-bottom: 1px solid var(--glass-border);">
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">LOG ID</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">OPERATIVE (CUSTOMER)</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">ORDERED HARDWARE</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">ACQUISITION VALUE</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">PROTOCOL STATUS</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px;">TIMESTAMP</th>
                    <th style="padding: 2rem 3.5rem; opacity: 0.5; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 2px; text-align: right;">OPERATIONS</th>
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
                <tr style="border-bottom: 1px solid var(--glass-border); transition: 0.3s; {{ ($editingOrder && $editingOrder->id == $order->id) ? 'background: rgba(var(--secondary-rgb), 0.1);' : '' }}" onmouseover="this.style.background='rgba(255,255,255,0.02)'" onmouseout="this.style.background='{{ ($editingOrder && $editingOrder->id == $order->id) ? 'rgba(var(--secondary-rgb), 0.1)' : 'transparent' }}'">
                    <td style="padding: 2rem 3.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1rem; color: var(--primary);">#EPC-{{ $order->id }}</td>
                    <td style="padding: 2rem 3.5rem;">
                        <div style="font-weight: 800; font-size: 1.1rem; letter-spacing: -0.5px;">{{ $order->user->name }}</div>
                        <div style="font-size: 0.75rem; opacity: 0.4; font-weight: 700; margin-top: 0.3rem;">{{ $order->user->email }}</div>
                    </td>
                    <td style="padding: 2rem 3.5rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                            @foreach($ownerItems as $item)
                                <div style="font-size: 0.9rem; font-weight: 700; opacity: 0.8;">
                                    {{ $item->product->name }}
                                    <span style="color: var(--primary); font-weight: 900; margin-left: 0.4rem;">x{{ $item->quantity }}</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 2rem 3.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.2rem; color: var(--primary);">${{ number_format($ownerSubtotal, 2) }}</td>
                    <td style="padding: 2rem 3.5rem;">
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
                        <span style="display: inline-block; padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.7rem; font-weight: 900; border: 1px solid {{ $color }}; color: {{ $color }}; text-transform: uppercase; letter-spacing: 1px;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding: 2rem 3.5rem; opacity: 0.6; font-size: 0.9rem; font-weight: 600;">{{ $order->created_at->format('M d, Y') }}</td>
                    <td style="padding: 2rem 3.5rem; text-align: right;">
                        <a href="{{ route('owner.orders', ['edit' => $order->id]) }}" class="glass" style="padding: 0.8rem 1.5rem; border-radius: 12px; font-size: 0.75rem; font-weight: 900; text-decoration: none; color: var(--secondary); border-color: rgba(var(--secondary-rgb), 0.2);">CALIBRATE STATUS</a>
                    </td>
                </tr>
                @endforeach
                @if($orders->isEmpty())
                <tr>
                    <td colspan="7" style="padding: 8rem; text-align: center; opacity: 0.3; font-weight: 800; letter-spacing: 2px;">NO LOGISTICS DATA DETECTED</td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>

    <!-- Mobile Stacked Card View -->
    <div class="mobile-only" style="display: none;">
        <div style="display: flex; flex-direction: column; gap: 2rem;">
            @foreach($orders as $order)
            @php
                $storeId = Auth::user()->store_id;
                $ownerItems = $order->items->filter(function($item) use ($storeId) {
                    return $item->product->store_id == $storeId;
                });
                $ownerSubtotal = $ownerItems->sum(function($item) {
                    return $item->price * $item->quantity;
                });
                $statusColors = [
                    'pending' => '#f59e0b',
                    'paid' => '#10b981',
                    'shipped' => '#3b82f6',
                    'completed' => '#8b5cf6',
                    'cancelled' => '#ef4444'
                ];
                $color = $statusColors[$order->status] ?? '#94a3b8';
            @endphp
            <div class="glass-card" style="padding: 2.5rem; border-radius: 32px; position: relative;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <span style="font-weight: 900; font-family: 'Outfit'; font-size: 1.2rem; color: var(--primary);">#EPC-{{ $order->id }}</span>
                    <span style="opacity: 0.6; font-size: 0.8rem; font-weight: 600;">{{ $order->created_at->format('M d, Y') }}</span>
                </div>

                <div style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--glass-border);">
                    <div style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 1px; margin-bottom: 0.5rem;">OPERATIVE (CUSTOMER)</div>
                    <div style="font-weight: 800; font-size: 1.1rem; letter-spacing: -0.3px;">{{ $order->user->name }}</div>
                    <div style="font-size: 0.8rem; opacity: 0.5; font-weight: 600; word-break: break-all;">{{ $order->user->email }}</div>
                </div>

                <div style="margin-bottom: 1.5rem; padding-bottom: 1.5rem; border-bottom: 1px solid var(--glass-border);">
                    <div style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 1px; margin-bottom: 0.8rem;">ORDERED HARDWARE</div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        @foreach($ownerItems as $item)
                            <div style="font-size: 0.9rem; font-weight: 700; opacity: 0.8; display: flex; justify-content: space-between;">
                                <span>{{ $item->product->name }}</span>
                                <span style="color: var(--primary); font-weight: 900;">x{{ $item->quantity }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                    <div>
                        <div style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 1px; margin-bottom: 0.3rem;">ACQUISITION VALUE</div>
                        <div style="font-weight: 900; font-family: 'Outfit'; font-size: 1.3rem; color: var(--primary);">${{ number_format($ownerSubtotal, 2) }}</div>
                    </div>
                    <div>
                        <div style="opacity: 0.5; font-size: 0.75rem; font-weight: 800; letter-spacing: 1px; margin-bottom: 0.3rem; text-align: right;">STATUS</div>
                        <span style="display: inline-block; padding: 0.4rem 1.2rem; border-radius: 50px; font-size: 0.7rem; font-weight: 900; border: 1px solid {{ $color }}; color: {{ $color }}; text-transform: uppercase; letter-spacing: 1px;">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <div>
                    <a href="{{ route('owner.orders', ['edit' => $order->id]) }}" class="glass" style="display: flex; align-items: center; justify-content: center; padding: 1.2rem; border-radius: 16px; font-size: 0.85rem; font-weight: 900; text-decoration: none; color: var(--secondary); border-color: rgba(var(--secondary-rgb), 0.3); background: rgba(var(--secondary-rgb), 0.02);">CALIBRATE STATUS</a>
                </div>
            </div>
            @endforeach
            @if($orders->isEmpty())
            <div class="glass-card" style="padding: 5rem 3rem; text-align: center; opacity: 0.3; font-weight: 800; letter-spacing: 2px;">NO LOGISTICS DATA DETECTED</div>
            @endif
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
</section>
@endsection
