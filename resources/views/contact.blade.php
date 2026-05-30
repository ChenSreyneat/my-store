@extends('layouts.main')

@section('title', 'Contact Us - ElitePC')

@section('content')
<section style="padding: 10rem 0 6rem 0; background: var(--bg);">
    <div class="container" style="max-width: 700px; margin: 0 auto;">
        
        <div>
            <h1 style="font-size: 3.5rem; font-weight: 800; color: #4F46E5; margin-bottom: 0.5rem; font-family: 'Outfit';">Contact Me</h1>
            <h2 style="font-size: 1.5rem; font-weight: 500; color: var(--text-dim); margin-bottom: 2rem; font-family: 'Outfit';">Let's get in touch.</h2>
            <p style="color: var(--text-dim); line-height: 1.6; margin-bottom: 3rem; font-size: 1rem; max-width: 100%;">
                I am always open to discussing new projects, creative ideas, or opportunities to be part of your visions.
            </p>

            <form action="#" method="POST" style="display: flex; flex-direction: column; gap: 1.5rem;">
                @csrf
                <div class="responsive-grid-2">
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-weight: 600; font-size: 0.8rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.2rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-dim);"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            Full Name
                        </label>
                        <input type="text" placeholder="Your name" required style="background: #ffffff; border: 1px solid #e2e8f0; padding: 0.8rem 1rem; border-radius: 8px; color: var(--text); width: 100%; font-size: 0.95rem; outline: none; transition: border-color 0.2s;">
                    </div>
                    <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                        <label style="font-weight: 600; font-size: 0.8rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.2rem;">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-dim);"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            Email Address
                        </label>
                        <input type="email" placeholder="your@email.com" required style="background: #ffffff; border: 1px solid #e2e8f0; padding: 0.8rem 1rem; border-radius: 8px; color: var(--text); width: 100%; font-size: 0.95rem; outline: none; transition: border-color 0.2s;">
                    </div>
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 600; font-size: 0.8rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.2rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-dim);"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        Subject
                    </label>
                    <input type="text" placeholder="What's this about?" required style="background: #ffffff; border: 1px solid #e2e8f0; padding: 0.8rem 1rem; border-radius: 8px; color: var(--text); width: 100%; font-size: 0.95rem; outline: none; transition: border-color 0.2s;">
                </div>
                
                <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-weight: 600; font-size: 0.8rem; color: var(--text-dim); text-transform: uppercase; letter-spacing: 0.05em; display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.2rem;">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color: var(--text-dim);"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                        Message
                    </label>
                    <textarea placeholder="Tell me about your project or question..." required style="background: #ffffff; border: 1px solid #e2e8f0; padding: 0.8rem 1rem; border-radius: 8px; color: var(--text); height: 160px; resize: none; width: 100%; font-size: 0.95rem; outline: none; transition: border-color 0.2s;"></textarea>
                </div>
                
                <button type="submit" style="background: #2563eb; color: white; border: none; padding: 1rem; border-radius: 8px; font-weight: 600; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; transition: background 0.3s; margin-top: 0.5rem; width: 100%;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    Send Message
                </button>
            </form>
        </div>
        
    </div>
</section>
@endsection
