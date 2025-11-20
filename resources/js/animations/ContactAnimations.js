import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default class ContactAnimations {
    constructor() {
        this.init();
    }

    init() {
        gsap.registerPlugin(ScrollTrigger);
        this.animateContact();
    }

    animateContact() {
        const contactSection = document.querySelector('#contact');
        if (!contactSection) return;

        // Animate header
        const header = contactSection.querySelector('.contact-header');
        if (header) {
            gsap.fromTo(header, {
                opacity: 0,
                y: 50,
            }, {
                opacity: 1,
                y: 0,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: header,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });
        }

        // Animate contact info cards
        const cards = contactSection.querySelectorAll('.contact-card');
        if (cards.length > 0) {
            gsap.fromTo(cards, {
                opacity: 0,
                x: -50,
            }, {
                opacity: 1,
                x: 0,
                duration: 0.8,
                stagger: 0.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.contact-info',
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });
        }

        // Animate map (if exists)
        const map = contactSection.querySelector('.contact-map');
        if (map) {
            gsap.fromTo(map, {
                opacity: 0,
                scale: 0.9,
            }, {
                opacity: 1,
                scale: 1,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: map,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });
        }

        // Animate form
        const form = contactSection.querySelector('.contact-form');
        if (form) {
            gsap.fromTo(form, {
                opacity: 0,
                x: 50,
            }, {
                opacity: 1,
                x: 0,
                duration: 1,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: form,
                    start: 'top 80%',
                    end: 'bottom 20%',
                    toggleActions: 'play none none reverse'
                }
            });

            // Animate form groups
            const formGroups = form.querySelectorAll('.form-group');
            if (formGroups.length > 0) {
                gsap.fromTo(formGroups, {
                    opacity: 0,
                    y: 30,
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.6,
                    stagger: 0.1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: form,
                        start: 'top 70%',
                        end: 'bottom 20%',
                        toggleActions: 'play none none reverse'
                    }
                });
            }
        }
    }
}
