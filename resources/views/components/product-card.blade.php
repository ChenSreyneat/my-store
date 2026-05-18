@props(['product'])

@php
    $isFav = Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->exists();
@endphp

<div class="product-card animate-fade-in">
    <div class="image-container">
        <div class="swiper product-gallery" style="width: 100%; height: 100%;">
            <div class="swiper-wrapper">
                @forelse($product->images as $image)
                <div class="swiper-slide">
                    <img src="{{ str_starts_with($image->image_url, 'http') ? $image->image_url : asset('storage/'.$image->image_url) }}" alt="{{ $product->name }}">
                </div>
                @empty
                <div class="swiper-slide">
                    <img src="https://placehold.co/400x400/F1F5F9/0F172A?text={{ urlencode($product->name) }}" alt="{{ $product->name }}">
                </div>
                @endforelse
            </div>
            <div class="swiper-pagination card-pagination"></div>
        </div>
        <div class="badge">{{ $product->category->name ?? 'Hardware' }}</div>
        <button onclick="toggleFavorite({{ $product->id }}, this)" class="fav-btn" title="Toggle Favorite">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="{{ $isFav ? '#ec4899' : 'none' }}" stroke="{{ $isFav ? '#ec4899' : 'currentColor' }}" stroke-width="2">
                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.84-8.84 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
            </svg>
        </button>
    </div>
    <div class="content">
        <div class="store-name">{{ $product->store->name ?? 'ElitePC Official' }}</div>
        <h3 title="{{ $product->name }}">{{ $product->name }}</h3>
        <p class="description">{{ Str::limit($product->description, 100) }}</p>
        <div class="price-row">
            <div class="price">${{ number_format($product->price, 2) }}</div>
        </div>
        <div class="actions">
            <a href="{{ route('product.details', $product->id) }}" class="btn btn-detail">Detail</a>
            <button onclick="addToCart({{ $product->id }})" class="btn btn-add">Add to Cart</button>
        </div>
    </div>
</div>
