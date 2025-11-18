import './bootstrap';

import 'flowbite';

import Alpine from 'alpinejs';
import Lenis from 'lenis';
import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';

window.Alpine = Alpine;
window.gsap = gsap;

gsap.registerPlugin(ScrollTrigger);
ScrollTrigger.config({ limitCallbacks: true, ignoreMobileResize: true });

const initLenis = () => {
    if (window.__lenis) {
        return window.__lenis;
    }

    const lenis = new Lenis({
        duration: 1.05,
        smoothWheel: true,
        smoothTouch: false,
        gestureOrientation: 'vertical',
        wheelMultiplier: 0.95,
    });

    lenis.on('scroll', ScrollTrigger.update);

    if (!window.__lenisTickerAdded) {
        const update = (time) => {
            lenis.raf(time * 1000);
        };

        gsap.ticker.add(update);
        gsap.ticker.lagSmoothing(0);
        window.__lenisTickerAdded = true;
        window.__lenisTicker = update;
    }

    window.__lenis = lenis;
    return lenis;
};

const animateProductShowcase = () => {
    const section = document.querySelector('.js-products-section');
    if (!section) {
        return;
    }

    const pinWrapper = section.querySelector('.js-products-pin-wrapper');
    const textPanels = gsap.utils.toArray('.js-product-text-panel');
    const imagePanels = gsap.utils.toArray('.js-product-image-panel');

    if (!pinWrapper || textPanels.length === 0 || imagePanels.length === 0) {
        return;
    }

    // Only enable on desktop
    if (window.innerWidth < 1024) {
        // Mobile: simple scroll animations
        const mobileItems = section.querySelectorAll('.js-product-mobile-item');
        mobileItems.forEach((item, index) => {
            gsap.set(item, { opacity: 0, y: 40 });
            ScrollTrigger.create({
                trigger: item,
                start: 'top 80%',
                once: true,
                onEnter: () => {
                    gsap.to(item, {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        ease: 'power2.out',
                    });
                },
            });
        });
        return;
    }

    // Preload all images
    imagePanels.forEach((panel) => {
        const images = panel.querySelectorAll('img');
        images.forEach(img => {
            if (img.src && !img.complete) {
                const tempImg = new Image();
                tempImg.src = img.src;
            }
        });
    });

    // Set initial states - all panels start hidden for entrance animation
    textPanels.forEach((panel, index) => {
        gsap.set(panel, {
            zIndex: textPanels.length - index,
        });

        // Start all panels hidden for entrance animation
        gsap.set(panel, {
            autoAlpha: index === 0 ? 0 : 0,
            y: index === 0 ? 50 : 30,
        });
    });

    imagePanels.forEach((panel, index) => {
        gsap.set(panel, {
            zIndex: imagePanels.length - index,
        });

        // Start all panels hidden for entrance animation
        gsap.set(panel, {
            autoAlpha: index === 0 ? 0 : 0,
            scale: index === 0 ? 0.9 : 0.95,
            y: index === 0 ? 60 : 40,
        });
    });

    // Get column containers for entrance animation and position swapping
    const textColumn = section.querySelector('.js-products-text-column');
    const imageColumn = section.querySelector('.js-products-image-column');

    // Helper function to determine if image should be on left for a given index
    const isImageOnLeft = (index) => index % 2 === 1;

    // Calculate swap distance once (cached for performance)
    // This is the exact distance needed to swap columns accounting for grid gap
    let cachedSwapDistance = 0;
    const calculateSwapDistance = (forceRecalc = false) => {
        if (cachedSwapDistance > 0 && !forceRecalc) return cachedSwapDistance;

        if (textColumn && imageColumn) {
            // Reset transforms temporarily to get accurate bounding boxes
            const textX = gsap.getProperty(textColumn, "x") || 0;
            const imageX = gsap.getProperty(imageColumn, "x") || 0;

            // Temporarily reset to get natural positions
            gsap.set([textColumn, imageColumn], { x: 0, clearProps: "x" });

            // Force a layout recalculation
            void textColumn.offsetHeight;
            void imageColumn.offsetHeight;

            const textRect = textColumn.getBoundingClientRect();
            const imageRect = imageColumn.getBoundingClientRect();

            // Restore transforms
            gsap.set(textColumn, { x: textX });
            gsap.set(imageColumn, { x: imageX });

            if (textRect.width > 0 && imageRect.width > 0) {
                const columnWidth = textRect.width;
                const gap = Math.max(0, imageRect.left - textRect.right);
                cachedSwapDistance = columnWidth + gap;
                return cachedSwapDistance;
            }
        }

        // Fallback calculation
        const containerWidth = pinWrapper?.offsetWidth || window.innerWidth;
        const gap = 48; // lg:gap-12 = 3rem = 48px
        const columnWidth = (containerWidth - gap) / 2;
        cachedSwapDistance = columnWidth + gap;
        return cachedSwapDistance;
    };

    // Calculate swap distance after a brief delay to ensure layout is ready
    requestAnimationFrame(() => {
        calculateSwapDistance();
    });

    // Recalculate on resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            cachedSwapDistance = 0;
            calculateSwapDistance(true);
        }, 150);
    });

    // Calculate scroll distance
    const scrollDistance = window.innerHeight * textPanels.length * 1.2;

    // Create pin scroll effect
    ScrollTrigger.create({
        trigger: section,
        start: 'top top',
        end: () => `+=${scrollDistance}`,
        pin: pinWrapper,
        pinSpacing: true,
        anticipatePin: 1,
        scrub: 1,
        onUpdate: (self) => {
            const progress = self.progress;
            const totalPanels = textPanels.length;

            // Calculate which panel transition we're in
            const panelProgress = progress * totalPanels;
            const currentIndex = Math.min(Math.floor(panelProgress), totalPanels - 1);
            const transitionProgress = panelProgress - currentIndex;

            // Determine target positions for current and next panels
            const currentImageLeft = isImageOnLeft(currentIndex);
            const nextImageLeft = currentIndex < totalPanels - 1 ? isImageOnLeft(currentIndex + 1) : currentImageLeft;

            // Get cached swap distance (calculated once for consistency)
            const swapDistance = calculateSwapDistance();

            // Animate column positions during transition with precise pixel calculation
            // Add delay threshold - only start swapping after 60% of transition progress
            // This means users need to scroll longer before columns alternate
            const swapThreshold = 0.6;
            const delayedProgress = transitionProgress < swapThreshold
                ? 0
                : (transitionProgress - swapThreshold) / (1 - swapThreshold);

            if (textColumn && imageColumn && swapDistance > 0) {
                if (currentIndex < totalPanels - 1 && currentImageLeft !== nextImageLeft) {
                    // Columns need to swap positions smoothly with delay
                    const swapProgress = Math.min(1, delayedProgress);

                    if (currentImageLeft) {
                        // Currently: image left, text right
                        // Text is at x = swapDistance, Image is at x = -swapDistance
                        // Target: text left, image right
                        // Text moves from swapDistance to 0
                        // Image moves from -swapDistance to 0
                        gsap.set(textColumn, {
                            x: swapDistance * (1 - swapProgress),
                        });
                        gsap.set(imageColumn, {
                            x: -swapDistance * (1 - swapProgress),
                        });
                    } else {
                        // Currently: text left, image right
                        // Text is at x = 0, Image is at x = 0
                        // Target: image left, text right
                        // Text moves from 0 to swapDistance
                        // Image moves from 0 to -swapDistance
                        gsap.set(textColumn, {
                            x: swapDistance * swapProgress,
                        });
                        gsap.set(imageColumn, {
                            x: -swapDistance * swapProgress,
                        });
                    }
                } else {
                    // No swap needed - set final positions based on current index
                    const finalImageLeft = isImageOnLeft(currentIndex);
                    if (finalImageLeft) {
                        // Image left, text right (swapped)
                        // Text moves right, Image moves left
                        gsap.set(textColumn, { x: swapDistance });
                        gsap.set(imageColumn, { x: -swapDistance });
                    } else {
                        // Text left, image right (default)
                        // Both at their natural grid positions
                        gsap.set(textColumn, { x: 0 });
                        gsap.set(imageColumn, { x: 0 });
                    }
                }
            }

            // Animate text panels - sequential: fade out current first, then fade in next
            // First 50% of transition: fade out current with blur
            // Second 50% of transition: fade in next
            const fadeOutProgress = Math.min(1, transitionProgress * 2); // 0 to 1 in first half
            const fadeInProgress = Math.max(0, (transitionProgress - 0.5) * 2); // 0 to 1 in second half

            textPanels.forEach((panel, index) => {
                if (index === currentIndex && currentIndex < totalPanels - 1) {
                    // Current panel fading out completely before next appears
                    const opacity = 1 - fadeOutProgress;
                    const blur = fadeOutProgress * 10; // Blur increases as it fades
                    gsap.set(panel, {
                        autoAlpha: opacity,
                        filter: `blur(${blur}px)`,
                        y: 30 * fadeOutProgress,
                    });
                } else if (index === currentIndex + 1) {
                    // Next panel only starts appearing after 50% transition
                    if (transitionProgress >= 0.5) {
                        const opacity = fadeInProgress;
                        const blur = (1 - fadeInProgress) * 10; // Blur decreases as it appears
                        gsap.set(panel, {
                            autoAlpha: opacity,
                            filter: `blur(${blur}px)`,
                            y: 30 * (1 - fadeInProgress),
                        });
                    } else {
                        // Keep completely hidden until fade out is done
                        gsap.set(panel, {
                            autoAlpha: 0,
                            filter: 'blur(10px)',
                            y: 30,
                        });
                    }
                } else if (index === currentIndex && currentIndex === totalPanels - 1) {
                    // Last panel - stay visible
                    gsap.set(panel, {
                        autoAlpha: 1,
                        filter: 'blur(0px)',
                        y: 0,
                    });
                } else {
                    // All other panels - keep completely hidden
                    gsap.set(panel, {
                        autoAlpha: 0,
                        filter: 'blur(10px)',
                        y: 30,
                    });
                }
            });

            // Animate image panels - sequential: fade out current first, then fade in next
            // Synchronized with text panels
            imagePanels.forEach((panel, index) => {
                if (index === currentIndex && currentIndex < totalPanels - 1) {
                    // Current panel fading out completely with blur
                    const opacity = 1 - fadeOutProgress;
                    const blur = fadeOutProgress * 15; // More blur for images
                    const scale = 1 - (fadeOutProgress * 0.1);
                    gsap.set(panel, {
                        autoAlpha: opacity,
                        filter: `blur(${blur}px)`,
                        scale: scale,
                        y: 40 * fadeOutProgress,
                    });
                } else if (index === currentIndex + 1) {
                    // Next panel only starts appearing after 50% transition
                    if (transitionProgress >= 0.5) {
                        const opacity = fadeInProgress;
                        const blur = (1 - fadeInProgress) * 15; // Blur decreases as it appears
                        const scale = 0.9 + (fadeInProgress * 0.1);
                        gsap.set(panel, {
                            autoAlpha: opacity,
                            filter: `blur(${blur}px)`,
                            scale: scale,
                            y: 40 * (1 - fadeInProgress),
                        });
                    } else {
                        // Keep completely hidden until fade out is done
                        gsap.set(panel, {
                            autoAlpha: 0,
                            filter: 'blur(15px)',
                            scale: 0.9,
                            y: 40,
                        });
                    }
                } else if (index === currentIndex && currentIndex === totalPanels - 1) {
                    // Last panel - stay visible
                    gsap.set(panel, {
                        autoAlpha: 1,
                        filter: 'blur(0px)',
                        scale: 1,
                        y: 0,
                    });
                } else {
                    // All other panels - keep completely hidden
                    gsap.set(panel, {
                        autoAlpha: 0,
                        filter: 'blur(15px)',
                        scale: 0.9,
                        y: 40,
                    });
                }
            });
        },
    });

    // Set initial column positions (Product 0: text left, image right)
    if (textColumn && imageColumn) {
        gsap.set(textColumn, { x: 0 });
        gsap.set(imageColumn, { x: 0 });
    }

    // Entrance animation when section comes into view
    ScrollTrigger.create({
        trigger: section,
        start: 'top 80%',
        once: true,
        onEnter: () => {
            const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

            // Animate columns entrance
            if (textColumn) {
                tl.from(textColumn, {
                    opacity: 0,
                    x: -40,
                    duration: 1,
                }, 0);
            }

            if (imageColumn) {
                tl.from(imageColumn, {
                    opacity: 0,
                    x: 40,
                    duration: 1,
                }, 0);
            }

            // Animate first text panel content
            const firstTextPanel = textPanels[0];
            if (firstTextPanel) {
                const firstLabel = firstTextPanel.querySelector('.js-products-label');
                const firstTitle = firstTextPanel.querySelector('.js-products-title');
                const firstDesc = firstTextPanel.querySelector('.js-products-description');
                const firstCta = firstTextPanel.querySelector('.js-products-cta');

                tl.to(firstTextPanel, {
                    autoAlpha: 1,
                    y: 0,
                    duration: 1,
                    ease: 'power3.out',
                }, 0.2);

                if (firstLabel) tl.from(firstLabel, { opacity: 0, y: 20, duration: 0.7 }, 0.4);
                if (firstTitle) tl.from(firstTitle, { opacity: 0, y: 30, duration: 0.9 }, 0.5);
                if (firstDesc) tl.from(firstDesc, { opacity: 0, y: 25, duration: 0.9 }, 0.7);
                if (firstCta) tl.from(firstCta, { opacity: 0, y: 20, duration: 0.8, ease: 'back.out(1.4)' }, 0.9);
            }

            // Animate first image panel
            const firstImagePanel = imagePanels[0];
            if (firstImagePanel) {
                tl.to(firstImagePanel, {
                    autoAlpha: 1,
                    scale: 1,
                    y: 0,
                    duration: 1.1,
                    ease: 'power3.out',
                }, 0.3);
            }
        },
    });

    // Animate explore more button after 3rd product scroll
    const exploreMoreContainer = section.querySelector('.js-explore-more-container');
    const exploreMoreBtn = section.querySelector('.js-explore-more-btn');
    
    if (exploreMoreContainer && exploreMoreBtn) {
        // Set initial state
        gsap.set(exploreMoreContainer, { opacity: 0, y: 30 });
        gsap.set(exploreMoreBtn, { scale: 0.8, opacity: 0 });
        
        // Create scroll trigger for explore more button
        ScrollTrigger.create({
            trigger: section,
            start: () => `top+=${window.innerHeight * 3 * 1.2 * 0.85} top`, // After 85% of 3rd product scroll
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });
                
                tl.to(exploreMoreContainer, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                })
                .to(exploreMoreBtn, {
                    scale: 1,
                    opacity: 1,
                    duration: 0.6,
                }, 0.3);
            },
        });
    }
};

