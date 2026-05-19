@if(session('admin_impersonator_id'))
<div style="background: var(--primary); color: white; padding: 0.8rem; text-align: center; font-size: 0.9rem; font-weight: 800; display: flex; justify-content: center; align-items: center; gap: 1rem; position: fixed; top: 0; left: 0; right: 0; z-index: 1001;">
    <span>PROTECTED MODE: Currently Impersonating {{ Auth::user()->name }}</span>
    <form action="{{ route('admin.stop_impersonating') }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" style="background: white; color: var(--primary); border: none; padding: 0.4rem 1.2rem; border-radius: 8px; font-weight: 900; cursor: pointer; font-size: 0.75rem; text-transform: uppercase;">Restore Admin Session</button>
    </form>
</div>
@endif

<nav class="glass" style="position: fixed; top: {{ session('admin_impersonator_id') ? '45px' : '0' }}; left: 0; right: 0; z-index: 1000; padding: 1rem 0; margin: 1.5rem 2rem; border-radius: 20px; transition: top 0.3s;">
    <div class="container" style="display: flex; justify-content: space-between; align-items: center;">
        <!-- Left: Logo & Mobile Toggle -->
        <div style="display: flex; align-items: center; flex: 1;">
            <button class="mobile-only" id="mobile-toggle" style="background: var(--glass-bg); border: 1px solid var(--glass-border); color: var(--text); padding: 8px; border-radius: 10px; margin-right: 1rem; cursor: pointer; display: none;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
            
            <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none;">
                <span class="text-gradient" style="font-size: 1.4rem; font-family: 'Outfit'; font-weight: 800;">ElitePC</span>
            </a>
        </div>

        <!-- Center: Desktop Navigation -->
        <div class="desktop-only" style="flex: 2; display: flex; justify-content: center; gap: 2.5rem; align-items: center;">
            <a href="{{ route('home') }}" style="color: var(--text); text-decoration: none; font-weight: 600; opacity: 0.7; transition: 0.3s; font-size: 0.95rem;">Home</a>
            
            <div style="position: relative;" class="dropdown-parent" id="category-dropdown-parent">
                <button id="category-btn" class="btn-dropdown" style="background: none; border: none; color: var(--text); font-weight: 600; opacity: 0.7; font-size: 0.95rem; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; transition: 0.3s;">
                    Categories
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"></path></svg>
                </button>
                <div id="category-menu" class="glass dropdown-menu" style="position: absolute; top: calc(100% + 1rem); left: 50%; transform: translateX(-50%); width: 240px; padding: 1rem; border-radius: 20px; opacity: 0; visibility: hidden; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: var(--card-shadow); pointer-events: none;">
                    <div style="display: grid; gap: 0.5rem;">
                        @foreach($navCategories as $cat)
                        <a href="{{ route('category', $cat->slug) }}" style="display: block; padding: 0.8rem 1.2rem; border-radius: 12px; color: var(--text); text-decoration: none; font-weight: 600; font-size: 0.9rem; transition: 0.2s;" onmouseover="this.style.background='var(--glass-bg)'; this.style.color='var(--primary)'" onmouseout="this.style.background='transparent'; this.style.color='var(--text)'">
                            {{ $cat->name }}
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <a href="{{ route('about') }}" style="color: var(--text); text-decoration: none; font-weight: 600; opacity: 0.7; transition: 0.3s; font-size: 0.95rem;">About</a>
            <a href="{{ route('contact') }}" style="color: var(--text); text-decoration: none; font-weight: 600; opacity: 0.7; transition: 0.3s; font-size: 0.95rem;">Contact</a>
        </div>

        <!-- Right: Actions -->
        <div class="nav-actions" style="flex: 1; display: flex; gap: 1.2rem; align-items: center; justify-content: flex-end;">
            <button onclick="window.toggleTheme()" class="btn-icon desktop-only" style="background: var(--glass-bg); border: 1px solid var(--glass-border); color: var(--text); width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; cursor: pointer;">
                <svg id="theme-icon-sun" style="display: none;" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>
                <svg id="theme-icon-moon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>
            </button>

            <a href="{{ route('favorites') }}" style="color: var(--text); background: var(--glass-bg); border: 1px solid var(--glass-border); width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center; transition: 0.3s;" onmouseover="this.style.color='var(--primary)'" onmouseout="this.style.color='var(--text)'">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l8.84-8.84 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </a>

            <a href="{{ route('cart.index') }}" style="color: var(--text); position: relative; background: var(--glass-bg); border: 1px solid var(--glass-border); width: 40px; height: 40px; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                @php $count = Auth::check() ? Auth::user()->cartItems()->sum('quantity') : 0; @endphp
                <span id="cart-badge" style="position: absolute; top: -5px; right: -5px; background: var(--secondary); color: white; font-size: 10px; min-width: 18px; height: 18px; padding: 0 4px; border-radius: 50%; display: {{ $count > 0 ? 'flex' : 'none' }}; align-items: center; justify-content: center; font-weight: 800; border: 2px solid var(--bg);">{{ $count }}</span>
            </a>

            @auth
                <div style="position: relative;" id="navUserDropdownParent">
                    <button id="navUserBtn" style="width: 44px; height: 44px; border-radius: 14px; overflow: hidden; border: 2px solid var(--glass-border); padding: 0; background: none; cursor: pointer; display: flex; transition: 0.3s;">
                        <img src="{{ Auth::user()->profile_image ? asset('storage/'.Auth::user()->profile_image) : 'https://ui-avatars.com/api/?name='.Auth::user()->name }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </button>
                    <div id="navUserMenu" class="glass" style="position: absolute; top: calc(100% + 1rem); right: 0; width: 220px; padding: 1rem; border-radius: 20px; opacity: 0; visibility: hidden; transition: 0.3s; box-shadow: var(--card-shadow); pointer-events: none; z-index: 1001;">
                        <div style="padding: 0.5rem 1rem 1rem 1rem; border-bottom: 1px solid var(--glass-border); margin-bottom: 0.5rem;">
                            <div style="font-weight: 800; font-size: 0.85rem; color: var(--text);">{{ Auth::user()->name }}</div>
                            <div style="font-size: 0.7rem; opacity: 0.5; text-transform: uppercase; font-weight: 800; letter-spacing: 0.5px;">{{ Auth::user()->role }} Account</div>
                        </div>
                        <div style="display: grid; gap: 0.2rem;">
                            <a href="{{ route('profile') }}" class="mobile-sub-link" style="padding: 0.8rem 1rem; border-radius: 12px; opacity: 0.8; font-size: 0.9rem;" onmouseover="this.style.background='var(--glass-bg)'; this.style.opacity='1'" onmouseout="this.style.background='transparent'; this.style.opacity='0.8'">Profile Hub</a>
                            <a href="{{ route('orders.my') }}" class="mobile-sub-link" style="padding: 0.8rem 1rem; border-radius: 12px; opacity: 0.8; font-size: 0.9rem;" onmouseover="this.style.background='var(--glass-bg)'; this.style.opacity='1'" onmouseout="this.style.background='transparent'; this.style.opacity='0.8'">My Orders</a>
                                <button type="button" onclick="openLogoutModal()" class="mobile-sub-link" style="width: 100%; text-align: left; background: none; border: none; padding: 0.8rem 1rem; border-radius: 12px; color: #ef4444; opacity: 0.8; font-size: 0.9rem; cursor: pointer;" onmouseover="this.style.background='rgba(239, 68, 68, 0.05)'; this.style.opacity='1'" onmouseout="this.style.background='transparent'; this.style.opacity='0.8'">Secure Logout</button>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline desktop-only" style="padding: 0.6rem 1.5rem; font-size: 0.9rem;">Login</a>
            @endauth
        </div>
    </div>
