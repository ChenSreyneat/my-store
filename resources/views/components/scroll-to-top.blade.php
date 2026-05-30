<button id="scrollToTopBtn" class="scroll-to-top" title="Go to top">
    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
        <path d="M18 15l-6-6-6 6"/>
    </svg>
</button>

<style>
    .scroll-to-top {
        position: fixed;
        bottom: 2rem;
        left: 2rem; /* Placed on left to avoid overlapping with toast container on the right */
        z-index: 999;
        background: var(--primary, #6366f1);
        color: white;
        border: none;
        outline: none;
        cursor: pointer;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 25px rgba(99, 102, 241, 0.4);
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .scroll-to-top.visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .scroll-to-top:hover {
        transform: translateY(-5px) scale(1.05);
        background: #4f46e5;
        box-shadow: 0 15px 35px rgba(99, 102, 241, 0.6);
    }

    @media (max-width: 768px) {
        .scroll-to-top {
            bottom: 1.5rem;
            left: 1.5rem;
            width: 45px;
            height: 45px;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const scrollBtn = document.getElementById('scrollToTopBtn');
        
        if (scrollBtn) {
            window.addEventListener('scroll', function() {
                if (window.scrollY > 300) {
                    scrollBtn.classList.add('visible');
                } else {
                    scrollBtn.classList.remove('visible');
                }
            });

            scrollBtn.addEventListener('click', function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        }
    });
</script>
