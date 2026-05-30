@extends('layouts.main')

@section('title', 'ElitePC - High-End Computer Hardware')

@section('content')
@section('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<style>
    .hero-swiper {
        width: 100%;
        height: clamp(600px, 80vh, 900px);
        margin-top: 5rem;
    }
    .swiper-slide {
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        background: var(--bg);
    }
    .slide-bg {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.6;
        transition: transform 8s ease-out;
    }
    .swiper-slide-active .slide-bg {
        transform: scale(1.1);
    }
    .slide-content {
        position: relative;
        z-index: 10;
        max-width: 800px;
        padding: 0 5%;
    }
    .swiper-pagination-bullet {
        background: #fff !important;
        opacity: 0.3;
        width: 12px;
        height: 12px;
    }
    .swiper-pagination-bullet-active {
        opacity: 1;
        background: var(--primary) !important;
        width: 30px;
        border-radius: 6px;
    }
    .main-product-pagination .swiper-pagination-bullet {
        background: var(--text-dim) !important;
        opacity: 0.4;
    }
    .swiper-button-next, .swiper-button-prev {
        color: #fff !important;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(10px);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.1);
    }
    .swiper-button-next:after, .swiper-button-prev:after {
        font-size: 1.5rem !important;
        font-weight: 900;
    }

    /* Product Card Gallery Styling */
    .product-gallery {
        cursor: grab;
    }
    .product-gallery:active {
        cursor: grabbing;
    }
    .card-pagination {
        bottom: 10px !important;
        opacity: 0;
        transition: 0.3s;
    }
    .product-card:hover .card-pagination {
        opacity: 1;
    }
    .card-pagination .swiper-pagination-bullet {
        width: 6px;
        height: 6px;
        background: var(--primary) !important;
    }
</style>
@endsection

<!-- Hero Slider -->
<div class="swiper hero-swiper">
    <div class="swiper-wrapper">
        <!-- Slide 1: Main Brand -->
        <div class="swiper-slide">
            <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&q=80&w=2000" class="slide-bg" alt="Elite Gaming">
            <div class="slide-content animate-fade-in">
                <div class="glass" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 50px; margin-bottom: 2rem; font-size: 0.9rem; font-weight: 700; color: #fff;">
                    <span style="width: 8px; height: 8px; background: var(--secondary); border-radius: 50%; display: inline-block;"></span>
                    ELITE PERFORMANCE ARCHITECTURE
                </div>
                <h1 style="line-height: 1; font-weight: 900; margin-bottom: 2rem; font-family: 'Outfit'; color: #fff;">
                    Unleash the <span class="text-gradient">Power</span> Within
                </h1>
                <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 3.5rem; max-width: 600px; line-height: 1.6; color: #fff;">
                    Experience the pinnacle of gaming engineering. Our custom builds are forged for those who refuse to compromise on speed or aesthetics.
                </p>
                <div style="display: flex; flex-wrap: wrap; gap: 1.5rem;">
                    <a href="#featured" class="btn btn-primary" style="padding: 1.4rem 3rem; font-size: 1.1rem;">Explore Collection</a>
                    <a href="{{ route('about') }}" class="btn btn-outline" style="padding: 1.4rem 3rem; font-size: 1.1rem; border-color: #fff; color: #fff;">Protocol Details</a>
                </div>
            </div>
        </div>

        <!-- Slide 2: RTX GPU -->
        <div class="swiper-slide">
            <img src="https://images.unsplash.com/photo-1624705002806-5d72df19c3ad?auto=format&fit=crop&q=80&w=2000" class="slide-bg" alt="Next Gen GPU">
            <div class="slide-content">
                <div class="glass" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 50px; margin-bottom: 2rem; font-size: 0.9rem; font-weight: 700; color: #fff;">
                    LIMITLESS GRAPHICAL FIDELITY
                </div>
                <h1 style="line-height: 1; font-weight: 900; margin-bottom: 2rem; font-family: 'Outfit'; color: #fff;">
                    Next-Gen <span class="text-gradient">Graphics</span>
                </h1>
                <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 3.5rem; max-width: 600px; line-height: 1.6; color: #fff;">
                    Deploy the latest RTX 40-Series nodes. Real-time ray tracing and AI-powered frames that redefine visual reality.
                </p>
                <a href="{{ route('category', 'gpu') }}" class="btn btn-primary" style="padding: 1.4rem 3rem; font-size: 1.1rem;">Deploy GPU Nodes</a>
            </div>
        </div>

        <!-- Slide 3: Laptops -->
        <div class="swiper-slide">
            <img src="https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&q=80&w=2000" class="slide-bg" alt="Elite Laptops">
            <div class="slide-content">
                <div class="glass" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 50px; margin-bottom: 2rem; font-size: 0.9rem; font-weight: 700; color: #fff;">
                    PORTABLE POWER STATIONS
                </div>
                <h1 style="line-height: 1; font-weight: 900; margin-bottom: 2rem; font-family: 'Outfit'; color: #fff;">
                    Elite <span class="text-gradient">Portability</span>
                </h1>
                <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 3.5rem; max-width: 600px; line-height: 1.6; color: #fff;">
                    Desktop-class performance in a sleek, aerodynamic chassis. Dominate the battlefield from anywhere in the world.
                </p>
                <a href="{{ route('category', 'laptops') }}" class="btn btn-primary" style="padding: 1.4rem 3rem; font-size: 1.1rem;">View Hardware</a>
            </div>
        </div>

        <!-- Slide 4: Custom Cooling -->
        <div class="swiper-slide">
            <img src="https://images.unsplash.com/photo-1591488320449-011701bb6704?auto=format&fit=crop&q=80&w=2000" class="slide-bg" alt="Liquid Cooling">
            <div class="slide-content">
                <div class="glass" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 50px; margin-bottom: 2rem; font-size: 0.9rem; font-weight: 700; color: #fff;">
                    THERMAL SUPREMACY
                </div>
                <h1 style="line-height: 1; font-weight: 900; margin-bottom: 2rem; font-family: 'Outfit'; color: #fff;">
                    Stay <span class="text-gradient">Frosty</span>
                </h1>
                <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 3.5rem; max-width: 600px; line-height: 1.6; color: #fff;">
                    Advanced liquid cooling protocols for maximum overclocking headroom. Quiet, cool, and undeniably beautiful.
                </p>
                <a href="#featured" class="btn btn-primary" style="padding: 1.4rem 3rem; font-size: 1.1rem;">Optimize Thermals</a>
            </div>
        </div>

        <!-- Slide 5: Peripherals -->
        <div class="swiper-slide">
            <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=2000" class="slide-bg" alt="Tactical Peripherals">
            <div class="slide-content">
                <div class="glass" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; border-radius: 50px; margin-bottom: 2rem; font-size: 0.9rem; font-weight: 700; color: #fff;">
                    TACTICAL INPUT INTERFACES
                </div>
                <h1 style="line-height: 1; font-weight: 900; margin-bottom: 2rem; font-family: 'Outfit'; color: #fff;">
                    Precision <span class="text-gradient">Control</span>
                </h1>
                <p style="font-size: 1.2rem; opacity: 0.9; margin-bottom: 3.5rem; max-width: 600px; line-height: 1.6; color: #fff;">
                    Optical-grade sensors and mechanical switches for zero-latency response. Your intent, executed instantly.
                </p>
                <a href="{{ route('category', 'peripherals') }}" class="btn btn-primary" style="padding: 1.4rem 3rem; font-size: 1.1rem;">Gear Up</a>
            </div>
        </div>
    </div>
    
    <!-- Navigation -->
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
    <div class="swiper-pagination"></div>
</div>

<!-- Categories Section -->
<section style="padding: 6rem 0; background: var(--glass-bg); border-top: 1px solid var(--glass-border); border-bottom: 1px solid var(--glass-border);">
    <div class="container">
        <h2 style="font-size: clamp(2.5rem, 5vw, 3rem); font-weight: 800; margin-bottom: 4rem; text-align: center; font-family: 'Outfit'; color: #4F46E5; letter-spacing: -1px;">
            Browse Popular Categories
        </h2>
        <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 2rem 4rem; align-items: flex-end;">
            @foreach($categories as $category)
            <a href="{{ route('category', $category->slug) }}" style="text-decoration: none; text-align: center; width: 160px; transition: transform 0.3s ease; display: block;" class="category-item" onmouseover="this.style.transform='translateY(-8px)'" onmouseout="this.style.transform='translateY(0)'">
                <div style="width: 100%; height: 130px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                    @php
                        $catImages = [
                            'cooling' => asset('storage/products/Case & Cooling/2.avif'),
                            'gpu' => asset('storage/products/Grapich cards/3.png'),
                            'ram' => asset('storage/products/Memory(RAM)/1.png'),
                            'mobo' => asset('storage/products/Mothers boards/2.png'),
                            'cpu' => asset('storage/products/Processors/1.png'),
                            'ssd' => asset('storage/products/storage/1.png'),
                            'desktop' => asset('storage/products/Desktop/1.png'),
                            'computer' => asset('storage/products/Computers/computer.png'),
                        ];
                        $img = $category->image ? asset('storage/' . $category->image) : ($catImages[strtolower($category->slug)] ?? 'https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&q=80&w=300');
                    @endphp
                    <img src="{{ $img }}" style="max-width: 100%; max-height: 100%; object-fit: contain; filter: drop-shadow(0 4px 15px rgba(0,0,0,0.3));">
                </div>
                <h4 style="color: var(--text); font-weight: 600; font-size: 1.05rem; font-family: 'Outfit';">{{ $category->name }}</h4>
            </a>
            @endforeach
        </div>
    </div>
</section>

<!-- New Acquisitions (Reference Style) -->
<section style="padding: 8rem 0; background: rgba(255,255,255,0.02);">
    <div class="container">
        <div style="text-align: center; margin-bottom: 5rem;">
            <div style="color: var(--primary); font-size: 0.75rem; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 1rem; opacity: 0.9;">LATEST HARDWARE DEPLOYMENTS</div>
            <div style="width: 30px; height: 3px; background: var(--primary); margin: 0 auto 1.5rem auto;"></div>
            <h2 style="font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 700; font-family: 'Outfit';">New Acquisitions</h2>
        </div>

        <div class="swiper product-swiper" style="padding-bottom: 4rem;">
            <div class="swiper-wrapper">
                @foreach($newArrivals as $product)
                <div class="swiper-slide">
                    <x-product-card :product="$product" />
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination main-product-pagination"></div>
        </div>
    </div>
</section>

<!-- Our Products Section (Reference Style) -->
<section id="featured" style="padding: 8rem 0; background: var(--bg);">
    <div class="container">
        <div style="text-align: center; margin-bottom: 5rem;">
            <div style="color: var(--primary); font-size: 0.75rem; font-weight: 800; letter-spacing: 2px; text-transform: uppercase; margin-bottom: 1rem; opacity: 0.9;">BEST SELLING IN THIS WEEK</div>
            <div style="width: 30px; height: 3px; background: #facc15; margin: 0 auto 1.5rem auto;"></div>
            <h2 style="font-size: clamp(2.5rem, 5vw, 3.5rem); font-weight: 700; color: var(--title-color); font-family: 'Outfit';">Our Products</h2>
        </div>

        <div class="swiper product-swiper" style="padding-bottom: 4rem;">
            <div class="swiper-wrapper">
                @foreach($featuredProducts as $product)
                <div class="swiper-slide">
                    <x-product-card :product="$product" />
                </div>
                @endforeach
            </div>
            <div class="swiper-pagination main-product-pagination"></div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Hero Slider
    const heroSwiper = new Swiper('.hero-swiper', {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        effect: 'fade',
        fadeEffect: { crossFade: true },
    });

    // Initialize All Product Swipers (New Acquisitions, Our Products, etc.)
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
