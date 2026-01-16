@props(['services' => collect()])

<section class="relative py-16 bg-slate-50 overflow-hidden lg:hidden">
    {{-- Background Bubbles --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-10 right-0 w-64 h-64 bg-blue-100/40 rounded-full blur-[60px]"></div>
        <div class="absolute bottom-10 left-0 w-64 h-64 bg-teal-100/40 rounded-full blur-[60px]"></div>
    </div>

    <div class="relative z-10 px-6">
        {{-- Header --}}
        <div class="text-center mb-12 js-services-mobile-header">
            <h2 class="text-4xl font-bold leading-tight text-center">
                <span class="text-black">Our</span>
                <span class="ml-3" style="color: #0d9488;">Services</span>
            </h2>
        </div>

        {{-- Stacked Cards (Dynamic from Database) --}}
        <div class="space-y-6">
            {{-- 1. Manufacturing (Slide In from Left) --}}
            <div class="js-service-mobile-card relative flex items-center p-5 bg-white rounded-2xl shadow-sm border border-slate-100 opacity-0 -translate-x-12 transition-all duration-700 ease-out"
                style="transition-delay: 0ms;">
                {{-- Icon --}}
                <div class="relative flex-shrink-0 w-16 h-16 mr-5">
                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-blue-600 to-blue-500 opacity-10">
                    </div>
                    <div class="absolute inset-0 rounded-full flex items-center justify-center">
                        <i
                            class="fa-solid fa-industry text-xl bg-gradient-to-br from-blue-600 to-blue-500 bg-clip-text text-transparent"></i>
                    </div>
                </div>
                {{-- Text --}}
                <div>
                    <h3 class="font-bold text-slate-900 text-lg mb-1">Manufacturing</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Premium soap production with consistent quality
                        standards.</p>
                </div>
            </div>

            {{-- 2. Wholesale (Slide In from Right) --}}
            <div class="js-service-mobile-card relative flex items-center p-5 bg-white rounded-2xl shadow-sm border border-slate-100 opacity-0 translate-x-12 transition-all duration-700 ease-out"
                style="transition-delay: 150ms;">
                {{-- Icon --}}
                <div class="relative flex-shrink-0 w-16 h-16 mr-5">
                    <div
                        class="absolute inset-0 rounded-full bg-gradient-to-br from-teal-500 to-emerald-500 opacity-10">
                    </div>
                    <div class="absolute inset-0 rounded-full flex items-center justify-center">
                        <i
                            class="fa-solid fa-boxes-stacked text-xl bg-gradient-to-br from-teal-500 to-emerald-500 bg-clip-text text-transparent"></i>
                    </div>
                </div>
                {{-- Text --}}
                <div>
                    <h3 class="font-bold text-slate-900 text-lg mb-1">Wholesale</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Bulk supply for retailers and distributors,
                        ensuring steady stock.</p>
                </div>
            </div>

            {{-- 3. Import (Slide In from Left) --}}
            <div class="js-service-mobile-card relative flex items-center p-5 bg-white rounded-2xl shadow-sm border border-slate-100 opacity-0 -translate-x-12 transition-all duration-700 ease-out"
                style="transition-delay: 300ms;">
                {{-- Icon --}}
                <div class="relative flex-shrink-0 w-16 h-16 mr-5">
                    <div
                        class="absolute inset-0 rounded-full bg-gradient-to-br from-indigo-600 to-purple-600 opacity-10">
                    </div>
                    <div class="absolute inset-0 rounded-full flex items-center justify-center">
                        <i
                            class="fa-solid fa-ship text-xl bg-gradient-to-br from-indigo-600 to-purple-600 bg-clip-text text-transparent"></i>
                    </div>
                </div>
                {{-- Text --}}
                <div>
                    <h3 class="font-bold text-slate-900 text-lg mb-1">Import</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Sourcing and distribution of related products from
                        global suppliers.</p>
                </div>
            </div>

            {{-- 4. Export (Slide In from Right) --}}
            <div class="js-service-mobile-card relative flex items-center p-5 bg-white rounded-2xl shadow-sm border border-slate-100 opacity-0 translate-x-12 transition-all duration-700 ease-out"
                style="transition-delay: 450ms;">
                {{-- Icon --}}
                <div class="relative flex-shrink-0 w-16 h-16 mr-5">
                    <div class="absolute inset-0 rounded-full bg-gradient-to-br from-cyan-600 to-blue-600 opacity-10">
                    </div>
                    <div class="absolute inset-0 rounded-full flex items-center justify-center">
                        <i
                            class="fa-solid fa-plane-departure text-xl bg-gradient-to-br from-cyan-600 to-blue-600 bg-clip-text text-transparent"></i>
                    </div>
                </div>
                {{-- Text --}}
                <div>
                    <h3 class="font-bold text-slate-900 text-lg mb-1">Export</h3>
                    <p class="text-slate-600 text-sm leading-relaxed">Supplying products to international markets via
                        reliable trade.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .js-service-mobile-card.is-visible {
            opacity: 1 !important;
            transform: translateX(0) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileCards = document.querySelectorAll('.js-service-mobile-card');
            if (!mobileCards.length) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -30px 0px'
            });

            mobileCards.forEach(card => observer.observe(card));
        });
    </script>
</section>