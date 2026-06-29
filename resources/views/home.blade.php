@extends('layouts.main')

@section('title', 'Computer Store')

@section('content')
<div class="container">
    <div style="display: flex; gap: 1.5rem; margin-top: 1.5rem;">
        <!-- Sidebar -->
        <div class="desktop-only" style="width: 260px; flex-shrink: 0; background: #fff; border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; height: fit-content;">
            <div style="background: #0056b3; color: white; padding: 1rem 1.2rem; font-weight: 700; display: flex; align-items: center; gap: 0.5rem; font-family: 'Inter', sans-serif;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                BROWSE CATEGORIES
            </div>
            <div style="display: flex; flex-direction: column;">
                @foreach($categories->take(10) as $cat)
                    <a href="{{ route('category', $cat->slug) }}" style="padding: 0.8rem 1.2rem; border-bottom: 1px solid #f3f4f6; color: #4b5563; text-decoration: none; display: flex; align-items: center; gap: 0.8rem; font-size: 0.9rem; transition: background 0.2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='none'">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="14" x2="23" y2="14"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="14" x2="4" y2="14"></line></svg>
                        {{ $cat->name }}
                    </a>
                @endforeach
                <a href="{{ route('category', 'all') }}" style="padding: 0.8rem 1.2rem; color: #0056b3; text-decoration: none; display: flex; justify-content: space-between; align-items: center; font-size: 0.9rem; font-weight: 600;">
                    View All Categories <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"></path></svg>
                </a>
            </div>
        </div>

        <!-- Main Slider -->
        <div style="flex: 1; background: #e0effd; border-radius: 4px; overflow: hidden; position: relative; min-height: 400px; display: flex; align-items: center; padding: 3rem;">
            <div style="max-width: 50%; z-index: 10;">
                <div style="color: #0056b3; font-weight: 700; font-size: 0.9rem; margin-bottom: 0.5rem; text-transform: uppercase;">BEST PERFORMANCE</div>
                <h1 style="font-size: 3rem; font-weight: 800; color: #111827; line-height: 1.1; margin-bottom: 1.5rem; font-family: 'Inter', sans-serif;">
                    THE BEST TECH <br><span style="color: #0056b3;">FOR YOUR NEEDS</span>
                </h1>
                <p style="color: #4b5563; font-size: 1rem; margin-bottom: 2rem; max-width: 400px;">
                    Explore a wide range of laptops, desktops, components and accessories at the best prices.
                </p>
                <a href="{{ route('category', 'all') }}" style="background: #0056b3; color: white; padding: 0.8rem 2rem; font-weight: 600; text-decoration: none; border-radius: 4px; display: inline-block; transition: background 0.2s;" onmouseover="this.style.background='#004494'" onmouseout="this.style.background='#0056b3'">SHOP NOW</a>
            </div>
            <!-- Right Image Grid / Composite -->
            <div style="position: absolute; right: 0; top: 0; bottom: 0; width: 55%; background: url('https://images.unsplash.com/photo-1593640408182-31c70c8268f5?auto=format&fit=crop&q=80&w=1000') center/cover no-repeat; clip-path: polygon(10% 0, 100% 0, 100% 100%, 0 100%);">
            </div>
            
            <!-- Slider Navigation Placeholders -->
            <div style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); cursor: pointer;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 18l-6-6 6-6"></path></svg></div>
            <div style="position: absolute; right: 1rem; top: 50%; transform: translateY(-50%); width: 40px; height: 40px; background: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 5px rgba(0,0,0,0.1); cursor: pointer; z-index: 20;"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 18l6-6-6-6"></path></svg></div>
            
            <!-- Pagination Placeholders -->
            <div style="position: absolute; bottom: 1.5rem; left: 50%; transform: translateX(-50%); display: flex; gap: 0.5rem; z-index: 20;">
                <div style="width: 10px; height: 10px; border-radius: 50%; background: #0056b3;"></div>
                <div style="width: 10px; height: 10px; border-radius: 50%; background: white;"></div>
                <div style="width: 10px; height: 10px; border-radius: 50%; background: white;"></div>
            </div>
        </div>
    </div>

    <!-- Features Bar -->
    <div style="margin-top: 2rem; padding: 2rem 0; border-top: 1px solid #f3f4f6; border-bottom: 1px solid #f3f4f6;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem;">
                <div style="color: #0056b3;"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="1" y="3" width="15" height="13"></rect><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle></svg></div>
                <div style="text-align: left;">
                    <div style="font-weight: 700; color: #111827; font-size: 0.95rem;">FREE DELIVERY</div>
                    <div style="color: #6b7280; font-size: 0.85rem;">On orders over NPR 5000</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; border-left: 1px solid #f3f4f6;">
                <div style="color: #0056b3;"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path><path d="M9 12l2 2 4-4"></path></svg></div>
                <div style="text-align: left;">
                    <div style="font-weight: 700; color: #111827; font-size: 0.95rem;">SECURE PAYMENT</div>
                    <div style="color: #6b7280; font-size: 0.85rem;">100% secure payment</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; border-left: 1px solid #f3f4f6;">
                <div style="color: #0056b3;"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg></div>
                <div style="text-align: left;">
                    <div style="font-weight: 700; color: #111827; font-size: 0.95rem;">WARRANTY</div>
                    <div style="color: #6b7280; font-size: 0.85rem;">Upto 2 years warranty</div>
                </div>
            </div>
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; border-left: 1px solid #f3f4f6;">
                <div style="color: #0056b3;"><svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M15.05 5A5 5 0 0 1 19 8.95M15.05 1A9 9 0 0 1 23 8.94m-1 7.98v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></div>
                <div style="text-align: left;">
                    <div style="font-weight: 700; color: #111827; font-size: 0.95rem;">24/7 SUPPORT</div>
                    <div style="color: #6b7280; font-size: 0.85rem;">We are here to help you</div>
                </div>
            </div>
        </div>
    </div>

    @if($featuredProducts->count() > 0)
    <!-- Featured Products -->
    <div style="margin-top: 4rem; margin-bottom: 4rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #111827; font-family: 'Inter', sans-serif;">FEATURED PRODUCTS</h2>
            <a href="{{ route('category', 'all') }}" style="color: #0056b3; font-weight: 700; text-decoration: none; font-size: 0.95rem;">View All</a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
            @foreach($featuredProducts->take(4) as $product)
                <div style="height: 400px;">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
    @endif

    @if($newArrivals->count() > 0)
    <!-- New Arrivals -->
    <div style="margin-top: 2rem; margin-bottom: 5rem;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <h2 style="font-size: 1.5rem; font-weight: 800; color: #111827; font-family: 'Inter', sans-serif;">NEW ARRIVALS</h2>
            <a href="{{ route('category', 'all') }}" style="color: #0056b3; font-weight: 700; text-decoration: none; font-size: 0.95rem;">View All</a>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem;">
            @foreach($newArrivals->take(4) as $product)
                <div style="height: 400px;">
                    <x-product-card :product="$product" />
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection

