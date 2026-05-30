@extends('layouts.main')

@section('title', 'Our Story - ElitePC')

@section('content')
<style>
    /* Fancy Animations & Keyframes */
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(1deg); }
    }
    @keyframes float-medium {
        0%, 100% { transform: translateY(0px) scale(1); }
        50% { transform: translateY(-8px) scale(1.02); }
    }
    @keyframes pulse-glow {
        0%, 100% { opacity: 0.15; transform: scale(1); }
        50% { opacity: 0.3; transform: scale(1.15); }
    }
    @keyframes gradient-move {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    @keyframes pulse-radar {
        0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
        100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    .hud-element {
        transition: all 0.3s ease;
    }
    .hud-image-container {
        position: relative;
        overflow: hidden;
        border-radius: 28px;
    }
    .hud-image {
        width: 100%;
        display: block;
        object-fit: cover;
        height: 420px;
        filter: contrast(1.05) brightness(0.95);
        transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .hud-image-container:hover .hud-image {
        transform: scale(1.08);
    }
    .hud-image-container:hover .hud-element {
        background: rgba(15, 23, 42, 0.8) !important;
        border-color: rgba(255, 255, 255, 0.3) !important;
    }

    /* Neon Orb Elements */
    .glow-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(130px);
        z-index: 1;
        pointer-events: none;
    }
    .orb-primary {
        top: 5%;
        right: -5%;
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.25) 0%, rgba(236, 72, 153, 0.05) 70%);
        animation: pulse-glow 10s infinite ease-in-out;
    }
    .orb-secondary {
        bottom: 10%;
        left: -10%;
        width: 700px;
        height: 700px;
        background: radial-gradient(circle, rgba(6, 182, 212, 0.2) 0%, rgba(99, 102, 241, 0.05) 70%);
        animation: pulse-glow 14s infinite ease-in-out alternate;
    }

    /* Premium Cards styling */
    .fancy-card {
        background: rgba(255, 255, 255, 0.45);
        backdrop-filter: blur(24px);
        -webkit-backdrop-filter: blur(24px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        box-shadow: 0 20px 50px -15px rgba(15, 23, 42, 0.04);
        border-radius: 28px;
        padding: 3rem 2.5rem;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        position: relative;
        overflow: hidden;
        z-index: 2;
    }
    .fancy-card::before {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: 28px;
        padding: 2px;
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.5) 0%, rgba(236, 72, 153, 0.15) 40%, rgba(6, 182, 212, 0.5) 100%);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .fancy-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 30px 60px -20px rgba(99, 102, 241, 0.15);
        background: rgba(255, 255, 255, 0.7);
    }
    .fancy-card:hover::before {
        opacity: 1;
    }

    /* Interactive Stats Panel */
    .stats-panel {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 24px;
        padding: 2rem;
        margin-bottom: 8rem;
        box-shadow: 0 20px 40px -15px rgba(0,0,0,0.03);
        position: relative;
        z-index: 2;
    }
    .stat-item {
        text-align: center;
        padding: 1rem 1.5rem;
        border-right: 1px solid rgba(15, 23, 42, 0.08);
    }
    .stat-item:last-child {
        border-right: none;
    }
    @media (max-width: 991px) {
        .stats-panel {
            grid-template-columns: repeat(2, 1fr);
            gap: 2rem 0;
        }
        .stat-item:nth-child(2) {
            border-right: none;
        }
    }
    @media (max-width: 576px) {
        .stats-panel {
            grid-template-columns: 1fr;
        }
        .stat-item {
            border-right: none;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08);
        }
        .stat-item:last-child {
            border-bottom: none;
        }
    }

    /* Timeline Section */
    .timeline-item {
        position: relative;
        padding-left: 3rem;
        border-left: 2px dashed rgba(99, 102, 241, 0.2);
        padding-bottom: 3.5rem;
    }
    .timeline-item:last-child {
        border-left: 2px solid transparent;
        padding-bottom: 0;
    }
    .timeline-dot {
        position: absolute;
        left: -10px;
        top: 6px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: var(--primary);
        border: 4px solid var(--bg);
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.15);
        transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }
    .timeline-item:hover .timeline-dot {
        background: var(--secondary);
        box-shadow: 0 0 0 6px rgba(236, 72, 153, 0.25);
        transform: scale(1.25);
    }

    /* Interactive Team Members */
    .team-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 2rem;
        margin-bottom: 8rem;
    }
    @media (max-width: 991px) {
        .team-grid {
            grid-template-columns: 1fr;
            max-width: 500px;
            margin: 0 auto 8rem auto;
        }
    }
    .team-card {
        background: rgba(255, 255, 255, 0.4);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 24px;
        padding: 2.5rem 2rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .team-card:hover {
        transform: translateY(-8px);
        background: rgba(255, 255, 255, 0.65);
        border-color: rgba(99, 102, 241, 0.25);
        box-shadow: 0 20px 40px -15px rgba(99, 102, 241, 0.1);
    }
    .avatar-container {
        position: relative;
        width: 120px;
        height: 120px;
        margin-bottom: 1.5rem;
    }
    .avatar-glow {
        position: absolute;
        inset: -4px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        opacity: 0.6;
        transition: all 0.4s ease;
    }
    .team-card:hover .avatar-glow {
        transform: scale(1.05);
        opacity: 1;
        filter: blur(2px);
    }
    .avatar-image {
        position: relative;
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #ffffff;
        z-index: 2;
    }

    /* Shiny CTA Container */
    .cta-container {
        position: relative;
        padding: 5rem 3rem;
        border-radius: 36px;
        text-align: center;
        overflow: hidden;
        z-index: 2;
        background: rgba(241, 245, 249, 0.8);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(15, 23, 42, 0.08);
        box-shadow: 0 20px 40px -15px rgba(15, 23, 42, 0.05);
    }
    .cta-container::after {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at 80% 20%, rgba(99, 102, 241, 0.1) 0%, transparent 60%),
                    radial-gradient(circle at 10% 80%, rgba(236, 72, 153, 0.08) 0%, transparent 50%);
        z-index: -1;
    }
