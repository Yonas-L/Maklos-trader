import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

export default class ManufacturingAnimations {
    constructor() {
        this.init();
    }

    init() {
        gsap.registerPlugin(ScrollTrigger);

        let mm = gsap.matchMedia();

        // Only run these animations on desktop (min-width: 1024px)
        // because the section .js-manufacturing-section has 'hidden lg:flex' classes
        mm.add("(min-width: 1024px)", () => {
            this.animateManufacturingSection();
            this.animateManufacturingBubbles();
        });
    }

    animateManufacturingSection() {
        const section = document.querySelector('.js-manufacturing-section');
        if (!section) {
            return;
        }

        // Animate header
        const label = section.querySelector('.js-manufacturing-label');
        const title = section.querySelector('.js-manufacturing-title');
        const description = section.querySelector('.js-manufacturing-description');
        const highlightWords = section.querySelectorAll('.js-manufacturing-word');

        if (label || highlightWords.length || title || description) {
            ScrollTrigger.create({
                trigger: section,
                start: 'top 80%',
                toggleActions: 'play none none reverse',
                onEnter: () => {
                    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

                    if (label) {
                        tl.from(label, {
                            opacity: 0,
                            y: 20,
                            duration: 0.8,
                        }, 0);
                    }

                    if (title) {
                        tl.from(title, {
                            opacity: 0,
                            y: 20,
                            scale: 0.95,
                            duration: 1,
                        }, label ? 0.15 : 0);
                    }

                    if (highlightWords.length) {
                        tl.from(highlightWords, {
                            opacity: 0,
                            y: 15,
                            rotateX: 18,
                            skewY: 6,
                            duration: 0.9,
                            stagger: 0.08,
                        }, '-=0.4');
                    }

                    if (description) {
                        tl.from(description, {
                            opacity: 0,
                            y: 15,
                            filter: 'blur(6px)',
                            duration: 0.8,
                        }, '-=0.2');
                    }
                },
            });
        }

        const pinWrapper = section.querySelector('.js-manufacturing-pin');
        const track = section.querySelector('.js-manufacturing-track');
        const cards = gsap.utils.toArray('.js-manufacturing-card');

        if (!pinWrapper || !track || cards.length === 0) {
            return;
        }

        // Desktop: horizontal scrolling track, pinned section
        const totalCards = cards.length;
        const scrollDistance = window.innerHeight * totalCards;

        // Helper to animate a card's content when it becomes active
        const animateCardContent = (card) => {
            if (!card) return;

            const features = card.querySelectorAll('.js-manufacturing-feature');
            const stepNumber = card.querySelector('.js-manufacturing-step-number');
            const stepTitle = card.querySelector('.js-manufacturing-step-title');
            const stepDescription = card.querySelector('.js-manufacturing-step-description');
            const image = card.querySelector('.js-manufacturing-image');

            const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

            if (stepNumber) {
                tl.to(stepNumber, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.7,
                    ease: 'back.out(1.7)',
                }, 0);
            }

            if (stepTitle) {
                tl.to(stepTitle, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.85,
                    opacity: 1,
                }, 0.1);
            }

