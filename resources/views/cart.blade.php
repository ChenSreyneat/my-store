@extends('layouts.main')

@section('title', 'Your Cart - ElitePC')

@section('content')
<section style="padding: 10rem 0 6rem 0;">
    <div class="container">
        <h1 style="font-size: clamp(2.5rem, 6vw, 3rem); font-weight: 800; margin-bottom: 4rem; font-family: 'Outfit';">Shopping <span class="text-gradient">Cart</span></h1>

        @if($cartItems->isEmpty())
        <div class="glass-card animate-fade-in" style="padding: 10rem 2rem; text-align: center;">
            <div style="font-size: 5rem; margin-bottom: 2rem; opacity: 0.1;">🛒</div>
            <h3 style="opacity: 0.5; font-size: 1.5rem; font-weight: 800;">Your hardware reservoir is empty.</h3>
            <p style="opacity: 0.4; margin-bottom: 3rem;">Construct your ultimate performance setup from our elite catalog.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 1.2rem 3rem; font-weight: 800; border-radius: 20px;">Return to Forge</a>
        </div>
        @else
        <div class="flex-responsive" style="align-items: start; gap: 4rem;">
            <!-- Cart Items -->
            <div style="flex: 2; width: 100%; display: flex; flex-direction: column; gap: 2rem;">
                @foreach($cartItems as $item)
                <div class="glass-card animate-fade-in" style="padding: 2rem; display: flex; flex-wrap: wrap; gap: 2.5rem; align-items: center; border-radius: 32px;" onmouseover="this.style.transform='translateX(10px)'" onmouseout="this.style.transform='translateX(0)'">
                    <div style="width: 140px; height: 140px; border-radius: 24px; overflow: hidden; background: white; flex-shrink: 0; padding: 1.5rem; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                        @php $firstImg = $item->product->images->first(); @endphp
                        <img src="{{ $firstImg ? (str_starts_with($firstImg->image_url, 'http') ? $firstImg->image_url : asset('storage/'.$firstImg->image_url)) : 'https://placehold.co/200x200/F1F5F9/0F172A?text='.$item->product->name }}" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    
                    <div style="flex: 1; min-width: 250px;">
                        <div style="font-size: 0.75rem; font-weight: 900; color: var(--primary); text-transform: uppercase; margin-bottom: 0.5rem; letter-spacing: 1.5px;">{{ $item->product->category->name }}</div>
                        <h4 style="font-size: 1.3rem; font-weight: 900; margin-bottom: 0.8rem; font-family: 'Outfit';">{{ $item->product->name }}</h4>
                        <div style="color: var(--text); font-weight: 900; font-size: 1.4rem; font-family: 'Outfit';">${{ number_format($item->product->price, 2) }}</div>
                    </div>

                    <div style="display: flex; align-items: center; gap: 2rem;">
                        <form action="{{ route('cart.update', $item) }}" method="POST" style="display: flex; align-items: center; gap: 0.8rem; background: rgba(255,255,255,0.03); padding: 0.6rem 1rem; border-radius: 16px; border: 1px solid var(--glass-border);">
                            @csrf @method('PATCH')
                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock + $item->quantity }}" style="width: 50px; background: transparent; border: none; color: white; font-weight: 800; text-align: center; font-size: 1.1rem;">
                            <button type="submit" style="background: none; border: none; color: var(--primary); cursor: pointer; font-weight: 900; font-size: 0.7rem; letter-spacing: 1px; padding-left: 0.5rem; border-left: 1px solid var(--glass-border);">SYNC</button>
                        </form>

                        <form action="{{ route('cart.remove', $item) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.2); color: #ef4444; width: 50px; height: 50px; border-radius: 16px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: 0.3s;" onmouseover="this.style.background='#ef4444'; this.style.color='white'">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach

                <div style="margin-top: 1rem; text-align: right;">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: #ef4444; opacity: 0.5; cursor: pointer; font-weight: 800; font-size: 0.8rem; letter-spacing: 1px; text-transform: uppercase;">WIPE RESERVOIR</button>
                    </form>
                </div>
            </div>

            <!-- Summary -->
            <div class="glass-card animate-fade-in" style="flex: 1; width: 100%; padding: 3rem; position: sticky; top: 10rem; border-radius: 40px; border-color: var(--primary);">
                <h3 style="margin-bottom: 2.5rem; font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; letter-spacing: -1px;">Acquisition Summary</h3>
                
                <div style="display: flex; flex-direction: column; gap: 1.5rem; margin-bottom: 3rem;">
                    <div style="display: flex; justify-content: space-between; opacity: 0.6; font-weight: 700;">
                        <span>Hardware Subtotal</span>
                        @php $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity); @endphp
                        <span style="color: var(--text);">${{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; opacity: 0.6; font-weight: 700;">
                        <span>Elite Logistics</span>
                        <span style="color: #10b981; font-weight: 900; letter-spacing: 1px;">COMPLIMENTARY</span>
                    </div>
                    <div style="margin-top: 1rem; padding-top: 2rem; border-top: 1px solid var(--glass-border); display: flex; justify-content: space-between; align-items: flex-end;">
                        <span style="font-weight: 900; font-size: 1.1rem; opacity: 0.5;">TOTAL INVESTMENT</span>
                        <span class="text-gradient" style="font-size: 2.5rem; font-weight: 900; font-family: 'Outfit'; line-height: 1;">${{ number_format($subtotal, 2) }}</span>
                    </div>
                </div>

                <a href="{{ route('checkout') }}" class="btn btn-primary" style="width: 100%; padding: 1rem 1.5rem; font-size: 1.05rem; font-weight: 800; border-radius: 16px; box-shadow: 0 10px 25px rgba(var(--primary-rgb), 0.3);">Initialize Checkout</a>
                
                <div style="display: flex; align-items: center; justify-content: center; gap: 0.8rem; margin-top: 2.5rem; opacity: 0.4;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                    <span style="font-size: 0.75rem; font-weight: 800; letter-spacing: 1px;">ENCRYPTED TRANSACTION</span>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
