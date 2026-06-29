@extends('layouts.dashboard')

@section('title', 'My Orders - ElitePC')

@section('content')
<section style="font-family: 'Inter', sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
            Acquisition History 📦
        </h1>
        

    </div>

    @if($orders->isEmpty())
        <div style="background: white; border-radius: 24px; padding: 5rem 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="font-size: 4rem; margin-bottom: 1.5rem; opacity: 0.2;">📦</div>
            <h3 style="color: #475569; font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">No acquisitions recorded in your history</h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 2rem;">Start exploring to add items to your collection.</p>
        </div>
    @else
        <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
            @php
                $statusColors = [
                    'pending' => '#f59e0b',
                    'paid' => '#10b981',
                    'shipped' => '#3b82f6',
                    'completed' => '#8b5cf6',
                    'cancelled' => '#ef4444'
                ];
            @endphp
            @foreach($orders as $order)
                @php 
                    $btnColor = $statusColors[$order->status] ?? '#64748b';
                    $firstItem = $order->items->first();
                    $firstImg = $firstItem ? $firstItem->product->images->first() : null;
                @endphp
                <div class="product-card" style="width: 277.5px; background: white; border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; display: flex; flex-direction: column; transition: box-shadow 0.2s; height: 400px;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.05)'" onmouseout="this.style.boxShadow='none'">
                    <!-- Top Image Area -->
                    <div style="position: relative; padding: 2rem 1rem; display: flex; justify-content: center; align-items: center; height: 200px;">
                        <!-- Status Badge -->
                        <div style="position: absolute; top: 0.8rem; left: 0.8rem; background: white; padding: 0.2rem 0.6rem; border-radius: 4px; font-size: 0.7rem; font-weight: 700; color: {{ $btnColor }}; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-transform: uppercase; z-index: 10; border: 1px solid #e5e7eb;">
                            {{ $order->status }}
                        </div>
                        <a href="{{ route('order.success', $order) }}" style="display: block; width: 100%; height: 100%;">
                            @if($firstItem && $firstItem->product->images->first())
                                <img src="{{ $firstImg ? (str_starts_with($firstImg->image_url, 'http') ? $firstImg->image_url : asset('storage/'.$firstImg->image_url)) : 'https://placehold.co/200x200/F1F5F9/0F172A?text='.$order->items->first()->product->name }}" style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: contain; z-index: 1;">
                            @else
                                <div style="font-size: 3rem; display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; z-index: 1;">📦</div>
                            @endif
                        </a>
                    </div>

                    <!-- Content Area -->
                    <div style="padding: 1.5rem; display: flex; flex-direction: column; flex: 1;">
                        <div style="color: #6b7280; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.4rem;">
                            {{ $order->created_at->format('M d, Y') }} &bull; {{ $order->items->sum('quantity') }} Items
                        </div>
                        
                        <a href="{{ route('order.success', $order) }}" style="color: #111827; font-weight: 700; font-size: 1.1rem; text-decoration: none; margin-bottom: 0.8rem; line-height: 1.3;">
                            Order #EPC-{{ $order->id }}
                        </a>
                        
                        <div style="color: #0056b3; font-weight: 800; font-size: 1.2rem; margin-bottom: 1rem;">
                            NPR {{ number_format($order->total_amount, 2) }}
                        </div>

                        <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center;">
                            <button onclick="window.location.href='{{ route('order.success', $order) }}'" style="background: #0056b3; color: white; border: none; padding: 0.7rem 1.2rem; border-radius: 4px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; cursor: pointer; transition: 0.2s; flex: 1; margin-right: 0.5rem;" onmouseover="this.style.background='#004494'" onmouseout="this.style.background='#0056b3'">
                                VIEW DETAILS
                            </button>
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" style="margin: 0; display: flex;">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: none; border: 1px solid #e5e7eb; color: #ef4444; width: 40px; height: 40px; border-radius: 4px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;" onmouseover="this.style.borderColor='#ef4444'; this.style.color='#dc2626'" onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#ef4444'" title="Delete Order">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
