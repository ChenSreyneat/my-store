<footer class="glass" style="margin-top: 8rem; border-top: 1px solid var(--glass-border); padding: 5rem 0 2rem 0; border-radius: 40px 40px 0 0;">
    <div class="container">
        <div class="responsive-grid grid-4" style="margin-bottom: 4rem;">
            <!-- Brand Column -->
            <div>
                <a href="{{ route('home') }}" style="display: flex; align-items: center; gap: 0.5rem; text-decoration: none; margin-bottom: 1.5rem;">
                    <span class="text-gradient" style="font-size: 1.4rem; font-family: 'Outfit';">ElitePC</span>
                </a>
                <p style="opacity: 0.6; font-size: 0.95rem; line-height: 1.8;">
                    The ultimate destination for premium PC hardware and custom builds in Cambodia. Elevate your performance with state-of-the-art tech.
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 style="margin-bottom: 1.5rem; font-weight: 700;">Explore</h4>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.8rem;">
                    <li><a href="{{ route('home') }}" style="color: var(--light); text-decoration: none; opacity: 0.6;">Home</a></li>
                    <li><a href="{{ route('about') }}" style="color: var(--light); text-decoration: none; opacity: 0.6;">About Us</a></li>
                    <li><a href="{{ route('contact') }}" style="color: var(--light); text-decoration: none; opacity: 0.6;">Contact</a></li>
                </ul>
            </div>

            <!-- Support -->
            <div>
                <h4 style="margin-bottom: 1.5rem; font-weight: 700;">Support</h4>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.8rem;">
                    <li><a href="#" style="color: var(--light); text-decoration: none; opacity: 0.6;">Shipping</a></li>
                    <li><a href="#" style="color: var(--light); text-decoration: none; opacity: 0.6;">Returns</a></li>
                    <li><a href="#" style="color: var(--light); text-decoration: none; opacity: 0.6;">FAQ</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h4 style="margin-bottom: 1.5rem; font-weight: 700;">Newsletter</h4>
                <p style="opacity: 0.6; font-size: 0.9rem; margin-bottom: 1.2rem;">Stay updated with latest deals and tech drops.</p>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="email" placeholder="Email" style="background: rgba(255,255,255,0.05); border: 1px solid var(--glass-border); padding: 0.8rem; border-radius: 10px; color: white; flex: 1; width: 100%;">
                    <button class="btn btn-primary" style="padding: 0.8rem 1.5rem;">Join</button>
                </div>
            </div>
        </div>

        <div style="border-top: 1px solid var(--glass-border); padding-top: 2rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1.5rem; opacity: 0.4; font-size: 0.8rem;">
            <p>&copy; {{ date('Y') }} ElitePC. Built with excellence in Cambodia.</p>
            <div style="display: flex; gap: 1.5rem;">
                <a href="#" style="color: white; text-decoration: none;">Privacy</a>
                <a href="#" style="color: white; text-decoration: none;">Terms</a>
            </div>
        </div>
    </div>
</footer>
