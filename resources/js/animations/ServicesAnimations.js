import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default class ServicesAnimations {
    constructor() {
        this.init();
    }

    init() {
        this.animateDesktop();
        this.animateMobile();
    }

    animateDesktop() {
        const section = document.querySelector('#services');
        if (!section) return;

        // Header
        const header = section.querySelector('.js-services-header');
        if (header) {
            gsap.fromTo(header, {
                opacity: 0,
                y: 40
            }, {
                scrollTrigger: {
                    trigger: section,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                },
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out'
            });
        }

        // Cards Stagger
        const cards = section.querySelectorAll('.js-service-card');
        if (cards.length > 0) {
            cards.forEach((card) => {
                const delay = parseFloat(card.dataset.delay || 0);

                gsap.fromTo(card, {
                    opacity: 0,
                    y: 60
                }, {
                    scrollTrigger: {
                        trigger: section,
                        start: 'top 75%',
                        toggleActions: 'play none none reverse'
                    },
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    delay: delay,
                    ease: 'back.out(1.2)'
                });
            });
        }
    }

    animateMobile() {
        const section = document.querySelector('#services-mobile');
        if (!section) return;

        // Header
        const header = section.querySelector('.js-services-mobile-header');
        if (header) {
            gsap.fromTo(header, {
                opacity: 0,
                y: 30
            }, {
                scrollTrigger: {
                    trigger: section,
                    start: 'top 85%',
                    toggleActions: 'play none none reverse'
                },
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out'
            });
        }

        // Stacked Cards Stagger
        const cards = section.querySelectorAll('.js-service-mobile-card');
        if (cards.length > 0) {
            cards.forEach((card) => {
                const delay = parseFloat(card.dataset.delay || 0);

                gsap.fromTo(card, {
                    opacity: 0,
                    x: 40 // Slide in from right for mobile
                }, {
                    scrollTrigger: {
                        trigger: card,
                        start: 'top 90%', // Trigger earlier on mobile
                        toggleActions: 'play none none reverse'
                    },
                    opacity: 1,
                    x: 0,
                    duration: 0.6,
                    delay: delay,
                    ease: 'power2.out'
                });
            });
        }
    }
}