            if (stepDescription) {
                tl.to(stepDescription, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                }, 0.2);
            }

            if (features.length) {
                tl.to(features, {
                    opacity: 1,
                    y: 0,
                    duration: 0.7,
                    stagger: 0.08,
                }, 0.3);
            }

            // Animate image
            if (image) {
                tl.to(image, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    filter: 'blur(0px)',
                    duration: 1,
                    ease: 'power2.out',
                }, 0.2);
            }
        };

        // Initial states
        cards.forEach((card, index) => {
            const features = card.querySelectorAll('.js-manufacturing-feature');
            const stepNumber = card.querySelector('.js-manufacturing-step-number');
            const stepTitle = card.querySelector('.js-manufacturing-step-title');
            const stepDescription = card.querySelector('.js-manufacturing-step-description');
            const image = card.querySelector('.js-manufacturing-image');

            gsap.set(card, {
                opacity: index === 0 ? 1 : 0.35,
                scale: index === 0 ? 1 : 0.92,
            });

            if (stepNumber) {
                gsap.set(stepNumber, { opacity: 0, y: 24, scale: 0.9 });
            }
            if (stepTitle) {
                gsap.set(stepTitle, { opacity: 0, y: 32, scale: 0.97 });
            }
            if (stepDescription) {
                gsap.set(stepDescription, { opacity: 0, y: 22 });
            }
            if (features.length) {
                gsap.set(features, { opacity: 0, y: 16 });
            }
            if (image) {
                gsap.set(image, {
                    opacity: 0,
                    y: 40,
                    scale: 0.95,
                    filter: 'blur(10px)',
                });
            }
        });

        let lastActiveIndex = -1;

        // Pin the section and scrub horizontal translation based on scroll progress
        ScrollTrigger.create({
            trigger: section,
            start: 'top 15%', // Add distinct vertical space (breathing room)
            end: () => `+=${scrollDistance}`,
            pin: pinWrapper,
            pinSpacing: true,
            scrub: 1.1,
            invalidateOnRefresh: true, // Handle resize/recalc
            anticipatePin: 1,
            onUpdate: (self) => {
                const progress = self.progress;
                const maxShift = (totalCards - 1) * 100;

                // Move track horizontally
                const xPercent = -progress * maxShift;
                gsap.set(track, { xPercent });

                // Determine which card is active
                const cardProgress = progress * (totalCards - 1);
                const activeIndex = Math.round(cardProgress);

                cards.forEach((card, index) => {
                    const isActive = index === activeIndex;
                    const cardOpacity = isActive ? 1 : 0.35;
                    const cardScale = isActive ? 1 : 0.94;

                    gsap.to(card, {
                        opacity: cardOpacity,
                        scale: cardScale,
                        duration: 0.4,
                        ease: 'power2.out',
                        overwrite: true,
                    });
                });

                if (activeIndex !== lastActiveIndex && activeIndex >= 0 && activeIndex < totalCards) {
                    animateCardContent(cards[activeIndex]);
                    lastActiveIndex = activeIndex;
                }
            },
            onEnter: () => {
                // Animate the first card when pinning starts
                animateCardContent(cards[0]);
                lastActiveIndex = 0;
            },
        });
    }

    animateManufacturingBubbles() {
        const section = document.querySelector('.js-manufacturing-section');
        if (!section) return;

        const bubblesContainer = section.querySelector('.js-manufacturing-bubbles');
        if (!bubblesContainer) return;

        const bubbles = bubblesContainer.querySelectorAll('.js-manufacturing-bubble');
        if (bubbles.length === 0) return;

        // Bubble configurations: [size, x, y, duration, delay, floatDistance]
        const bubbleConfigs = [
            [70, 10, 15, 9, 0, 45],
            [85, 85, 20, 10, 0.3, 50],
            [60, 45, 10, 8, 0.6, 40],
            [75, 20, 70, 9.5, 0.9, 48],
            [80, 75, 65, 8.5, 1.2, 52],
            [65, 50, 80, 8, 1.5, 42],
            [55, 15, 50, 7.5, 1.8, 38],
            [90, 80, 45, 10.5, 2.1, 55],
            [50, 35, 30, 7, 0.2, 35],
            [72, 60, 60, 8.5, 0.5, 46],
            [68, 25, 85, 8.2, 0.8, 44],
            [78, 70, 25, 9.2, 1.1, 50],
            [58, 40, 55, 7.8, 1.4, 39],
            [82, 55, 15, 9.8, 1.7, 53],
        ];

        bubbles.forEach((bubble, index) => {
            const config = bubbleConfigs[index] || [60, 50, 50, 8, 0, 40];
            const [size, xPercent, yPercent, duration, delay, floatDistance] = config;

            // Set initial position and size
            const baseX = 0;
            const baseY = 0;

            const initialOpacity = parseFloat(getComputedStyle(bubble).opacity) || 0.15;

            gsap.set(bubble, {
                width: `${size}px`,
                height: `${size}px`,
                left: `${xPercent}%`,
                top: `${yPercent}%`,
                x: baseX,
                y: baseY,
                opacity: 0,
                scale: 0,
            });

            // Generate random waypoints for organic movement
            const generateRandomWaypoints = (count) => {
                const waypoints = [{ x: 0, y: 0 }];
                for (let i = 0; i < count; i++) {
                    const angle = (Math.PI * 2 * i) / count + (Math.random() - 0.5) * 0.8;
                    const distance = floatDistance * (0.5 + Math.random() * 1.0);
                    const x = Math.cos(angle) * distance;
                    const y = Math.sin(angle) * distance;
                    waypoints.push({ x, y });
                }
                waypoints.push({ x: 0, y: 0 });
                return waypoints;
            };

            const waypointCount = 4 + Math.floor(Math.random() * 3);
            const waypoints = generateRandomWaypoints(waypointCount);

            // Create random floating animation timeline
            const floatTL = gsap.timeline({
                repeat: -1,
                delay: delay,
            });

            // Entrance animation
            gsap.to(bubble, {
                opacity: initialOpacity,
                scale: 1,
                duration: 1.5,
                ease: 'back.out(1.7)',
                delay: delay + 0.3,
            });

            // Random movement through waypoints
            waypoints.forEach((waypoint, i) => {
                if (i === 0) return;

                const segmentDuration = duration * (0.6 + Math.random() * 0.6);
                const rotationAmount = (Math.random() > 0.5 ? 1 : -1) * (90 + Math.random() * 270);

                floatTL.to(bubble, {
                    x: baseX + waypoint.x,
                    y: baseY + waypoint.y,
                    rotation: `+=${rotationAmount}`,
                    duration: segmentDuration,
                    ease: 'sine.inOut',
                });
            });

            // Subtle scale pulsing
            gsap.to(bubble, {
                scale: 1.15,
                duration: duration * 0.7,
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                delay: delay + 1.2,
            });

            // Opacity shimmer
            gsap.to(bubble, {
                opacity: `+=${initialOpacity * 0.4}`,
                duration: duration * 0.5,
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                delay: delay + 0.7,
            });
        });
    }
}
