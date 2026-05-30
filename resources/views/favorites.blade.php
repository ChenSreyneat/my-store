@extends('layouts.dashboard')

@section('title', 'My Favorites - ElitePC')

@section('content')
<section style="font-family: 'Inter', sans-serif;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem;">
        <h1 style="font-size: 2rem; font-weight: 700; color: #1e293b; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
            Favorite hardware 😋
        </h1>
        

    </div>

    @if($favorites->isEmpty())
        <div style="background: white; border-radius: 24px; padding: 5rem 2rem; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.03);">
            <div style="font-size: 4rem; margin-bottom: 1.5rem; opacity: 0.2;">🖤</div>
            <h3 style="color: #475569; font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">Your wishlist is empty</h3>
            <p style="color: #94a3b8; font-size: 0.9rem; margin-bottom: 2rem;">Start exploring to add your favorite components.</p>
        </div>
    @else
        <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
            @foreach($favorites as $product)
                <div class="favorite-card" style="width: 277.5px; height: 400px; background: #f3f4f6; border-radius: 16px; display: flex; flex-direction: column; position: relative; overflow: hidden; border: 1px solid #e5e7eb; transition: 0.3s; box-shadow: 0 4px 15px rgba(0,0,0,0.02);" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 30px rgba(0,0,0,0.06)';" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.02)';">
                    
                    <!-- Top Image Area -->
                    <div style="background: radial-gradient(circle at center, #ffffff 0%, #f9fafb 100%); height: 180px; position: relative; display: flex; align-items: center; justify-content: center; border-bottom: 1px solid rgba(0,0,0,0.02);">
                        
                        <!-- Heart Button -->
                        <button onclick="toggleFavorite({{ $product->id }}, this)" style="position: absolute; top: 0.8rem; left: 0.8rem; background: rgba(255,255,255,0.7); border: 1px solid #f3f4f6; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; z-index: 10; box-shadow: 0 2px 5px rgba(0,0,0,0.02);">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="#ec4899" stroke="#ec4899" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                            </svg>
                        </button>

                        <!-- Price Badge -->
                        <div style="position: absolute; top: 0; right: 0; background: #6366f1; color: white; font-weight: 800; font-size: 1rem; padding: 0.6rem 1.2rem; border-bottom-left-radius: 16px; box-shadow: -2px 2px 8px rgba(99, 102, 241, 0.2);">
                            ${{ number_format($product->price, 0) }}
                        </div>

                        @php $firstImage = $product->images->first(); @endphp
                        <img src="{{ $firstImage ? (str_starts_with($firstImage->image_url, 'http') ? $firstImage->image_url : asset('storage/'.$firstImage->image_url)) : 'https://placehold.co/400x400/F1F5F9/0F172A?text='.$product->name }}" style="width: 100%; height: 100%; object-fit: cover; mix-blend-mode: multiply;">
                    </div>

                    <!-- Content Area -->
                    <div style="padding: 1rem 1.2rem; display: flex; flex-direction: column; flex: 1;">
                        
                        <div style="display: flex; flex-direction: column; margin-bottom: 1rem; flex: 1;">
                            
                            <h3 style="font-weight: 900; font-size: 1.1rem; color: #5a5ce6; margin-bottom: 0.3rem; line-height: 1.2;">{{ $product->name }}</h3>
                            
                            <div style="display: flex; gap: 0.15rem; margin-bottom: 0.6rem;">
                                @for($i=1; $i<=5; $i++)
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="{{ $i <= 4 ? '#facc15' : '#cbd5e1' }}" stroke="none">
                                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                                    </svg>
                                @endfor
                            </div>
                            
                            <p style="font-size: 0.75rem; color: #64748b; margin-bottom: 0.8rem; line-height: 1.4;">
                                {{ \Illuminate\Support\Str::limit($product->description ?? 'Premium hardware component delivering high-end performance.', 65) }}
                            </p>

                            <!-- Metadata Area -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-top: auto; padding-top: 0.8rem; border-top: 1px solid #e2e8f0;">
                                <div>
                                    <div style="font-weight: 800; font-size: 0.6rem; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.1rem;">BRAND</div>
                                    <div style="font-size: 0.7rem; color: #64748b;">{{ $product->brand->name ?? 'ElitePC' }}</div>
                                </div>
                                <div>
                                    <div style="font-weight: 800; font-size: 0.6rem; color: #0f172a; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 0.1rem;">STOCK</div>
                                    <div style="font-size: 0.7rem; color: #64748b;">{{ $product->stock }} Units</div>
                                </div>
                            </div>
                        </div>

                        @if($product->stock > 0)
                        <button onclick="addToCart({{ $product->id }})" style="width: 100%; background: #6366f1; color: white; border: none; padding: 0.8rem; border-radius: 20px; font-weight: 800; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='#4f46e5'" onmouseout="this.style.background='#6366f1'">
                            ADD TO CART
                        </button>
                        @else
                        <button disabled style="width: 100%; background: #ef4444; color: white; border: none; padding: 0.8rem; border-radius: 20px; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px; cursor: not-allowed; opacity: 0.8;">
                            SOLD OUT
                        </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</section>

<!-- Toast Container -->
<div id="toast-container"></div>

<script>
    function showToast(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;
        
        const toast = document.createElement('div');
        toast.className = `toast glass ${type}`;
        toast.style.cssText = `
            padding: 1rem 2rem; border-radius: 12px; background: var(--bg, #f8fafc); 
            backdrop-filter: blur(10px); border: 1px solid var(--glass-border, rgba(15,23,42,0.1)); 
            color: var(--text, #0f172a); box-shadow: 0 8px 32px 0 rgba(15,23,42,0.08); 
            display: flex; align-items: center; gap: 0.75rem; 
            position: fixed; bottom: 2rem; right: 2rem; z-index: 1000;
            transition: opacity 0.3s, transform 0.3s;
        `;
        toast.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
            <span style="font-weight: 600;">${message}</span>
        `;
        container.appendChild(toast);
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }

    async function toggleFavorite(productId, button) {
        try {
            const response = await fetch(`/favorites/${productId}/toggle`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (response.status === 401 && data.redirect) {
                window.location.href = data.redirect;
                return;
            }
            
            if (data.favorited) {
                const svg = button.querySelector('svg');
                svg.setAttribute('fill', '#ec4899');
                svg.setAttribute('stroke', '#ec4899');
                showToast('Added to favorites');
            } else {
                const card = button.closest('.favorite-card');
                if (card) {
                    card.style.transition = '0.3s';
                    card.style.opacity = '0';
                    card.style.transform = 'scale(0.9)';
                    setTimeout(() => {
                        card.remove();
                        if (document.querySelectorAll('.favorite-card').length === 0) {
                            window.location.reload();
                        }
                    }, 300);
                }
                showToast('Removed from favorites');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Action failed', 'error');
        }
    }

    async function addToCart(productId) {
        try {
            const response = await fetch(`/cart/add/${productId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                }
            });
            const data = await response.json();

            if (response.status === 401 && data.redirect) {
                window.location.href = data.redirect;
                return;
            }
            
            if (data.success) {
                const badge = document.getElementById('cart-badge');
                if (badge) {
                    badge.textContent = data.cartCount;
                    badge.style.display = 'flex';
                }
                showToast('Added to cart');
            } else {
                showToast(data.message || 'Failed to add to cart', 'error');
            }
        } catch (error) {
            console.error('Error:', error);
            showToast('Failed to add to cart', 'error');
        }
    }
</script>
@endsection
