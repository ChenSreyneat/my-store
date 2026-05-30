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
                <div class="favorite-card" style="width: 277.5px; height: 400px; background: #f3f4f6; border-radius: 16px; display: flex; flex-direction: column; position: relative; overflow: hidden; border: 1px solid #e5e7eb; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.02);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.06)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.02)';">
                    
                    <!-- Top Image Area -->
                    <div style="background: radial-gradient(circle at center, #ffffff 0%, #f9fafb 100%); height: 180px; position: relative; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid rgba(0,0,0,0.02);">
                        
                        <!-- Status Badge -->
                        <div style="position: absolute; top: 0.8rem; left: 0.8rem; background: white; padding: 0.4rem 0.8rem; border-radius: 50px; font-size: 0.7rem; font-weight: 700; color: {{ $btnColor }}; box-shadow: 0 2px 5px rgba(0,0,0,0.05); text-transform: uppercase; z-index: 10;">
                            {{ $order->status }}
                        </div>

                        <!-- Price Badge -->
                        <div style="position: absolute; top: 0; right: 0; background: #6366f1; color: white; font-weight: 800; font-size: 1rem; padding: 0.6rem 1.2rem; border-bottom-left-radius: 16px; box-shadow: -2px 2px 8px rgba(99, 102, 241, 0.2); z-index: 10;">
                            ${{ number_format($order->total_amount, 2) }}
                        </div>

                        @if($firstItem && $firstItem->product->images->first())
                            <img src="{{ $firstImg ? (str_starts_with($firstImg->image_url, 'http') ? $firstImg->image_url : asset('storage/'.$firstImg->image_url)) : 'https://placehold.co/200x200/F1F5F9/0F172A?text='.$order->items->first()->product->name }}" style="width: 100%; height: 100%; object-fit: cover; z-index: 1;">
                        @else
                            <div style="font-size: 3rem; z-index: 1;">📦</div>
                        @endif
                    </div>

                    <!-- Content Area -->
                    <div style="padding: 1rem 1.2rem; display: flex; flex-direction: column; flex: 1;">
                        
                        <div style="display: flex; flex-direction: column; margin-bottom: 1rem; flex: 1;">
                            
                            <h3 style="font-weight: 900; font-size: 1.1rem; color: #5a5ce6; margin-bottom: 0.3rem; line-height: 1.2;">Order #EPC-{{ $order->id }}</h3>
                            
                            <p style="font-size: 0.75rem; color: #64748b; margin-bottom: 0.8rem; line-height: 1.4;">
                                {{ $firstItem ? $firstItem->product->name : 'Unknown Item' }}
                                @if($order->items->count() > 1)
                                    <br><span style="font-size: 0.7rem; color: #94a3b8; font-weight: 600;">+ {{ $order->items->count() - 1 }} more items</span>
                                @endif
                            </p>

                            <!-- Metadata Area -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: auto; padding-top: 0.8rem; border-top: 1px solid #e2e8f0;">
                                <div>
                                    <div style="font-weight: 800; font-size: 0.6rem; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.1rem;">DATE</div>
                                    <div style="font-size: 0.7rem; color: #64748b;">{{ $order->created_at->format('M d, Y') }}</div>
                                </div>
                                <div>
                                    <div style="font-weight: 800; font-size: 0.6rem; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.1rem;">ITEMS</div>
                                    <div style="font-size: 0.7rem; color: #64748b;">{{ $order->items->sum('quantity') }} Units</div>
                                </div>
                            </div>
                        </div>

                        <div style="display: flex; gap: 0.5rem; margin-top: auto;">
                            <form action="{{ route('orders.destroy', $order) }}" method="POST" style="margin: 0; display: flex;">
                                @csrf @method('DELETE')
                                <button type="submit" style="width: 44px; background: #fee2e2; color: #ef4444; border: none; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'" title="Delete Order">
                                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                </button>
                            </form>
                            <button onclick="window.location.href='{{ route('order.success', $order) }}'" style="flex: 1; background: #6366f1; color: white; border: none; padding: 0.8rem; border-radius: 12px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1'">
                                VIEW DETAILS
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
