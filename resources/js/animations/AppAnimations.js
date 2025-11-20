import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import HeroAnimations from './HeroAnimations';
import ProductShowcase from './ProductShowcase';
import ManufacturingAnimations from './ManufacturingAnimations';
import AboutAnimations from './AboutAnimations';
import FaqAnimations from './FaqAnimations';
import ContactAnimations from './ContactAnimations';
import NavbarAnimations from './NavbarAnimations';

export default class AppAnimations {
    constructor() {
        this.init();
    }

    init() {
        this.initLenis();
        this.initScrollTrigger();

        // Initialize section animations
        new HeroAnimations();
        new ProductShowcase();
        new ManufacturingAnimations();
        new AboutAnimations();
        new FaqAnimations();
        new ContactAnimations();
        new NavbarAnimations();
    }

    initLenis() {
        if (window.__lenis) return;

        const lenis = new Lenis({
            duration: 1.05,
            smoothWheel: true,
            smoothTouch: false,
            gestureOrientation: 'vertical',
            wheelMultiplier: 0.95,
        });

        lenis.on('scroll', ScrollTrigger.update);

        gsap.ticker.add((time) => {
            lenis.raf(time * 1000);
        });

        gsap.ticker.lagSmoothing(0);
        window.__lenis = lenis;
    }

    initScrollTrigger() {
        gsap.registerPlugin(ScrollTrigger);
        ScrollTrigger.config({ limitCallbacks: true, ignoreMobileResize: true });

    }
}
