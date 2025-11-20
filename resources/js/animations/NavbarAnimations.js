import gsap from 'gsap';

export default class NavbarAnimations {
    constructor() {
        this.init();
    }

    init() {
        this.animateNavbar();
    }

    animateNavbar() {
        const navbarTextStrokes = document.querySelectorAll('.navbar-text-stroke');
        if (navbarTextStrokes.length === 0) return;

        // Set initial state
        gsap.set(navbarTextStrokes, {
            strokeDasharray: '500',
            strokeDashoffset: '500',
            opacity: 0
        });

        // Create animation timeline
        const tl = gsap.timeline({
            delay: 0.5 // Small delay for dramatic effect
        });

        // Animate navbar text drawing
        tl.to(navbarTextStrokes, {
            strokeDashoffset: 0,
            opacity: 1,
            duration: 1.5,
            stagger: 0.05,
            ease: "power2.inOut"
        });
    }
}
