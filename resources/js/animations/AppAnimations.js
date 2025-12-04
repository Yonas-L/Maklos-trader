import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import Lenis from 'lenis';
import HeroAnimations from './HeroAnimations';
import ProductShowcase from './ProductShowcase';
import { initMobileProductShowcase } from './ProductShowcaseMobile';
import ManufacturingAnimations from './ManufacturingAnimations';
import { initMobileManufacturing } from './ManufacturingMobile';
import AboutAnimations from './AboutAnimations';
import initManufacturingImagePromo from './ManufacturingImagePromo';
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
        initMobileProductShowcase(); // Initialize mobile product animations
        new ManufacturingAnimations();
        initMobileManufacturing(); // Initialize mobile manufacturing animations
        new AboutAnimations();
        new FaqAnimations();
        new ContactAnimations();
        new NavbarAnimations();

        // Initialize manufacturing image promo (desktop + mobile)
        initManufacturingImagePromo();
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
