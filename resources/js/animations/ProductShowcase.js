import gsap from 'gsap';
import ScrollTrigger from 'gsap/ScrollTrigger';
import { isMobile } from './Utils';

// Constants for better maintainability
const ANIMATION_CONFIG = {
    DESKTOP_BREAKPOINT: 1024,
    SCROLL_MULTIPLIER: 0.35,
    SWAP_THRESHOLD: 0.5,
    TRANSITION_DURATION: 0.8,
    ENTRANCE_DURATION: 1,
    EASE: 'power3.out',
    EASE_ELASTIC: 'back.out(1.2)',
};

const BUBBLE_CONFIG = {
    SIZES: {
        XL: [200, 220, 250],
        L: [120, 140, 160, 180],
        M: [80, 90, 100],
        S: [40, 50],
    },
    FLOAT_DISTANCE_MULTIPLIER: 0.2, // Reduced from 0.4 for more stable movement
    SCROLL_SPEED: 0.3, // Reduced from 0.5 for slower, smoother scroll
};

export default class ProductShowcase {
    constructor() {
        this.scrollTriggers = [];
        this.init();
    }

    init() {
        gsap.registerPlugin(ScrollTrigger);
        this.animateProductShowcase();
        this.animateProductBubbles();
    }

    animateProductShowcase() {
        const section = document.querySelector('.js-products-section');
        if (!section) return;

        const pinWrapper = section.querySelector('.js-products-pin-wrapper');
        const textPanels = gsap.utils.toArray('.js-product-text-panel');
        const imagePanels = gsap.utils.toArray('.js-product-image-panel');

        if (!pinWrapper || textPanels.length === 0 || imagePanels.length === 0) return;

        // Mobile: simple scroll animations
        if (isMobile()) {
            this.setupMobileAnimations(section);
            return;
        }

        // Desktop: advanced pin & scroll animations
        this.setupDesktopAnimations(section, pinWrapper, textPanels, imagePanels);
    }

    setupMobileAnimations(section) {
        const mobileItems = section.querySelectorAll('.js-product-mobile-item');

        mobileItems.forEach((item) => {
            gsap.set(item, { opacity: 0, y: 40 });

            const trigger = ScrollTrigger.create({
                trigger: item,
                start: 'top 85%',
                once: true,
                onEnter: () => {
                    gsap.to(item, {
                        opacity: 1,
                        y: 0,
                        duration: ANIMATION_CONFIG.TRANSITION_DURATION,
                        ease: ANIMATION_CONFIG.EASE,
                    });
                },
            });

            this.scrollTriggers.push(trigger);
        });
    }

    setupDesktopAnimations(section, pinWrapper, textPanels, imagePanels) {
        // Preload images for smooth transitions
        this.preloadImages(imagePanels);

        // Set initial states
        this.setInitialStates(textPanels, imagePanels);

        // Get column containers
        const textColumn = section.querySelector('.js-products-text-column');
        const imageColumn = section.querySelector('.js-products-image-column');

        // Setup column swapping
        const { calculateSwapDistance, isImageOnLeft } = this.setupColumnSwapping(
            textColumn,
            imageColumn,
            pinWrapper
        );

        // Create main scroll trigger
        this.createPinScrollTrigger(
            section,
            pinWrapper,
            textPanels,
            imagePanels,
            textColumn,
            imageColumn,
            calculateSwapDistance,
            isImageOnLeft
        );

        // Setup entrance animation
        this.setupEntranceAnimation(section, textColumn, imageColumn, textPanels, imagePanels);
    }

    preloadImages(imagePanels) {
        imagePanels.forEach((panel) => {
            const images = panel.querySelectorAll('img');
            images.forEach((img) => {
                if (img.src && !img.complete) {
                    const tempImg = new Image();
                    tempImg.src = img.src;
                }
            });
        });
    }

    setInitialStates(textPanels, imagePanels) {
        textPanels.forEach((panel, index) => {
            gsap.set(panel, {
                zIndex: textPanels.length - index,
                autoAlpha: index === 0 ? 1 : 0,
                y: index === 0 ? 0 : 30,
                scale: index === 0 ? 1 : 0.98,
            });
        });

        imagePanels.forEach((panel, index) => {
            gsap.set(panel, {
                zIndex: imagePanels.length - index,
                autoAlpha: index === 0 ? 1 : 0,
                y: index === 0 ? 0 : 40,
                scale: index === 0 ? 1 : 0.95,
            });
        });
    }

