@props(['product'])

<div class="product-card" style="background: white; border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; display: flex; flex-direction: column; transition: box-shadow 0.2s; height: 100%;" onmouseover="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.05)'" onmouseout="this.style.boxShadow='none'">
    <div style="position: relative; padding: 2rem 1rem; display: flex; justify-content: center; align-items: center; height: 200px;">
        <a href="{{ route('product.details', $product) }}" style="display: block; width: 100%; height: 100%;">
            @php 
                $imgUrl = '';
                if($product->images->count() > 0) {
                    $img = $product->images->first();
                    $imgUrl = str_starts_with($img->image_url ?? $img->image_path ?? '', 'http') 
                        ? ($img->image_url ?? $img->image_path) 
                        : asset('storage/'.($img->image_url ?? $img->image_path ?? ''));
                } else {
                    $imgUrl = 'https://placehold.co/400x400/111/fff?text='.urlencode($product->name);
                }
            @endphp
            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" style="max-width: 100%; max-height: 100%; width: 100%; height: 100%; object-fit: contain;">
        </a>
    </div>
    <div style="padding: 1.5rem; display: flex; flex-direction: column; flex: 1;">
        <div style="color: #6b7280; font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-bottom: 0.4rem;">
            {{ Str::limit($product->category->name ?? 'Hardware', 20) }}
        </div>
        <a href="{{ route('product.details', $product) }}" title="{{ $product->name }}" style="color: #111827; font-weight: 700; font-size: 1.1rem; text-decoration: none; margin-bottom: 0.8rem; line-height: 1.3;">
            {{ Str::limit($product->name, 40) }}
        </a>
        <div style="color: #0056b3; font-weight: 800; font-size: 1.2rem; margin-bottom: 1rem;">
            NPR {{ number_format($product->price, 0) }}
        </div>
        
        <div style="margin-top: auto; display: flex; justify-content: space-between; align-items: center;">
            @if(!isset($product->stock) || $product->stock > 0)
                <button onclick="addToCart({{ $product->id }})" style="background: #0056b3; color: white; border: none; padding: 0.7rem 1.2rem; border-radius: 4px; font-weight: 600; display: flex; align-items: center; justify-content: center; gap: 0.5rem; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#004494'" onmouseout="this.style.background='#0056b3'">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                    Add to Cart
                </button>
            @else
                <button disabled style="background: #ef4444; color: white; border: none; padding: 0.7rem 1.2rem; border-radius: 4px; font-weight: 600; cursor: not-allowed; display: flex; align-items: center; gap: 0.5rem; opacity: 0.8;">
                    Sold Out
                </button>
            @endif

            @auth
            <button onclick="toggleFavorite({{ $product->id }}, this)" style="background: none; border: none; cursor: pointer; color: {{ Auth::user()->favorites->contains($product->id) ? '#ef4444' : '#9ca3af' }}; transition: color 0.2s; padding: 4px; display: flex; align-items: center; justify-content: center;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="{{ Auth::user()->favorites->contains($product->id) ? '#ef4444' : 'none' }}" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.84-8.84 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
            @else
            <button onclick="window.location.href='{{ route('login') }}'" style="background: none; border: none; cursor: pointer; color: #9ca3af; transition: color 0.2s; padding: 4px; display: flex; align-items: center; justify-content: center;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.84-8.84 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                </svg>
            </button>
            @endauth
        </div>
    </div>
</div>
