@extends('layouts.dashboard')

@section('title', 'Earnings - Owner')

@section('content')
<section style="padding-bottom: 5rem; font-family: 'Inter', sans-serif;">
    <!-- Cohesive Header -->
    <div style="margin-bottom: 3rem; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
        <div>
            <h1 style="font-size: 2.2rem; font-weight: 800; color: #1e293b; margin-bottom: 0.5rem; line-height: 1.2;">
                Store Earnings 💰
            </h1>
            <p style="color: #64748b; font-size: 1rem; margin: 0;">Managing your store's financial performance and revenue.</p>
        </div>
        <div style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 700; color: #6366f1; background: #eef2ff; border: 1px solid #e0e7ff; box-shadow: 0 2px 10px rgba(99,102,241,0.1);">
            STORE ID: #ST-{{ Auth::user()->store_id }}
        </div>
    </div>

    <!-- Primary Telemetry Matrix -->
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 2rem; margin-bottom: 4rem;">
        
        <!-- Total Store Earnings -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #ecfdf5; color: #10b981;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #10b981; line-height: 1.1; margin-bottom: 0.2rem;">
                    ${{ number_format($totalEarnings, 2) }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Total Store Earnings</div>
            </div>
        </div>

        <!-- Pending Payouts -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #fff7ed; color: #f97316;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #f97316; line-height: 1.1; margin-bottom: 0.2rem;">
                    $0.00
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Pending Payouts</div>
            </div>
        </div>

        <!-- Total Sales Count -->
        <div style="background: #ffffff; border-radius: 24px; padding: 2rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02); display: flex; align-items: center; gap: 1.5rem;">
            <div style="width: 56px; height: 56px; border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0; background: #eef2ff; color: #6366f1;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
            </div>
            <div>
                <div style="font-size: 1.8rem; font-weight: 800; color: #1e293b; line-height: 1.1; margin-bottom: 0.2rem;">
                    {{ $orders->count() }}
                </div>
                <div style="font-size: 0.85rem; font-weight: 600; color: #64748b;">Total Sales Count</div>
            </div>
        </div>

    </div>

    <!-- Desktop Table View -->
    <div class="desktop-only" style="background: #ffffff; border-radius: 24px; padding: 2.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 20px rgba(0,0,0,0.03); display: none;">
        <h3 style="margin-bottom: 2rem; font-weight: 800; font-size: 1.3rem; color: #1e293b; margin-top: 0;">Recent Successful Sales</h3>
        <div style="overflow-x: auto;">
            <table style="width: 100%; border-collapse: separate; border-spacing: 0; text-align: left; min-width: 800px;">
                <thead>
                    <tr>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Order ID</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Customer</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Amount</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Date</th>
                        <th style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.75rem; text-transform: uppercase; font-weight: 800; letter-spacing: 1px; border-bottom: 2px solid #f1f5f9;">Status</th>
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
                    <tr style="transition: background 0.3s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">
                        <td style="padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1rem; color: #1e293b; border-bottom: 1px solid #f1f5f9;">#EPC-{{ $order->id }}</td>
                        <td style="padding: 1.25rem 1.5rem; font-weight: 700; font-size: 1.05rem; color: #1e293b; border-bottom: 1px solid #f1f5f9;">{{ $order->user->name ?? 'Guest/Deleted' }}</td>
                        <td style="padding: 1.25rem 1.5rem; font-weight: 800; font-size: 1.1rem; color: #10b981; border-bottom: 1px solid #f1f5f9;">+ ${{ number_format($ownerSubtotal, 2) }}</td>
                        <td style="padding: 1.25rem 1.5rem; color: #64748b; font-size: 0.9rem; font-weight: 500; border-bottom: 1px solid #f1f5f9;">{{ $order->updated_at->format('M d, Y') }}</td>
                        <td style="padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9;">
                            <span style="padding: 0.35rem 0.8rem; border-radius: 50px; font-size: 0.72rem; font-weight: 800; background: #d1fae5; color: #059669; text-transform: uppercase; letter-spacing: 0.5px;">
                                COMPLETED
                            </span>
                        </td>
                    </tr>
                    @endforeach
                    @if($orders->isEmpty())
                    <tr>
                        <td colspan="5" style="padding: 6rem 1.5rem; text-align: center; color: #64748b; font-weight: 700; font-size: 0.95rem;">No successful transactions yet.</td>
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
            @endphp
            <div style="background: #ffffff; border-radius: 20px; padding: 1.5rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 15px rgba(0,0,0,0.02);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.25rem;">
                    <span style="font-weight: 800; font-size: 1.1rem; color: #1e293b;">#EPC-{{ $order->id }}</span>
                    <span style="opacity: 0.8; font-size: 0.8rem; font-weight: 600; color: #64748b;">{{ $order->updated_at->format('M d, Y') }}</span>
                </div>

                <div style="margin-bottom: 1.25rem; padding-bottom: 1.25rem; border-bottom: 1px solid #f1f5f9;">
                    <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.4rem;">CUSTOMER</div>
                    <div style="font-weight: 800; font-size: 1.05rem; color: #1e293b;">{{ $order->user->name ?? 'Guest/Deleted' }}</div>
                </div>

                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <div>
                        <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.2rem;">AMOUNT</div>
                        <div style="font-weight: 800; font-size: 1.15rem; color: #10b981;">+ ${{ number_format($ownerSubtotal, 2) }}</div>
                    </div>
                    <div style="text-align: right;">
                        <div style="color: #64748b; font-size: 0.7rem; font-weight: 700; letter-spacing: 1px; margin-bottom: 0.2rem;">STATUS</div>
                        <span style="display: inline-block; padding: 0.25rem 0.65rem; border-radius: 50px; font-size: 0.65rem; font-weight: 800; background: #d1fae5; color: #059669; text-transform: uppercase;">
                            COMPLETED
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
            @if($orders->isEmpty())
            <div style="background: #ffffff; border-radius: 20px; padding: 4rem 1.5rem; text-align: center; color: #64748b; font-weight: 700; border: 1px solid #f1f5f9;">No successful transactions yet.</div>
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

