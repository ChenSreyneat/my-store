@extends('layouts.dashboard')

@section('title', 'My Favorites - ElitePC')

@section('content')
<section>
    <div style="margin-bottom: 4rem;">
        <h1 style="font-size: 3rem; font-weight: 800; font-family: 'Outfit';">My <span class="text-gradient">Favorites</span></h1>
        <p style="opacity: 0.5;">Your curated collection of premium hardware and peripherals.</p>
    </div>

    @if($favorites->isEmpty())
        <div class="glass-card" style="padding: 10rem 2rem; text-align: center;">
            <div style="font-size: 5rem; margin-bottom: 2rem; opacity: 0.1;">🖤</div>
            <h3 style="opacity: 0.5; font-size: 1.5rem; font-weight: 800;">Your hardware wishlist is empty.</h3>
            <p style="opacity: 0.4; margin-bottom: 3rem;">Start building your dream setup by exploring our latest collections.</p>
            <a href="{{ route('home') }}" class="btn btn-primary" style="padding: 1.2rem 3rem; font-weight: 800; border-radius: 20px;">Explore Collections</a>
        </div>
    @else
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(340px, 1fr)); gap: 3rem;">
            @foreach($favorites as $product)
                <div class="glass-card animate-fade-in" style="overflow: hidden; display: flex; flex-direction: column; transition: 0.4s; height: 100%; padding: 0;" onmouseover="this.style.transform='translateY(-10px)'" onmouseout="this.style.transform='translateY(0)'">
                    <div style="height: 280px; background: white; padding: 2.5rem; display: flex; align-items: center; justify-content: center; position: relative;">
                        @php $firstImage = $product->images->first(); @endphp
                        <img src="{{ $firstImage ? (str_starts_with($firstImage->image_url, 'http') ? $firstImage->image_url : asset('storage/'.$firstImage->image_url)) : 'https://placehold.co/400x400/F1F5F9/0F172A?text='.$product->name }}" style="max-height: 100%; max-width: 100%; object-fit: contain; transition: 0.5s;">
                        
                        <!-- Premium Remove Button -->
                        <button onclick="toggleFavorite({{ $product->id }}, this)" style="position: absolute; top: 1.5rem; right: 1.5rem; background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2); width: 45px; height: 45px; border-radius: 15px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: #ef4444; backdrop-filter: blur(10px); transition: 0.3s;" onmouseover="this.style.background='#ef4444'; this.style.color='white'">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="currentColor" stroke="none"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.84-8.84 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        </button>

                        <div style="position: absolute; bottom: 1.5rem; left: 1.5rem;">
                            <span class="glass" style="padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.7rem; font-weight: 800; color: var(--primary); letter-spacing: 1px;">{{ strtoupper($product->brand->name ?? 'ELITE') }}</span>
                        </div>
                    </div>
                    <div style="padding: 2.5rem; flex: 1; display: flex; flex-direction: column; background: rgba(255,255,255,0.02);">
                        <div style="font-size: 0.75rem; font-weight: 900; color: var(--secondary); text-transform: uppercase; margin-bottom: 0.8rem; letter-spacing: 1.5px;">{{ $product->category->name }}</div>
                        <h3 style="font-size: 1.4rem; font-weight: 900; margin-bottom: 1.5rem; flex: 1; font-family: 'Outfit'; line-height: 1.3;">{{ $product->name }}</h3>
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                            <div style="font-size: 1.8rem; font-weight: 900; color: var(--primary); font-family: 'Outfit';">${{ number_format($product->price, 2) }}</div>
                            <a href="{{ route('product.details', $product->id) }}" class="btn btn-outline" style="padding: 0.8rem 1.8rem; font-size: 0.85rem; font-weight: 800; border-radius: 12px;">Acquire Specs</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>
@endsection
