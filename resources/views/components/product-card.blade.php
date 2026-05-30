@props(['product'])

@php
    $colors = ['#00d2ff', '#ff00ff', '#ff9900'];
    $themeColor = $colors[$product->id % count($colors)] ?? '#00d2ff';
@endphp

<div class="product-card animate-fade-in" style="--theme-color: {{ $themeColor }};">
    <!-- Top Image Section -->
    <div class="image-section">
        <div class="price-badge">${{ number_format($product->price, 0) }}</div>

        @auth
        <button onclick="toggleFavorite({{ $product->id }}, this)" class="btn-favorite" style="position: absolute; top: 10px; left: 10px; background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3); border-radius: 50%; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; backdrop-filter: blur(5px); transition: 0.3s;" onmouseover="this.style.transform='scale(1.1)'; this.style.background='rgba(255,255,255,0.3)'" onmouseout="this.style.transform='scale(1)'; this.style.background='rgba(255,255,255,0.2)'">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="{{ Auth::user()->favorites->contains($product->id) ? '#ec4899' : 'none' }}" stroke="{{ Auth::user()->favorites->contains($product->id) ? '#ec4899' : 'white' }}" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="transition: 0.3s;">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </button>
        @endauth

        <div class="swiper product-gallery" style="width: 100%; height: 100%;">
            <div class="swiper-wrapper">
                @forelse($product->images as $image)
                <div class="swiper-slide">
                    <a href="{{ route('product.details', $product) }}" style="display: block; width: 100%; height: 100%;">
                        <img src="{{ str_starts_with($image->image_url, 'http') ? $image->image_url : asset('storage/'.$image->image_url) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </a>
                </div>
                @empty
                <div class="swiper-slide">
                    <a href="{{ route('product.details', $product) }}" style="display: block; width: 100%; height: 100%;">
                        <img src="https://placehold.co/400x400/111/fff?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </a>
                </div>
                @endforelse
            </div>
            <div class="swiper-pagination card-pagination"></div>
        </div>
    </div>
    
    <!-- Bottom Details Section -->
    <div class="details-section">
        <div class="details-columns">
            <!-- Left side -->
            <div class="details-left">
                <h3 title="{{ $product->name }}" style="font-size: 1.05rem; font-weight: 600; font-family: 'Outfit'; margin-bottom: 0.6rem;">
                    <a href="{{ route('product.details', $product) }}" style="color: inherit; text-decoration: none; transition: 0.2s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='inherit'">
                        {{ Str::limit($product->name, 35) }}
                    </a>
                </h3>
                <p class="description">
                    {{ Str::limit($product->description, 60) }}
                </p>
                <div class="stars">
                    ★ ★ ★ ★ <span style="color: #666;">★</span>
                </div>
            </div>
            
            <!-- Divider -->
            <div class="divider"></div>
            
            <!-- Right side -->
            <div class="details-right">
                <div class="feature">
                    <h4>MANUFACTURER</h4>
                    <p>{{ Str::limit($product->brand->name ?? 'Generic', 30) }}</p>
                </div>
                <div class="feature">
                    <h4>TAXONOMY</h4>
                    <p>{{ Str::limit($product->category->name ?? 'Hardware', 30) }}</p>
                </div>
                <div class="feature">
                    <h4>STOCK CAPACITY</h4>
                    <p>{{ $product->stock }} Units Available</p>
                </div>
            </div>
        </div>
        @if($product->stock > 0)
            <button onclick="addToCart({{ $product->id }})" class="btn btn-primary" style="width: 100%; padding: 0.8rem; font-size: 0.95rem; font-weight: 800; border-radius: 12px; margin-top: auto;">ADD TO CART</button>
        @else
            <button disabled class="btn" style="width: 100%; padding: 0.8rem; font-size: 0.95rem; font-weight: 900; border-radius: 12px; margin-top: auto; background: #ef4444; color: white; cursor: not-allowed; border: none; opacity: 0.8;">SOLD OUT</button>
        @endif
    </div>
</div>