</nav>

<!-- Premium Mobile Sidebar -->
<div class="mobile-sidebar-overlay" id="mobile-overlay"></div>
<aside class="mobile-sidebar glass" id="mobile-sidebar">
    <div style="padding: 2.5rem 1.5rem; height: 100%; display: flex; flex-direction: column;">
        <!-- Header -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3rem;">
            <div style="display: flex; align-items: center; gap: 0.8rem;">
                <span class="text-gradient" style="font-size: 1.3rem; font-family: 'Outfit'; font-weight: 800;">ElitePC</span>
            </div>
            <button id="mobile-close" style="background: var(--glass-bg); border: 1px solid var(--glass-border); color: var(--text); padding: 8px; border-radius: 10px; cursor: pointer;">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"></path></svg>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav style="display: flex; flex-direction: column; gap: 0.5rem; flex: 1; overflow-y: auto;">
            <a href="{{ route('home') }}" class="mobile-nav-link active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                Home
            </a>
            
            <!-- Mobile Accordion for Categories -->
            <div class="mobile-accordion">
                <button class="mobile-nav-link" id="mobile-cat-toggle" style="width: 100%; justify-content: space-between;">
                    <span style="display: flex; align-items: center; gap: 1rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect><path d="M8 21h8M12 17v4"></path></svg>
                        Categories
                    </span>
                    <svg class="chevron" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M6 9l6 6 6-6"></path></svg>
                </button>
                <div class="mobile-accordion-content" id="mobile-cat-content">
                    @foreach($navCategories as $cat)
                    <a href="{{ route('category', $cat->slug) }}" class="mobile-sub-link">{{ $cat->name }}</a>
                    @endforeach
                </div>
            </div>

            <a href="{{ route('about') }}" class="mobile-nav-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4M12 8h.01"></path></svg>
                About Us
            </a>
            <a href="{{ route('contact') }}" class="mobile-nav-link">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                Contact
            </a>
        </nav>

        <!-- Footer Actions -->
        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--glass-border); display: flex; flex-direction: column; gap: 1rem;">
            <button onclick="window.toggleTheme()" class="mobile-nav-link" style="width: 100%;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="5"></circle><path d="M12 1v2M12 21v2M4.22 4.22l1.42 1.42M18.36 18.36l1.42 1.42M1 12h2M21 12h2M4.22 19.78l1.42-1.42M18.36 5.64l1.42-1.42"></path></svg>
                Switch Theme
            </button>
            @auth
                <a href="{{ route('profile') }}" class="btn btn-primary" style="padding: 1.2rem; text-align: center;">My Profile</a>
                <button onclick="openLogoutModal()" class="btn btn-outline" style="width: 100%; padding: 1rem; border-color: #ef4444; color: #ef4444;">Log out</button>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline" style="padding: 1rem; text-align: center;">Login</a>
                <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 1rem; text-align: center;">Join ElitePC</a>
            @endauth
        </div>
    </div>
