import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default class FaqAnimations {
    constructor() {
        this.init();
    }

    init() {
        this.animateFaq();
    }

    animateFaq() {
        const faqSection = document.querySelector('.js-faq-section');
        if (!faqSection) return;

        const faqItems = faqSection.querySelectorAll('.js-faq-item');

        faqItems.forEach((item, index) => {
            gsap.fromTo(item, {
                opacity: 0,
                y: 30,
            }, {
                opacity: 1,
                y: 0,
                duration: 0.6,
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: item,
                    start: 'top 90%',
                    toggleActions: 'play none none reverse'
                },
                ease: 'power3.out'
            });
        });
    }
}
