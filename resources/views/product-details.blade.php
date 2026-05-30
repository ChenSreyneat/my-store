@extends('layouts.main')

@section('title', $product->name . ' - ElitePC')

@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .product-gallery { cursor: grab; }
    .product-gallery:active { cursor: grabbing; }
    .card-pagination { bottom: 10px !important; opacity: 0; transition: 0.3s; }
    .product-card:hover .card-pagination { opacity: 1; }
    .card-pagination .swiper-pagination-bullet { width: 6px; height: 6px; background: var(--primary) !important; }
</style>
@endsection

@section('content')
<section style="padding: 10rem 0 6rem 0; position: relative; overflow: hidden;">
    <!-- Abstract Background -->
    <div style="position: absolute; top: 0; right: 0; width: 600px; height: 600px; background: radial-gradient(circle, rgba(99, 102, 241, 0.08) 0%, transparent 70%);"></div>

    <div class="container">
        <div class="flex-responsive" style="align-items: start; gap: 6rem;">
            <!-- Left: Immersive Gallery -->
            <div class="animate-fade-in" style="flex: 1.3; width: 100%;">
                <div class="glass" style="border-radius: 40px; overflow: hidden; margin-bottom: 2rem; background: white; padding: 3rem; box-shadow: 0 40px 100px -20px rgba(0,0,0,0.1); position: relative;">
                    @php $firstImage = $product->images->first(); @endphp
                    <img id="main-image" src="{{ $firstImage ? (str_starts_with($firstImage->image_url, 'http') ? $firstImage->image_url : asset('storage/'.$firstImage->image_url)) : 'https://placehold.co/800x800/F1F5F9/0F172A?text='.$product->name }}" style="width: 100%; height: auto; max-height: 550px; object-fit: contain; transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1);">
                    
                    <!-- Zoom Badge -->
                    <div style="position: absolute; bottom: 2rem; right: 2rem; background: rgba(0,0,0,0.05); padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.7rem; font-weight: 800; color: #64748b; letter-spacing: 1px;">ELITE OPTICS</div>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(60px, 1fr)); gap: 1rem;">
                    @foreach($product->images as $img)
                    <div class="glass thumb-container" style="border-radius: 16px; overflow: hidden; cursor: pointer; height: 100px; background: white; padding: 0.8rem; border: 2px solid transparent; transition: 0.3s;" onclick="changeMainImage('{{ str_starts_with($img->image_url, 'http') ? $img->image_url : asset('storage/'.$img->image_url) }}', this)">
                        <img src="{{ str_starts_with($img->image_url, 'http') ? $img->image_url : asset('storage/'.$img->image_url) }}" style="width: 100%; height: 100%; object-fit: contain;">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Right: Elite Info Panel -->
            <div class="animate-fade-in" style="flex: 1; animation-delay: 0.2s; width: 100%;">
                <div style="margin-bottom: 3rem;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 2rem;">
                        <span class="glass" style="padding: 0.5rem 1.5rem; border-radius: 50px; font-size: 0.85rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary);">{{ strtoupper($product->brand->name ?? 'PREMIUM') }}</span>
                        <span style="opacity: 0.2; font-size: 1.5rem;">/</span>
                        <span style="opacity: 0.5; font-size: 0.9rem; font-weight: 600;">SKU: EPC-{{ str_pad($product->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>

                    <h1 style="font-size: clamp(2rem, 4vw, 2.8rem); font-weight: 900; line-height: 1.1; margin-bottom: 1.5rem; font-family: 'Outfit'; letter-spacing: -1px;">{{ $product->name }}</h1>
                    
                    <div style="display: flex; align-items: flex-end; gap: 2rem; margin-bottom: 3rem;">
                        <div style="font-size: clamp(1.8rem, 3vw, 2.2rem); font-weight: 800; color: var(--primary); font-family: 'Outfit';">${{ number_format($product->price, 2) }}</div>
                        <div style="padding-bottom: 0.8rem;">
                            <div class="glass" style="padding: 0.4rem 1rem; border-radius: 50px; color: #10b981; font-weight: 800; font-size: 0.75rem; letter-spacing: 1px; background: rgba(16, 185, 129, 0.05);">{{ $product->stock }} UNITS AVAILABLE</div>
                        </div>
                    </div>

                    <div class="glass" style="padding: 2.5rem; border-radius: 24px; margin-bottom: 3.5rem;">
                        <h4 style="font-weight: 800; font-size: 0.9rem; letter-spacing: 1px; margin-bottom: 1rem; opacity: 0.5;">ARCHITECTURAL OVERVIEW</h4>
                        <p style="font-size: 1.15rem; opacity: 0.8; line-height: 1.8;">
                            {{ $product->description }}
                        </p>
                    </div>

                    <div style="display: flex; gap: 1.5rem; margin-bottom: 4rem;">
                        <button onclick="addToCart({{ $product->id }})" class="btn btn-primary" style="flex: 1; padding: 1rem 1.5rem; font-size: 1.05rem; font-weight: 800; border-radius: 16px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="margin-right: 0.5rem;"><path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z"></path><path d="M3 6h18"></path><path d="M16 10a4 4 0 0 1-8 0"></path></svg>
                            Add to Cart
                        </button>
                        <button onclick="toggleFavorite({{ $product->id }}, this)" class="glass" style="width: 55px; height: 55px; border-radius: 16px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s;">
                            @php $isFav = Auth::check() && Auth::user()->favorites()->where('product_id', $product->id)->exists(); @endphp
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="{{ $isFav ? '#ec4899' : 'none' }}" stroke="{{ $isFav ? '#ec4899' : 'currentColor' }}" stroke-width="2.5"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.84-8.84 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        </button>
                    </div>

                    <!-- Specs Table -->
                    <div style="display: flex; flex-direction: column; gap: 1.2rem;">
                        <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                            <span style="opacity: 0.5; font-weight: 700; font-size: 0.9rem;">Category</span>
                            <span style="font-weight: 800; color: var(--text);">{{ $product->category->name }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                            <span style="opacity: 0.5; font-weight: 700; font-size: 0.9rem;">Manufacturer</span>
                            <span style="font-weight: 800; color: var(--text);">{{ $product->brand->name }}</span>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding-bottom: 1rem; border-bottom: 1px solid var(--glass-border);">
                            <span style="opacity: 0.5; font-weight: 700; font-size: 0.9rem;">Elite Support</span>
                            <span style="font-weight: 800; color: var(--text);">3 Years Warranty</span>
                        </div>
                        <div style="display: flex; justify-content: space-between;">
                            <span style="opacity: 0.5; font-weight: 700; font-size: 0.9rem;">Fulfilled By</span>
                            <span style="font-weight: 800; color: var(--primary);">{{ $product->store->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Hardware -->
        <div style="margin-top: 10rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 4rem;">
                <div>
                    <h2 style="font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px;">Complete the <span class="text-gradient">Ecosystem</span></h2>
                    <p style="opacity: 0.6; margin-top: 1rem; font-size: 1.2rem;">Synergistic hardware optimized for your selection.</p>
                </div>
            </div>
            
            <div class="responsive-grid grid-4">
                @foreach($related as $rel)
                <x-product-card :product="$rel" />
                @endforeach
            </div>
        </div>
    </div>
</section>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    function changeMainImage(src, thumb) {
        const main = document.getElementById('main-image');
        main.style.opacity = '0';
        main.style.transform = 'scale(0.95)';
        
        setTimeout(() => {
            main.src = src;
            main.style.opacity = '1';
            main.style.transform = 'scale(1)';
        }, 300);

        // Update thumb styles
        document.querySelectorAll('.thumb-container').forEach(t => t.style.borderColor = 'transparent');
        thumb.style.borderColor = 'var(--primary)';
    }

    // Initialize Product Swiper for Related Hardware
    document.querySelectorAll('.product-swiper').forEach((el) => {
        new Swiper(el, {
            slidesPerView: 1,
            spaceBetween: 30,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            pagination: {
                el: el.querySelector('.main-product-pagination'),
                clickable: true,
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                1024: { slidesPerView: 3 },
                1280: { slidesPerView: 4 },
            },
        });
    });

    // Initialize Nested Card Galleries
    const productGalleries = new Swiper('.product-gallery', {
        loop: true,
        nested: true,
        effect: 'fade',
        fadeEffect: { crossFade: true },
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
    });
</script>
@endsection
@endsection
