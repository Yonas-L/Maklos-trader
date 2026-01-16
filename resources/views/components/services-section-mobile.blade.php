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
            @forelse ($services as $index => $service)
                @php
                    $colors = $service->color_classes;
                    $gradientMap = [
                        'blue' => 'from-blue-600 to-blue-500',
                        'teal' => 'from-teal-500 to-emerald-500',
                        'indigo' => 'from-indigo-600 to-purple-600',
                        'cyan' => 'from-cyan-600 to-blue-600',
                    ];
                    $gradient = $gradientMap[$service->color_scheme] ?? 'from-blue-600 to-blue-500';
                @endphp

                <div class="js-service-mobile-card relative flex items-center p-4 bg-white rounded-2xl shadow-sm border border-slate-100 opacity-0 -translate-x-12 transition-all duration-700 ease-out"
                    style="transition-delay: {{ $index * 150 }}ms;">

                    {{-- Circular Icon Wrapper --}}
                    <div class="relative flex-shrink-0 w-16 h-16 mr-5">
                        <div class="absolute inset-0 rounded-full bg-gradient-to-br {{ $gradient }} opacity-10"></div>
                        <div class="absolute inset-0 rounded-full flex items-center justify-center">
                            <i
                                class="{{ $service->icon }} text-xl bg-gradient-to-br {{ $gradient }} bg-clip-text text-transparent"></i>
                        </div>
                    </div>

                    {{-- Text --}}
                    <div>
                        <h3 class="font-bold text-slate-900 text-lg mb-1">{{ $service->title }}</h3>
                        <p class="text-slate-500 text-xs leading-relaxed">{{ $service->description }}</p>
                    </div>
                </div>
            @empty
                {{-- Fallback: Show placeholder when no services in database --}}
                <div class="text-center py-10 text-slate-400">
                    <i class="fa-solid fa-cog text-4xl mb-3"></i>
                    <p class="text-sm">No services configured.</p>
                </div>
            @endforelse
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