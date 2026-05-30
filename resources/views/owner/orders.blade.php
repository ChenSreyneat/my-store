@extends('layouts.dashboard')

@section('title', 'Orders - Owner')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif;">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.2;">
                Store Orders 📦
            </h1>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Manage your customer orders and fulfillments.</p>
        </div>
        <div style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: #6366f1; background: #eef2ff; border: 1px solid #e0e7ff; box-shadow: 0 2px 10px rgba(99,102,241,0.1);">
            TOTAL ORDERS: {{ $orders->count() }}
        </div>
    </div>

    @if($editingOrder)
        <!-- Fulfillment Calibration Console -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #fdf2f8; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 3rem; background: #fffcfdf8;">
            <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Update Order #EPC-{{ $editingOrder->id }}</h3>
            <form action="{{ route('owner.orders.update', $editingOrder->id) }}" method="POST" style="display: flex; gap: 1.5rem; align-items: end; flex-wrap: wrap;">
                @csrf
                @method('PUT')
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem; flex: 1; min-width: 280px;">
                    <label style="font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b;">Order Status</label>
                    <select name="status" required style="padding: 0.8rem 1rem; border-radius: 12px; border: 1px solid #e2e8f0; font-size: 0.95rem; outline: none; transition: 0.2s; background: white;" onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236,72,153,0.1)'" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='none'">
                        <option value="pending" {{ $editingOrder->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $editingOrder->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="shipped" {{ $editingOrder->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="completed" {{ $editingOrder->status == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ $editingOrder->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div style="display: flex; gap: 1rem; align-items: flex-end;">
                    <button type="submit" style="padding: 0.8rem 1.8rem; border-radius: 50px; font-weight: 700; background: #ec4899; color: white; border: none; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 15px rgba(236,72,153,0.3);" onmouseover="this.style.background='#db2777'" onmouseout="this.style.background='#ec4899'">
                        Update Status
                    </button>
                    <a href="{{ route('owner.orders') }}" style="padding: 0.8rem 1.8rem; border-radius: 50px; font-weight: 700; color: #475569; background: #f1f5f9; text-decoration: none; border: 1px solid #e2e8f0; transition: 0.2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Cancel</a>
                </div>
            </form>
        </div>
    @endif

    <!-- Desktop Table View -->
    <div class="desktop-only" style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: none;">
        <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Order History</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; min-width: 800px;">
            <thead>
                <tr>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Order ID</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Customer</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Items</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Total</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Status</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Date</th>
                    <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9; text-align: right;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                @php
                    $storeId = Auth::user()->store_id;
                    $ownerItems = $order->items->filter(function($item) use ($storeId) {
                        return $item->product && $item->product->store_id == $storeId;
                    });
                    $ownerSubtotal = $ownerItems->sum(function($item) {
                        return $item->price * $item->quantity;
                    });
                @endphp
                <tr style="transition: background 0.3s; {{ ($editingOrder && $editingOrder->id == $order->id) ? 'background: #fdf2f8;' : '' }}" onmouseover="this.style.background='{{ ($editingOrder && $editingOrder->id == $order->id) ? '#fdf2f8' : '#f8fafc' }}'" onmouseout="this.style.background='{{ ($editingOrder && $editingOrder->id == $order->id) ? '#fdf2f8' : 'transparent' }}'">
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; font-weight: 700; font-size: 1rem; color: #1e293b;">#EPC-{{ $order->id }}</td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                        <div style="font-weight: 700; font-size: 1.05rem; color: #1e293b;">{{ $order->user->name ?? 'Guest/Deleted' }}</div>
                        <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.2rem;">{{ $order->user->email ?? 'N/A' }}</div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                        <div style="display: flex; flex-direction: column; gap: 0.25rem;">
                            @foreach($ownerItems as $item)
                                <div style="font-size: 0.9rem; font-weight: 700; color: #1e293b;">
                                    {{ $item->product->name ?? 'Deleted Product' }}
                                    <span style="color: #6366f1; font-weight: 800; margin-left: 0.25rem;">x{{ $item->quantity }}</span>
                                </div>
                            @endforeach
                        </div>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; font-weight: 800; font-size: 1.1rem; color: #0f172a;">${{ number_format($ownerSubtotal, 2) }}</td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
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
                        <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase; letter-spacing: 0.5px;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; color: #64748b; font-size: 0.9rem; font-weight: 500;">{{ $order->created_at->format('M d, Y') }}</td>
                    <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; text-align: right;">
                        <a href="{{ route('owner.orders', ['edit' => $order->id]) }}" style="padding: 0.5rem 1rem; font-size: 0.75rem; border-radius: 50px; font-weight: 700; color: #ec4899; background: #fdf2f8; border: 1px solid #fbcfe8; text-decoration: none; transition: 0.2s;" onmouseover="this.style.background='#fce7f3'" onmouseout="this.style.background='#fdf2f8'">Edit</a>
                    </td>
                </tr>
                @endforeach
                @if($orders->isEmpty())
                <tr>
                    <td colspan="7" style="padding: 6rem 1.5rem; text-align: center; color: #64748b; font-weight: 700; font-size: 0.95rem;">NO ORDERS FOUND</td>
                </tr>
                @endif
            </tbody>
        </table>
        </div>
    </div>

    <!-- Mobile Stacked Card View -->
    <div class="mobile-only" style="display: none;">
        <div style="display: flex; flex-direction: column; gap: 1.5rem;">
            @foreach($orders as $order)
            @php
                $storeId = Auth::user()->store_id;
                $ownerItems = $order->items->filter(function($item) use ($storeId) {
                    return $item->product && $item->product->store_id == $storeId;
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
                $style = $statusStyles[$order->status] ?? ['bg' => '#f1f5f9', 'color' => '#475569'];
            @endphp
            <div style="background: #ffffff; border-radius: 20px; padding: 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); position: relative;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <span style="font-weight: 800; font-size: 1.1rem; color: #1e293b;">#EPC-{{ $order->id }}</span>
                    <span style="opacity: 0.8; font-size: 0.8rem; font-weight: 600; color: #64748b;">{{ $order->created_at->format('M d, Y') }}</span>
                </div>

                <div style="margin-bottom: 1.25rem; padding-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9;">
                    <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.4rem;">CUSTOMER</div>
                    <div style="font-weight: 800; font-size: 1.05rem; color: #1e293b;">{{ $order->user->name ?? 'Guest/Deleted' }}</div>
                    <div style="font-size: 0.8rem; color: #64748b; margin-top: 0.1rem; word-break: break-all;">{{ $order->user->email ?? 'N/A' }}</div>
                </div>

                <div style="margin-bottom: 1.25rem; padding-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9;">
                    <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.6rem;">ITEMS</div>
                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                        @foreach($ownerItems as $item)
                            <div style="font-size: 0.9rem; font-weight: 700; color: #1e293b; display: flex; justify-content: space-between;">
                                <span>{{ $item->product->name ?? 'Deleted Product' }}</span>
                                <span style="color: #6366f1; font-weight: 800;">x{{ $item->quantity }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <div>
                        <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.2rem;">TOTAL</div>
                        <div style="font-weight: 800; font-size: 1.15rem; color: #0f172a;">${{ number_format($ownerSubtotal, 2) }}</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.2rem;">STATUS</div>
                        <span style="display: inline-block; padding: 0.25rem 0.65rem; border-radius: 50px; font-size: 0.65rem; font-weight: 800; background: {{ $style['bg'] }}; color: {{ $style['color'] }}; text-transform: uppercase;">
                            {{ $order->status }}
                        </span>
                    </div>
                </div>

                <div>
                    <a href="{{ route('owner.orders', ['edit' => $order->id]) }}" style="width: 100%; display: flex; align-items: center; justify-content: center; padding: 0.6rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; color: #ec4899; background: #fdf2f8; border: 1px solid #fbcfe8; text-decoration: none; transition: 0.2s;" onmouseover="this.style.background='#fce7f3'" onmouseout="this.style.background='#fdf2f8'">Edit</a>
                </div>
            </div>
            @endforeach
            @if($orders->isEmpty())
            <div style="background: #ffffff; border-radius: 20px; padding: 4rem 1.5rem; text-align: center; color: #64748b; font-weight: 700; border: 1px solid #f1f5f9;">NO ORDERS FOUND</div>
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
    </style>
</section>
@endsection
