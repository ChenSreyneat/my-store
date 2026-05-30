<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - ElitePC Dashboard</title>

    <!-- Google Fonts: Outfit & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Inter:wght@100..900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #6366f1;                          /* Indigo Accent */
            --primary-hover: #4f46e5;                    /* Indigo Hover State */
            --primary-glow: rgba(99, 102, 241, 0.5);     /* Indigo Halo Accent */
            --secondary: #ec4899;                        /* Hot Pink Highlight */
            --bg: #f8fafc;                               /* Off-white Slate Backdrop */
            --text: #0f172a;                             /* Charcoal Dark Text */
            --text-dim: #64748b;                         /* Cool Gray Muted Text */
            --title-color: #4f46e5;                      /* Deep Indigo for Light Mode */
            --glass-bg: rgba(15, 23, 42, 0.04);          /* Light Glass Surface */
            --glass-border: rgba(15, 23, 42, 0.1);       /* Light Glass Edge */
            --glass-blur: blur(12px);                    /* Frost Backdrop Filter */
            --card-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.08); /* Light Shadow Depth */
            --text-gradient: linear-gradient(135deg, #6366f1 0%, #ec4899 100%);
            --sidebar-bg: rgba(255, 255, 255, 0.8);
            --sidebar-width: 300px;
            --topbar-height: 80px;
            --radius-xl: 24px;
            --radius-lg: 20px;
            --radius-md: 16px;
            --radius-sm: 12px;
            --transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Custom Scrollbars */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        ::-webkit-scrollbar-track {
            background: #10163f;
        }
        ::-webkit-scrollbar-thumb {
            background: var(--primary);
            border-radius: 5px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-hover);
        }

        body {
            background-color: var(--bg);
            color: var(--text);
            overflow-x: hidden;
            transition: var(--transition);
            scrollbar-width: thin;
            scrollbar-color: var(--primary) #10163f;
        }

        h1, h2, h3, .font-outfit {
            font-family: 'Outfit', sans-serif;
        }

        /* Dashboard Typography Scale */
        h1 {
            font-size: clamp(2rem, 4vw, 2.8rem);
            font-weight: 700;
            letter-spacing: -1px;
            color: var(--title-color);
            line-height: 1.2;
        }

        h2 {
            font-size: 1.6rem;
            font-weight: 700;
            letter-spacing: -0.5px;
            color: var(--title-color);
        }

        h3 {
            font-size: 1.05rem;
            font-weight: 600;
            color: var(--text);
            line-height: 1.4;
        }

        /* Dashboard Layout */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--glass-border);
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            overflow: hidden; /* Completely disable scrolling */
        }

        /* Hide scrollbars for the sidebar navigation links container */
        .sidebar-nav {
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
        }
        .sidebar-nav::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        .sidebar-logo {
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-logo img {
            width: 40px;
            height: 40px;
            filter: drop-shadow(0 0 10px var(--primary-glow));
        }

        .sidebar-logo span {
            font-family: 'Outfit', sans-serif;
            font-size: 1.3rem;
            font-weight: 900;
            letter-spacing: -1px;
            background: linear-gradient(to right, #fff, var(--primary));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .nav-group {
            margin-bottom: 1.25rem;
        }

        .nav-label {
            font-size: 0.65rem;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1.5px;
            color: var(--text-dim);
            margin-bottom: 0.8rem;
            padding-left: 0.8rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.7rem 0.9rem;
            color: var(--text-dim);
            text-decoration: none;
            border-radius: var(--radius-md);
            margin-bottom: 0.3rem;
            transition: var(--transition);
            font-weight: 600;
            font-size: 0.85rem;
            position: relative;
        }

        .sidebar-link svg {
            width: 18px;
            height: 18px;
            stroke-width: 2;
        }

        .sidebar-link:hover {
            color: var(--text);
            background: var(--glass-bg);
            transform: translateX(3px);
        }

        .sidebar-link.active {
            color: #fff;
            background: var(--primary);
            box-shadow: 0 8px 16px -4px var(--primary-glow);
        }

        /* Main Content */
        .main-wrapper {
            margin-left: var(--sidebar-width);
            flex: 1;
            padding: 2.5rem 4rem;
            min-height: 100vh;
        }

        /* Top Bar */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 4rem;
            position: relative;
            z-index: 95;
        }

        .search-box {
            background: #ffffff;
            border: 1px solid rgba(15, 23, 42, 0.08);
            padding: 0.6rem 1.25rem;
            border-radius: 100px;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            width: 320px;
            box-shadow: 0 4px 12px rgba(15, 23, 42, 0.02);
            transition: var(--transition);
        }

        .search-box:focus-within {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-glow), 0 4px 12px rgba(15, 23, 42, 0.02);
        }

        .search-box input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]) {
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            border-radius: 0 !important;
            box-shadow: none !important;
            color: var(--text) !important;
            width: 100% !important;
            outline: none !important;
            font-size: 0.88rem !important;
            font-weight: 500 !important;
        }

        .search-box input::placeholder {
            color: var(--text-dim);
            opacity: 0.8;
        }

        .search-shortcut {
            background: rgba(15, 23, 42, 0.05);
            color: var(--text-dim);
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.5px;
            user-select: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .top-actions {
            display: flex;
            align-items: center;
            gap: 2rem;
        }



        .user-pill {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.5rem 1.2rem 0.5rem 0.5rem;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 50px;
            cursor: pointer;
            transition: var(--transition);
        }

        .user-pill:hover {
            border-color: var(--primary);
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary), #818cf8);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: white;
            font-size: 0.8rem;
        }

        .user-info .name {
            font-size: 0.9rem;
            font-weight: 700;
            display: block;
        }

        .user-info .role {
            font-size: 0.7rem;
            opacity: 0.5;
            text-transform: uppercase;
            font-weight: 800;
        }

        /* Glass Cards */
        .glass-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-lg);
            padding: 2.5rem;
            transition: var(--transition);
        }

        .glass-card:hover {
            border-color: var(--primary);
            transform: translateY(-5px);
        }

        .glass {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            backdrop-filter: blur(10px);
            border-radius: var(--radius-md);
        }

        .text-gradient {
            background: linear-gradient(to right, var(--primary), #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn {
            padding: 0.8rem 1.5rem;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .table-responsive {
            overflow-x: auto;
        }

        @keyframes modalPop {
            from { transform: scale(0.9); opacity: 0; }
            to { transform: scale(1); opacity: 1; }
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 10px 20px -5px var(--primary-glow);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px -5px var(--primary-glow);
        }

        /* Badge Styling */
        .badge {
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 800;
            background: var(--glass-bg);
        }

        .badge-red { background: rgba(239, 68, 68, 0.1); color: #ef4444; }
        .badge-green { background: rgba(16, 185, 129, 0.1); color: #10b981; }

        /* Utility Classes for Responsiveness */
        .flex-wrap-md { display: flex; flex-wrap: wrap; gap: 1.5rem; justify-content: space-between; align-items: flex-end; }
        .grid-responsive { display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; }
        .form-grid-admin { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; align-items: end; }
        .grid-split { display: grid; grid-template-columns: 2fr 1.2fr; gap: 3rem; }
        @media (max-width: 1024px) {
            .grid-split { grid-template-columns: 1fr; gap: 2rem; }
        }
        
        @media (max-width: 768px) {
            .flex-wrap-md { flex-direction: column; align-items: flex-start; gap: 1rem; }
            .form-grid-admin { grid-template-columns: 1fr; }
            .header-stack { flex-direction: column; align-items: flex-start !important; gap: 1.5rem !important; }
            .glass-card { padding: 2rem !important; border-radius: 32px !important; }
            .glass { padding: 2rem !important; border-radius: 32px !important; }
            .table-container table th,
            .table-container table td {
                padding: 1rem 1.25rem !important;
            }
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            border-radius: var(--radius-md);
        }

        @media (max-width: 1280px) {
            :root { --sidebar-width: 260px; }
            .main-wrapper { padding: 2rem clamp(1.5rem, 3vw, 3rem); }
            .search-box { width: 280px; }
        }

        @media (max-width: 1200px) {
            .sidebar { 
                transform: translateX(-100%); 
                transition: var(--transition);
                box-shadow: 20px 0 50px rgba(0,0,0,0.5);
                width: 280px;
                padding: 2rem;
            }
            .sidebar.active { transform: translateX(0); }
            .main-wrapper { margin-left: 0; padding: 2rem; }
            .top-bar { margin-bottom: 2.5rem; }
            .search-box { display: none; }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 23, 42, 0.6);
                backdrop-filter: blur(8px);
                z-index: 90;
            }
            .sidebar-overlay.active { display: block; }
            .mobile-toggle {
                display: flex !important;
            }
        }

        @media (max-width: 640px) {
            .main-wrapper { padding: 1rem; }
            .user-info { display: none; }
            .user-pill { padding: 0.5rem; }
            .top-actions { gap: 0.8rem; }
            .glass-card { padding: 1.25rem !important; border-radius: 20px !important; }
            .glass { padding: 1.25rem !important; border-radius: 20px !important; }
            .top-bar { align-items: center; }
            h1 { font-size: 2.2rem !important; letter-spacing: -1px !important; }
            .table-container table th,
            .table-container table td {
                padding: 0.75rem 1rem !important;
            }
        }

        .mobile-toggle {
            display: none;
            width: 42px;
            height: 42px;
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 10px;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            color: var(--text);
            transition: var(--transition);
        }
        .mobile-toggle:hover {
            border-color: var(--primary);
            color: var(--primary);
        }

        select option {
            background-color: #f8fafc;
            color: #0f172a;
        }

        /* Prevent nested container double-margins and alignment shift in dashboard */
        .main-wrapper .container {
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Restrict dashboard content width to 1200px */
        .dashboard-content {
            max-width: 1200px;
            width: 100%;
            margin-right: auto;
        }

        /* Clean and professional form controls */
        input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]),
        textarea,
        select {
            width: 100% !important;
            background: var(--glass-bg) !important;
            border: 1px solid var(--glass-border) !important;
            padding: 0.8rem 1.2rem !important;
            border-radius: 12px !important;
            color: var(--text) !important;
            font-size: 0.95rem !important;
            font-weight: 500 !important;
            transition: var(--transition) !important;
            outline: none !important;
            box-sizing: border-box !important;
        }

        input:not([type="radio"]):not([type="checkbox"]):not([type="submit"]):not([type="button"]):focus,
        textarea:focus,
        select:focus {
            border-color: var(--primary) !important;
            background: rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 0 0 4px var(--primary-glow) !important;
        }

        label {
            display: block !important;
            font-weight: 800 !important;
            font-size: 0.75rem !important;
            text-transform: uppercase !important;
            letter-spacing: 1.5px !important;
            margin-bottom: 0.8rem !important;
            opacity: 0.6 !important;
        }

        /* Clean outline button styles */
        .btn-outline {
            background: transparent !important;
            border: 1px solid var(--glass-border) !important;
            color: var(--text) !important;
        }

        .btn-outline:hover {
            background: var(--glass-bg) !important;
            border-color: var(--primary) !important;
            transform: translateY(-2px) !important;
            color: var(--text) !important;
        }

        /* Laravel Pagination Styling */
        nav[role="navigation"] {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 1.5rem 0;
            width: 100%;
        }

        nav[role="navigation"] .flex-1.justify-between {
            display: none !important;
        }

        nav[role="navigation"] .hidden {
            display: flex !important;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            gap: 1.5rem;
        }

        @media (max-width: 640px) {
            nav[role="navigation"] .hidden {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }

        nav[role="navigation"] p {
            font-size: 0.9rem;
            opacity: 0.6;
            font-weight: 500;
        }

        nav[role="navigation"] p span {
            font-weight: 700;
            color: var(--primary);
        }

        nav[role="navigation"] span.relative.z-0 {
            display: inline-flex;
            gap: 0.5rem;
        }

        nav[role="navigation"] span.relative.z-0 a,
        nav[role="navigation"] span.relative.z-0 span[aria-current="page"] span,
        nav[role="navigation"] span.relative.z-0 span[disabled] span,
        nav[role="navigation"] span.relative.z-0 span.relative {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            min-width: 40px;
            height: 40px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            color: var(--text);
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        nav[role="navigation"] span.relative.z-0 a:hover {
            border-color: var(--primary);
            background: rgba(255, 255, 255, 0.05);
        }

        nav[role="navigation"] span.relative.z-0 span[aria-current="page"] span {
            background: var(--primary);
            border-color: var(--primary);
            color: white;
            cursor: default;
            box-shadow: 0 5px 15px -5px var(--primary);
        }

        nav[role="navigation"] span.relative.z-0 span[disabled] span {
            opacity: 0.4;
            cursor: not-allowed;
        }

        nav[role="navigation"] svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Mobile Overlay -->
        <div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-logo" style="display: flex; align-items: center; gap: 0.8rem; margin-bottom: 2rem;">
                <div style="width: 38px; height: 38px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 8px 16px -4px var(--primary-glow);">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="4" y="4" width="16" height="16" rx="2" ry="2"></rect><rect x="9" y="9" width="6" height="6"></rect><line x1="9" y1="1" x2="9" y2="4"></line><line x1="15" y1="1" x2="15" y2="4"></line><line x1="9" y1="20" x2="9" y2="23"></line><line x1="15" y1="20" x2="15" y2="23"></line><line x1="20" y1="9" x2="23" y2="9"></line><line x1="20" y1="15" x2="23" y2="15"></line><line x1="1" y1="9" x2="4" y2="9"></line><line x1="1" y1="15" x2="4" y2="15"></line></svg>
                </div>
                <span style="font-family: 'Outfit', sans-serif; font-size: 1.4rem; font-weight: 900; background: linear-gradient(to right, var(--text), var(--primary)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; letter-spacing: -0.5px;">ElitePC</span>
            </div>
            
            {{--
            @if(Auth::user()->isAdmin() || Auth::user()->isOwner())
            <div style="margin-bottom: 2.5rem;">
                <a href="{{ Auth::user()->isAdmin() ? route('admin.products') : route('owner.products') }}" class="btn btn-primary" style="width: 100%; border-radius: 14px; font-weight: 800; font-size: 0.85rem; padding: 0.9rem; justify-content: center; background: #6366f1; gap: 0.5rem; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.4);">
                    Add Product
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                </a>
            </div>
            @endif
            --}}

            <!-- Navigation Links -->
            <div class="sidebar-nav" style="flex: 1; overflow-y: auto; overflow-x: hidden;">
                @if(Auth::user()->isAdmin())
                    <div class="nav-group">
                        <p class="nav-label">Core Control</p>
                        <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path></svg>
                            Dashboard of admin
                        </a>
                        <a href="{{ route('admin.users', ['role' => 'owner']) }}" class="sidebar-link {{ request()->role === 'owner' ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 0 0-3-3.87m-4-12a4 4 0 0 1 0 7.75"></path></svg>
                            Manage Owner
                        </a>
                        <a href="{{ route('admin.users', ['role' => 'user']) }}" class="sidebar-link {{ request()->role === 'user' ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-2-4.472"></path></svg>
                            Manage User
                        </a>
                    </div>

                    <div class="nav-group">
                        <p class="nav-label">Platform Assets</p>
                        <a href="{{ route('admin.stores') }}" class="sidebar-link {{ request()->routeIs('admin.stores') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Store
                        </a>
                        <a href="{{ route('admin.products') }}" class="sidebar-link {{ request()->routeIs('admin.products') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            Product
                        </a>
                        <a href="{{ route('admin.orders') }}" class="sidebar-link {{ request()->routeIs('admin.orders') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Customers Orders
                        </a>
                    </div>

                    <div class="nav-group">
                        <p class="nav-label">Intelligence & Settlement</p>
                        <a href="{{ route('admin.reports') }}" class="sidebar-link {{ request()->routeIs('admin.reports') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            Analysis Report
                        </a>
                        <a href="{{ route('admin.settlement') }}" class="sidebar-link {{ request()->routeIs('admin.settlement') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.407 2.651 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.407-2.651-1M12 16V7"></path></svg>
                            Vendor Settlement
                        </a>
                        <a href="{{ route('admin.payment_accounts') }}" class="sidebar-link {{ request()->routeIs('admin.payment_accounts') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"></rect><line x1="2" y1="10" x2="22" y2="10"></line></svg>
                            Payment Protocols
                        </a>
                    </div>

                    <div class="nav-group">
                        <p class="nav-label">Platform Taxonomy</p>
                        <a href="{{ route('admin.categories') }}" class="sidebar-link {{ request()->routeIs('admin.categories') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                            Category
                        </a>
                        <a href="{{ route('admin.product_types') }}" class="sidebar-link {{ request()->routeIs('admin.product_types') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Product Type
                        </a>
                        <a href="{{ route('admin.brands') }}" class="sidebar-link {{ request()->routeIs('admin.brands') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            Brand
                        </a>
                    </div>
                @endif

                @if(Auth::user()->isOwner())
                    <div class="nav-group">
                        <a href="{{ route('owner.dashboard') }}" class="sidebar-link {{ request()->routeIs('owner.dashboard') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v4a1 1 0 01-1 1h-2a1 1 0 01-1-1v-4a1 1 0 001-1m-6 0h6"></path></svg>
                            Dashboard Owner
                        </a>
                        <a href="{{ route('owner.settings') }}" class="sidebar-link {{ request()->routeIs('owner.settings') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            My Store
                        </a>
                        <a href="{{ route('owner.products') }}" class="sidebar-link {{ request()->routeIs('owner.products') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            Inventory
                        </a>
                        <a href="{{ route('owner.orders') }}" class="sidebar-link {{ request()->routeIs('owner.orders') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Orders
                            @if(isset($pendingOrdersCount) && $pendingOrdersCount > 0)
                                <span class="badge badge-red" style="margin-left: auto;">{{ $pendingOrdersCount }}</span>
                            @endif
                        </a>
                        <a href="{{ route('owner.reports') }}" class="sidebar-link {{ request()->routeIs('owner.reports') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                            Analytics
                        </a>
                        <a href="{{ route('owner.users') }}" class="sidebar-link {{ request()->routeIs('owner.users') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-2-4.472m-6-8.154a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 01-2-4.472"></path></svg>
                            User Manage
                        </a>
                        <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            Profile
                        </a>
                    </div>
                @endif

                @if(!Auth::user()->isAdmin() && !Auth::user()->isOwner())
                    <div class="nav-group">
                        <p class="nav-label">Member Hub</p>
                        <a href="{{ route('profile') }}" class="sidebar-link {{ request()->routeIs('profile') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            My Profile
                        </a>
                        <a href="{{ route('orders.my') }}" class="sidebar-link {{ request()->routeIs('orders.my') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                            Order History
                        </a>
                        <a href="{{ route('favorites') }}" class="sidebar-link {{ request()->routeIs('favorites') ? 'active' : '' }}">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            My Favorites
                        </a>
                    </div>

                    <div class="nav-group">
                        <p class="nav-label">Store Access</p>
                        <a href="{{ route('home') }}" class="sidebar-link">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v4a1 1 0 01-1 1h-2a1 1 0 01-1-1v-4a1 1 0 001-1m-6 0h6"></path></svg>
                            Return to Store
                        </a>
                    </div>
                @endif
                
                {{--
                <!-- Mobile App Promotion Card (adapted from H-care UI mockup) -->
                <div style="margin: 2.5rem 0.5rem; padding: 1.5rem; border-radius: 20px; background: linear-gradient(135deg, rgba(99, 102, 241, 0.05), rgba(236, 72, 153, 0.05)); border: 1px dashed rgba(99, 102, 241, 0.2); text-align: center;">
                    <div style="width: 40px; height: 40px; background: rgba(99, 102, 241, 0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 0.75rem auto; color: var(--primary);">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                    </div>
                    <div style="font-size: 0.8rem; font-weight: 800; color: var(--text); margin-bottom: 0.3rem;">Get mobile app</div>
                    <p style="font-size: 0.7rem; color: var(--text-dim); line-height: 1.4; margin-bottom: 1rem;">Manage active nodes and check diagnostic feeds anywhere.</p>
                    <div style="display: flex; gap: 0.4rem; justify-content: center;">
                        <a href="#" style="background: var(--text); color: white; padding: 0.35rem 0.75rem; border-radius: 8px; font-size: 0.65rem; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;">App Store</a>
                        <a href="#" style="background: var(--text); color: white; padding: 0.35rem 0.75rem; border-radius: 8px; font-size: 0.65rem; font-weight: 800; text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;">Google Play</a>
                    </div>
                </div>
                --}}
            </div>

            <!-- Bottom Actions -->
            <div style="border-top: 1px solid var(--glass-border); padding-top: 1.5rem;">
                    <button type="button" onclick="openLogoutModal()" class="sidebar-link" style="width: 100%; background: none; border: none; cursor: pointer; color: #ef4444;">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Secure Logout
                    </button>
            </div>
        </aside>

        <!-- Content -->
        <main class="main-wrapper">
            <div class="dashboard-content">
                <!-- Top Bar -->
                <header class="top-bar">
                <div style="display: flex; align-items: center; gap: 1.5rem;">
                    <div class="mobile-toggle" onclick="toggleSidebar()">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </div>
                    <div class="search-box">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="color: var(--text-dim);"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <input type="text" placeholder="Search task..." style="background: transparent !important; border: none !important; padding: 0 !important; margin: 0 !important; border-radius: 0 !important; box-shadow: none !important;">
                    </div>
                </div>

                <div class="top-actions">


                    <div class="user-pill" style="position: relative;" id="userDropdownTrigger">
                        <img src="{{ Auth::user()->profile_image_url }}" style="width: 35px; height: 35px; border-radius: 50%; object-fit: cover; border: 2px solid var(--primary);">
                        <div class="user-info">
                            <span class="name">{{ Auth::user()->name }}</span>
                            <span class="role">{{ strtoupper(Auth::user()->role) }}</span>
                        </div>
                        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 9l-7 7-7-7"></path></svg>
                        
                        <!-- Dropdown Menu -->
                        <div class="glass-card" id="userDropdownMenu" style="display: none; position: absolute; top: calc(100% + 15px); right: 0; min-width: 240px; padding: 1.5rem; z-index: 1000; box-shadow: 0 30px 60px rgba(0,0,0,0.4); border-color: var(--primary);">
                            <div style="margin-bottom: 1.5rem; border-bottom: 1px solid var(--glass-border); padding-bottom: 1.5rem;">
                                <div style="font-weight: 800; font-size: 0.9rem;">{{ Auth::user()->name }}</div>
                                <div style="font-size: 0.75rem; opacity: 0.5;">{{ Auth::user()->email }}</div>
                            </div>
                            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                                <a href="{{ route('profile') }}" class="sidebar-link" style="margin: 0; padding: 0.8rem 1rem; font-size: 0.85rem;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                    Profile Hub
                                </a>
                                <button type="button" onclick="openLogoutModal()" class="sidebar-link" style="width: 100%; margin: 0; padding: 0.8rem 1rem; font-size: 0.85rem; border: none; background: none; color: #ef4444; cursor: pointer;">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    Logout
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Alerts -->
            @if(session('success'))
                <div class="glass-card animate-fade-in" style="padding: 1.2rem 2rem; margin-bottom: 2rem; border-color: #10b981; background: rgba(16, 185, 129, 0.1); color: #10b981; font-weight: 700;">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="glass-card animate-fade-in" style="padding: 1.2rem 2rem; margin-bottom: 2rem; border-color: #ef4444; background: rgba(239, 68, 68, 0.1); color: #ef4444; font-weight: 700;">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="glass-card animate-fade-in" style="padding: 1.5rem 2.5rem; margin-bottom: 2rem; border-color: #ef4444; background: rgba(239, 68, 68, 0.1); color: #ef4444;">
                    <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>
                        <span style="font-weight: 800; letter-spacing: 1px; font-size: 0.9rem;">PROTOCOL VIOLATION</span>
                    </div>
                    <ul style="margin: 0; padding-left: 1.5rem; font-weight: 600; font-size: 0.95rem; opacity: 0.9;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Yield Content -->
            @yield('content')
            </div>
        </main>
    </div>

    <!-- Delete Confirmation Modal (iOS Style) -->
    <div id="deleteModal" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(20px); z-index: 9999; align-items: center; justify-content: center;">
        <div style="background: var(--bg); border: 1px solid var(--glass-border); width: 300px; border-radius: 20px; overflow: hidden; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5); text-align: center; animation: modalPop 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);">
            <div style="padding: 2rem 1.5rem;">
                <h3 style="font-family: 'Outfit'; font-weight: 800; font-size: 1.15rem; margin-bottom: 0.4rem; color: var(--text); letter-spacing: -0.5px;">Confirm Destruction?</h3>
                <p style="font-size: 0.85rem; opacity: 0.6; font-weight: 500; line-height: 1.4;">This action is irreversible. All associated data will be purged from the ElitePC ecosystem.</p>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; border-top: 1px solid var(--glass-border);">
                <button onclick="closeDeleteModal()" style="padding: 1rem; background: none; border: none; border-right: 1px solid var(--glass-border); color: #007aff; font-weight: 600; font-size: 1.05rem; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='none'">Abort</button>
                <button id="confirmDeleteBtn" style="padding: 1rem; background: none; border: none; color: #ff3b30; font-weight: 600; font-size: 1.05rem; cursor: pointer; transition: 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.05)'" onmouseout="this.style.background='none'">Purge</button>
            </div>
        </div>
    </div>

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

    <script>
        function toggleSidebar() {
            document.getElementById('sidebar').classList.toggle('active');
            document.getElementById('sidebarOverlay').classList.toggle('active');
        }

        function openLogoutModal() {
            document.getElementById('logoutModal').style.display = 'flex';
        }
        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }


        let deleteForm = null;
        function openDeleteModal(form) {
            deleteForm = form;
            document.getElementById('deleteModal').style.display = 'flex';
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').style.display = 'none';
        }

        document.getElementById('confirmDeleteBtn').onclick = () => {
            if (deleteForm) deleteForm.submit();
        };

        // Intercept all delete forms
        document.addEventListener('submit', function(e) {
            if (e.target.method.toLowerCase() === 'post' && e.target.querySelector('input[name="_method"][value="DELETE"]')) {
                if (e.target.hasAttribute('data-no-confirm')) return;
                e.preventDefault();
                openDeleteModal(e.target);
            }
        });
        // User Dropdown Logic
        const dropdownTrigger = document.getElementById('userDropdownTrigger');
        const dropdownMenu = document.getElementById('userDropdownMenu');
        
        if (dropdownTrigger && dropdownMenu) {
            dropdownTrigger.onclick = (e) => {
                e.stopPropagation();
                dropdownMenu.style.display = dropdownMenu.style.display === 'none' ? 'block' : 'none';
            };
            
            window.onclick = () => {
                dropdownMenu.style.display = 'none';
            };
        }
    </script>
    <x-scroll-to-top />
</body>
</html>