// Animate soap bubbles in hero section
const animateHeroBubbles = () => {
    const bubblesContainer = document.querySelector('.js-hero-bubbles');
    if (!bubblesContainer) return;

    const bubbles = bubblesContainer.querySelectorAll('.js-hero-bubble');
    if (bubbles.length === 0) return;

    // Bubble configurations for hero: [size, x, y, duration, delay, floatDistance]
    const bubbleConfigs = [
        // Large bubbles (60-90px)
        [85, 5, 10, 11, 0, 55],        // Large bubble 1
        [75, 92, 15, 10, 0.4, 50],     // Large bubble 2
        [90, 50, 8, 12, 0.8, 58],     // Large bubble 3
        [80, 20, 25, 10, 1.2, 52],    // Large bubble 4
        [70, 80, 30, 9, 1.6, 48],     // Large bubble 5
        // Medium bubbles (40-60px)
        [58, 10, 45, 8, 0.2, 42],     // Medium bubble 6
        [55, 88, 50, 7.5, 0.6, 40],   // Medium bubble 7
        [62, 45, 35, 8.5, 1, 44],     // Medium bubble 8
        [50, 65, 55, 7, 1.4, 38],     // Medium bubble 9
        [60, 25, 60, 8, 1.8, 43],     // Medium bubble 10
        // Small bubbles (25-40px)
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

        // Get initial opacity from class or use default
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

        // Generate random movement waypoints for organic, random motion
        const generateRandomWaypoints = (count = 4) => {
            const waypoints = [];
            // Start at origin
            waypoints.push({ x: 0, y: 0 });

            for (let i = 1; i < count; i++) {
                // Random angles and distances for each waypoint
                const angle = Math.random() * Math.PI * 2; // Completely random angle
                const distance = floatDistance * (0.5 + Math.random() * 1.0); // 50-150% of base distance
                const x = Math.cos(angle) * distance;
                const y = Math.sin(angle) * distance;
                waypoints.push({ x, y });
            }

            // Add final waypoint that loops back to start (smooth loop)
            waypoints.push({ x: 0, y: 0 });
            return waypoints;
        };

        const waypointCount = 4 + Math.floor(Math.random() * 3); // 4-6 waypoints
        const waypoints = generateRandomWaypoints(waypointCount);

        // Create random floating animation timeline
        const floatTL = gsap.timeline({
            repeat: -1,
            delay: delay,
        });

        // Entrance animation - animate to the opacity defined in the class
        gsap.to(bubble, {
            opacity: initialOpacity,
            scale: 1,
            duration: 1.5,
            ease: 'back.out(1.7)',
            delay: delay + 0.3,
        });

        // Random movement through waypoints - each bubble follows a unique path
        waypoints.forEach((waypoint, i) => {
            if (i === 0) return; // Skip first waypoint (start position)

            const segmentDuration = duration * (0.6 + Math.random() * 0.6); // Random duration 60-120% of base
            const rotationAmount = (Math.random() > 0.5 ? 1 : -1) * (90 + Math.random() * 270); // Random rotation 90-360deg

            floatTL.to(bubble, {
                x: baseX + waypoint.x,
                y: baseY + waypoint.y,
                rotation: `+=${rotationAmount}`,
                duration: segmentDuration,
                ease: 'sine.inOut',
            });
        });

        // Random scale pulsing (breathing effect) with varied timing
        const scaleDuration = duration * (0.7 + Math.random() * 0.4);
        gsap.to(bubble, {
            scale: 1 + (0.05 + Math.random() * 0.1), // Random scale between 1.05-1.15
            duration: scaleDuration,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: delay + 1 + Math.random() * 0.5,
        });

        // Random opacity variation for shimmer effect
        const opacityDuration = duration * (0.5 + Math.random() * 0.3);
        gsap.to(bubble, {
            opacity: `+=${0.1 + Math.random() * 0.1}`, // Random opacity variation
            duration: opacityDuration,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: delay + 0.5 + Math.random() * 0.5,
        });
    });
};

