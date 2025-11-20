import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(ScrollTrigger, SplitText);

/**
 * Initialize mobile manufacturing section animations
 */
export function initMobileManufacturing() {
    const mobileSection = document.getElementById('manufacturing-mobile');

    if (!mobileSection) {
        console.log('Mobile manufacturing section not found');
        return;
    }

    console.log('Initializing mobile manufacturing animations');

    // Animate floating bubbles
    const bubbles = mobileSection.querySelectorAll('.js-manufacturing-bubble-mobile');
    bubbles.forEach((bubble, index) => {
        // Random size between 40px and 120px
        const size = gsap.utils.random(40, 120);
        gsap.set(bubble, {
            width: size,
            height: size,
            x: gsap.utils.random(0, window.innerWidth - size),
            y: gsap.utils.random(0, mobileSection.offsetHeight)
        });

        // Floating animation
        gsap.to(bubble, {
            y: `-=${gsap.utils.random(100, 300)}`,
            x: `+=${gsap.utils.random(-50, 50)}`,
            duration: gsap.utils.random(8, 15),
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut',
            delay: index * 0.5
        });

        // Opacity pulse
        gsap.to(bubble, {
            opacity: gsap.utils.random(0.3, 0.8),
            duration: gsap.utils.random(3, 6),
            repeat: -1,
            yoyo: true,
            ease: 'sine.inOut'
        });
    });

    // Animate header elements
    const fadeInElements = mobileSection.querySelectorAll('[data-animate="fade-in"]');
    fadeInElements.forEach((element) => {
        const delay = parseFloat(element.getAttribute('data-delay')) || 0;

        gsap.from(element, {
            scrollTrigger: {
                trigger: element,
                start: 'top 85%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 20,
            duration: 0.8,
            delay: delay,
            ease: 'power2.out'
        });
    });

    // Animate title with split text
    const splitTextElements = mobileSection.querySelectorAll('[data-animate="split-text"]');
    splitTextElements.forEach((element) => {
        const split = new SplitText(element, { type: 'words,chars' });

        gsap.from(split.chars, {
            scrollTrigger: {
                trigger: element,
                start: 'top 85%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 20,
            rotationX: -90,
            stagger: 0.02,
            duration: 0.6,
            ease: 'back.out(1.7)'
        });
    });

    // Animate manufacturing cards
    const cards = mobileSection.querySelectorAll('[data-animate="fade-up"]');
    cards.forEach((card) => {
        const delay = parseFloat(card.getAttribute('data-delay')) || 0;

        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top 85%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 60,
            duration: 0.9,
            delay: delay,
            ease: 'power3.out'
        });

        // Animate card content elements
        const contentElements = card.querySelectorAll('[data-animate="fade-in"]');
        contentElements.forEach((element) => {
            const contentDelay = parseFloat(element.getAttribute('data-delay')) || 0;

            gsap.from(element, {
                scrollTrigger: {
                    trigger: card,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                },
                opacity: 0,
                y: 15,
                duration: 0.6,
                delay: contentDelay,
                ease: 'power2.out'
            });
        });
    });

    console.log('Mobile manufacturing animations initialized');
}

/**
 * Cleanup function
 */
export function cleanupMobileManufacturing() {
    ScrollTrigger.getAll().forEach(trigger => {
        if (trigger.vars.trigger && trigger.vars.trigger.closest('#manufacturing-mobile')) {
            trigger.kill();
        }
    });
}