</style>

<section style="padding: 10rem 0 6rem 0; position: relative; overflow: hidden; background: var(--bg);">
    <!-- Ambient Neon Blur Orbs -->
    <div class="glow-orb orb-primary"></div>
    <div class="glow-orb orb-secondary"></div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <!-- Hero Section -->
        <div class="responsive-grid grid-2" style="align-items: center; margin-bottom: 8rem; gap: 5rem;">
            <div class="animate-fade-in">
                <div class="glass" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1.25rem; border-radius: 50px; margin-bottom: 2rem; font-weight: 800; color: var(--primary); font-size: 0.8rem; letter-spacing: 2px; text-transform: uppercase; border-color: rgba(99, 102, 241, 0.2);">
                    <span style="width: 8px; height: 8px; background: var(--primary); border-radius: 50%; display: inline-block; box-shadow: 0 0 10px var(--primary);"></span>
                    The Elite Standard
                </div>
                
                <h1 style="font-weight: 900; line-height: 1.1; margin-bottom: 2.5rem; font-family: 'Outfit'; letter-spacing: -2px; color: var(--text);">
                    Artisanship Without <span class="text-gradient">Compromise</span>
                </h1>
                
                <p style="font-size: 1.2rem; opacity: 0.8; line-height: 1.8; margin-bottom: 1.8rem; color: var(--text-dim); font-weight: 500;">
                    Founded in Phnom Penh, ElitePC was born from a single obsession: computer hardware built to its absolute limit. We don't build generic systems; we build custom masterpieces.
                </p>
                
                <p style="font-size: 1.05rem; opacity: 0.65; line-height: 1.8; color: var(--text-dim);">
                    Whether you are an e-sports champion, a 3D animator, or a hardcore collector, our engineers hand-select, meticulously test, and custom-craft each configuration to match your dream setup.
                </p>
            </div>
            
            <div class="animate-fade-in" style="animation-delay: 0.2s; position: relative;">
                <!-- Decorative Graphic Element resembling PC interior -->
                <div style="position: absolute; inset: -20px; background: linear-gradient(135deg, var(--primary), var(--secondary)); opacity: 0.15; filter: blur(30px); border-radius: 40px; z-index: -1;"></div>
                
                <div class="glass" style="padding: 1.25rem; border-radius: 40px; box-shadow: 0 30px 60px -15px rgba(0,0,0,0.1); border-color: rgba(255,255,255,0.7); animation: float-slow 6s infinite ease-in-out;">
                    <div class="hud-image-container">
                        <img src="https://images.unsplash.com/photo-1587202372775-e229f172b9d7?auto=format&fit=crop&q=80&w=1200" alt="Tech Lab" class="hud-image">
                        
                        <!-- Viewfinder corners -->
                        <div style="position: absolute; top: 1.25rem; left: 1.25rem; width: 14px; height: 14px; border-top: 2px solid rgba(255,255,255,0.5); border-left: 2px solid rgba(255,255,255,0.5); pointer-events: none;"></div>
                        <div style="position: absolute; top: 1.25rem; right: 1.25rem; width: 14px; height: 14px; border-top: 2px solid rgba(255,255,255,0.5); border-right: 2px solid rgba(255,255,255,0.5); pointer-events: none;"></div>
                        <div style="position: absolute; bottom: 6.25rem; left: 1.25rem; width: 14px; height: 14px; border-bottom: 2px solid rgba(255,255,255,0.5); border-left: 2px solid rgba(255,255,255,0.5); pointer-events: none;"></div>
                        <div style="position: absolute; bottom: 6.25rem; right: 1.25rem; width: 14px; height: 14px; border-bottom: 2px solid rgba(255,255,255,0.5); border-right: 2px solid rgba(255,255,255,0.5); pointer-events: none;"></div>

                        <!-- Tech readouts -->
                        <div class="hud-element" style="position: absolute; top: 1.25rem; left: 1.25rem; background: rgba(15,23,42,0.6); backdrop-filter: blur(8px); padding: 0.4rem 0.8rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.15); color: #10b981; font-family: monospace; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; gap: 0.4rem; z-index: 10;">
                            <span style="width: 6px; height: 6px; background: #10b981; border-radius: 50%; display: inline-block;"></span>
                            LIVE FEED #09
                        </div>
                        
                        <div class="hud-element" style="position: absolute; top: 1.25rem; right: 1.25rem; background: rgba(15,23,42,0.6); backdrop-filter: blur(8px); padding: 0.4rem 0.8rem; border-radius: 8px; border: 1px solid rgba(255,255,255,0.15); color: #3b82f6; font-family: monospace; font-size: 0.75rem; font-weight: 700; display: flex; flex-direction: column; gap: 0.1rem; text-align: right; z-index: 10;">
                            <div>SYS TEMP: 28.4°C</div>
                            <div style="color: rgba(255,255,255,0.5); font-size: 0.65rem;">PUMP: OPTIMAL</div>
                        </div>

                        <!-- Overlay Hologram Specs -->
                        <div class="hud-element" style="position: absolute; bottom: 1.25rem; left: 1.25rem; right: 1.25rem; padding: 1.25rem; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(12px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.15); display: flex; align-items: center; justify-content: space-between; z-index: 10;">
                            <div>
                                <div style="color: #ffffff; font-weight: 800; font-size: 0.95rem; font-family: 'Outfit';">Rigorous Lab Standard</div>
                                <div style="color: rgba(255,255,255,0.6); font-size: 0.75rem; font-weight: 600; text-transform: uppercase; margin-top: 0.2rem; letter-spacing: 0.5px;">Testing phase active</div>
                            </div>
                            <div style="width: 12px; height: 12px; background: #10b981; border-radius: 50%; box-shadow: 0 0 12px #10b981; animation: pulse-radar 1.5s infinite;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Stats Panel -->
        <div class="stats-panel animate-fade-in" style="animation-delay: 0.3s;">
            <div class="stat-item">
                <div class="text-gradient" style="font-size: 3rem; font-weight: 900; font-family: 'Outfit'; line-height: 1;">15k+</div>
                <div style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-dim); margin-top: 0.5rem;">Rig builds completed</div>
            </div>
            <div class="stat-item">
                <div class="text-gradient" style="font-size: 3rem; font-weight: 900; font-family: 'Outfit'; line-height: 1;">99.9%</div>
                <div style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-dim); margin-top: 0.5rem;">Happy enthusiasts</div>
            </div>
            <div class="stat-item">
                <div class="text-gradient" style="font-size: 3rem; font-weight: 900; font-family: 'Outfit'; line-height: 1;">5 Yrs</div>
                <div style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-dim); margin-top: 0.5rem;">Crafting experience</div>
            </div>
            <div class="stat-item">
                <div class="text-gradient" style="font-size: 3rem; font-weight: 900; font-family: 'Outfit'; line-height: 1;">0</div>
                <div style="font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; color: var(--text-dim); margin-top: 0.5rem;">Compromises made</div>
            </div>
        </div>

        <!-- Section Header: Core Values -->
        <div style="text-align: center; margin-bottom: 4rem;">
            <h2 style="font-size: 2.8rem; font-weight: 800; font-family: 'Outfit'; color: var(--text);">Why Builders Choose <span class="text-gradient">ElitePC</span></h2>
            <p style="color: var(--text-dim); max-width: 600px; margin: 1rem auto 0 auto; font-size: 1.05rem; font-weight: 500;">We operate at the intersection of aesthetic art and ultimate silicon performance.</p>
        </div>

        <!-- Interactive Core Values Grid -->
        <div class="responsive-grid grid-3" style="margin-bottom: 8rem; gap: 2.5rem;">
            <div class="fancy-card">
                <div style="width: 60px; height: 60px; background: rgba(99, 102, 241, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; color: var(--primary);">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="9" y1="3" x2="9" y2="21"></line><line x1="15" y1="3" x2="15" y2="21"></line><line x1="3" y1="9" x2="21" y2="9"></line><line x1="3" y1="15" x2="21" y2="15"></line></svg>
                </div>
                <h3 style="font-size: 1.4rem; font-weight: 800; font-family: 'Outfit'; margin-bottom: 1rem; color: var(--text);">Pure Selection</h3>
                <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.7; color: var(--text-dim);">We don't stock inventory blindly. Every single GPU, SSD, and RAM kit is stress-tested in-house to verify stability and performance headroom before being shipped.</p>
            </div>
            
            <div class="fancy-card">
                <div style="width: 60px; height: 60px; background: rgba(236, 72, 153, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; color: var(--secondary);">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
                <h3 style="font-size: 1.4rem; font-weight: 800; font-family: 'Outfit'; margin-bottom: 1rem; color: var(--text);">Watercooling Mastery</h3>
                <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.7; color: var(--text-dim);">Hardline acrylic and brass loops are bent by hand by our experienced engineering team. Perfectly clean lines, optimized flow-rates, and ultimate temperature headroom.</p>
            </div>
            
            <div class="fancy-card">
                <div style="width: 60px; height: 60px; background: rgba(6, 182, 212, 0.1); border-radius: 18px; display: flex; align-items: center; justify-content: center; margin-bottom: 2rem; color: #06b6d4;">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                </div>
                <h3 style="font-size: 1.4rem; font-weight: 800; font-family: 'Outfit'; margin-bottom: 1rem; color: var(--text);">Enthusiast Shield</h3>
                <p style="opacity: 0.7; font-size: 0.95rem; line-height: 1.7; color: var(--text-dim);">Our warranty doesn't include waitlists. You get direct access to our tech builders via phone or shop-in for quick diagnoses and free hardware cleaning services.</p>
            </div>
        </div>

        <!-- Section: Timeline (Evolutionary Journey) -->
        <div style="max-width: 800px; margin: 0 auto 8rem auto;">
            <div style="text-align: center; margin-bottom: 5rem;">
                <h2 style="font-size: 2.8rem; font-weight: 800; font-family: 'Outfit'; color: var(--text);">Our Journey</h2>
                <p style="color: var(--text-dim); margin-top: 1rem; font-size: 1.05rem;">From a tiny workbench to Cambodia's prime destination for custom systems.</p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div style="font-weight: 900; font-size: 1.1rem; color: var(--primary); font-family: 'Outfit'; margin-bottom: 0.5rem; letter-spacing: 0.5px;">2021 &bull; THE GENESIS</div>
                    <h3 style="font-weight: 800; margin-bottom: 0.6rem; color: var(--text); font-size: 1.25rem;">Workshop Launch</h3>
                    <p style="color: var(--text-dim); line-height: 1.7; font-size: 0.95rem;">ElitePC begins on a small single desk in Phnom Penh, focused entirely on fixing critical thermal issues and overclocking standard PCs for local competitive gamers.</p>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div style="font-weight: 900; font-size: 1.1rem; color: var(--primary); font-family: 'Outfit'; margin-bottom: 0.5rem; letter-spacing: 0.5px;">2023 &bull; THE LIQUID ERA</div>
                    <h3 style="font-weight: 800; margin-bottom: 0.6rem; color: var(--text); font-size: 1.25rem;">Custom Loops Revolution</h3>
                    <p style="color: var(--text-dim); line-height: 1.7; font-size: 0.95rem;">We pioneered customized hardline water loop builds locally, sponsoring national gaming events and offering boutique modifications that could withstand Cambodian summer heat.</p>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div style="font-weight: 900; font-size: 1.1rem; color: var(--primary); font-family: 'Outfit'; margin-bottom: 0.5rem; letter-spacing: 0.5px;">2026 &bull; ELITEPC 2.0</div>
                    <h3 style="font-weight: 800; margin-bottom: 0.6rem; color: var(--text); font-size: 1.25rem;">Aesthetic Tech Showroom</h3>
                    <p style="color: var(--text-dim); line-height: 1.7; font-size: 0.95rem;">Opening our flagship interactive showroom in Phnom Penh alongside this premium customization portal to serve the next generation of digital builders and designers.</p>
                </div>
            </div>
        </div>

        <!-- Section: Meet the Builders -->
        <div style="margin-bottom: 8rem;">
            <div style="text-align: center; margin-bottom: 5rem;">
                <h2 style="font-size: 2.8rem; font-weight: 800; font-family: 'Outfit'; color: var(--text);">Meet the <span class="text-gradient">Builders</span></h2>
                <p style="color: var(--text-dim); margin-top: 1rem; font-size: 1.05rem; font-weight: 500;">The specialized engineers responsible for bringing your system to life.</p>
            </div>

            <div class="team-grid">
                <div class="team-card">
                    <div class="avatar-container">
                        <div class="avatar-glow"></div>
                        <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=300" alt="Vibol Sen" class="avatar-image">
                    </div>
                    <h3 style="font-weight: 800; font-family: 'Outfit'; font-size: 1.25rem; color: var(--text); margin-bottom: 0.3rem;">Vibol Sen</h3>
                    <div style="color: var(--primary); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Founder &amp; Chief Architect</div>
                    <p style="color: var(--text-dim); font-size: 0.88rem; line-height: 1.6; opacity: 0.8;">Custom waterloop designer with over 8 years of hardware performance design.</p>
                </div>

                <div class="team-card">
                    <div class="avatar-container">
                        <div class="avatar-glow"></div>
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=300" alt="Sophea Chan" class="avatar-image">
                    </div>
                    <h3 style="font-weight: 800; font-family: 'Outfit'; font-size: 1.25rem; color: var(--text); margin-bottom: 0.3rem;">Sophea Chan</h3>
                    <div style="color: var(--primary); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Lead Diagnostics Expert</div>
                    <p style="color: var(--text-dim); font-size: 0.88rem; line-height: 1.6; opacity: 0.8;">Responsible for our 48-hour continuous stability testing protocol.</p>
                </div>

                <div class="team-card">
                    <div class="avatar-container">
                        <div class="avatar-glow"></div>
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=300" alt="Rathana Kim" class="avatar-image">
                    </div>
                    <h3 style="font-weight: 800; font-family: 'Outfit'; font-size: 1.25rem; color: var(--text); margin-bottom: 0.3rem;">Rathana Kim</h3>
                    <div style="color: var(--primary); font-size: 0.8rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Customer Experience Director</div>
                    <p style="color: var(--text-dim); font-size: 0.88rem; line-height: 1.6; opacity: 0.8;">Ensuring lifetime support, rapid RMA resolutions, and upgrade consulting.</p>
                </div>
            </div>
        </div>

        <!-- Premium CTA Section -->
        <div class="cta-container animate-fade-in" style="animation-delay: 0.2s;">
            <h2 style="font-size: clamp(2rem, 5vw, 3.2rem); font-weight: 900; margin-bottom: 1.5rem; font-family: 'Outfit'; color: var(--text); line-height: 1.2;">
                Ready to Build Your <span class="text-gradient">Masterpiece</span>?
            </h2>
            
            <p style="font-size: 1.15rem; max-width: 700px; margin: 0 auto 3.5rem auto; line-height: 1.8; color: var(--text-dim); font-weight: 500;">
                Collaborate directly with our Phnom Penh custom tech laboratory builders to design a rig built to your exact visual and gaming performance requirements.
            </p>
            
            <a href="{{ route('contact') }}" class="btn btn-primary glow-btn" style="padding: 1.25rem 3rem; font-size: 1rem; width: fit-content; text-transform: uppercase; letter-spacing: 1px; font-weight: 800; box-shadow: 0 0 25px rgba(99, 102, 241, 0.4);">
                Consult a Rig Builder
            </a>
        </div>
    </div>
</section>
@endsection
