import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default class AboutAnimations {
    constructor() {
        this.init();
    }

    init() {
        gsap.registerPlugin(ScrollTrigger);
        this.animateAbout();
    }

    animateAbout() {
        const aboutSection = document.querySelector('.js-about-section');
        if (!aboutSection) return;

        // Animate header (like Contact section)
        const header = aboutSection.querySelector('.js-about-header');
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

        // Animate description
        const aboutDescription = aboutSection.querySelector('.js-about-description');
        if (aboutDescription) {
            gsap.fromTo(aboutDescription, {
                opacity: 0,
                y: 30,
            }, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: aboutDescription,
                    start: 'top 80%',
                    toggleActions: 'play none none reverse'
                }
            });
        }

        // Animate values
        const aboutValues = aboutSection.querySelectorAll('.js-about-value');
        aboutValues.forEach((value, index) => {
            gsap.fromTo(value, {
                opacity: 0,
                y: 40,
                scale: 0.95,
            }, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.8,
                delay: index * 0.1,
                scrollTrigger: {
                    trigger: value,
                    start: 'top 85%',
                    once: true
                },
                ease: 'power3.out'
            });
        });

        // Animate MVV bubbles
        const bubbles = aboutSection.querySelectorAll('.js-mvv-bubbles .js-mvv-bubble');
        bubbles.forEach((bubble, index) => {
            gsap.to(bubble, {
                opacity: Math.random() * 0.4 + 0.2,
                scale: Math.random() * 0.3 + 0.9,
                duration: Math.random() * 3 + 2,
                repeat: -1,
                yoyo: true,
                ease: 'power1.inOut',
                delay: index * 0.2
            });

            gsap.to(bubble, {
                y: 'random(-20, 20)',
                x: 'random(-15, 15)',
                duration: Math.random() * 8 + 8,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut',
                delay: index * 0.3
            });
        });

        // Expertise Animation
        const expertiseSection = aboutSection.querySelector('.js-about-expertise-wrapper');
        if (expertiseSection) {
            const number = expertiseSection.querySelector('.js-about-expertise-number');
            const text = expertiseSection.querySelector('.js-about-expertise-text');

            const tl = gsap.timeline({
                scrollTrigger: {
                    trigger: expertiseSection,
                    start: 'top 85%',
                    once: true
                }
            });

            if (number) {
                tl.from(number, {
                    textContent: 0,
                    duration: 2,
                    ease: 'power1.out',
                    snap: { textContent: 1 },
                    stagger: 1,
                });
            }

            if (text) {
                tl.from(text, {
                    opacity: 0,
                    x: -20,
                    duration: 1,
                    ease: 'power2.out'
                }, '-=1.5');
            }
        }

        // Card Flip Logic
        const cards = document.querySelectorAll('.js-mvv-card-wrapper');
        cards.forEach(card => {
            const flipCard = (isFlipped) => {
                gsap.to(card, {
                    rotationY: isFlipped ? 180 : 0,
                    duration: 0.8,
                    ease: 'power2.inOut'
                });
            };

            // Click event
            card.addEventListener('click', () => {
                const currentRotation = gsap.getProperty(card, "rotationY");
                const isFlipped = Math.abs(currentRotation - 180) < 10;
                flipCard(!isFlipped);
            });

            // Hover event
            card.addEventListener('mouseenter', () => flipCard(true));
            card.addEventListener('mouseleave', () => flipCard(false));
        });
    }
}