// Animate soap bubbles in products section
const animateProductBubbles = () => {
    const bubblesContainer = document.querySelector('.js-products-bubbles');
    if (!bubblesContainer) return;

    const bubbles = bubblesContainer.querySelectorAll('.js-bubble');
    if (bubbles.length === 0) return;

    // Bubble configurations: [size, x, y, duration, delay, floatDistance]
    const bubbleConfigs = [
        // Large bubbles (60-90px)
        [80, 8, 12, 10, 0, 50],       // Large bubble 1
        [75, 88, 18, 9, 0.3, 48],     // Large bubble 2
        [85, 45, 8, 11, 0.6, 52],     // Large bubble 3
        [70, 15, 25, 9, 0.9, 45],     // Large bubble 4
        [90, 80, 30, 8, 1.2, 55],     // Large bubble 5
        [78, 50, 15, 10, 1.5, 50],    // Large bubble 6
        [72, 25, 70, 9, 1.8, 47],     // Large bubble 7
        [82, 70, 65, 8.5, 2.1, 51],   // Large bubble 8
        // Medium bubbles (40-60px)
        [55, 5, 45, 7, 0.2, 38],      // Medium bubble 9
        [50, 92, 50, 6.5, 0.5, 35],   // Medium bubble 10
        [60, 40, 35, 7.5, 0.8, 42],   // Medium bubble 11
        [45, 60, 55, 6, 1.1, 32],     // Medium bubble 12
        [58, 20, 60, 7, 1.4, 40],     // Medium bubble 13
        [52, 75, 40, 6.5, 1.7, 36],   // Medium bubble 14
        [48, 35, 75, 7, 2, 34],       // Medium bubble 15
        // Small bubbles (25-40px)
        [38, 12, 30, 5, 0.1, 28],     // Small bubble 16
        [32, 85, 45, 5.5, 0.4, 24],   // Small bubble 17
        [42, 48, 20, 4.5, 0.7, 30],   // Small bubble 18
        [28, 30, 50, 5, 1, 20],       // Small bubble 19
        [35, 65, 35, 4.8, 1.3, 26],   // Small bubble 20
        [30, 15, 65, 5.2, 1.6, 22],   // Small bubble 21
        [40, 80, 55, 4.5, 1.9, 29],   // Small bubble 22
        [33, 55, 70, 5, 2.2, 25],     // Small bubble 23
        [36, 25, 40, 4.8, 2.5, 27],   // Small bubble 24
        [29, 70, 25, 5.2, 2.8, 21],   // Small bubble 25
    ];

    bubbles.forEach((bubble, index) => {
        const config = bubbleConfigs[index] || [60, 50, 50, 8, 0, 40];
        const [size, xPercent, yPercent, duration, delay, floatDistance] = config;

        // Set initial position and size
        const baseY = -size / 2;
        bubble.dataset.baseY = baseY;

        // Get initial opacity from class or use default
        const initialOpacity = parseFloat(getComputedStyle(bubble).opacity) || 0.4;

        gsap.set(bubble, {
            width: `${size}px`,
            height: `${size}px`,
            left: `${xPercent}%`,
            top: `${yPercent}%`,
            x: `-${size / 2}px`,
            y: baseY,
            opacity: 0,
            scale: 0,
        });

        // Create floating animation timeline
        const floatTL = gsap.timeline({
            repeat: -1,
            delay: delay,
        });

        // Entrance animation - animate to the opacity defined in the class
        gsap.to(bubble, {
            opacity: initialOpacity,
            scale: 1,
            duration: 1.5,
            ease: 'back.out(1.7)',
            delay: delay + 0.3,
        });

        // Continuous floating animation (using absolute values to work with parallax)
        const floatUpY = baseY - floatDistance;
        const floatDownY = baseY + floatDistance;
        const floatRightX = floatDistance * 0.6;
        const floatLeftX = -floatDistance * 0.4;

        floatTL
            .to(bubble, {
                y: floatUpY,
                x: floatRightX,
                rotation: 360,
                duration: duration,
                ease: 'sine.inOut',
            })
            .to(bubble, {
                y: floatDownY,
                x: floatLeftX,
                rotation: -360,
                duration: duration,
                ease: 'sine.inOut',
            });

        // Subtle scale pulsing (breathing effect)
        gsap.to(bubble, {
            scale: 1.1,
            duration: duration * 0.8,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: delay + 1,
        });

        // Opacity variation for shimmer effect
        gsap.to(bubble, {
            opacity: '+=0.15',
            duration: duration * 0.6,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: delay + 0.5,
        });
    });

    // Scroll-based upward movement - bubbles rise more as you scroll
    // Store scroll offset for each bubble
    bubbles.forEach((bubble) => {
        bubble.dataset.scrollOffset = 0;
    });

    ScrollTrigger.create({
        trigger: '.js-products-section',
        start: 'top bottom',
        end: 'bottom top',
        scrub: 1.5,
        onUpdate: (self) => {
            const progress = self.progress;
            bubbles.forEach((bubble, index) => {
                // Calculate upward movement based on scroll progress
                // Larger bubbles move more, smaller bubbles move less
                const size = parseFloat(bubble.style.width) || 100;
                const upwardMovement = progress * (size * 1.5); // Bubbles rise up more as you scroll
                const baseY = parseFloat(bubble.dataset.baseY) || 0;

                // Apply scroll offset - subtract from baseY to move upward
                // The floating animation will work on top of this
                bubble.dataset.scrollOffset = -upwardMovement;

                // Get current floating Y (from GSAP) and add scroll offset
                const currentY = gsap.getProperty(bubble, "y") || baseY;
                const floatingY = currentY - parseFloat(bubble.dataset.scrollOffset || 0);

                // Apply the combined transform
                gsap.set(bubble, {
                    y: baseY - upwardMovement,
                });
            });
        },
    });
};

