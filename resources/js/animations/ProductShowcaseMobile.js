import { gsap } from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';
import { SplitText } from 'gsap/SplitText';

gsap.registerPlugin(ScrollTrigger, SplitText);

/**
 * Initialize mobile product showcase animations
 */
export function initMobileProductShowcase() {
    const mobileSection = document.getElementById('products-mobile');

    if (!mobileSection) {
        console.log('Mobile product section not found');
        return;
    }

    console.log('Initializing mobile product showcase animations');

    // Animate section header
    const header = mobileSection.querySelector('h2');
    if (header) {
        gsap.from(header, {
            scrollTrigger: {
                trigger: header,
                start: 'top 80%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 30,
            duration: 0.8,
            ease: 'power3.out'
        });
    }

    // Animate product cards with fade-up
    const productCards = mobileSection.querySelectorAll('[data-animate="fade-up"]');
    productCards.forEach((card) => {
        const delay = parseFloat(card.getAttribute('data-delay')) || 0;

        gsap.from(card, {
            scrollTrigger: {
                trigger: card,
                start: 'top 85%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            y: 50,
            duration: 0.8,
            delay: delay,
            ease: 'power3.out'
        });
    });

    // Animate text elements with fade-in
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
            duration: 0.6,
            delay: delay,
            ease: 'power2.out'
        });
    });

    // Animate titles with split text effect
    const splitTextElements = mobileSection.querySelectorAll('[data-animate="split-text"]');
    splitTextElements.forEach((element) => {
        const delay = parseFloat(element.getAttribute('data-delay')) || 0;

        // Split the text into words
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
            delay: delay,
            ease: 'back.out(1.7)'
        });
    });

    // Animate the explore button
    const exploreButton = mobileSection.querySelector('a[href*="products.index"]');
    if (exploreButton) {
        gsap.from(exploreButton, {
            scrollTrigger: {
                trigger: exploreButton,
                start: 'top 90%',
                end: 'bottom 20%',
                toggleActions: 'play none none reverse'
            },
            opacity: 0,
            scale: 0.8,
            duration: 0.6,
            ease: 'back.out(1.7)'
        });
    }

    console.log('Mobile product showcase animations initialized');
}

/**
 * Cleanup function to kill all ScrollTriggers
 */
export function cleanupMobileProductShowcase() {
    ScrollTrigger.getAll().forEach(trigger => {
        if (trigger.vars.trigger && trigger.vars.trigger.closest('#products-mobile')) {
            trigger.kill();
        }
    });
}
