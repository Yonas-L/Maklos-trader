@props(['products' => []])

<section id="products-mobile"
    class="lg:hidden bg-gradient-to-br from-maklos-50/50 via-maklos-50/30 to-eucalyptus-50/40 text-charcoal relative overflow-hidden py-12">
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
                    $imageUrl = $product['image'] ?? asset('storage/assets/IMG_6745.JPG');
                @endphp
                <a href="{{ route('products.show', $product['slug']) }}"
                    class="js-product-mobile-item block space-y-4 group" data-animate="fade-up"
                    data-delay="{{ $index * 0.1 }}">
                    <div
                        class="relative w-full aspect-[16/9] rounded-2xl overflow-hidden bg-gradient-to-br from-maklos-50 to-maklos-100 transition-transform duration-200 active:scale-[0.98]">
                        <img src="{{ $imageUrl }}" alt="{{ $product['title'] }}"
                            class="absolute inset-0 w-full h-full object-cover" loading="lazy" decoding="async" />
                    </div>
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-wider text-maklos-500 mb-2"
                            data-animate="fade-in" data-delay="{{ $index * 0.1 + 0.1 }}">
                            {{ $product['label'] }}
                        </p>
                        <h2 class="font-display text-2xl font-bold text-charcoal mb-3 transition-colors active:text-maklos-600"
                            data-animate="split-text" data-delay="{{ $index * 0.1 + 0.15 }}">
                            {{ $product['title'] }}
                        </h2>
                        <p class="text-sm text-charcoal/70 leading-relaxed mb-3" data-animate="fade-in"
                            data-delay="{{ $index * 0.1 + 0.2 }}">
                            {{ $product['description'] }}
                        </p>
                        <div class="inline-flex items-center gap-2 text-sm font-semibold text-maklos-600"
                            data-animate="fade-in" data-delay="{{ $index * 0.1 + 0.25 }}">
                            View details
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        {{-- Explore More Button --}}
        <div class="flex justify-center py-8 mt-8">
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-3 px-8 py-4 bg-maklos-600 text-white font-semibold rounded-full 
                      active:bg-maklos-700 transform transition-all duration-300 active:scale-95 shadow-lg
                      border-2 border-maklos-600">
                <span>Explore All Products</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                </svg>
            </a>
        </div>
    </div>
</section>