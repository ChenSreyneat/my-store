@extends('layouts.main')

@section('title', $category->name . ' - ElitePC')

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
<section style="padding: 10rem 0 6rem 0; position: relative;">
    <div style="position: absolute; top: 0; left: 50%; transform: translateX(-50%); width: 100%; height: 400px; background: linear-gradient(180deg, rgba(99, 102, 241, 0.05) 0%, transparent 100%);"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <!-- Header -->
        <div style="margin-bottom: 6rem; text-align: center;">
            <div class="glass" style="display: inline-flex; padding: 0.6rem 2rem; border-radius: 50px; margin-bottom: 2rem; font-weight: 800; color: var(--primary); font-size: 0.9rem; letter-spacing: 2px;">ELITE COLLECTION</div>
            <h1 style="font-size: clamp(3rem, 8vw, 5.5rem); font-weight: 900; font-family: 'Outfit'; line-height: 1; letter-spacing: -2px;">{{ $category->name }}</h1>
            <p style="opacity: 0.7; max-width: 700px; margin: 2rem auto 0 auto; font-size: 1.2rem; line-height: 1.6;">{{ $category->description ?: 'Precision-engineered hardware components, curated for world-class performance and reliability.' }}</p>
        </div>

        <div style="display: grid; grid-template-columns: 280px 1fr; gap: 4rem;">
            <!-- Advanced Filter Sidebar -->
            <aside style="display: flex; flex-direction: column; gap: 3rem;">
                <div class="glass-card" style="padding: 2.5rem; border-radius: 32px; position: sticky; top: 120px;">
                    <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.4rem; margin-bottom: 2.5rem; letter-spacing: -0.5px;">Filter <span class="text-gradient">Hardware</span></h3>
                    
                    <form action="{{ route('category', $category->slug) }}" method="GET" id="filterForm">
                        <!-- Brand Taxonomy -->
                        <div style="margin-bottom: 3rem;">
                            <label style="font-size: 0.7rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.5; display: block; margin-bottom: 1.5rem; text-transform: uppercase;">MANUFACTURER</label>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <label style="display: flex; align-items: center; gap: 1rem; cursor: pointer; font-weight: 600; font-size: 0.95rem;">
                                    <input type="radio" name="brand_id" value="" onchange="this.form.submit()" {{ !request('brand_id') ? 'checked' : '' }} style="accent-color: var(--primary); width: 18px; height: 18px;">
                                    All Manufacturers
                                </label>
                                @foreach($brands as $brand)
                                <label style="display: flex; align-items: center; gap: 1rem; cursor: pointer; font-weight: 600; font-size: 0.95rem; opacity: {{ request('brand_id') == $brand->id ? '1' : '0.6' }};">
                                    <input type="radio" name="brand_id" value="{{ $brand->id }}" onchange="this.form.submit()" {{ request('brand_id') == $brand->id ? 'checked' : '' }} style="accent-color: var(--primary); width: 18px; height: 18px;">
                                    {{ $brand->name }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Hardware Type Taxonomy -->
                        <div style="margin-bottom: 3rem;">
                            <label style="font-size: 0.7rem; font-weight: 800; letter-spacing: 1.5px; opacity: 0.5; display: block; margin-bottom: 1.5rem; text-transform: uppercase;">SYSTEM TYPE</label>
                            <div style="display: flex; flex-direction: column; gap: 1rem;">
                                <label style="display: flex; align-items: center; gap: 1rem; cursor: pointer; font-weight: 600; font-size: 0.95rem;">
                                    <input type="radio" name="product_type_id" value="" onchange="this.form.submit()" {{ !request('product_type_id') ? 'checked' : '' }} style="accent-color: var(--primary); width: 18px; height: 18px;">
                                    All Hardware
                                </label>
                                @foreach($productTypes as $type)
                                <label style="display: flex; align-items: center; gap: 1rem; cursor: pointer; font-weight: 600; font-size: 0.95rem; opacity: {{ request('product_type_id') == $type->id ? '1' : '0.6' }};">
                                    <input type="radio" name="product_type_id" value="{{ $type->id }}" onchange="this.form.submit()" {{ request('product_type_id') == $type->id ? 'checked' : '' }} style="accent-color: var(--primary); width: 18px; height: 18px;">
                                    {{ $type->name }}
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <a href="{{ route('category', $category->slug) }}" style="font-size: 0.8rem; font-weight: 800; color: var(--primary); text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; opacity: 0.8; transition: 0.3s;" onmouseover="this.style.opacity='1'" onmouseout="this.style.opacity='0.8'">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 4v6h-6"></path><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                            RESET FILTERS
                        </a>
                    </form>
                </div>
            </aside>

            <!-- Product Intelligence Feed -->
            <div>
                <div class="responsive-grid grid-3">
                    @forelse($products as $product)
                    <x-product-card :product="$product" />
                    @empty
                    <div style="grid-column: 1/-1; text-align: center; padding: 10rem 0;">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" style="opacity: 0.2; margin-bottom: 2rem;"><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                        <p style="opacity: 0.5; font-size: 1.2rem;">No products found matching these parameters.</p>
                        <a href="{{ route('category', $category->slug) }}" class="btn btn-primary" style="margin-top: 2rem;">Clear All Filters</a>
                    </div>
                    @endforelse
                </div>

                <div style="margin-top: 5rem;">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</section>
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    // Initialize Product Card Galleries with Autoplay
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
