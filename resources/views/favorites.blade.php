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
                <div class="favorite-card" style="width: 277.5px; height: 400px;">
                    <x-product-card :product="$product" />
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
