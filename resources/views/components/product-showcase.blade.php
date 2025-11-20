@props(['products' => [], 'productImages' => []])

<section id="products"
    class="js-products-section bg-gradient-to-br from-maklos-50/50 via-maklos-50/30 to-eucalyptus-50/40 text-charcoal relative overflow-hidden pb-0 flex items-center justify-center min-h-screen">
    {{-- Animated Soap Bubbles Background - Reduced and Blurred --}}
    <div class="js-products-bubbles absolute inset-0 z-0 pointer-events-none overflow-hidden"
        style="filter: blur(2px);">
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

    <div class="mx-auto max-w-7xl px-6 relative z-10 w-full">
        {{-- Section header: fades in on entrance, centered and styled to match shape divider color --}}
        <div class="js-products-header mb-8 lg:mb-10 flex items-center justify-center h-14 lg:h-16">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-center">
                <span class="text-black">Our</span>
                <span class="ml-3" style="color: #0d9488;">Products</span>
            </h2>
        </div>
        <div
            class="js-products-pin-wrapper grid lg:grid-cols-2 lg:gap-10 lg:items-center lg:justify-center py-2 lg:py-4">
            {{-- Left column: Text content that swaps on scroll --}}
            <div class="js-products-text-column relative lg:h-[400px] lg:flex lg:items-center lg:justify-center">
                <div class="js-products-text-container relative w-full h-full">
                    @foreach ($products as $index => $product)
                        @if($product['slug'])
                            <a href="{{ route('products.show', $product['slug']) }}"
                                class="js-product-text-panel js-product-text-panel-{{ $index }} absolute inset-0 flex items-center {{ $index === 0 ? '' : 'opacity-0 pointer-events-none' }} cursor-pointer group">
                        @else
                                <div
                                    class="js-product-text-panel js-product-text-panel-{{ $index }} absolute inset-0 flex items-center {{ $index === 0 ? '' : 'opacity-0 pointer-events-none' }}">
                            @endif
                                <div class="space-y-4 lg:space-y-6 w-full">
                                    <div>
                                        <p
                                            class="js-products-label text-xs font-semibold uppercase tracking-[0.3em] text-maklos-500 mb-3">
                                            {{ $product['label'] }}
                                        </p>
                                        <h2
                                            class="js-products-title font-display text-3xl font-bold text-charcoal sm:text-4xl lg:text-5xl leading-[1.1] lg:leading-[1.15] transition-colors {{ $product['slug'] ? 'group-hover:text-maklos-600' : '' }}">
                                            {{ $product['title'] }}
                                        </h2>
                                    </div>
                                    <p
                                        class="js-products-description text-base lg:text-lg text-charcoal/70 leading-relaxed">
                                        {{ $product['description'] }}
                                    </p>
                                    @if($index === 0)
                                        {{-- Removed Request full catalog button --}}
                                    @elseif($product['slug'])
                                        <div class="flex flex-wrap items-center gap-4 pt-4">
                                            <span
                                                class="js-products-link inline-flex items-center gap-2 text-base font-semibold text-maklos-600 group-hover:gap-4 transition-all duration-300">
                                                View product details
                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                    class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </span>
                                        </div>
                                    @endif
                                </div>
                                @if($product['slug'])
                                    </a>
                                @else
                            </div>
                        @endif
                    @endforeach
            </div>
        </div>

        {{-- Right column: Images that swap on scroll --}}
        <div class="js-products-image-column relative lg:h-[500px]">
            <div class="js-products-image-container relative w-full h-full">
                @foreach ($products as $index => $product)
                    @php
                        // Get image URL from product data
                        $imageUrl = $product['image'] ?? asset('storage/assets/IMG_6745.JPG');
                    @endphp
                    @if($product['slug'])
                        <a href="{{ route('products.show', $product['slug']) }}"
                            class="js-product-image-panel js-product-image-panel-{{ $index }} absolute inset-0 {{ $index === 0 ? '' : 'opacity-0 pointer-events-none' }} cursor-pointer group">
                    @else
                            <div
                                class="js-product-image-panel js-product-image-panel-{{ $index }} absolute inset-0 {{ $index === 0 ? '' : 'opacity-0 pointer-events-none' }}">
                        @endif
                            <div
                                class="relative w-full h-full rounded-3xl overflow-hidden bg-gradient-to-br from-maklos-50 to-maklos-100 transition-transform duration-500 {{ $product['slug'] ? 'group-hover:scale-[1.02]' : '' }}">
                                <img src="{{ $imageUrl }}" alt="{{ $product['title'] }}"
                                    class="js-product-image absolute inset-0 w-full h-full object-cover transition-transform duration-700 {{ $product['slug'] ? 'group-hover:scale-110' : '' }}"
                                    loading="{{ $index === 0 ? 'eager' : 'lazy' }}" decoding="async"
                                    style="display: block;" />
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-black/10 to-transparent {{ $product['slug'] ? 'group-hover:from-black/20' : '' }} transition-opacity duration-500">
                                </div>
                            </div>
                            @if($product['slug'])
                                </a>
                            @else
                        </div>
                    @endif
                @endforeach
        </div>
    </div>

    {{-- Mobile: Stacked layout --}}
    <div class="js-products-mobile lg:hidden col-span-2 space-y-12 mt-12">
        @foreach ($products as $index => $product)
            @if($index > 0)
                @php
                    // Get image URL from product data
                    $imageUrl = $product['image'] ?? asset('storage/assets/IMG_6745.JPG');
                @endphp
                <a href="{{ route('products.show', $product['slug']) }}" class="js-product-mobile-item block space-y-6 group">
                    <div
                        class="relative w-full aspect-[4/3] rounded-3xl overflow-hidden bg-gradient-to-br from-maklos-50 to-maklos-100 transition-transform duration-500 group-hover:scale-[1.02]">
                        <img src="{{ $imageUrl }}" alt="{{ $product['title'] }}"
                            class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            loading="lazy" decoding="async" />
                    </div>
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500 mb-4">{{ $product['label'] }}
                        </p>
                        <h2
                            class="font-display text-3xl font-bold text-charcoal sm:text-4xl mb-4 transition-colors group-hover:text-maklos-600">
                            {{ $product['title'] }}
                        </h2>
                        <p class="text-base text-charcoal/70 leading-relaxed">
                            {{ $product['description'] }}
                        </p>
                        <div
                            class="mt-4 inline-flex items-center gap-2 text-base font-semibold text-maklos-600 group-hover:gap-4 transition-all duration-300">
                            View product details
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                            </svg>
                        </div>
                    </div>
                </a>
            @endif
        @endforeach
    </div>
    </div>

    {{-- Explore More Button - appears after 3rd scroll --}}
    <div class="js-explore-more-container flex justify-center py-8 opacity-0">
        <a href="{{ route('products.index') }}" class="js-explore-more-btn inline-flex items-center gap-3 px-8 py-4 bg-maklos-600 text-white font-semibold rounded-full 
                      hover:bg-maklos-700 transform transition-all duration-300 hover:scale-105 hover:shadow-xl
                      border-2 border-maklos-600 hover:border-maklos-700">
            <span>Explore All Products</span>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
            </svg>
        </a>
    </div>
    </div>
</section>