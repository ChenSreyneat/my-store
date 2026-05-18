@extends('layouts.main')

@section('title', 'Contact Us - ElitePC')

@section('content')
<section style="padding: 10rem 0 6rem 0; position: relative;">
    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 600px; background: radial-gradient(circle at 50% 0%, rgba(99, 102, 241, 0.1) 0%, transparent 70%);"></div>

    <div class="container" style="position: relative; z-index: 2;">
        <div style="text-align: center; margin-bottom: 5rem;">
            <div class="glass" style="display: inline-flex; padding: 0.6rem 2rem; border-radius: 50px; margin-bottom: 2rem; font-weight: 800; color: var(--primary); font-size: 0.9rem; letter-spacing: 2px;">GET IN TOUCH</div>
            <h1 style="font-size: clamp(3rem, 8vw, 5.5rem); font-weight: 900; font-family: 'Outfit'; line-height: 1; letter-spacing: -2px;">Hardware <span class="text-gradient">Support</span></h1>
            <p style="opacity: 0.7; max-width: 700px; margin: 2rem auto 0 auto; font-size: 1.2rem; line-height: 1.6;">Have a technical question or need help with an order? Our world-class experts are here to help.</p>
        </div>

        <div class="responsive-grid grid-2" style="grid-template-columns: 1fr 1.5fr; align-items: start; gap: 4rem;">
            <!-- Contact Info -->
            <div style="display: flex; flex-direction: column; gap: 2rem;">
                <div class="glass" style="padding: 2.5rem; border-radius: 32px;">
                    <div style="width: 48px; height: 48px; background: rgba(99, 102, 241, 0.1); border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center; color: var(--primary);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    </div>
                    <h4 style="font-weight: 800; margin-bottom: 0.5rem;">Phone Support</h4>
                    <p style="opacity: 0.6; font-size: 0.95rem;">+855 12 345 678</p>
                    <p style="opacity: 0.4; font-size: 0.8rem; margin-top: 0.5rem;">Mon - Sat, 9am - 6pm</p>
                </div>

                <div class="glass" style="padding: 2.5rem; border-radius: 32px;">
                    <div style="width: 48px; height: 48px; background: rgba(236, 72, 153, 0.1); border-radius: 12px; margin-bottom: 1.5rem; display: flex; align-items: center; justify-content: center; color: var(--secondary);">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    </div>
                    <h4 style="font-weight: 800; margin-bottom: 0.5rem;">Email Inquiry</h4>
                    <p style="opacity: 0.6; font-size: 0.95rem;">support@elitepc.com</p>
                    <p style="opacity: 0.4; font-size: 0.8rem; margin-top: 0.5rem;">Average response: 2 hours</p>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="glass" style="padding: clamp(1.5rem, 5vw, 4rem); border-radius: 40px;">
                <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 2rem;">
                    <div class="responsive-grid grid-2" style="gap: 2rem;">
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label style="font-weight: 700; opacity: 0.7; font-size: 0.9rem;">Name</label>
                            <input type="text" required style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 16px; color: white; width: 100%;">
                        </div>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label style="font-weight: 700; opacity: 0.7; font-size: 0.9rem;">Email</label>
                            <input type="email" required style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 16px; color: white; width: 100%;">
                        </div>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-weight: 700; opacity: 0.7; font-size: 0.9rem;">Subject</label>
                        <select style="background: var(--dark); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 16px; color: white; width: 100%;">
                            <option>Order Support</option>
                            <option>Technical Question</option>
                            <option>Returns & Warranty</option>
                            <option>Other</option>
                        </select>
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-weight: 700; opacity: 0.7; font-size: 0.9rem;">Message</label>
                        <textarea required style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 1rem; border-radius: 16px; color: white; height: 150px; resize: none; width: 100%;"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" style="padding: 1.25rem; font-size: 1.1rem; width: 100%;">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