// Split text into words for animation
const splitTextIntoWords = (element) => {
    const text = element.textContent.trim();
    const words = text.split(/\s+/);

    // Create word spans with proper spacing - simpler structure for better alignment
    element.innerHTML = words.map((word, index) => {
        if (!word) return '';
        const space = index < words.length - 1 ? ' ' : '';
        return `<span class="word-wrapper"><span class="word">${word}</span></span>${space}`;
    }).join('');

    return element.querySelectorAll('.word');
};

const animateHero = () => {
    const hero = document.querySelector('.js-home-hero');
    if (!hero) {
        return;
    }

    const title = hero.querySelector('.js-hero-title');
    const description = hero.querySelector('.js-hero-description');
    const buttons = hero.querySelectorAll('.hero-button');
    const carousel = hero.querySelector('.js-hero-carousel');
    const carouselItems = carousel ? carousel.querySelectorAll('.js-hero-carousel-item') : [];
    const blobs = hero.querySelectorAll('.pointer-events-none > div');

    // Create main timeline with smooth, elegant defaults
    const tl = gsap.timeline({
        defaults: {
            ease: 'power3.out',
            duration: 0.9
        }
    });

    // Animate hero title with smooth, sexy word-by-word reveal
    if (title) {
        const words = splitTextIntoWords(title);

        // Set initial state with subtle effects for smoothness (no blur to preserve alignment)
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
        // Split description into words for same effect
        const descText = description.textContent.trim();
        const descWords = descText.split(/\s+/);

        // Clear and rebuild with word spans
        description.innerHTML = descWords.map((word, index) => {
            const space = index < descWords.length - 1 ? ' ' : '';
            return `<span class="desc-word-wrapper"><span class="desc-word">${word}</span></span>${space}`;
        }).join('');

        const descWordElements = description.querySelectorAll('.desc-word');

        // Set initial state with same subtle effects as title
        gsap.set(descWordElements, {
            opacity: 0,
            y: 12,
            scale: 0.97
        });

        // Smooth, elegant word reveal with beautiful stagger (same as title)
        tl.to(descWordElements, {
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
                // Clear transforms after animation
                descWordElements.forEach(word => {
                    gsap.set(word, { clearProps: 'y,scale' });
                });
            }
        }, '-=0.3');
    }

    // Animate carousel with smooth, sexy entrance - synchronized with description
    if (carousel) {
        // Set carousel to invisible initially with elegant transform
        gsap.set(carousel, {
            opacity: 0,
            y: 45,
            scale: 0.96,
            rotationY: -3,
            filter: 'blur(10px)'
        });

        // Smooth, sexy carousel entrance - starts with description for harmony
        tl.to(carousel, {
            opacity: 1,
            y: 0,
            scale: 1,
            rotationY: 0,
            filter: 'blur(0px)',
            duration: 1.2,
            ease: 'power2.out',
        }, '-=1'); // Start at the same time as description for synchronized entrance

        // Wait for Alpine to render carousel items, then add smooth click handlers
        const setupCarouselClicks = () => {
            const items = carousel.querySelectorAll('.js-hero-carousel-item');
            if (items.length > 0) {
                // Add smooth, sexy click animation feedback
                items.forEach((item) => {
                    item.addEventListener('click', function () {
                        // Smooth scale pulse with elegant bounce
                        gsap.to(this, {
                            scale: 0.97,
                            duration: 0.18,
                            yoyo: true,
                            repeat: 1,
                            ease: 'elastic.out(1, 0.6)',
                            onComplete: () => {
                                // Clear any inline styles so Alpine's classes work
                                gsap.set(this, { clearProps: 'scale' });
                            }
                        });
                    });
                });
            } else {
                // Retry if items aren't ready yet
                setTimeout(setupCarouselClicks, 100);
            }
        };

        // Setup click handlers after Alpine renders
        setTimeout(setupCarouselClicks, 300);
    }

    // Animate buttons with smooth, sexy, elegant entrance
    if (buttons.length > 0) {
        // Set initial state with subtle, elegant effects
        gsap.set(buttons, {
            opacity: 0,
            y: 28,
            scale: 0.92,
            filter: 'blur(4px)'
        });

        // Smooth, sexy button animation with elegant stagger and bounce
        buttons.forEach((btn, index) => {
            tl.to(btn, {
                opacity: 1,
                y: 0,
                scale: 1,
                filter: 'blur(0px)',
                duration: 0.85,
                ease: 'back.out(1.5)',
            }, `-=${0.55 - (index * 0.12)}`);
        });
    }

    // Hero blobs remain static to keep hero free of scroll-driven motion
    if (blobs.length) {
        gsap.set(blobs, { clearProps: 'xPercent,yPercent' });
    }
};

// Floating bubbles in manufacturing section
const animateManufacturingBubbles = () => {
    const bubblesContainer = document.querySelector('.js-manufacturing-bubbles');
    if (!bubblesContainer) return;

    const bubbles = bubblesContainer.querySelectorAll('.js-manufacturing-bubble');
    if (!bubbles.length) return;

    // Bubble configs: [size, x%, y%, duration, delay, floatDistance]
    const baseConfigs = [
        [70, 8, 78, 9, 0.1, 55],
        [82, 18, 20, 10, 0.4, 60],
        [64, 30, 72, 8, 0.7, 48],
        [76, 42, 18, 9.5, 1.0, 52],
        [58, 55, 80, 8.5, 0.3, 42],
        [68, 65, 22, 9.2, 0.8, 50],
        [52, 78, 76, 7.8, 1.1, 38],
        [60, 88, 28, 8.6, 0.6, 44],
        [46, 12, 38, 7.2, 0.9, 32],
        [50, 32, 30, 7.4, 1.2, 34],
        [44, 48, 82, 6.8, 0.5, 30],
        [42, 68, 34, 6.6, 1.3, 28],
        [40, 82, 60, 6.4, 1.5, 26],
        [38, 22, 58, 6.2, 1.7, 24],
    ];

    bubbles.forEach((bubble, index) => {
        const [size, xPercent, yPercent, duration, delay, floatDistance] =
            baseConfigs[index] || [50, 10 + index * 5, 50, 8, index * 0.15, 36];

        const baseY = -size / 2;
        bubble.dataset.baseY = baseY;

        gsap.set(bubble, {
            width: `${size}px`,
            height: `${size}px`,
            left: `${xPercent}%`,
            top: `${yPercent}%`,
            x: `-${size / 2}px`,
            y: baseY,
            opacity: 0,
            scale: 0.85,
            filter: 'blur(2px)',
        });

        const floatUpY = baseY - floatDistance;
        const floatDownY = baseY + floatDistance * 0.4;
        const floatRightX = floatDistance * 0.5;
        const floatLeftX = -floatDistance * 0.3;

        const tl = gsap.timeline({ repeat: -1, delay });

        // Entrance
        tl.to(bubble, {
            opacity: 0.7,
            scale: 1,
            duration: 1.4,
            ease: 'power2.out',
        }, 0);

        // Float up/right
        tl.to(bubble, {
            y: floatUpY,
            x: floatRightX,
            duration: duration * 0.55,
            ease: 'sine.inOut',
        }, 0.2);

        // Float down/left slightly
        tl.to(bubble, {
            y: floatDownY,
            x: floatLeftX,
            opacity: 0.25,
            duration: duration * 0.45,
            ease: 'sine.inOut',
        });

        // Soft breathing scale & opacity shimmer
        gsap.to(bubble, {
            scale: 1.08,
            opacity: '+=0.12',
            duration: duration * 0.7,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: delay + 0.5,
        });
    });

    // Scroll-based subtle upward drift across the whole section
    ScrollTrigger.create({
        trigger: '.js-manufacturing-section',
        start: 'top bottom',
        end: 'bottom top',
        scrub: 1.3,
        onUpdate: (self) => {
            const progress = self.progress;
            bubbles.forEach((bubble) => {
                const size = parseFloat(bubble.style.width) || 60;
                const baseY = parseFloat(bubble.dataset.baseY) || 0;
                const upward = progress * (size * 0.8);

                gsap.set(bubble, {
                    y: baseY - upward,
                });
            });
        },
    });
};

