@extends('layouts.dashboard')

@section('title', 'Admin Profile')

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
            <div class="glass-card" style="padding: 2.5rem; text-align: center; margin-bottom: 1.5rem; background: #f8fafc; border: 1px solid rgba(15, 23, 42, 0.05); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="position: relative; width: 140px; height: 140px; margin: 0 auto 2rem;">
                    <img src="{{ Auth::user()->profile_image_url }}" style="width: 100%; height: 100%; border-radius: 40px; object-fit: cover; box-shadow: 0 20px 40px rgba(0,0,0,0.1);">
                    <div style="position: absolute; bottom: -10px; right: -10px; width: 44px; height: 44px; background: white; border: 2px solid var(--primary); border-radius: 15px; display: flex; align-items: center; justify-content: center; color: var(--primary); box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
                    </div>
                </div>
                <h3 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.5rem; margin-bottom: 0.5rem; color: var(--text);">{{ Auth::user()->name }}</h3>
                <p style="opacity: 0.8; font-size: 0.85rem; font-weight: 800; letter-spacing: 1px; color: var(--primary);">ADMIN OPERATIVE</p>
            </div>

            <button onclick="scrollToSection('info-section')" class="nav-btn active">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                Identity Matrix
            </button>
            <button onclick="scrollToSection('config-section')" class="nav-btn">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                Platform Config
            </button>
        </div>

        <!-- Main Content Area -->
        <div style="display: flex; flex-direction: column; gap: 3rem;">
            <!-- Identity Matrix -->
            <div id="info-section" class="glass-card animate-fade-in" style="padding: 4rem; background: #f8fafc; border: 1px solid rgba(99, 102, 241, 0.2); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem;">
                    <h2 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; display: flex; align-items: center; gap: 1.5rem; color: var(--text);">
                        <div style="width: 44px; height: 44px; background: var(--primary); border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        </div>
                        Identity Matrix
                    </h2>
                    <span class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: #4b5563; background: #e2e8f0; letter-spacing: 1px;">CORE DATA</span>
                </div>

                <form action="{{ route('profile.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2.5rem;">
                    @csrf @method('PATCH')
                    <div class="form-row-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                        <div class="input-group">
                            <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b;">OPERATIVE NAME</label>
                            <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}" required style="border: 1px solid rgba(15, 23, 42, 0.05); padding: 1.2rem; border-radius: 12px; font-size: 1rem; color: var(--text); background: #f1f5f9; font-weight: 500;">
                            @error('name')
                                <span style="color: #ef4444; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem;">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-group">
                            <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b;">COMMUNICATION EMAIL</label>
                            <input type="email" value="{{ Auth::user()->email }}" disabled style="border: 1px solid rgba(15, 23, 42, 0.05); padding: 1.2rem; border-radius: 12px; font-size: 1rem; color: #64748b; background: #f1f5f9; cursor: not-allowed; font-weight: 500;">
                        </div>
                    </div>
                    <div style="display: flex; justify-content: flex-end; margin-top: 1.5rem;">
                        <button type="submit" class="btn btn-primary" style="padding: 1.2rem 3rem; border-radius: 18px; font-weight: 800; box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);">Synchronize Identity</button>
                    </div>
                </form>
            </div>

            <!-- Platform Configuration -->
            <div id="config-section" class="glass-card animate-fade-in" style="padding: 4rem; background: #f8fafc; border: 1px solid rgba(15, 23, 42, 0.05); box-shadow: 0 4px 20px rgba(0,0,0,0.02);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 3.5rem;">
                    <h2 style="font-weight: 900; font-family: 'Outfit'; font-size: 1.8rem; display: flex; align-items: center; gap: 1.5rem; color: var(--text);">
                        <div style="width: 44px; height: 44px; background: #10b981; border-radius: 14px; display: flex; align-items: center; justify-content: center; color: white; box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3);">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 20h9"></path><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path></svg>
                        </div>
                        Platform Config
                    </h2>
                    <span class="glass" style="padding: 0.5rem 1rem; border-radius: 50px; font-size: 0.75rem; font-weight: 800; color: #4b5563; background: #e2e8f0; letter-spacing: 1px;">SYSTEM SETTINGS</span>
                </div>

                <div class="form-row-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 2.5rem;">
                    <div class="input-group">
                        <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b;">GLOBAL COMMISSION FEE</label>
                        <input type="text" value="5.00%" disabled style="border: 1px solid rgba(15, 23, 42, 0.05); padding: 1.2rem; border-radius: 12px; font-size: 1rem; color: #64748b; background: #f1f5f9; cursor: not-allowed; font-weight: 500;">
                    </div>
                    <div class="input-group">
                        <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b;">SYSTEM STATUS</label>
                        <div style="border: 1px solid rgba(16, 185, 129, 0.2); padding: 1.2rem; border-radius: 12px; font-size: 1rem; color: #10b981; background: rgba(16, 185, 129, 0.05); font-weight: 800; display: flex; align-items: center; gap: 0.5rem;">
                            <div style="width: 8px; height: 8px; border-radius: 50%; background: #10b981;"></div>
                            ALL SYSTEMS OPERATIONAL
                        </div>
                    </div>
                    <div class="input-group">
                        <label style="font-weight: 800; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; color: #64748b;">SYSTEM CACHE</label>
                        <button type="button" style="border: 1px solid #ef4444; padding: 1.2rem; border-radius: 12px; font-size: 1rem; color: #ef4444; background: rgba(239, 68, 68, 0.05); font-weight: 800; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: 0.3s;" onmouseover="this.style.background='#ef4444'; this.style.color='white'" onmouseout="this.style.background='rgba(239, 68, 68, 0.05)'; this.style.color='#ef4444'">Flush Application Cache</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .nav-btn {
        background: transparent;
        border: 1px solid transparent;
        padding: 1.5rem 2rem;
        border-radius: 20px;
        color: #64748b;
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
        background: rgba(15, 23, 42, 0.02);
        color: var(--text);
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
        const sections = ['info-section', 'config-section'];
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