</aside>

<style>
    /* Utility Classes for Responsive Visibility */
    @media (max-width: 991px) {
        .desktop-only { display: none !important; }
        #mobile-toggle { display: flex !important; }
        nav.glass { margin: 1rem !important; }
    }
    @media (min-width: 992px) {
        .mobile-only { display: none !important; }
    }

    /* Mobile Sidebar Styles */
    .mobile-sidebar {
        position: fixed;
        top: 0;
        left: -100%;
        width: 85%;
        max-width: 350px;
        height: 100vh;
        z-index: 2000;
        transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border-radius: 0 40px 40px 0;
        border-left: none;
    }
    .mobile-sidebar.active { left: 0; }

    .mobile-sidebar-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.4);
        backdrop-filter: blur(8px);
        z-index: 1999;
        opacity: 0;
        visibility: hidden;
        transition: 0.3s;
    }
    .mobile-sidebar-overlay.active {
        opacity: 1;
        visibility: visible;
    }

    .mobile-nav-link {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.2rem;
        border-radius: 16px;
        color: var(--text);
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1rem;
        transition: 0.3s;
        border: 1px solid transparent;
        background: none;
    }
    .mobile-nav-link:active, .mobile-nav-link.active {
        background: var(--glass-bg);
        border-color: var(--glass-border);
        color: var(--primary);
    }
    .mobile-nav-link .chevron { transition: 0.3s; }
    .mobile-nav-link.active .chevron { transform: rotate(180deg); }

    .mobile-accordion-content {
        max-height: 0;
        overflow: hidden;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        padding-left: 3rem;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    .mobile-accordion-content.active { max-height: 500px; padding-bottom: 1rem; }
    
    .mobile-sub-link {
        color: var(--text);
        text-decoration: none;
        padding: 0.8rem 0;
        font-weight: 600;
        opacity: 0.6;
        font-size: 1rem;
        display: block;
    }

    /* Desktop Dropdown logic */
    #category-menu.active {
        opacity: 1 !important;
        visibility: visible !important;
        top: calc(100% + 0.5rem) !important;
        pointer-events: auto !important;
    }
    #category-btn.active {
        color: var(--primary) !important;
        opacity: 1 !important;
    }