const animateAboutSection = () => {
    const section = document.querySelector('.js-about-section');
    if (!section) {
        return;
    }

    // Animate header elements
    const label = section.querySelector('.js-about-label');
    const title = section.querySelector('.js-about-title');
    const description = section.querySelector('.js-about-description');
    const expertiseWrapper = section.querySelector('.js-about-expertise-wrapper');
    const expertiseNumber = section.querySelector('.js-about-expertise-number');
    const expertiseText = section.querySelector('.js-about-expertise-text');

    // Cool animation for "11 years of expertise" - huge and impressive
    if (expertiseWrapper && expertiseNumber && expertiseText) {
        // Set initial states
        gsap.set(expertiseNumber, {
            opacity: 0,
            scale: 0,
            rotation: -180,
            y: 100,
            filter: 'blur(20px)',
        });
        gsap.set(expertiseText, {
            opacity: 0,
            x: -100,
            filter: 'blur(10px)',
        });

        ScrollTrigger.create({
            trigger: expertiseWrapper,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

                // Animate the number "11" with dramatic effect
                tl.to(expertiseNumber, {
                    opacity: 1,
                    scale: 1,
                    rotation: 0,
                    y: 0,
                    filter: 'blur(0px)',
                    duration: 1.2,
                    ease: 'back.out(2)',
                }, 0);

                // Add a pulse/glow effect
                tl.to(expertiseNumber, {
                    scale: 1.1,
                    duration: 0.3,
                    ease: 'power2.inOut',
                    yoyo: true,
                    repeat: 1,
                }, 0.8);

                // Animate the text "years of expertise" with slide and fade
                tl.to(expertiseText, {
                    opacity: 1,
                    x: 0,
                    filter: 'blur(0px)',
                    duration: 1,
                    ease: 'power2.out',
                }, 0.4);

                // Add continuous subtle animation
                gsap.to(expertiseNumber, {
                    scale: 1.05,
                    duration: 2,
                    ease: 'sine.inOut',
                    yoyo: true,
                    repeat: -1,
                });
            },
        });

        // Parallax effect on scroll
        ScrollTrigger.create({
            trigger: expertiseWrapper,
            start: 'top bottom',
            end: 'bottom top',
            scrub: 1,
            onUpdate: (self) => {
                const progress = self.progress;
                const yOffset = (progress - 0.5) * 50;
                const scale = 1 + (progress - 0.5) * 0.1;
                gsap.set(expertiseNumber, { y: yOffset, scale: scale });
            },
        });
    }

    if (label || title || description) {
        ScrollTrigger.create({
            trigger: section,
            start: 'top 80%',
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

                if (label) {
                    tl.from(label, {
                        opacity: 0,
                        y: 20,
                        duration: 0.7,
                    }, 0);
                }

                if (title) {
                    tl.from(title, {
                        opacity: 0,
                        y: 40,
                        scale: 0.95,
                        duration: 1,
                    }, 0.2);
                }

                if (description) {
                    tl.from(description, {
                        opacity: 0,
                        y: 30,
                        duration: 0.9,
                    }, 0.5);
                }
            },
        });
    }

    // Animate interconnected Mission, Vision, Values section
    const mvvSection = section.querySelector('.js-mvv-section');
    if (mvvSection) {
        const columns = mvvSection.querySelectorAll('.js-mvv-column');
        const cardWrappers = mvvSection.querySelectorAll('.js-mvv-card-wrapper');
        const lines = mvvSection.querySelector('.js-mvv-lines');
        const line1 = mvvSection.querySelector('.js-mvv-line-1');
        const line2 = mvvSection.querySelector('.js-mvv-line-2');
        const bubblesContainer = mvvSection.querySelector('.js-mvv-bubbles');

        // Create floating bubbles
        if (bubblesContainer) {
            const bubbleCount = 15;
            const colors = [
                { color: '#1f58be', opacity: 0.3 }, // maklos-600
                { color: '#0d9488', opacity: 0.3 }, // eucalyptus-600
                { color: '#ffffff', opacity: 0.2 },
            ];

            for (let i = 0; i < bubbleCount; i++) {
                const bubble = document.createElement('div');
                const size = 20 + Math.random() * 40;
                const colorData = colors[Math.floor(Math.random() * colors.length)];
                const startX = Math.random() * 100;
                const startY = Math.random() * 100;
                const duration = 8 + Math.random() * 12;
                const delay = Math.random() * 5;

                bubble.className = 'js-mvv-bubble absolute rounded-full';
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                bubble.style.background = `radial-gradient(circle, ${colorData.color}${Math.floor(colorData.opacity * 255).toString(16).padStart(2, '0')} 0%, transparent 70%)`;
                bubble.style.left = `${startX}%`;
                bubble.style.top = `${startY}%`;
                bubble.style.filter = 'blur(2px)';
                bubble.style.pointerEvents = 'none';

                bubblesContainer.appendChild(bubble);

                // Animate bubble floating
                gsap.to(bubble, {
                    x: (Math.random() - 0.5) * 200,
                    y: (Math.random() - 0.5) * 200,
                    scale: 0.8 + Math.random() * 0.4,
                    opacity: 0.2 + Math.random() * 0.3,
                    duration: duration,
                    ease: 'sine.inOut',
                    yoyo: true,
                    repeat: -1,
                    delay: delay,
                });

                // Add rotation
                gsap.to(bubble, {
                    rotation: 360,
                    duration: duration * 2,
                    ease: 'none',
                    repeat: -1,
                });
            }
        }

        // Set initial states for card wrappers
        cardWrappers.forEach((wrapper, index) => {
            gsap.set(wrapper, {
                opacity: 0,
                y: 60,
                scale: 0.9,
                rotationY: 0,
            });
        });

        // Initial scroll animation - card wrappers fade in
        ScrollTrigger.create({
            trigger: mvvSection,
            start: 'top 80%',
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

                cardWrappers.forEach((wrapper, index) => {
                    tl.to(wrapper, {
                        opacity: 1,
                        y: 0,
                        scale: 1,
                        duration: 0.8,
                    }, index * 0.15);
                });
            },
        });

        // Function to draw connecting lines
        const drawConnectingLines = (hoveredIndex) => {
            if (!line1 || !line2 || columns.length < 3) return;

            const missionWrapper = columns[0].querySelector('.js-mvv-card-wrapper');
            const visionWrapper = columns[1].querySelector('.js-mvv-card-wrapper');
            const valuesWrapper = columns[2].querySelector('.js-mvv-card-wrapper');

            if (!missionWrapper || !visionWrapper || !valuesWrapper) return;

            const getCardCenter = (wrapper) => {
                const rect = wrapper.getBoundingClientRect();
                const sectionRect = mvvSection.getBoundingClientRect();
                return {
                    x: rect.left + rect.width / 2 - sectionRect.left,
                    y: rect.top + rect.height - 40 - sectionRect.top, // Bottom of card
                };
            };

            const missionCenter = getCardCenter(missionWrapper);
            const visionCenter = getCardCenter(visionWrapper);
            const valuesCenter = getCardCenter(valuesWrapper);

            // Draw line from Mission to Vision
            const path1 = `M ${missionCenter.x} ${missionCenter.y} Q ${(missionCenter.x + visionCenter.x) / 2} ${missionCenter.y - 30} ${visionCenter.x} ${visionCenter.y}`;

            // Draw line from Vision to Values
            const path2 = `M ${visionCenter.x} ${visionCenter.y} Q ${(visionCenter.x + valuesCenter.x) / 2} ${visionCenter.y - 30} ${valuesCenter.x} ${valuesCenter.y}`;

            if (hoveredIndex === 0 || hoveredIndex === 1) {
                gsap.to(line1, {
                    attr: { d: path1 },
                    opacity: 0.8,
                    duration: 0.6,
                    ease: 'power2.out',
                });
            } else {
                gsap.to(line1, {
                    opacity: 0,
                    duration: 0.3,
                });
            }

            if (hoveredIndex === 1 || hoveredIndex === 2) {
                gsap.to(line2, {
                    attr: { d: path2 },
                    opacity: 0.8,
                    duration: 0.6,
                    ease: 'power2.out',
                });
            } else {
                gsap.to(line2, {
                    opacity: 0,
                    duration: 0.3,
                });
            }
        };

        // No continuous animations on cards - they stay still

        // Hover animations for each column - 180 degree flip
        columns.forEach((column, index) => {
            const cardWrapper = column.querySelector('.js-mvv-card-wrapper');
            const cardFront = column.querySelector('.js-mvv-card-front');
            const cardBack = column.querySelector('.js-mvv-card-back');
            const expandedContent = column.querySelector('.js-mvv-expanded');

            if (!cardWrapper || !cardFront || !cardBack) return;

            // Hover enter - flip to back
            column.addEventListener('mouseenter', () => {
                const tl = gsap.timeline({ defaults: { ease: 'power2.inOut' } });

                // Flip the card wrapper 180 degrees
                tl.to(cardWrapper, {
                    rotationY: 180,
                    duration: 0.8,
                    transformStyle: 'preserve-3d',
                }, 0);

                // Animate expanded content items with stagger after flip
                if (expandedContent) {
                    const expandedItems = expandedContent.querySelectorAll('div.rounded-2xl');
                    if (expandedItems.length) {
                        gsap.set(expandedItems, { opacity: 0, y: 20 });
                        gsap.to(expandedItems, {
                            opacity: 1,
                            y: 0,
                            duration: 0.5,
                            stagger: 0.1,
                            delay: 0.4,
                            ease: 'power2.out',
                        });
                    }
                }

                // No connecting lines on hover
            });

            // Hover leave - flip back to front
            column.addEventListener('mouseleave', () => {
                const tl = gsap.timeline({ defaults: { ease: 'power2.inOut' } });

                // Flip the card wrapper back to 0 degrees
                tl.to(cardWrapper, {
                    rotationY: 0,
                    duration: 0.8,
                    transformStyle: 'preserve-3d',
                }, 0);

                // Fade out expanded items
                if (expandedContent) {
                    const expandedItems = expandedContent.querySelectorAll('div.rounded-2xl');
                    if (expandedItems.length) {
                        gsap.to(expandedItems, {
                            opacity: 0,
                            y: -10,
                            duration: 0.3,
                            stagger: 0.05,
                        });
                    }
                }

                // No connecting lines to hide
            });
        });

        // Update lines on resize
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                const hoveredColumn = mvvSection.querySelector('.js-mvv-column:hover');
                if (hoveredColumn) {
                    const index = Array.from(columns).indexOf(hoveredColumn);
                    drawConnectingLines(index);
                }
            }, 250);
        });

        // No parallax effect - cards stay still
    }

    // Animate CTA section
    const cta = section.querySelector('.js-about-cta');
    if (cta) {
        gsap.set(cta, { opacity: 0, y: 40, scale: 0.95 });

        ScrollTrigger.create({
            trigger: cta,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                gsap.to(cta, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 1,
                    ease: 'power3.out',
                });
            },
        });
    }
};

