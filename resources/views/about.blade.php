@extends('layouts.main')

@section('title', 'Our Story - ElitePC')

@section('content')
<section style="padding: 10rem 0 6rem 0; position: relative; overflow: hidden;">
    <div style="position: absolute; top: -10%; right: -5%; width: 600px; height: 600px; background: var(--primary); filter: blur(180px); opacity: 0.1; border-radius: 50%;"></div>
    
    <div class="container" style="position: relative; z-index: 2;">
        <!-- Hero Section -->
        <div class="responsive-grid grid-2" style="align-items: center; margin-bottom: 8rem; gap: 4rem;">
            <div class="animate-fade-in">
                <div class="glass" style="display: inline-flex; padding: 0.6rem 2rem; border-radius: 50px; margin-bottom: 2rem; font-weight: 800; color: var(--secondary); font-size: 0.9rem; letter-spacing: 2px;">THE ELITE MISSION</div>
                <h1 style="font-size: clamp(3rem, 8vw, 5.5rem); font-weight: 900; line-height: 1; margin-bottom: 3rem; font-family: 'Outfit'; letter-spacing: -2px;">Defining the <span class="text-gradient">Standard</span> of Excellence</h1>
                <p style="font-size: 1.25rem; opacity: 0.7; line-height: 1.8; margin-bottom: 2rem;">
                    Founded in Phnom Penh, ElitePC was born from a simple obsession: hardware without compromise. We don't just sell components; we provide the foundation for your greatest digital achievements.
                </p>
                <p style="font-size: 1.1rem; opacity: 0.6; line-height: 1.8;">
                    Whether you are a competitive gamer, a creative professional, or a hardware enthusiast, we curate only the highest-performing tech on the planet.
                </p>
            </div>
            <div class="animate-fade-in" style="animation-delay: 0.3s;">
                <div class="glass" style="padding: 1rem; border-radius: 40px;">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=1200" style="width: 100%; border-radius: 32px; box-shadow: 0 30px 60px -20px rgba(0,0,0,0.6);">
                </div>
            </div>
        </div>

        <!-- Features Grid -->
        <div class="responsive-grid grid-3" style="margin-bottom: 8rem;">
            <div class="glass animate-fade-in" style="padding: 3rem; border-radius: 32px; text-align: center; animation-delay: 0.1s;">
                <div style="font-size: 3rem; margin-bottom: 1.5rem;">💎</div>
                <h3 style="font-weight: 800; margin-bottom: 1rem;">Pure Quality</h3>
                <p style="opacity: 0.6; font-size: 0.95rem;">Every component is rigorously tested by our engineering team before listing.</p>
            </div>
            <div class="glass animate-fade-in" style="padding: 3rem; border-radius: 32px; text-align: center; animation-delay: 0.2s;">
                <div style="font-size: 3rem; margin-bottom: 1.5rem;">⚡</div>
                <h3 style="font-weight: 800; margin-bottom: 1rem;">Max Performance</h3>
                <p style="opacity: 0.6; font-size: 0.95rem;">We only source the latest-generation hardware optimized for modern workloads.</p>
            </div>
            <div class="glass animate-fade-in" style="padding: 3rem; border-radius: 32px; text-align: center; animation-delay: 0.3s;">
                <div style="font-size: 3rem; margin-bottom: 1.5rem;">🛡️</div>
                <h3 style="font-weight: 800; margin-bottom: 1rem;">Elite Support</h3>
                <p style="opacity: 0.6; font-size: 0.95rem;">Our relationship doesn't end at checkout. We offer lifetime technical guidance.</p>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="glass" style="padding: 4rem 2rem; border-radius: 50px; text-align: center; background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(236, 72, 153, 0.1) 100%);">
            <h2 style="font-size: clamp(2rem, 5vw, 3.5rem); font-weight: 800; margin-bottom: 2rem; font-family: 'Outfit';">The Future of <span class="text-gradient">Gaming</span> in Cambodia</h2>
            <p style="font-size: 1.2rem; opacity: 0.7; max-width: 800px; margin: 0 auto 4rem auto; line-height: 1.8;">
                We are building more than a store. We are fostering a community of pioneers, gamers, and creators who push the boundaries of what's possible.
            </p>
            <a href="{{ route('register') }}" class="btn btn-primary" style="padding: 1.5rem 3rem; font-size: 1.1rem; width: fit-content;">Join the Elite Community</a>
        </div>
    </div>
</section>
@endsection
