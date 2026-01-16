@props(['products' => [], 'productImages' => []])

@php
    $productsArray = $products instanceof \Illuminate\Support\Collection ? $products->toArray() : $products;
    // Duplicate array 3 times for seamless infinite scroll
    $allProducts = array_merge($productsArray, $productsArray, $productsArray); 
@endphp

<section id="js-product-showcase"
    class="relative py-24 bg-[#f8fafc] overflow-hidden select-none opacity-0 translate-y-12 transition-all duration-700 ease-out">

    {{-- 1. Static Background (GPU Friendly) --}}
    <div class="absolute inset-0 pointer-events-none z-0">
        <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-[#1f58be]/5 rounded-full blur-[80px]"></div>
        <div class="absolute bottom-0 right-1/4 w-[600px] h-[600px] bg-[#0d9488]/5 rounded-full blur-[80px]"></div>
        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-15 mix-blend-soft-light">
        </div>
    </div>

    {{-- 2. Header --}}
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 mb-16">
        <div class="flex items-center justify-center h-12 lg:h-24">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-center">
                <span class="text-black">Our</span>
                <span class="ml-3" style="color: #0d9488;">Products</span>
            </h2>
        </div>
    </div>

    {{-- 3. High Performance Track --}}
    <div class="track-container relative w-full z-20 overflow-x-auto scrollbar-hide cursor-grab active:cursor-grabbing"
        x-data="{ 
            isDown: false, 
            startX: 0, 
            scrollLeft: 0,
            isDragging: false
         }"
        @mousedown="isDown = true; startX = $event.pageX - $el.offsetLeft; scrollLeft = $el.scrollLeft; isDragging = false"
        @mouseleave="isDown = false" @mouseup="isDown = false"
        @mousemove="if(isDown) { $event.preventDefault(); isDragging = true; const x = $event.pageX - $el.offsetLeft; const walk = (x - startX) * 2; $el.scrollLeft = scrollLeft - walk; }"
        @touchstart="startX = $event.touches[0].pageX - $el.offsetLeft; scrollLeft = $el.scrollLeft"
        @touchmove="const x = $event.touches[0].pageX - $el.offsetLeft; const walk = (x - startX) * 2; $el.scrollLeft = scrollLeft - walk;">

        <div class="track flex items-center w-max px-8 group">

            @foreach ($allProducts as $index => $product)
                @php
                    $p = (array) $product;
                    // Map database fields (from ProductHighlight model) to card variables
                    $imageUrl = isset($p['image_path']) && $p['image_path']
                        ? asset('storage/' . $p['image_path'])
                        : ($p['image'] ?? asset('storage/assets/IMG_6745.JPG'));
                    $title = $p['title'] ?? 'Product Title';
                    $price = $p['price'] ?? '450 ETB';
                    $weight = $p['weight'] ?? '150g';
                    $stock = $p['in_stock'] ?? ($p['stock'] ?? true);
                    $source = $p['source'] ?? 'Organic Extract';
                    // Benefits is now an array
                    $benefits = $p['benefits'] ?? ['Deep Cleansing'];
                    if (!is_array($benefits)) {
                        $benefits = [$benefits];
                    }
                    $desc = $p['description'] ?? 'Crafted with premium ingredients to ensure a refreshing experience.';
                @endphp

                {{-- CARD --}}
                <div class="product-card relative h-[600px] bg-white rounded-[2rem] shadow-xl overflow-hidden mx-3">

                    {{-- LAYER A: Image Background --}}
                    <div class="image-layer absolute inset-0 z-0">
                        <img src="{{ $imageUrl }}" alt="{{ $title }}" class="w-full h-full object-cover" />
                        {{-- Gradient for default readability --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>

                        {{-- Collapsed State Info (Visible Default) --}}
                        <div class="collapsed-info absolute bottom-8 left-8 transition-opacity duration-200">
                            <h3 class="text-3xl font-bold text-white font-display">{{ $title }}</h3>
                            <p class="text-white/80 text-sm mt-1 uppercase tracking-widest font-bold">{{ $price }}</p>
                        </div>
                    </div>

                    {{-- LAYER B: Dashboard (Visible Hover) --}}
                    <div class="content-layer absolute inset-0 z-20 p-10 opacity-0 pointer-events-none">

                        {{-- Glass Backdrop --}}
                        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-md z-[-1]"></div>

                        <div class="h-full flex flex-col justify-between text-white relative z-10">

                            {{-- Top Row: Status & Price --}}
                            <div
                                class="flex justify-between items-start translate-y-[-10px] opacity-0 transition-all duration-300 delay-100 content-anim">
                                <span
                                    class="px-3 py-1 rounded-full text-[11px] font-bold uppercase tracking-wider bg-white/20 border border-white/20 backdrop-blur-sm">
                                    {{ $stock ? 'In Stock' : 'Sold Out' }}
                                </span>
                                <span class="font-mono text-2xl text-[#4ade80] font-bold">{{ $price }}</span>
                            </div>

                            {{-- Middle: Title & Desc --}}
                            <div
                                class="mt-4 translate-y-[10px] opacity-0 transition-all duration-300 delay-150 content-anim">
                                <h3 class="text-5xl font-bold mb-4 leading-none">{{ $title }}</h3>
                                <p
                                    class="text-base text-white/90 leading-relaxed border-l-4 border-[#0d9488] pl-4 max-w-lg">
                                    {{ $desc }}
                                </p>
                            </div>

                            {{-- Bottom: Specs Grid --}}
                            <div
                                class="grid grid-cols-2 gap-4 mt-auto translate-y-[20px] opacity-0 transition-all duration-300 delay-200 content-anim">
                                <div class="spec-box">
                                    <span class="spec-label">Weight</span>
                                    <span class="spec-value">{{ $weight }}</span>
                                </div>
                                <div class="spec-box">
                                    <span class="spec-label">Source</span>
                                    <span class="spec-value truncate">{{ $source }}</span>
                                </div>
                                <div class="spec-box col-span-2">
                                    <span class="spec-label mb-2">Benefits</span>
                                    <ul class="space-y-1">
                                        @foreach ($benefits as $benefitItem)
                                            <li class="flex items-center gap-2 text-sm text-white/90">
                                                <svg class="w-4 h-4 text-yellow-400 flex-shrink-0" fill="none"
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
    </div>

    <style>
        /* --- SECTION ENTRANCE ANIMATION --- */
        #js-product-showcase.is-visible {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }

        /* --- UTILS --- */
        .spec-box {
            @apply p-4 rounded-xl bg-white/10 border border-white/10 backdrop-blur-sm flex flex-col justify-center transition-colors duration-300 hover:bg-white/20;
        }

        .spec-label {
            @apply text-[10px] text-white/60 uppercase tracking-widest mb-1 font-bold;
        }

        .spec-value {
            @apply text-xl font-bold tracking-tight;
        }

        /* --- ANIMATIONS --- */
        @keyframes scroll {
            0% {
                transform: translate3d(0, 0, 0);
            }

            100% {
                transform: translate3d(-33.33%, 0, 0);
            }
        }

        /* --- TRACK ANIMATION --- */
        .track {
            animation: scroll 60s linear infinite;
        }

        /* --- SCROLLBAR HIDE --- */
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        /* --- TRACK CONTAINER HOVER PAUSE --- */
        .track-container:hover .track {
            animation-play-state: paused;
        }

        /* --- CARD MECHANICS --- */
        .product-card {
            /* 
               DEFAULT STATE 
               Width: 28vw (approx 3 cards visible)
            */
            width: 28vw;
            min-width: 400px;

            /* Hardware Acceleration Hints */
            will-change: width, transform, filter;
            transform: translate3d(0, 0, 0);
            /* Force GPU */

            /* 
               FAST SPRING TRANSITION 
               0.4s duration + Fast Out, Slow In curve
            */
            transition: all 0.4s cubic-bezier(0.2, 0, 0, 1);

            /* No filters by default */
            filter: brightness(1);
        }

        /* --- HOVERING THE TRACK (SIBLING EFFECT) --- */
        /* When mouse enters the track, pause animation and dim/blur everyone */
        .track:hover {
            animation-play-state: paused;
        }

        .track:hover .product-card {
            filter: brightness(0.6) blur(3px);
            /* 3px is cheaper than 10px */
            opacity: 0.9;
        }

        /* --- HOVERING THE CARD (ACTIVE EFFECT) --- */
        /* Specific card overrides the track hover */
        .product-card:hover {
            /* Expand width */
            width: 50vw !important;
            min-width: 750px !important;

            /* Clear filters */
            filter: brightness(1) blur(0) !important;
            opacity: 1 !important;

            /* Slight Pop (2D only, no rotateY) */
            transform: scale(1.02);
            z-index: 50;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        /* --- INTERNAL ELEMENT LOGIC --- */

        /* 1. Collapse Info: Fade out instantly on hover */
        .product-card:hover .collapsed-info {
            opacity: 0;
            transition-duration: 0.1s;
        }

        /* 2. Content Layer: Fade in */
        .product-card:hover .content-layer {
            opacity: 1;
            pointer-events: auto;
        }

        /* 3. Staggered Text Entrance (The .content-anim classes) */
        .product-card:hover .content-anim {
            opacity: 1;
            transform: translateY(0);
        }

        /* 4. Background Image Adjustment */
        /* Slight zoom to create depth without 3D rotation */
        .product-card:hover .image-layer img {
            transform: scale(1.05);
            transition: transform 0.4s ease-out;
        }

        /* --- MOBILE --- */
        @media (max-width: 1023px) {
            .track {
                animation: none;
                flex-direction: column;
                width: 100%;
                gap: 1.5rem;
            }

            .product-card {
                width: 90% !important;
                min-width: 0 !important;
                height: 550px;
                margin: 0 auto;
                transform: none !important;
            }

            .content-layer {
                opacity: 1 !important;
                pointer-events: auto;
            }

            .content-anim {
                opacity: 1 !important;
                transform: none !important;
            }

            .collapsed-info {
                display: none;
            }

            .image-layer img {
                filter: brightness(0.5);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const productSection = document.getElementById('js-product-showcase');
            if (!productSection) return;

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        productSection.classList.add('is-visible');
                    } else {
                        productSection.classList.remove('is-visible');
                    }
                });
            }, {
                threshold: 0.1,
                rootMargin: '0px 0px -100px 0px'
            });

            observer.observe(productSection);
        });
    </script>
</section>