const animateManufacturingSection = () => {
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
            once: true,
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
                        y: 40,
                        scale: 0.95,
                        duration: 1,
                    }, label ? 0.15 : 0);
                }

                if (highlightWords.length) {
                    tl.from(highlightWords, {
                        opacity: 0,
                        y: 28,
                        rotateX: 18,
                        skewY: 6,
                        duration: 0.9,
                        stagger: 0.08,
                    }, '-=0.4');
                }

                if (description) {
                    tl.from(description, {
                        opacity: 0,
                        y: 24,
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

    // Mobile / small screens: no horizontal pinning, just fade/slide in cards
    if (window.innerWidth < 1024) {
        gsap.set(cards, { opacity: 0, y: 40 });

        cards.forEach((card) => {
            ScrollTrigger.create({
                trigger: card,
                start: 'top 85%',
                once: true,
                onEnter: () => {
                    gsap.to(card, {
                        opacity: 1,
                        y: 0,
                        duration: 0.9,
                        ease: 'power3.out',
                    });
                },
            });
        });

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
        const imageWrapper = card.querySelector('.js-manufacturing-image-wrapper');
        const image = card.querySelector('.js-manufacturing-image img');

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

        // Enhanced image animation with Lenis smooth scroll
        if (imageWrapper) {
            tl.to(imageWrapper, {
                opacity: 1,
                scale: 1,
                duration: 1.2,
                ease: 'power2.out',
            }, 0.4);
        }

        if (image) {
            tl.to(image, {
                scale: 1,
                filter: 'blur(0px)',
                opacity: 1,
                duration: 1.4,
                ease: 'power2.out',
            }, 0.3)
            .to(image, {
                y: 0,
                duration: 1.6,
                ease: 'power3.out',
            }, 0.2);
        }
    };

    // Initial states
    cards.forEach((card, index) => {
        const features = card.querySelectorAll('.js-manufacturing-feature');
        const stepNumber = card.querySelector('.js-manufacturing-step-number');
        const stepTitle = card.querySelector('.js-manufacturing-step-title');
        const stepDescription = card.querySelector('.js-manufacturing-step-description');
        const image = card.querySelector('.js-manufacturing-image img');
        const imageWrapper = card.querySelector('.js-manufacturing-image-wrapper');

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
                opacity: index === 0 ? 1 : 0.8,
                scale: index === 0 ? 1 : 1.02,
                filter: index === 0 ? 'blur(0px)' : 'blur(2px)',
                transform: `scale(${index === 0 ? 1 : 1.02})`,
                y: index === 0 ? 0 : 10,
            });
        }
        if (imageWrapper) {
            gsap.set(imageWrapper, {
                opacity: index === 0 ? 1 : 0.8,
                scale: index === 0 ? 1 : 1.05,
            });
        }
    });

    let lastActiveIndex = -1;

    // Pin the section and scrub horizontal translation based on scroll progress
    // Start pinning only after the entire section has come into view
    ScrollTrigger.create({
        trigger: section,
        start: 'bottom bottom',
        end: () => `+=${scrollDistance}`,
        pin: pinWrapper,
        pinSpacing: true,
        scrub: 1.1,
        anticipatePin: 1,
        onUpdate: (self) => {
            const progress = self.progress;
            const maxShift = (totalCards - 1) * 100;

            // Move track horizontally: 0% -> -200% for 3 cards
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

                // Add parallax effect to active image
                const image = card.querySelector('.js-manufacturing-image img');
                if (image && isActive) {
                    const parallaxY = (progress - (index / (totalCards - 1))) * 20;
                    gsap.to(image, {
                        y: parallaxY,
                        duration: 0.3,
                        ease: 'power2.out',
                        overwrite: true,
                    });
                }
            });

            if (activeIndex !== lastActiveIndex && activeIndex >= 0 && activeIndex < totalCards) {
                // Reset previous card's image animation
                if (lastActiveIndex >= 0 && lastActiveIndex < totalCards) {
                    const prevCard = cards[lastActiveIndex];
                    const prevImage = prevCard.querySelector('.js-manufacturing-image img');
                    const prevImageWrapper = prevCard.querySelector('.js-manufacturing-image-wrapper');
                    
                    if (prevImage) {
                        gsap.to(prevImage, {
                            opacity: 0.6,
                            scale: 1.02,
                            filter: 'blur(2px)',
                            y: 10,
                            duration: 0.5,
                            ease: 'power2.in',
                        });
                    }
                    if (prevImageWrapper) {
                        gsap.to(prevImageWrapper, {
                            opacity: 0.7,
                            scale: 1.05,
                            duration: 0.5,
                            ease: 'power2.in',
                        });
                    }
                }
                
                // Animate current card's content
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
};

const animateFaqSection = () => {
    const section = document.querySelector('.js-faq-section');
    if (!section) {
        return;
    }

    const items = section.querySelectorAll('.js-faq-item');
    if (!items.length) {
        return;
    }

    gsap.set(items, { opacity: 0, x: -28, skewX: 3 });

    ScrollTrigger.batch(items, {
        start: 'top 85%',
        interval: 0.2,
        batchMax: 2,
        onEnter: (batch) => {
            gsap.to(batch, {
                opacity: 1,
                x: 0,
                skewX: 0,
                duration: 0.65,
                ease: 'power2.out',
                stagger: 0.08,
                overwrite: true,
            });
        },
        onEnterBack: (batch) => {
            gsap.to(batch, {
                opacity: 1,
                x: 0,
                skewX: 0,
                duration: 0.6,
                ease: 'power2.out',
                stagger: 0.08,
                overwrite: true,
            });
        },
        onLeave: (batch) => gsap.set(batch, { opacity: 0, x: 24, skewX: -2 }),
        onLeaveBack: (batch) => gsap.set(batch, { opacity: 0, x: -28, skewX: 3 }),
    });
};

const animateProductDetails = () => {
    const hero = document.querySelector('.js-product-hero');
    if (hero) {
        gsap.from(hero.querySelectorAll('h1, p, a'), {
            y: 40,
            opacity: 0,
            duration: 0.9,
            stagger: 0.1,
            ease: 'power3.out',
        });

        gsap.from(hero.querySelectorAll('img'), {
            y: 60,
            opacity: 0,
            duration: 1.1,
            ease: 'power3.out',
            delay: 0.1,
        });
    }

    const sections = gsap.utils.toArray('.js-product-section');
    sections.forEach((section) => {
        const targets = section.querySelectorAll('h2, p, li, article, a');
        gsap.from(targets, {
            y: 40,
            opacity: 0,
            duration: 0.8,
            stagger: 0.08,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: section,
                start: 'top 80%',
            },
        });
    });

    const gallery = document.querySelectorAll('.js-product-gallery > div');
    if (gallery.length) {
        gsap.from(gallery, {
            y: 50,
            opacity: 0,
            duration: 0.7,
            stagger: 0.1,
            ease: 'power3.out',
            scrollTrigger: {
                trigger: '.js-product-gallery',
                start: 'top 85%',
            },
        });
    }
};

