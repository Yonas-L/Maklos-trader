import gsap from 'gsap';
import { splitTextIntoWords } from './Utils';

export default class HeroAnimations {
    constructor() {
        this.init();
    }

    init() {
        this.animateHero();
        this.animateHeroBubbles();
        this.animateShapeDivider();
    }

    animateShapeDivider() {
        const divider = document.querySelector('.js-shape-divider');
        const bubbles = document.querySelectorAll('.js-shape-bubble');

        if (!divider && bubbles.length === 0) return;

        // Animate bubbles in the shape divider
        bubbles.forEach((bubble, index) => {
            // Random float movement
            gsap.to(bubble, {
                y: 'random(-20, 20)',
                x: 'random(-10, 10)',
                rotation: 'random(-15, 15)',
                duration: 'random(3, 6)',
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                delay: index * 0.1
            });

            // Pulse effect
            gsap.to(bubble, {
                scale: 'random(0.9, 1.1)',
                opacity: 'random(0.5, 0.8)',
                duration: 'random(2, 4)',
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                delay: index * 0.2
            });
        });
    }

    animateHero() {
        const hero = document.querySelector('.js-home-hero');
        if (!hero) return;

        const title = hero.querySelector('.js-hero-title');
        const description = hero.querySelector('.js-hero-description');
        const buttons = hero.querySelectorAll('.hero-button');

        // Create main timeline with smooth, elegant defaults
        // Create main timeline with smooth, elegant defaults
        const tl = gsap.timeline({
            scrollTrigger: {
                trigger: hero,
                start: 'top 60%',
                toggleActions: 'play none none reverse'
            },
            defaults: {
                ease: 'power3.out',
                duration: 0.9
            }
        });

        // Animate hero title with smooth, sexy word-by-word reveal
        if (title) {
            const words = splitTextIntoWords(title);

            // Set initial state with subtle effects for smoothness
            gsap.set(words, {
                opacity: 0,
                y: 12,
                scale: 0.97
            });

            // Smooth, elegant word reveal with beautiful stagger
            tl.to(words, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.7,
                stagger: {
                    amount: 0.45,
                    from: 'start',
                    ease: 'power2.out'
                },
                ease: 'power2.out',
                onComplete: () => {
                    // Clear transforms after animation to preserve alignment
                    words.forEach(word => {
                        gsap.set(word, { clearProps: 'y,scale' });
                    });
                }
            });
        }

        // Animate description with same smooth word-by-word reveal
        if (description) {
            const descWords = splitTextIntoWords(description);

            // Add class for specific styling if needed
            descWords.forEach(word => word.classList.add('desc-word'));

            gsap.set(descWords, {
                opacity: 0,
                y: 12,
                scale: 0.97
            });

            tl.to(descWords, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 0.7,
                stagger: {
                    amount: 0.45,
                    from: 'start',
                    ease: 'power2.out'
                },
                ease: 'power2.out',
                onComplete: () => {
                    descWords.forEach(word => {
                        gsap.set(word, { clearProps: 'y,scale' });
                    });
                }
            }, "-=0.5");
        }

        // Animate buttons
        if (buttons.length > 0) {
            gsap.set(buttons, { opacity: 0, y: 20 });
            tl.to(buttons, {
                opacity: 1,
                y: 0,
                duration: 0.8,
                stagger: 0.1,
                ease: 'power3.out'
            }, "-=0.3");
        }
    }

    animateHeroBubbles() {
        const bubblesContainer = document.querySelector('.js-hero-bubbles');
        if (!bubblesContainer) return;

        const bubbles = bubblesContainer.querySelectorAll('.js-hero-bubble');
        if (bubbles.length === 0) return;

        // Bubble configurations for hero: [size, x, y, duration, delay, floatDistance]
        const bubbleConfigs = [
            [85, 5, 10, 11, 0, 55],        // Large bubble 1
            [75, 92, 15, 10, 0.4, 50],     // Large bubble 2
            [90, 50, 8, 12, 0.8, 58],     // Large bubble 3
            [80, 20, 25, 10, 1.2, 52],    // Large bubble 4
            [70, 80, 30, 9, 1.6, 48],     // Large bubble 5
            [58, 10, 45, 8, 0.2, 42],     // Medium bubble 6
            [55, 88, 50, 7.5, 0.6, 40],   // Medium bubble 7
            [62, 45, 35, 8.5, 1, 44],     // Medium bubble 8
            [50, 65, 55, 7, 1.4, 38],     // Medium bubble 9
            [60, 25, 60, 8, 1.8, 43],     // Medium bubble 10
            [38, 15, 30, 6, 0.1, 30],     // Small bubble 11
            [35, 85, 40, 6.5, 0.5, 28],   // Small bubble 12
            [42, 55, 25, 5.5, 0.9, 32],   // Small bubble 13
            [32, 30, 50, 6, 1.3, 26],     // Small bubble 14
            [40, 70, 35, 5.8, 1.7, 31],   // Small bubble 15
            [36, 12, 65, 6.2, 2.1, 29],   // Small bubble 16
            [33, 75, 55, 5.5, 2.5, 27],   // Small bubble 17
            [39, 40, 70, 6, 2.9, 30],     // Small bubble 18
        ];

        bubbles.forEach((bubble, index) => {
            const config = bubbleConfigs[index] || [50, 50, 50, 8, 0, 35];
            const [size, xPercent, yPercent, duration, delay, floatDistance] = config;

            // Set initial position and size
            const baseY = -size / 2;
            const baseX = -size / 2;
            bubble.dataset.baseY = baseY;
            bubble.dataset.baseX = baseX;

            const initialOpacity = parseFloat(getComputedStyle(bubble).opacity) || 0.4;

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

            // Generate random movement waypoints
            const generateRandomWaypoints = (count = 4) => {
                const waypoints = [];
                waypoints.push({ x: 0, y: 0 });

                for (let i = 1; i < count; i++) {
                    const angle = Math.random() * Math.PI * 2;
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

            const floatTL = gsap.timeline({
                repeat: -1,
                delay: delay,
            });

            // Entrance
            gsap.to(bubble, {
                opacity: initialOpacity,
                scale: 1,
                duration: 1.5,
                ease: 'back.out(1.7)',
                delay: delay + 0.3,
            });

            // Movement
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

            // Pulsing
            const scaleDuration = duration * (0.7 + Math.random() * 0.4);
            gsap.to(bubble, {
                scale: 1 + (0.05 + Math.random() * 0.1),
                duration: scaleDuration,
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                delay: delay + 1 + Math.random() * 0.5,
            });

            // Shimmer
            const opacityDuration = duration * (0.5 + Math.random() * 0.3);
            gsap.to(bubble, {
                opacity: `+=${0.1 + Math.random() * 0.1}`,
                duration: opacityDuration,
                ease: 'sine.inOut',
                repeat: -1,
                yoyo: true,
                delay: delay + 0.5 + Math.random() * 0.5,
            });
        });
    }
}
