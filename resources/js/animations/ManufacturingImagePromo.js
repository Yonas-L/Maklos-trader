import gsap from 'gsap';
import { ScrollTrigger } from 'gsap/ScrollTrigger';

gsap.registerPlugin(ScrollTrigger);

export default function initManufacturingImagePromo() {
    const section = document.getElementById('manufacturing-image-promo');
    if (!section) { return; }

    const heading = section.querySelector('.js-mip-header');
    const subtitle = section.querySelector('.js-mip-subtitle');
    const imgWrapper = section.querySelector('.js-mip-image-wrapper');
    const image = section.querySelector('.js-mip-image');

    // Heading entrance
    if (heading) {
        gsap.fromTo(heading, {
            opacity: 0,
            y: 50,
        }, {
            scrollTrigger: { trigger: section, start: 'top 80%', toggleActions: 'play none none reverse' },
            opacity: 1,
            y: 0,
            duration: 1,
            ease: 'power3.out',
        });
    }

    // Subtitle slight delay
    if (subtitle) {
        gsap.from(subtitle, {
            scrollTrigger: { trigger: section, start: 'top 78%', toggleActions: 'play none none reverse' },
            opacity: 0,
            y: 18,
            duration: 0.7,
            delay: 0.1,
            ease: 'power2.out',
        });
    }

    // Image wrapper pop-in with shadow depth
    if (imgWrapper) {
        gsap.fromTo(imgWrapper,
            { scale: 0.96, borderRadius: '2.5rem', boxShadow: '0 25px 60px rgba(0,0,0,0.35)' },
            {
                scrollTrigger: { trigger: imgWrapper, start: 'top 85%', toggleActions: 'play none none reverse' },
                scale: 1,
                borderRadius: '1.5rem',
                duration: 1,
                ease: 'expo.out',
            }
        );
    }

    // Subtle image parallax and reveal
    if (image) {
        gsap.from(image, {
            scrollTrigger: { trigger: imgWrapper ?? image, start: 'top 85%', toggleActions: 'play none none reverse' },
            opacity: 0,
            y: 40,
            duration: 1,
            ease: 'power3.out',
        });

        gsap.to(image, {
            scrollTrigger: { trigger: section, start: 'top bottom', end: 'bottom top', scrub: true },
            y: -30,
            ease: 'none',
        });
    }
}