const animateQualitySection = () => {
    const section = document.querySelector('.js-quality-section');
    if (!section) return;

    const label = section.querySelector('.js-quality-label');
    const title = section.querySelector('.js-quality-title');
    const description = section.querySelector('.js-quality-description');
    const cards = section.querySelectorAll('.js-quality-card');
    const capacity = section.querySelector('.js-quality-capacity');

    // Animate header with Lenis-style word-by-word text animation
    if (label || title || description) {
        ScrollTrigger.create({
            trigger: section,
            start: 'top 80%',
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

                // Label fade in
                if (label) {
                    tl.from(label, {
                        opacity: 0,
                        y: 20,
                        duration: 0.7,
                    }, 0);
                }

                // Title with word-by-word Lenis animation
                if (title) {
                    const titleText = title.textContent.trim();
                    const titleWords = titleText.split(/\s+/);

                    title.innerHTML = titleWords.map((word, index) => {
                        const space = index < titleWords.length - 1 ? ' ' : '';
                        return `<span class="quality-title-word-wrapper"><span class="quality-title-word">${word}</span></span>${space}`;
                    }).join('');

                    const titleWordElements = title.querySelectorAll('.quality-title-word');

                    gsap.set(titleWordElements, {
                        opacity: 0,
                        y: 30,
                        clipPath: 'inset(100% 0% 0% 0%)',
                    });

                    tl.to(titleWordElements, {
                        opacity: 1,
                        y: 0,
                        clipPath: 'inset(0% 0% 0% 0%)',
                        duration: 0.8,
                        stagger: {
                            amount: 0.6,
                            from: 'start',
                            ease: 'power2.out',
                        },
                        ease: 'power2.out',
                        onComplete: () => {
                            titleWordElements.forEach(word => {
                                gsap.set(word, { clearProps: 'y,clipPath' });
                            });
                        },
                    }, 0.3);
                }

                // Description with word-by-word Lenis animation
                if (description) {
                    const descText = description.textContent.trim();
                    const descWords = descText.split(/\s+/);

                    description.innerHTML = descWords.map((word, index) => {
                        const space = index < descWords.length - 1 ? ' ' : '';
                        return `<span class="quality-desc-word-wrapper"><span class="quality-desc-word">${word}</span></span>${space}`;
                    }).join('');

                    const descWordElements = description.querySelectorAll('.quality-desc-word');

                    gsap.set(descWordElements, {
                        opacity: 0,
                        y: 25,
                        clipPath: 'inset(100% 0% 0% 0%)',
                    });

                    tl.to(descWordElements, {
                        opacity: 1,
                        y: 0,
                        clipPath: 'inset(0% 0% 0% 0%)',
                        duration: 0.9,
                        stagger: {
                            amount: 0.8,
                            from: 'start',
                            ease: 'power2.out',
                        },
                        ease: 'power2.out',
                        onComplete: () => {
                            descWordElements.forEach(word => {
                                gsap.set(word, { clearProps: 'y,clipPath' });
                            });
                        },
                    }, 0.6);
                }
            },
        });
    }

    // Animate quality cards with smooth entrance
    if (cards.length) {
        cards.forEach((card, index) => {
            const icon = card.querySelector('.js-quality-icon');
            const cardTitle = card.querySelector('.js-quality-card-title');
            const items = card.querySelectorAll('.js-quality-item');
            const itemTexts = card.querySelectorAll('.js-quality-item-text');

            // Set initial states
            gsap.set(card, {
                opacity: 0,
                y: 60,
                scale: 0.95,
            });

            if (icon) {
                gsap.set(icon, {
                    opacity: 0,
                    scale: 0.5,
                    rotation: -180,
                });
            }

            if (cardTitle) {
                gsap.set(cardTitle, {
                    opacity: 0,
                    y: 30,
                });
            }

            if (itemTexts.length) {
                gsap.set(itemTexts, {
                    opacity: 0,
                    y: 20,
                    clipPath: 'inset(100% 0% 0% 0%)',
                });
            }

            ScrollTrigger.create({
                trigger: card,
                start: 'top 85%',
                once: true,
                onEnter: () => {
                    const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

                    // Card entrance
                    tl.to(card, {
                        opacity: 1,
                        y: 0,
                        scale: 1,
                        duration: 1,
                    }, 0);

                    // Icon animation
                    if (icon) {
                        tl.to(icon, {
                            opacity: 1,
                            scale: 1,
                            rotation: 0,
                            duration: 0.9,
                            ease: 'back.out(2)',
                        }, 0.2);
                    }

                    // Title animation
                    if (cardTitle) {
                        tl.to(cardTitle, {
                            opacity: 1,
                            y: 0,
                            duration: 0.8,
                        }, 0.4);
                    }

                    // Items with word-by-word Lenis animation
                    if (itemTexts.length) {
                        itemTexts.forEach((itemText, itemIndex) => {
                            const text = itemText.textContent.trim();
                            const words = text.split(/\s+/);

                            itemText.innerHTML = words.map((word, wordIndex) => {
                                const space = wordIndex < words.length - 1 ? ' ' : '';
                                return `<span class="quality-item-word-wrapper"><span class="quality-item-word">${word}</span></span>${space}`;
                            }).join('');

                            const wordElements = itemText.querySelectorAll('.quality-item-word');

                            gsap.set(wordElements, {
                                opacity: 0,
                                y: 15,
                                clipPath: 'inset(100% 0% 0% 0%)',
                            });

                            tl.to(wordElements, {
                                opacity: 1,
                                y: 0,
                                clipPath: 'inset(0% 0% 0% 0%)',
                                duration: 0.7,
                                stagger: {
                                    amount: 0.3,
                                    from: 'start',
                                },
                                ease: 'power2.out',
                                onComplete: () => {
                                    wordElements.forEach(word => {
                                        gsap.set(word, { clearProps: 'y,clipPath' });
                                    });
                                },
                            }, 0.6 + (itemIndex * 0.15));
                        });
                    }
                },
            });

            // Subtle parallax trailing effect
            ScrollTrigger.create({
                trigger: card,
                start: 'top bottom',
                end: 'bottom top',
                scrub: 1.5,
                onUpdate: (self) => {
                    const progress = self.progress;
                    const yOffset = (progress - 0.5) * 20;
                    gsap.set(card, { y: yOffset });
                },
            });
        });
    }

    // Animate production capacity with Lenis-style text animation
    if (capacity) {
        const capacityLabel = capacity.querySelector('.js-quality-capacity-label');
        const capacityText = capacity.querySelector('.js-quality-capacity-text');
        const capacityDesc = capacity.querySelector('.js-quality-capacity-desc');

        gsap.set(capacity, {
            opacity: 0,
            y: 50,
            scale: 0.95,
        });

        ScrollTrigger.create({
            trigger: capacity,
            start: 'top 85%',
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: 'power3.out' } });

                // Capacity container
                tl.to(capacity, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 1,
                }, 0);

                // Label
                if (capacityLabel) {
                    tl.from(capacityLabel, {
                        opacity: 0,
                        y: 20,
                        duration: 0.7,
                    }, 0.2);
                }

                // Capacity text with word-by-word animation
                if (capacityText) {
                    const textContent = capacityText.textContent.trim();
                    const words = textContent.split(/\s+/);

                    capacityText.innerHTML = words.map((word, index) => {
                        const space = index < words.length - 1 ? ' ' : '';
                        return `<span class="capacity-word-wrapper"><span class="capacity-word">${word}</span></span>${space}`;
                    }).join('');

                    const wordElements = capacityText.querySelectorAll('.capacity-word');

                    gsap.set(wordElements, {
                        opacity: 0,
                        y: 30,
                        scale: 0.9,
                    });

                    tl.to(wordElements, {
                        opacity: 1,
                        y: 0,
                        scale: 1,
                        duration: 0.8,
                        stagger: {
                            amount: 0.5,
                            from: 'start',
                        },
                        ease: 'power2.out',
                        onComplete: () => {
                            wordElements.forEach(word => {
                                gsap.set(word, { clearProps: 'y,scale' });
                            });
                        },
                    }, 0.4);
                }

                // Description with word-by-word animation
                if (capacityDesc) {
                    const descText = capacityDesc.textContent.trim();
                    const descWords = descText.split(/\s+/);

                    capacityDesc.innerHTML = descWords.map((word, index) => {
                        const space = index < descWords.length - 1 ? ' ' : '';
                        return `<span class="capacity-desc-word-wrapper"><span class="capacity-desc-word">${word}</span></span>${space}`;
                    }).join('');

                    const descWordElements = capacityDesc.querySelectorAll('.capacity-desc-word');

                    gsap.set(descWordElements, {
                        opacity: 0,
                        y: 20,
                        clipPath: 'inset(100% 0% 0% 0%)',
                    });

                    tl.to(descWordElements, {
                        opacity: 1,
                        y: 0,
                        clipPath: 'inset(0% 0% 0% 0%)',
                        duration: 0.9,
                        stagger: {
                            amount: 0.7,
                            from: 'start',
                        },
                        ease: 'power2.out',
                        onComplete: () => {
                            descWordElements.forEach(word => {
                                gsap.set(word, { clearProps: 'y,clipPath' });
                            });
                        },
                    }, 0.7);
                }
            },
        });
    }
};

