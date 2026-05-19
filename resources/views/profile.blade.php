@extends('layouts.dashboard')

@section('title', 'Profile Hub - ElitePC')

@section('content')
<section style="padding-bottom: 5rem;">
    <!-- Profile Header -->
    <div style="margin-bottom: 5rem;" class="flex-wrap-md header-stack">
        <div>
            <h1 style="font-size: clamp(2.5rem, 6vw, 4rem); font-weight: 900; font-family: 'Outfit'; letter-spacing: -2px; line-height: 1; margin-bottom: 1.5rem;">User <span class="text-gradient">Hub</span></h1>
            <p style="opacity: 0.6; font-size: 1.1rem; font-weight: 600;">Architect your identity and secure your performance ecosystem.</p>
        </div>
        <div class="glass" style="padding: 0.6rem 1.5rem; border-radius: 50px; font-size: 0.8rem; font-weight: 800; color: var(--primary); letter-spacing: 1px; border-color: var(--primary); margin-bottom: 0.5rem;">
            STATUS: ACTIVE NODE
        </div>
    </div>

    <div style="display: grid; grid-template-columns: 320px 1fr; gap: 4rem;" class="dynamic-grid">
        <!-- Sidebar Navigation -->
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            <div class="glass-card" style="padding: 2.5rem; text-align: center; margin-bottom: 1.5rem;">
                <div style="position: relative; width: 140px; height: 140px; margin: 0 auto 2rem;">
                    @if(Auth::user()->profile_image)
                        <img src="{{ asset('storage/'.Auth::user()->profile_image) }}" style="width: 100%; height: 100%; border-radius: 40px; object-fit: cover; box-shadow: 0 20px 40px rgba(0,0,0,0.3);">
                    @else
                        <div style="width: 100%; height: 100%; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 40px; display: flex; align-items: center; justify-content: center; font-size: 3.5rem; font-weight: 900; color: white; transform: rotate(-3deg); box-shadow: 0 20px 40px rgba(0,0,0,0.2);">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                    @endif
                    <label for="profile_image_input" style="position: absolute; bottom: -10px; right: -10px; width: 44px; height: 44px; background: var(--bg); border: 2px solid var(--primary); border-radius: 15px; display: flex; align-items: center; justify-content: center; cursor: pointer; color: var(--primary); transition: 0.3s; box-shadow: 0 10px 20px rgba(0,0,0,0.2);" onmouseover="this.style.background='var(--primary)'; this.style.color='white'">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    </label>
                </div>
                <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; margin-bottom: 0.5rem;">{{ Auth::user()->name }}</h3>
                <p style="opacity: 0.5; font-size: 0.85rem; font-weight: 800; letter-spacing: 1px; color: var(--primary);">{{ strtoupper(Auth::user()->role) }} OPERATIVE</p>
            </div>

            <button onclick="scrollToSection('info-section')" class="nav-btn active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Identity Matrix
            </button>
            <button onclick="scrollToSection('logistics-section')" class="nav-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                Deployment Logistics
            </button>
            <button onclick="scrollToSection('security-section')" class="nav-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                Security Protocols
            </button>
        </div>

        <!-- Main Content Area -->
        <div style="display: flex; flex-direction: column; gap: 3rem;">
            <!-- Hidden Image Form -->
            <form id="avatar-form" action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" style="display: none;">
                @csrf @method('PATCH')
                <input type="file" id="profile_image_input" name="profile_image" accept="image/*" onchange="document.getElementById('avatar-form').submit()">
                <input type="hidden" name="name" value="{{ Auth::user()->name }}">
            </form>

            <!-- Identity Matrix -->
            <div id="info-section" class="glass-card animate-fade-in" style="padding: 4rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem;">
                    <h2 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; display: flex; align-items: center; gap: 1.5rem;">
                        <div style="width: 44px; height: 44px; background: var(--primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        Identity Matrix
                    </h2>
                    <span class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; opacity: 0.5; letter-spacing: 1px;">CORE DATA</span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2.5rem;">
                    @csrf @method('PATCH')
                    <div class="form-row-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                        <div class="input-group">
                            <label>OPERATIVE NAME</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="border-color: {{ $errors->has('name') ? '#ef4444' : '' }}">
                            @error('name')
                                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label>COMMUNICATION EMAIL</label>
                            <input type="email" value="{{ Auth::user()->email }}" disabled style="opacity: 0.5; cursor: not-allowed; background: rgba(255,255,255,0.01);">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary" style="padding: 1.2rem 3rem; border-radius: 18px; font-weight: 800;">Synchronize Identity</button>
                    </div>
                </form>
            </div>

            <!-- Deployment Logistics -->
            <div id="logistics-section" class="glass-card animate-fade-in" style="padding: 4rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem;">
                    <h2 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; display: flex; align-items: center; gap: 1.5rem;">
                        <div style="width: 44px; height: 44px; background: var(--secondary); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                        </div>
                        Deployment Logistics
                    </h2>
                    <span class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; opacity: 0.5; letter-spacing: 1px;">SUPPLY CHAIN</span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2.5rem;">
                    @csrf @method('PATCH')
                    <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                    
                    <div class="input-group">
                        <label>CONTACT TELEMETRY (PHONE)</label>
                        <input type="text" name="phone" value="{{ old('phone', Auth::user()->phone) }}" placeholder="+855 00 000 000" style="border-color: {{ $errors->has('phone') ? '#ef4444' : '' }}">
                        @error('phone')
                            <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="input-group">
                        <label>DEPLOYMENT TARGET (ADDRESS)</label>
                        <textarea name="address" style="min-height: 120px; resize: none; border-color: {{ $errors->has('address') ? '#ef4444' : '' }}">{{ old('address', Auth::user()->address) }}</textarea>
                        @error('address')
                            <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary" style="padding: 1.2rem 3rem; border-radius: 18px; font-weight: 800; background: var(--secondary); border-color: var(--secondary); box-shadow: 0 15px 30px rgba(var(--secondary-rgb), 0.2);">Update Logistics</button>
                    </div>
                </form>
            </div>

            <!-- Security Protocols -->
            <div id="security-section" class="glass-card animate-fade-in" style="padding: 4rem;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem;">
                    <h2 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; display: flex; align-items: center; gap: 1.5rem;">
                        <div style="width: 44px; height: 44px; background: #ef4444; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white;">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        </div>
                        Security Protocols
                    </h2>
                    <span class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; opacity: 0.5; letter-spacing: 1px; border-color: #ef4444; color: #ef4444;">ENCRYPTED</span>
                </div>

                <form action="{{ route('profile.password.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2.5rem;">
                    @csrf @method('PATCH')
                    
                    <div class="input-group">
                        <label>CURRENT AUTHENTICATION KEY</label>
                        <input type="password" name="current_password" required style="border-color: {{ $errors->has('current_password') ? '#ef4444' : '' }}">
                        @error('current_password')
                            <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                        <div class="input-group">
                            <label>NEW ACCESS KEY</label>
                            <input type="password" name="password" required style="border-color: {{ $errors->has('password') ? '#ef4444' : '' }}">
                            @error('password')
                                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label>CONFIRM ACCESS KEY</label>
                            <input type="password" name="password_confirmation" required>
                        </div>
                    </div>

                    <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary" style="padding: 1.2rem 3rem; border-radius: 18px; font-weight: 800; background: #ef4444; border-color: #ef4444; box-shadow: 0 15px 30px rgba(239, 68, 68, 0.2);">Rotate Access Keys</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-btn {
        background: transparent;
        border: 1px solid var(--glass-border);
        padding: 1.5rem 2rem;
        border-radius: 20px;
        color: var(--text);
        font-weight: 800;
        font-size: 1rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        cursor: pointer;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        text-align: left;
    }
    .nav-btn:hover {
        background: rgba(255,255,255,0.05);
        border-color: var(--primary);
        transform: translateX(10px);
    }
    .nav-btn.active {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        box-shadow: 0 15px 30px rgba(var(--primary-rgb), 0.3);
    }
    .input-group {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }
    .input-group label {
        font-weight: 800;
        opacity: 0.5;
        font-size: 0.8rem;
        letter-spacing: 1.5px;
    }
    .input-group input, .input-group textarea {
        background: rgba(255,255,255,0.03);
        border: 1px solid var(--glass-border);
        padding: 1.25rem 1.5rem;
        border-radius: 20px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        transition: 0.3s;
        font-family: 'Inter';
    }
    .input-group input:focus, .input-group textarea:focus {
        border-color: var(--primary);
        background: rgba(255,255,255,0.05);
        outline: none;
        box-shadow: 0 0 20px rgba(var(--primary-rgb), 0.1);
    }

    @media (max-width: 992px) {
        .dynamic-grid {
            grid-template-columns: 1fr !important;
            gap: 3rem !important;
        }
    }

    @media (max-width: 768px) {
        .form-row-grid {
            grid-template-columns: 1fr !important;
            gap: 1.5rem !important;
        }
        .glass-card {
            padding: 2.5rem !important;
        }
        .input-group input, .input-group textarea {
            padding: 1rem 1.25rem !important;
        }
    }
</style>

<script>
    function scrollToSection(id) {
        document.getElementById(id).scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Update active nav button
        document.querySelectorAll('.nav-btn').forEach(btn => {
            btn.classList.remove('active');
            if (btn.getAttribute('onclick').includes(id)) {
                btn.classList.add('active');
            }
        });
    }

    // Auto update active nav on scroll
    window.addEventListener('scroll', () => {
        const sections = ['info-section', 'logistics-section', 'security-section'];
        let current = '';
        
        sections.forEach(s => {
            const el = document.getElementById(s);
            const rect = el.getBoundingClientRect();
            if (rect.top <= 250) current = s;
        });

        if (current) {
            document.querySelectorAll('.nav-btn').forEach(btn => {
                btn.classList.remove('active');
                if (btn.getAttribute('onclick').includes(current)) {
                    btn.classList.add('active');
                }
            });
        }
    });
</script>
@endsection
