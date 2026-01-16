@props(['services' => collect()])

<section class="hidden lg:block relative py-24 bg-slate-50 overflow-hidden selection:bg-blue-500 selection:text-white">

    {{-- 1. Background Atmosphere --}}
    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute inset-0"
            style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 40px 40px; opacity: 0.4;">
        </div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[800px] bg-blue-100/50 rounded-full blur-[120px]">
        </div>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6">

        {{-- 2. Section Header --}}
        <div class="text-center mb-16 lg:mb-0 relative z-20">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-center">
                <span class="text-black">Our</span>
                <span class="ml-3" style="color: #0d9488;">Services</span>
            </h2>
        </div>

        {{-- 3. THE ECOSYSTEM CONTAINER --}}
        <div class="relative mt-12 lg:mt-8 w-full lg:h-[700px] max-w-6xl mx-auto">

            {{-- SVG CONNECTING LINES (Desktop Only) --}}
            <svg class="absolute inset-0 w-full h-full pointer-events-none hidden lg:block z-0"
                xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <linearGradient id="pulse-gradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#3b82f6; stop-opacity:0.1" />
                        <stop offset="50%" style="stop-color:#0d9488; stop-opacity:0.8" />
                        <stop offset="100%" style="stop-color:#3b82f6; stop-opacity:0.1" />
                    </linearGradient>
                </defs>

                {{-- Top Left Connection --}}
                <line x1="50%" y1="50%" x2="20%" y2="20%" stroke="url(#pulse-gradient)" stroke-width="2"
                    stroke-dasharray="8 8" class="animate-dash-flow opacity-40" />
                {{-- Top Right Connection --}}
                <line x1="50%" y1="50%" x2="80%" y2="20%" stroke="url(#pulse-gradient)" stroke-width="2"
                    stroke-dasharray="8 8" class="animate-dash-flow opacity-40" style="animation-delay: -1s" />
                {{-- Bottom Left Connection --}}
                <line x1="50%" y1="50%" x2="20%" y2="80%" stroke="url(#pulse-gradient)" stroke-width="2"
                    stroke-dasharray="8 8" class="animate-dash-flow opacity-40" style="animation-delay: -2s" />
                {{-- Bottom Right Connection --}}
                <line x1="50%" y1="50%" x2="80%" y2="80%" stroke="url(#pulse-gradient)" stroke-width="2"
                    stroke-dasharray="8 8" class="animate-dash-flow opacity-40" style="animation-delay: -3s" />
            </svg>

            {{-- CENTRAL HUB (Dead Center) --}}
            <div
                class="hidden lg:flex absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-48 h-48 z-10 items-center justify-center">
                {{-- Pulsing Rings --}}
                <div
                    class="absolute inset-0 rounded-full border border-blue-200 animate-[ping_3s_linear_infinite] opacity-30">
                </div>
                <div class="absolute inset-8 rounded-full border border-teal-200 animate-[ping_3s_linear_infinite] opacity-30"
                    style="animation-delay: 1.5s"></div>

                {{-- Core Circle --}}
                <div
                    class="relative w-32 h-32 bg-white rounded-full shadow-[0_0_40px_rgba(13,148,136,0.15)] flex items-center justify-center z-20 border-4 border-slate-50">
                    <div class="text-center">
                        <div class="font-display font-bold text-2xl text-slate-900 tracking-tight">MAKLOS</div>
                        <div class="text-[10px] font-bold tracking-widest text-[#0d9488] uppercase mt-1">Trader</div>
                    </div>
                </div>
            </div>

            {{-- SERVICES GRID (Dynamic from Database) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 lg:block">

                {{-- 1. Manufacturing (Top Left) --}}
                <div class="js-service-card group relative lg:absolute lg:top-10 lg:left-10 lg:w-[350px] transition-all duration-500 hover:z-30 opacity-0 translate-y-8"
                    style="transition-delay: 0ms;">
                    <div
                        class="relative p-8 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 hover:border-blue-200 transition-all duration-300 group-hover:-translate-y-2">
                        <div
                            class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center text-3xl mb-6 group-hover:bg-blue-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <i class="fa-solid fa-industry"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Manufacturing</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Premium soap production with consistent quality standards for local and regional markets.
                        </p>
                        <div
                            class="hidden lg:block absolute bottom-8 -right-2 w-4 h-4 bg-blue-500 rounded-full border-4 border-white shadow-sm z-20">
                        </div>
                    </div>
                </div>

                {{-- 2. Wholesale (Top Right) --}}
                <div class="js-service-card group relative lg:absolute lg:top-10 lg:right-10 lg:w-[350px] transition-all duration-500 hover:z-30 opacity-0 translate-y-8"
                    style="transition-delay: 150ms;">
                    <div
                        class="relative p-8 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 hover:border-teal-200 transition-all duration-300 group-hover:-translate-y-2">
                        <div
                            class="w-16 h-16 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-3xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <i class="fa-solid fa-boxes-stacked"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Wholesale</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Bulk supply for retailers and distributors, ensuring steady stock and competitive pricing.
                        </p>
                        <div
                            class="hidden lg:block absolute bottom-8 -left-2 w-4 h-4 bg-teal-500 rounded-full border-4 border-white shadow-sm z-20">
                        </div>
                    </div>
                </div>

                {{-- 3. Import (Bottom Left) --}}
                <div class="js-service-card group relative lg:absolute lg:bottom-10 lg:left-10 lg:w-[350px] transition-all duration-500 hover:z-30 opacity-0 translate-y-8"
                    style="transition-delay: 300ms;">
                    <div
                        class="relative p-8 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 hover:border-indigo-200 transition-all duration-300 group-hover:-translate-y-2">
                        <div
                            class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-3xl mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <i class="fa-solid fa-ship"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Import</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Sourcing and distribution of related products, connecting global suppliers with local needs.
                        </p>
                        <div
                            class="hidden lg:block absolute top-8 -right-2 w-4 h-4 bg-indigo-500 rounded-full border-4 border-white shadow-sm z-20">
                        </div>
                    </div>
                </div>

                {{-- 4. Export (Bottom Right) --}}
                <div class="js-service-card group relative lg:absolute lg:bottom-10 lg:right-10 lg:w-[350px] transition-all duration-500 hover:z-30 opacity-0 translate-y-8"
                    style="transition-delay: 450ms;">
                    <div
                        class="relative p-8 bg-white rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-100 hover:border-cyan-200 transition-all duration-300 group-hover:-translate-y-2">
                        <div
                            class="w-16 h-16 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center text-3xl mb-6 group-hover:bg-cyan-600 group-hover:text-white transition-colors duration-300 shadow-sm">
                            <i class="fa-solid fa-plane-departure"></i>
                        </div>
                        <h3 class="text-xl font-bold text-slate-900 mb-2">Export</h3>
                        <p class="text-slate-500 text-sm leading-relaxed">
                            Supplying products to international markets, expanding reach with reliable trade
                            partnerships.
                        </p>
                        <div
                            class="hidden lg:block absolute top-8 -left-2 w-4 h-4 bg-cyan-500 rounded-full border-4 border-white shadow-sm z-20">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <style>
        @keyframes dash-flow {
            0% {
                stroke-dashoffset: 100;
            }

            100% {
                stroke-dashoffset: 0;
            }
        }

        .animate-dash-flow {
            animation: dash-flow 2s linear infinite;
        }

        .js-service-card.is-visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const serviceCards = document.querySelectorAll('.js-service-card');
            if (!serviceCards.length) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            serviceCards.forEach(card => observer.observe(card));
        });
    </script>
</section>