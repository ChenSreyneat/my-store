@if(session('admin_impersonator_id'))
<div style="background: var(--primary); color: white; padding: 0.8rem; text-align: center; font-size: 0.9rem; font-weight: 800; display: flex; justify-content: center; align-items: center; gap: 1rem; position: relative; z-index: 1001;">
    <span>PROTECTED MODE: Currently Impersonating {{ Auth::user()->name }}</span>
    <form action="{{ route('admin.stop_impersonating') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" style="background: white; color: var(--primary); border: none; padding: 0.4rem 1.2rem; border-radius: 8px; font-weight: 900; cursor: pointer; font-size: 0.75rem; text-transform: uppercase;">Restore Admin Session</button>
    </form>
</div>
@endif

<header style="background: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.05); position: sticky; top: 0; z-index: 1000;">
    <!-- Top Bar -->
    <div style="background: #111827; color: #f3f4f6; font-size: 0.8rem; padding: 0.5rem 0;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; gap: 1.5rem; align-items: center;">
                <span style="display: flex; align-items: center; gap: 0.4rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    +977 984-1234567
                </span>
                <span style="display: flex; align-items: center; gap: 0.4rem;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    support@computerstore.com
                </span>
            </div>
            <div class="desktop-only" style="display: flex; align-items: center; gap: 0.4rem;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                Free Delivery on orders over NPR 5000!
            </div>
            <div style="display: flex; gap: 1.5rem; align-items: center;">
                <a href="#" style="color: #f3f4f6; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#f3f4f6'">Track Order</a>
                <a href="#" style="color: #f3f4f6; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='#f3f4f6'">Store Location</a>
                <div style="display: flex; gap: 0.8rem; align-items: center; border-left: 1px solid rgba(255,255,255,0.2); padding-left: 1rem; margin-left: 0.5rem;">
                    <a href="#" style="color: #f3f4f6;"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg></a>
                    <a href="#" style="color: #f3f4f6;"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg></a>
                    <a href="#" style="color: #f3f4f6;"><svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div style="padding: 1.5rem 0; border-bottom: 1px solid #f3f4f6;">
        <div class="container" style="display: flex; justify-content: space-between; align-items: center; gap: 2rem;">
            <!-- Logo -->
            <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 0.8rem; text-decoration: none; flex-shrink: 0;">
                <div style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#0056b3" stroke-width="2" style="width: 100%; height: 100%;">
                        <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <path d="M16 10a4 4 0 0 1-8 0"></path>
                    </svg>
                </div>
                <div style="display: flex; flex-direction: column; line-height: 1.1;">
                    <span style="font-family: 'Inter', sans-serif; font-weight: 800; font-size: 1.2rem; color: #111827;">COMPUTER</span>
                    <span style="font-family: 'Inter', sans-serif; font-weight: 800; font-size: 1.2rem; color: #0056b3;">STORE</span>
                </div>
            </a>

            <!-- Search Bar -->
            <div class="desktop-only" style="flex: 1; max-width: 600px; display: flex; border: 1px solid #e5e7eb; border-radius: 4px; overflow: hidden; height: 45px;">
                <select style="background: #f9fafb; border: none; border-right: 1px solid #e5e7eb; padding: 0 1rem; color: #4b5563; font-size: 0.9rem; outline: none; cursor: pointer;">
                    <option>All Categories</option>
                    @foreach($navCategories ?? [] as $cat)
                        <option value="{{ $cat->slug }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <input type="text" placeholder="Search for products..." style="flex: 1; border: none; padding: 0 1rem; outline: none; font-size: 0.95rem;">
                <button style="background: #0056b3; border: none; color: white; width: 60px; cursor: pointer; display: flex; align-items: center; justify-content: center; transition: background 0.2s;" onmouseover="this.style.background='#004494'" onmouseout="this.style.background='#0056b3'">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                </button>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 1.5rem; align-items: center; flex-shrink: 0;">
                @auth
                    <div style="position: relative;" id="navUserDropdownParent">
                        <button id="navUserBtn" style="display: flex; align-items: center; gap: 0.5rem; background: none; border: none; cursor: pointer; color: #111827;">
                            <img src="{{ Auth::user()->profile_image_url }}" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover;">
                            <div class="desktop-only" style="text-align: left; line-height: 1.2;">
                                <div style="font-size: 0.75rem; color: #6b7280;">Welcome back</div>
                                <div style="font-weight: 600; font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                            </div>
                        </button>
                        <div id="navUserMenu" style="position: absolute; top: calc(100% + 10px); right: 0; background: #fff; border: 1px solid #e5e7eb; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); border-radius: 8px; width: 200px; padding: 0.5rem 0; display: none; z-index: 1001;">
                            <a href="{{ route('profile') }}" style="display: block; padding: 0.7rem 1.2rem; color: #374151; text-decoration: none; font-size: 0.9rem;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='none'">Profile</a>
                            <a href="{{ route('orders.my') }}" style="display: block; padding: 0.7rem 1.2rem; color: #374151; text-decoration: none; font-size: 0.9rem;" onmouseover="this.style.background='#f3f4f6'" onmouseout="this.style.background='none'">My Orders</a>
                            <div style="border-top: 1px solid #e5e7eb; margin: 0.5rem 0;"></div>
                            <button onclick="openLogoutModal()" style="display: block; width: 100%; text-align: left; padding: 0.7rem 1.2rem; color: #ef4444; background: none; border: none; font-size: 0.9rem; cursor: pointer;" onmouseover="this.style.background='#fef2f2'" onmouseout="this.style.background='none'">Log out</button>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; color: #111827; transition: color 0.2s;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="desktop-only" style="font-weight: 500; font-size: 0.95rem;">Login / Register</span>
                    </a>
                @endauth

                <a href="{{ route('favorites') }}" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: #111827; position: relative; transition: color 0.2s;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">
                    <div style="position: relative;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.84-8.84 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                        <span style="position: absolute; top: -5px; right: -8px; background: #0056b3; color: white; font-size: 10px; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700;">0</span>
                    </div>
                    <span class="desktop-only" style="font-size: 0.75rem; font-weight: 500; margin-top: 0.2rem;">Wishlist</span>
                </a>

                <a href="{{ route('cart.index') }}" style="display: flex; flex-direction: column; align-items: center; text-decoration: none; color: #111827; position: relative; transition: color 0.2s;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">
                    <div style="position: relative;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                        @php $count = Auth::check() ? Auth::user()->cartItems()->sum('quantity') : 0; @endphp
                        <span id="cart-badge" style="position: absolute; top: -5px; right: -8px; background: #0056b3; color: white; font-size: 10px; width: 16px; height: 16px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-weight: 700;">{{ $count }}</span>
                    </div>
                    <span class="desktop-only" style="font-size: 0.75rem; font-weight: 500; margin-top: 0.2rem;">Cart</span>
                </a>

                <!-- Mobile menu toggle -->
                <button class="mobile-only" id="mobile-toggle" style="background: none; border: none; padding: 0; margin-left: 0.5rem; cursor: pointer; color: #111827;">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Navigation Menu (Desktop) -->
    <div class="desktop-only" style="border-bottom: 1px solid #f3f4f6;">
        <div class="container" style="display: flex; gap: 2rem;">
            <!-- Category Sidebar Placeholder Header (Matches width of sidebar if needed, but in image it's on the home page. Wait, looking at the image, "BROWSE CATEGORIES" has a blue background and sits right next to "HOME". It might be in the nav bar container.) -->
            <!-- We will let the Home page handle the BROWSE CATEGORIES block, or handle it here if it's on all pages. Usually it's only expanded on home. -->
            
            <nav style="display: flex; gap: 0.5rem; padding: 0.5rem 0;">
                <a href="{{ route('home') }}" style="padding: 0.6rem 1.2rem; background: {{ request()->routeIs('home') ? '#0056b3' : 'transparent' }}; color: {{ request()->routeIs('home') ? 'white' : '#111827' }}; text-decoration: none; font-weight: 600; font-size: 0.9rem; border-radius: 4px; transition: 0.2s;" onmouseover="if(!this.style.background.includes('#0056b3')) { this.style.color='#0056b3'; }" onmouseout="if(!this.style.background.includes('#0056b3')) { this.style.color='#111827'; }">HOME</a>
                <a href="{{ route('category', 'all') }}" style="padding: 0.6rem 1.2rem; color: #111827; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.2s; display: flex; align-items: center; gap: 0.3rem;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">PRODUCTS <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"></path></svg></a>
                <a href="{{ route('category', 'all') }}" style="padding: 0.6rem 1.2rem; color: #111827; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.2s; display: flex; align-items: center; gap: 0.3rem;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">CATEGORIES <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"></path></svg></a>
                <a href="#" style="padding: 0.6rem 1.2rem; color: #111827; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.2s; display: flex; align-items: center; gap: 0.3rem;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">DEALS <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6"></path></svg></a>
                <a href="#" style="padding: 0.6rem 1.2rem; color: #111827; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.2s;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">BRANDS</a>
                <a href="{{ route('about') }}" style="padding: 0.6rem 1.2rem; color: #111827; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.2s;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">ABOUT US</a>
                <a href="{{ route('contact') }}" style="padding: 0.6rem 1.2rem; color: #111827; text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.2s;" onmouseover="this.style.color='#0056b3'" onmouseout="this.style.color='#111827'">CONTACT US</a>
            </nav>
        </div>
    </div>
</header>

<!-- Mobile Sidebar (Simplified) -->
<div class="mobile-sidebar-overlay" id="mobile-overlay" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5); z-index:1999;"></div>
<aside class="mobile-sidebar" id="mobile-sidebar" style="position:fixed; top:0; left:-100%; width:80%; max-width:300px; height:100vh; background:#fff; z-index:2000; transition:0.3s; padding:2rem 1.5rem; overflow-y:auto; box-shadow: 5px 0 15px rgba(0,0,0,0.1);">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
        <span style="font-weight:800; font-size:1.2rem;">Menu</span>
        <button id="mobile-close" style="background:none; border:none; cursor:pointer;"><svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"></path></svg></button>
    </div>
    <div style="display:flex; flex-direction:column; gap:1rem;">
        <a href="{{ route('home') }}" style="text-decoration:none; color:#111827; font-weight:600;">Home</a>
        <a href="{{ route('category', 'all') }}" style="text-decoration:none; color:#111827; font-weight:600;">Products</a>
        <a href="{{ route('about') }}" style="text-decoration:none; color:#111827; font-weight:600;">About Us</a>
        <a href="{{ route('contact') }}" style="text-decoration:none; color:#111827; font-weight:600;">Contact Us</a>
    </div>