</style>

<script>
    // Robust Theme Logic
    window.toggleTheme = () => {
        const html = document.documentElement;
        const currentTheme = html.getAttribute('data-theme') || 'dark';
        const newTheme = currentTheme === 'light' ? 'dark' : 'light';
        html.setAttribute('data-theme', newTheme);
        localStorage.setItem('theme', newTheme);
        window.updateThemeIcons(newTheme);
    };

    window.updateThemeIcons = (theme) => {
        const sun = document.getElementById('theme-icon-sun');
        const moon = document.getElementById('theme-icon-moon');
        if(sun && moon) {
            if(theme === 'light') {
                sun.style.display = 'block';
                moon.style.display = 'none';
            } else {
                sun.style.display = 'none';
                moon.style.display = 'block';
            }
        }
    };

    // Initialize Theme
    (function() {
        const savedTheme = localStorage.getItem('theme') || 'dark';
        document.documentElement.setAttribute('data-theme', savedTheme);
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', () => window.updateThemeIcons(savedTheme));
        } else {
            window.updateThemeIcons(savedTheme);
        }
    })();

    // Dropdown Logic (Desktop)
    const categoryBtn = document.getElementById('category-btn');
    const categoryMenu = document.getElementById('category-menu');
    const categoryParent = document.getElementById('category-dropdown-parent');

    if(categoryBtn && categoryMenu) {
        categoryBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            categoryBtn.classList.toggle('active');
            categoryMenu.classList.toggle('active');
        });
        document.addEventListener('click', (e) => {
            if (categoryParent && !categoryParent.contains(e.target)) {
                categoryBtn.classList.remove('active');
                categoryMenu.classList.remove('active');
            }
        });
    }

    // Mobile Sidebar Logic
    const mobileToggle = document.getElementById('mobile-toggle');
    const mobileClose = document.getElementById('mobile-close');
    const mobileSidebar = document.getElementById('mobile-sidebar');
    const mobileOverlay = document.getElementById('mobile-overlay');
    const mobileCatToggle = document.getElementById('mobile-cat-toggle');
    const mobileCatContent = document.getElementById('mobile-cat-content');

    const toggleSidebar = (show) => {
        if(show) {
            mobileSidebar.classList.add('active');
            mobileOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        } else {
            mobileSidebar.classList.remove('active');
            mobileOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    };

    if(mobileToggle) mobileToggle.addEventListener('click', () => toggleSidebar(true));
    if(mobileClose) mobileClose.addEventListener('click', () => toggleSidebar(false));
    if(mobileOverlay) mobileOverlay.addEventListener('click', () => toggleSidebar(false));

    if(mobileCatToggle) {
        mobileCatToggle.addEventListener('click', () => {
            mobileCatToggle.classList.toggle('active');
            mobileCatContent.classList.toggle('active');
        });
    }

    // Nav User Dropdown (Public)
    const navUserBtn = document.getElementById('navUserBtn');
    const navUserMenu = document.getElementById('navUserMenu');
    const navUserParent = document.getElementById('navUserDropdownParent');

    if(navUserBtn && navUserMenu) {
        navUserBtn.addEventListener('click', (e) => {
            e.stopPropagation();
            const isActive = navUserMenu.style.visibility === 'visible';
            navUserMenu.style.opacity = isActive ? '0' : '1';
            navUserMenu.style.visibility = isActive ? 'hidden' : 'visible';
            navUserMenu.style.pointerEvents = isActive ? 'none' : 'auto';
            navUserMenu.style.top = isActive ? 'calc(100% + 1rem)' : 'calc(100% + 0.5rem)';
        });

        document.addEventListener('click', (e) => {
            if (navUserParent && !navUserParent.contains(e.target)) {
                navUserMenu.style.opacity = '0';
                navUserMenu.style.visibility = 'hidden';
                navUserMenu.style.pointerEvents = 'none';
                navUserMenu.style.top = 'calc(100% + 1rem)';
            }
        });
    }
</script>