    setupColumnSwapping(textColumn, imageColumn, pinWrapper) {
        const isImageOnLeft = (index) => index % 2 === 1;

        let cachedSwapDistance = 0;

        const calculateSwapDistance = (forceRecalc = false) => {
            if (cachedSwapDistance > 0 && !forceRecalc) return cachedSwapDistance;

            if (textColumn && imageColumn) {
                const textX = gsap.getProperty(textColumn, 'x') || 0;
                const imageX = gsap.getProperty(imageColumn, 'x') || 0;

                gsap.set([textColumn, imageColumn], { x: 0, clearProps: 'x' });
                void textColumn.offsetHeight;

                const textRect = textColumn.getBoundingClientRect();
                const imageRect = imageColumn.getBoundingClientRect();

                gsap.set(textColumn, { x: textX });
                gsap.set(imageColumn, { x: imageX });

                if (textRect.width > 0 && imageRect.width > 0) {
                    const columnWidth = textRect.width;
                    const gap = Math.max(0, imageRect.left - textRect.right);
                    cachedSwapDistance = columnWidth + gap;
                    return cachedSwapDistance;
                }
            }

            const containerWidth = pinWrapper?.offsetWidth || window.innerWidth;
            const gap = 48;
            const columnWidth = (containerWidth - gap) / 2;
            cachedSwapDistance = columnWidth + gap;
            return cachedSwapDistance;
        };

        // Calculate on next frame
        requestAnimationFrame(() => calculateSwapDistance());

        // Recalculate on resize
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                cachedSwapDistance = 0;
                calculateSwapDistance(true);
            }, 150);
        });

        // Set initial positions
        if (textColumn && imageColumn) {
            gsap.set(textColumn, { x: 0 });
            gsap.set(imageColumn, { x: 0 });
        }

        return { calculateSwapDistance, isImageOnLeft };
    }

    createPinScrollTrigger(section, pinWrapper, textPanels, imagePanels, textColumn, imageColumn, calculateSwapDistance, isImageOnLeft) {
        const totalPanels = textPanels.length;
        const scrollDistance = window.innerHeight * totalPanels * ANIMATION_CONFIG.SCROLL_MULTIPLIER;

        const trigger = ScrollTrigger.create({
            trigger: section,
            start: 'top top',
            end: () => `+=${scrollDistance}`,
            pin: pinWrapper,
            pinSpacing: true,
            anticipatePin: 1,
            scrub: 1,
            onUpdate: (self) => {
                const progress = self.progress;
                const panelProgress = progress * totalPanels;
                const currentIndex = Math.min(Math.floor(panelProgress), totalPanels - 1);
                const transitionProgress = panelProgress - currentIndex;

                // Handle column swapping
                this.updateColumnPositions(
                    currentIndex,
                    transitionProgress,
                    totalPanels,
                    textColumn,
                    imageColumn,
                    calculateSwapDistance,
                    isImageOnLeft
                );

                // Handle content transitions
                this.updateContentTransitions(
                    currentIndex,
                    transitionProgress,
                    totalPanels,
                    textPanels,
                    imagePanels
                );
            },
        });

        this.scrollTriggers.push(trigger);
    }

    updateColumnPositions(currentIndex, transitionProgress, totalPanels, textColumn, imageColumn, calculateSwapDistance, isImageOnLeft) {
        if (!textColumn || !imageColumn) return;

        const swapDistance = calculateSwapDistance();
        if (swapDistance <= 0) return;

        const currentImageLeft = isImageOnLeft(currentIndex);
        const nextImageLeft = currentIndex < totalPanels - 1 ? isImageOnLeft(currentIndex + 1) : currentImageLeft;

        // Smooth swap: fade out text, swap columns, fade in new text
        if (currentIndex < totalPanels - 1 && currentImageLeft !== nextImageLeft) {
            // Swap happens at 50% of transition
            const swapProgress = transitionProgress >= ANIMATION_CONFIG.SWAP_THRESHOLD
                ? (transitionProgress - ANIMATION_CONFIG.SWAP_THRESHOLD) / (1 - ANIMATION_CONFIG.SWAP_THRESHOLD)
                : 0;

            // Fade out text in first 40% of transition
            let textOpacity = 1;
            if (transitionProgress < 0.4) {
                textOpacity = 1 - (transitionProgress / 0.4);
            } else if (transitionProgress > 0.6) {
                // Fade in text in last 40% of transition
                textOpacity = (transitionProgress - 0.6) / 0.4;
            } else {
                // Fully hidden during swap (40%-60%)
                textOpacity = 0;
            }

            if (currentImageLeft) {
                // Swapping from image-left to text-left
                gsap.set(textColumn, {
                    x: swapDistance * (1 - swapProgress),
                    opacity: textOpacity
                });
                gsap.set(imageColumn, { x: -swapDistance * (1 - swapProgress) });
            } else {
                // Swapping from text-left to image-left
                gsap.set(textColumn, {
                    x: swapDistance * swapProgress,
                    opacity: textOpacity
                });
                gsap.set(imageColumn, { x: -swapDistance * swapProgress });
            }
        } else {
            // No swap needed - keep in final position
            const finalImageLeft = isImageOnLeft(currentIndex);
            if (finalImageLeft) {
                gsap.set(textColumn, { x: swapDistance, opacity: 1 });
                gsap.set(imageColumn, { x: -swapDistance });
            } else {
                gsap.set(textColumn, { x: 0, opacity: 1 });
                gsap.set(imageColumn, { x: 0 });
            }
        }
    }

    updateContentTransitions(currentIndex, transitionProgress, totalPanels, textPanels, imagePanels) {
        // Smooth crossfade with subtle scale
        const easeProgress = (t) => (1 - Math.cos(t * Math.PI)) / 2;
        const cross = easeProgress(transitionProgress);

        textPanels.forEach((panel, index) => {
            if (index === currentIndex && currentIndex < totalPanels - 1) {
                // Current panel fading out
                gsap.set(panel, {
                    autoAlpha: 1 - cross,
                    y: 15 * cross,
                    scale: 1 - (cross * 0.02),
                });
            } else if (index === currentIndex + 1) {
                // Next panel fading in
                gsap.set(panel, {
                    autoAlpha: cross,
                    y: 15 * (1 - cross),
                    scale: 0.98 + (cross * 0.02),
                });
            } else if (index === currentIndex && currentIndex === totalPanels - 1) {
                // Last panel stays visible
                gsap.set(panel, {
                    autoAlpha: 1,
                    y: 0,
                    scale: 1,
                });
            } else {
                // Hidden panels
                gsap.set(panel, {
                    autoAlpha: 0,
                    y: 30,
                    scale: 0.98,
                });
            }
        });

        imagePanels.forEach((panel, index) => {
            if (index === currentIndex && currentIndex < totalPanels - 1) {
                // Current panel fading out
                gsap.set(panel, {
                    autoAlpha: 1 - cross,
                    y: 20 * cross,
                    scale: 1 - (cross * 0.05),
                });
            } else if (index === currentIndex + 1) {
                // Next panel fading in
                gsap.set(panel, {
                    autoAlpha: cross,
                    y: 20 * (1 - cross),
                    scale: 0.95 + (cross * 0.05),
                });
            } else if (index === currentIndex && currentIndex === totalPanels - 1) {
                // Last panel stays visible
                gsap.set(panel, {
                    autoAlpha: 1,
                    y: 0,
                    scale: 1,
                });
            } else {
                // Hidden panels
                gsap.set(panel, {
                    autoAlpha: 0,
                    y: 40,
                    scale: 0.95,
                });
            }
        });
    }

    setupEntranceAnimation(section, textColumn, imageColumn, textPanels, imagePanels) {
        const trigger = ScrollTrigger.create({
            trigger: section,
            start: 'top 80%',
            once: true,
            onEnter: () => {
                const tl = gsap.timeline({ defaults: { ease: ANIMATION_CONFIG.EASE } });

                // Animate columns
                if (textColumn) {
                    tl.from(textColumn, {
                        opacity: 0,
                        x: -30,
                        duration: ANIMATION_CONFIG.ENTRANCE_DURATION,
                    }, 0);
                }

                if (imageColumn) {
                    tl.from(imageColumn, {
                        opacity: 0,
                        x: 30,
                        duration: ANIMATION_CONFIG.ENTRANCE_DURATION,
                    }, 0);
                }

                // Animate first panel content
                const firstTextPanel = textPanels[0];
                if (firstTextPanel) {
                    tl.to(firstTextPanel, {
                        autoAlpha: 1,
                        y: 0,
                        scale: 1,
                        duration: ANIMATION_CONFIG.TRANSITION_DURATION,
                    }, 0.2);

                    // Stagger child elements
                    const label = firstTextPanel.querySelector('.js-products-label');
                    const title = firstTextPanel.querySelector('.js-products-title');
                    const description = firstTextPanel.querySelector('.js-products-description');

                    if (label) tl.from(label, { opacity: 0, y: 15, duration: 0.6 }, 0.3);
                    if (title) tl.from(title, { opacity: 0, y: 20, duration: 0.7 }, 0.4);
                    if (description) tl.from(description, { opacity: 0, y: 15, duration: 0.6 }, 0.5);
                }

                const firstImagePanel = imagePanels[0];
                if (firstImagePanel) {
                    tl.to(firstImagePanel, {
                        autoAlpha: 1,
                        y: 0,
                        scale: 1,
                        duration: ANIMATION_CONFIG.ENTRANCE_DURATION,
                        ease: ANIMATION_CONFIG.EASE_ELASTIC,
                    }, 0.3);
                }
            },
        });

        this.scrollTriggers.push(trigger);
    }

    animateProductBubbles() {
        const bubblesContainer = document.querySelector('.js-products-bubbles');
        if (!bubblesContainer) return;

        const bubbles = bubblesContainer.querySelectorAll('.js-bubble');
        if (bubbles.length === 0) return;

        // Generate bubble configurations
        const bubbleConfigs = this.generateBubbleConfigs();

        bubbles.forEach((bubble, index) => {
            const config = bubbleConfigs[index] || [80, 50, 50, 8, 0, 40];
            this.animateBubble(bubble, config, index);
        });

        // Scroll-based upward movement
        this.setupBubbleScrollAnimation(bubbles);
    }

    generateBubbleConfigs() {
        const configs = [];
        let configIndex = 0;

        // Helper to create config: [size, x, y, duration, delay, floatDistance]
        const createConfig = (size, index, total) => {
            const xPercent = (index / total) * 100;
            const yPercent = 10 + Math.random() * 80;
            const duration = 8 + Math.random() * 5;
            const delay = Math.random() * 3;
            const floatDistance = size * BUBBLE_CONFIG.FLOAT_DISTANCE_MULTIPLIER;
            return [size, xPercent, yPercent, duration, delay, floatDistance];
        };

        // Extra large bubbles
        BUBBLE_CONFIG.SIZES.XL.forEach((size, i) => {
            configs.push(createConfig(size, i, BUBBLE_CONFIG.SIZES.XL.length));
        });

        // Large bubbles
        BUBBLE_CONFIG.SIZES.L.forEach((size, i) => {
            configs.push(createConfig(size, i, BUBBLE_CONFIG.SIZES.L.length));
        });

        // Medium bubbles
        BUBBLE_CONFIG.SIZES.M.forEach((size, i) => {
            configs.push(createConfig(size, i, BUBBLE_CONFIG.SIZES.M.length));
        });

        // Small bubbles
        BUBBLE_CONFIG.SIZES.S.forEach((size, i) => {
            configs.push(createConfig(size, i, BUBBLE_CONFIG.SIZES.S.length));
        });

        return configs;
    }

    animateBubble(bubble, config, index) {
        const [size, xPercent, yPercent, duration, delay, floatDistance] = config;

        const baseY = -size / 2;
        bubble.dataset.baseY = baseY;

        const initialOpacity = parseFloat(getComputedStyle(bubble).opacity) || BUBBLE_CONFIG.OPACITY_BASE;

        // Set initial state
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

        // Entrance animation
        gsap.to(bubble, {
            opacity: initialOpacity,
            scale: 1,
            duration: 1.5,
            ease: 'back.out(1.7)',
            delay: delay + 0.3,
        });

        // Floating animation
        const floatTL = gsap.timeline({ repeat: -1, delay });

        const floatUpY = baseY - floatDistance;
        const floatDownY = baseY + floatDistance;
        const floatRightX = floatDistance * 0.6;
        const floatLeftX = -floatDistance * 0.4;

        floatTL
            .to(bubble, {
                y: floatUpY,
                x: floatRightX,
                rotation: 360,
                duration,
                ease: 'sine.inOut',
            })
            .to(bubble, {
                y: floatDownY,
                x: floatLeftX,
                rotation: -360,
                duration,
                ease: 'sine.inOut',
            });

        // Scale pulsing
        gsap.to(bubble, {
            scale: BUBBLE_CONFIG.SCALE_PULSE,
            duration: duration * 0.8,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: delay + 1,
        });

        // Opacity shimmer
        gsap.to(bubble, {
            opacity: `+=${initialOpacity * 0.3}`,
            duration: duration * 0.6,
            ease: 'sine.inOut',
            repeat: -1,
            yoyo: true,
            delay: delay + 0.5,
        });
    }

    setupBubbleScrollAnimation(bubbles) {
        bubbles.forEach((bubble) => {
            bubble.dataset.scrollOffset = 0;
        });

        const trigger = ScrollTrigger.create({
            trigger: '.js-products-section',
            start: 'top bottom',
            end: 'bottom top',
            scrub: 1.5,
            onUpdate: (self) => {
                const progress = self.progress;
                bubbles.forEach((bubble) => {
                    const size = parseFloat(bubble.style.width) || 100;
                    const upwardMovement = progress * (size * 1.5);
                    const baseY = parseFloat(bubble.dataset.baseY) || 0;

                    gsap.set(bubble, {
                        y: baseY - upwardMovement,
                    });
                });
            },
        });

        this.scrollTriggers.push(trigger);
    }

    cleanup() {
        // Clean up ScrollTriggers when needed
        this.scrollTriggers.forEach((trigger) => trigger.kill());
        this.scrollTriggers = [];
    }
}
