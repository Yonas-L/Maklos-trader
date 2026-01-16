@props(['products' => []])

<section id="js-product-showcase-mobile"
    class="lg:hidden bg-gradient-to-br from-maklos-50/50 via-maklos-50/30 to-eucalyptus-50/40 text-charcoal relative overflow-hidden py-12 opacity-0 translate-y-12 transition-all duration-700 ease-out">
    {{-- Animated Soap Bubbles Background --}}
    <div class="absolute inset-0 z-0 pointer-events-none overflow-hidden" style="filter: blur(2px);">
        {{-- Extra Large bubbles (3) --}}
        <div class="js-bubble js-bubble-1 absolute rounded-full opacity-40 z-20"></div>
        <div class="js-bubble js-bubble-2 absolute rounded-full opacity-35 z-10"></div>
        <div class="js-bubble js-bubble-3 absolute rounded-full opacity-45 z-20"></div>
        {{-- Large bubbles (4) --}}
        <div class="js-bubble js-bubble-4 absolute rounded-full opacity-40 z-20"></div>
        <div class="js-bubble js-bubble-5 absolute rounded-full opacity-35 z-10"></div>
        <div class="js-bubble js-bubble-6 absolute rounded-full opacity-45 z-20"></div>
        <div class="js-bubble js-bubble-7 absolute rounded-full opacity-40 z-15"></div>
        {{-- Medium bubbles (3) --}}
        <div class="js-bubble js-bubble-8 absolute rounded-full opacity-50 z-15"></div>
        <div class="js-bubble js-bubble-9 absolute rounded-full opacity-45 z-10"></div>
        <div class="js-bubble js-bubble-10 absolute rounded-full opacity-55 z-20"></div>
        {{-- Small bubbles (2) --}}
        <div class="js-bubble js-bubble-11 absolute rounded-full opacity-60 z-20"></div>
        <div class="js-bubble js-bubble-12 absolute rounded-full opacity-55 z-15"></div>
    </div>

    <div class="relative z-10">
        {{-- Section header --}}
        <div class="mb-8 flex items-center justify-center px-4">
            <h2 class="text-4xl font-bold leading-tight text-center">
                <span class="text-black">Our</span>
                <span class="ml-3" style="color: #0d9488;">Products</span>
            </h2>
        </div>

        {{-- Mobile Products Grid --}}
        <div class="w-full px-4 space-y-8">
            @foreach ($products as $index => $product)
                @php
                    $p = (array) $product;
                    $imageUrl = isset($p['image_path']) && $p['image_path']
                        ? asset('storage/' . $p['image_path'])
                        : ($p['image'] ?? asset('storage/assets/IMG_6745.JPG'));

                    // Desktop-like data extraction
                    $title = $p['title'] ?? 'Product Title';
                    $label = $p['label'] ?? ''; // Keep existing mobile label if needed, or map to title
                    $desc = $p['description'] ?? '';
                    $price = $p['price'] ?? '450 ETB';
                    $weight = $p['weight'] ?? '150g';
                    $stock = $p['in_stock'] ?? ($p['stock'] ?? true);
                    $source = $p['source'] ?? 'Organic Extract';
                    $benefits = $p['benefits'] ?? ['Deep Cleansing'];
                    if (!is_array($benefits)) {
                        $benefits = [$benefits];
                    }
                @endphp
                <div class="js-product-mobile-item block space-y-4 group relative" data-animate="fade-up"
                    data-delay="{{ $index * 0.1 }}" x-data="{ expanded: false, zoomed: false }">
                    {{-- Image with Zoom Effect (No Link) --}}
                    <div class="block cursor-pointer z-10" @click="zoomed = !zoomed" @click.outside="zoomed = false">
                        <div class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden bg-gradient-to-br from-maklos-50 to-maklos-100 transition-all duration-300 ease-out"
                            :class="zoomed ? 'scale-110 shadow-xl z-50' : 'scale-100 shadow-none z-0'">
                            <img src="{{ $imageUrl }}" alt="{{ $title }}"
                                class="absolute inset-0 w-full h-full object-cover" loading="lazy" decoding="async" />

                            {{-- Stock Badge (Overlay on Mobile Image) --}}
                            <div class="absolute top-3 right-3">
                                <span
                                    class="px-2 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider bg-white/90 text-maklos-700 shadow-sm backdrop-blur-sm">
                                    {{ $stock ? 'In Stock' : 'Sold Out' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-maklos-500 mb-2"
                            data-animate="fade-in" data-delay="{{ $index * 0.1 + 0.1 }}">
                            {{ $label }}
                        </p>
                        <a href="{{ route('products.show', $product['slug']) }}">
                            <h2 class="font-display text-2xl font-bold text-charcoal mb-3 transition-colors active:text-maklos-600"
                                data-animate="split-text" data-delay="{{ $index * 0.1 + 0.15 }}">
                                {{ $title }}
                            </h2>
                        </a>
                        <p class="text-sm text-charcoal/70 leading-relaxed mb-3" data-animate="fade-in"
                            data-delay="{{ $index * 0.1 + 0.2 }}">
                            {{ $desc }}
                        </p>

                        {{-- Expand Button --}}
                        {{-- Expand Button --}}
                        <button @click="expanded = !expanded"
                            class="w-full flex items-center justify-between px-4 py-3 mt-2 rounded-lg bg-slate-50 text-sm font-semibold text-maklos-600 active:bg-slate-100 transition-colors"
                            data-animate="fade-in" data-delay="{{ $index * 0.1 + 0.25 }}">
                            <span>View details</span>
                            {{-- Chevron Down Icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 transition-transform duration-300 transform"
                                :class="expanded ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                            </svg>
                        </button>
                    </div>

                    {{-- Expanded Details Section --}}
                    {{-- Expanded Details Section (Accordion Animation) --}}
                    {{-- Expanded Details Section (Accordion Animation) --}}
                    <div class="grid transition-[grid-template-rows] duration-300 ease-in-out"
                        :class="expanded ? 'grid-rows-[1fr]' : 'grid-rows-[0fr]'">
                        <div class="overflow-hidden">
                            <div class="bg-white rounded-xl p-5 border border-slate-100 shadow-sm mt-2">

                                <div class="flex justify-between items-center mb-4 pb-3 border-b border-slate-50">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">Price</span>
                                    <span class="font-mono text-xl text-maklos-600 font-bold">{{ $price }}</span>
                                </div>

                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div class="bg-slate-50 p-3 rounded-lg">
                                        <span
                                            class="block text-[10px] uppercase text-slate-400 font-bold mb-1">Weight</span>
                                        <span class="text-sm font-semibold text-slate-700">{{ $weight }}</span>
                                    </div>
                                    <div class="bg-slate-50 p-3 rounded-lg">
                                        <span
                                            class="block text-[10px] uppercase text-slate-400 font-bold mb-1">Source</span>
                                        <span class="text-sm font-semibold text-slate-700 truncate">{{ $source }}</span>
                                    </div>
                                </div>

                                <div>
                                    <span class="block text-[10px] uppercase text-slate-400 font-bold mb-2">Benefits</span>
                                    <ul class="space-y-2">
                                        @foreach ($benefits as $benefitItem)
                                            <li class="flex items-start gap-2 text-sm text-slate-600">
                                                <svg class="w-4 h-4 text-maklos-500 mt-0.5 flex-shrink-0" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span>{{ $benefitItem }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Explore More Button removed as requested --}}
    </div>

    <style>
        #js-product-showcase-mobile.is-visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mobileSection = document.getElementById('js-product-showcase-mobile');
            if (!mobileSection) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        mobileSection.classList.add('is-visible');
                    } else {
                        mobileSection.classList.remove('is-visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            });

            observer.observe(mobileSection);
        });
    </script>
</section>