</aside>

<style>
    @media (max-width: 991px) {
        .desktop-only { display: none !important; }
        #mobile-toggle { display: block !important; }
    }
    @media (min-width: 992px) {
        .mobile-only { display: none !important; }
    }
    .mobile-sidebar.active { left: 0 !important; }
</style>

<script>
    // User dropdown logic
    const navUserBtn = document.getElementById('navUserBtn');
    const navUserMenu = document.getElementById('navUserMenu');
    const navUserParent = document.getElementById('navUserDropdownParent');

    if(navUserBtn && navUserMenu) {
        navUserBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isVisible = navUserMenu.style.display === 'block';
            navUserMenu.style.display = isVisible ? 'none' : 'block';
        });

        document.addEventListener('click', (e) => {
            if (navUserParent && !navUserParent.contains(e.target)) {
                navUserMenu.style.display = 'none';
            }
        });
    }

    // Mobile sidebar
    const toggle = document.getElementById('mobile-toggle');
    const close = document.getElementById('mobile-close');
    const sidebar = document.getElementById('mobile-sidebar');
    const overlay = document.getElementById('mobile-overlay');

    if(toggle) toggle.addEventListener('click', () => { sidebar.classList.add('active'); overlay.style.display = 'block'; });
    if(close) close.addEventListener('click', () => { sidebar.classList.remove('active'); overlay.style.display = 'none'; });
    if(overlay) overlay.addEventListener('click', () => { sidebar.classList.remove('active'); overlay.style.display = 'none'; });
</script>

