import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default class ProductShowcase {
    constructor() {
        this.init();
    }

    init() {
        gsap.registerPlugin(ScrollTrigger);
        this.animateProductGrid();
    }

    animateProductGrid() {
        const section = document.querySelector('.js-products-section');
        if (!section) return;

        // Animate Header
        const header = section.querySelector('.js-products-header');
        if (header) {
            gsap.to(header, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 75%',
                    toggleActions: 'play none none reverse'
                }
            });
        }

        // Animate Cards Stagger
        const cards = section.querySelectorAll('.js-product-card');
        if (cards.length > 0) {
            gsap.to(cards, {
                opacity: 1,
                y: 0,
                duration: 1,
                stagger: 0.15,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 70%',
                    toggleActions: 'play none none reverse'
                }
            });
        }

        // Animate Explore Button
        const exploreBtn = section.querySelector('.js-explore-button');
        if (exploreBtn) {
            gsap.to(exploreBtn, {
                opacity: 1,
                y: 0,
                duration: 1,
                delay: 0.5,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: section,
                    start: 'top 70%',
                    toggleActions: 'play none none reverse'
                }
            });
        }
    }
}