const initPageAnimations = () => {
    initLenis();

    if (window.__gsapContext) {
        window.__gsapContext.revert();
        window.__gsapContext = null;
    }

    window.__gsapContext = gsap.context(() => {
        animateHero();
        animateHeroBubbles();
        animateProductShowcase();
        animateProductBubbles();
        animateAboutSection();
        animateManufacturingSection();
        animateManufacturingBubbles();
        animateQualitySection();
        animateFaqSection();
        animateProductDetails();
        animateShapeDivider();
    });

    ScrollTrigger.refresh();
};

document.addEventListener('DOMContentLoaded', initPageAnimations);

window.addEventListener('turbo:load', initPageAnimations);

window.addEventListener('turbo:before-cache', () => {
    if (window.__gsapContext) {
        window.__gsapContext.revert();
        window.__gsapContext = null;
    }
    ScrollTrigger.getAll().forEach((trigger) => trigger.kill());
});

// Animate the shape divider wave and gradient shimmer
const animateShapeDivider = () => {
    const dividers = document.querySelectorAll('.js-shape-divider');
    if (!dividers.length) return;

    const lenis = initLenis();

    dividers.forEach((divider) => {
        const path = divider.querySelector('path');
        const gradient = divider.querySelector('#shapeDividerGradient');
        const stops = gradient ? gradient.querySelectorAll('stop') : [];
        const bubblesContainer = divider.parentElement?.querySelector('.js-shape-bubbles');
        const bubbles = bubblesContainer ? bubblesContainer.querySelectorAll('.js-shape-bubble') : [];

        if (path) {
            gsap.set(path, { transformOrigin: '50% 50%' });
            // Gentle wave-like motion using vertical oscillation + slight skew/scale
            const waveTl = gsap.timeline({ repeat: -1, yoyo: true });
            waveTl.to(path, {
                y: 4,
                scaleY: 1.03,
                skewX: 1.2,
                duration: 3.2,
                ease: 'sine.inOut',
            }).to(path, {
                y: -2,
                scaleY: 0.995,
                skewX: -1.2,
                duration: 3.2,
                ease: 'sine.inOut',
            });
        }

        // Subtle gradient shimmer on the center stops
        if (stops.length >= 5) {
            const mids = [stops[1], stops[2], stops[3]];
            gsap.to(mids, {
                attr: { 'stop-opacity': 0.98 },
                duration: 2.4,
                repeat: -1,
                yoyo: true,
                ease: 'sine.inOut',
                stagger: 0.18
            });
        }

        // Rising bubbles with slight sway, speed influenced by scroll (Lenis)
        if (bubbles.length) {
            bubbles.forEach((bubble, idx) => {
                const startX = bubble.style.left || `${10 + idx * 6}%`;
                gsap.set(bubble, {
                    y: 0,
                    xPercent: 0,
                    opacity: 0,
                    filter: 'blur(0px)'
                });

                const riseDistance = 120 + Math.random() * 100; // px, match taller divider
                const sway = 10 + Math.random() * 8; // stronger sway for larger bubbles
                const dur = 3.2 + Math.random() * 1.4; // slightly longer for smoothness

                const tl = gsap.timeline({ repeat: -1, delay: Math.random() * 1.2 });
                tl.to(bubble, {
                    opacity: 1,
                    y: -riseDistance * 0.25,
                    x: `+=${sway}`,
                    duration: dur * 0.4,
                    ease: 'power1.out'
                }).to(bubble, {
                    y: -riseDistance,
                    x: `-=${sway * 2}`,
                    opacity: 0,
                    filter: 'blur(0.5px)',
                    duration: dur * 0.6,
                    ease: 'sine.inOut',
                    onComplete: () => {
                        gsap.set(bubble, { clearProps: 'x,filter' });
                    }
                });

                // Tie speed to scroll velocity for natural feel
                lenis.on('scroll', ({ velocity }) => {
                    const speed = 1 + Math.min(Math.abs(velocity) * 0.25, 0.75);
                    tl.timeScale(speed);
                });
            });
        }
    });
};

Alpine.data('heroCarousel', ({ slides = [], interval = 4500 } = {}) => ({
    slides,
    interval,
    current: 0,
    timer: null,
    start() {
        this.stop();
        if (this.slides.length <= 1) {
            return;
        }

        this.timer = setInterval(() => this.next(), this.interval);
    },
    stop() {
        if (this.timer) {
            clearInterval(this.timer);
            this.timer = null;
        }
    },
    next() {
        this.current = (this.current + 1) % this.slides.length;
    },
    prev() {
        this.current = (this.current - 1 + this.slides.length) % this.slides.length;
    },
    goTo(index) {
        if (index >= 0 && index < this.slides.length) {
            this.current = index;
            this.start();
        }
    },
    position(index) {
        const total = this.slides.length;
        if (!total) {
            return 'hidden';
        }

        const diff = (index - this.current + total) % total;
        if (diff === 0) {
            return 'current';
        }

        if (diff === 1) {
            return 'next';
        }

        if (diff === total - 1) {
            return 'prev';
        }

        return 'hidden';
    },
    classes(index) {
        switch (this.position(index)) {
            case 'current':
                return 'translate-x-0 translate-y-0 scale-110 opacity-100 z-30';
            case 'next':
                return 'translate-x-44 translate-y-8 scale-90 blur-sm opacity-80 z-20';
            case 'prev':
                return '-translate-x-44 translate-y-12 scale-90 blur-md opacity-70 z-10';
            default:
                return 'translate-x-64 translate-y-16 scale-75 opacity-0 blur-lg pointer-events-none z-0';
        }
    },
    slideImage(slide) {
        if (typeof slide === 'string') {
            return slide;
        }

        return slide?.image ?? '';
    },
    slideTitle(slide) {
        if (typeof slide === 'object' && slide?.title) {
            return slide.title;
        }

        return 'Maklos Product';
    },
    slideCaption(slide) {
        if (typeof slide === 'object' && slide?.caption) {
            return slide.caption;
        }

        return '';
    },
    indicatorClasses(index) {
        return this.current === index
            ? 'w-6 bg-maklos-500'
            : 'w-2 bg-maklos-200';
    },
}));

Alpine.start();
