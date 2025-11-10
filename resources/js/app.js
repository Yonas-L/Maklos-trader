import './bootstrap';

import 'flowbite';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

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
