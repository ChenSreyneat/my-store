<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ElitePC - Premium Hardware')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&family=Outfit:wght@400;600;700;800&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    

    
    @yield('styles')
</head>
<body>
    <x-navbar />

    <main>
        <!-- Global Validation Errors -->
        @if ($errors->any())
            <div class="container" style="margin-top: 8rem; margin-bottom: -6rem; position: relative; z-index: 10;">
                <div class="glass animate-fade-in" style="padding: 1.5rem 2.5rem; border-radius: 24px; border-color: #ef4444; background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <span style="font-weight: 800; letter-spacing: 1px; font-size: 0.9rem;">SYSTEM UPDATE FAILED</span>
                    </div>
                    <ul style="margin: 0; padding-left: 1.5rem; font-weight: 600; font-size: 0.95rem; opacity: 0.9;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <x-footer />

    <!-- Logout Confirmation Modal (iOS Style) -->
    <div id="logoutModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(20px); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: var(--bg); border: 1px solid var(--glass-border); width: 300px; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); text-align: center; animation: modalPop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 2rem 1.5rem;">
                <h3 style="font-family: 'Outfit'; font-weight: 800; font-size: 1.15rem; margin-bottom: 0.4rem; color: var(--text); letter-spacing: -0.5px;">Log out of your account?</h3>
                <p style="font-size: 0.85rem; opacity: 0.6; font-weight: 500; line-height: 1.4;">Are you sure you want to terminate your current session?</p>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; border-top: 1px solid var(--glass-border);">
                <button onclick="closeLogoutModal()" style="padding: 1rem; background: none; border: none; border-right: 1px solid var(--glass-border); color: #007aff; font-weight: 600; font-size: 1.05rem; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='none'">Cancel</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" style="padding: 1rem; background: none; border: none; color: #ff3b30; font-weight: 600; font-size: 1.05rem; cursor: pointer; width: 100%; transition: 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='none'">Log out</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Toast Container -->
    <div id="toast-container"></div>

    <style>
        @keyframes modalPop {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }
    </style>

    <!-- Scripts -->
    <script>
        function openLogoutModal() {
            document.getElementById('logoutModal').style.display = 'flex';
        }
        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }
        // ... previous functions ...
        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `toast glass ${type}`;
            toast.innerHTML = `
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                <span>${message}</span>
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
                
                const svg = button.querySelector('svg');
                if (data.favorited) {
                    svg.setAttribute('fill', '#ec4899');
                    svg.setAttribute('stroke', '#ec4899');
                    showToast('Added to favorites');
                } else {
                    svg.setAttribute('fill', 'none');
                    svg.setAttribute('stroke', 'currentColor');
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
    @yield('scripts')
    <x-scroll-to-top />
</body>
</html>
