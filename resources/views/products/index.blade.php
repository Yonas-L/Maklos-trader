<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Products - {{ config('app.name', 'Maklos Trader') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-white font-sans text-charcoal antialiased">
        @include('layouts.navigation')

        <main class="pt-24">
            <!-- Hero Section -->
            <section class="relative overflow-hidden bg-gradient-to-br from-maklos-50/70 via-white to-maklos-100/40">
                <div class="pointer-events-none absolute inset-0">
                    <div class="absolute left-[-10%] top-[-25%] h-[520px] w-[520px] animate-blob rounded-full bg-gradient-to-br from-eucalyptus/40 via-maklos-200/25 to-white/0 blur-[220px]"></div>
                    <div class="absolute right-[-15%] bottom-[-20%] h-[620px] w-[620px] animate-blob-slow rounded-full bg-gradient-to-tr from-maklos-200/35 via-eucalyptus/30 to-white/10 blur-[240px]" style="animation-delay:-6s"></div>
                </div>
                <div class="mx-auto max-w-7xl px-6 py-28 text-center">
                    <div class="space-y-8">
                        <div class="inline-flex items-center gap-3 rounded-full border border-maklos-200/60 bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-maklos-600">
                            Our Portfolio
                        </div>
                        <h1 class="font-display text-4xl font-semibold text-charcoal sm:text-5xl lg:text-6xl">
                            Premium Maklos Products
                        </h1>
                        <p class="max-w-2xl mx-auto text-lg text-charcoal/70 sm:text-xl">
                            Discover our complete collection of eucalyptus-powered products crafted with botanical science and sustainable practices.
                        </p>
                    </div>
                </div>
            </section>

            <!-- Categories Section -->
            @if($categories->isNotEmpty())
                <section class="bg-white py-24">
                    <div class="mx-auto max-w-7xl px-6">
                        <div class="mb-16 text-center">
                            <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500">Browse by Category</p>
                            <h2 class="mt-4 font-display text-3xl text-charcoal sm:text-4xl">Product Categories</h2>
                        </div>
                        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                            @foreach($categories as $category)
                                <div class="group cursor-pointer" data-category="{{ $category['slug'] }}">
                                    <div class="relative overflow-hidden rounded-3xl border border-maklos-100 bg-white shadow-sm transition-all duration-300 hover:-translate-y-2 hover:shadow-xl">
                                        <div class="aspect-[4/3] overflow-hidden bg-maklos-50">
                                            <img src="{{ $category['image'] }}" alt="{{ $category['name'] }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                                        </div>
                                        <div class="p-6">
                                            <h3 class="font-display text-2xl text-charcoal">{{ $category['name'] }}</h3>
                                            <p class="mt-2 text-sm text-charcoal/70">{{ $category['products']->count() }} products</p>
                                            <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-maklos-600">
                                                View products
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <!-- Products Grid Section -->
            <section class="bg-maklos-50 py-24">
                <div class="mx-auto max-w-7xl px-6">
                    <div class="mb-16 text-center">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500">All Products</p>
                        <h2 class="mt-4 font-display text-3xl text-charcoal sm:text-4xl">Complete Product Collection</h2>
                    </div>
                    
                    <!-- Category Filter -->
                    <div class="mb-12 flex flex-wrap justify-center gap-3" id="category-filters">
                        <button class="category-filter active rounded-full border border-maklos-200 bg-white px-4 py-2 text-sm font-semibold text-charcoal transition hover:bg-maklos-100" data-category="all">
                            All Products
                        </button>
                        @foreach($categories as $category)
                            <button class="category-filter rounded-full border border-maklos-200 bg-white px-4 py-2 text-sm font-semibold text-charcoal transition hover:bg-maklos-100" data-category="{{ $category['slug'] }}">
                                {{ $category['name'] }}
                            </button>
                        @endforeach
                    </div>

                    <!-- Products Grid -->
                    <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3" id="products-grid">
                        @foreach($products as $product)
                            <article class="product-card group" data-category="{{ Str::slug($product['category'] ?? '') }}">
                                <a href="{{ route('products.show', $product['slug']) }}" class="flex flex-col overflow-hidden rounded-3xl border border-maklos-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                                    <div class="aspect-[4/3] overflow-hidden bg-maklos-50">
                                        <img src="{{ $product['hero_image_url'] ?? asset('storage/assets/IMG_6745.JPG') }}" alt="{{ $product['name'] ?? 'Maklos Product' }}" class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                                    </div>
                                    <div class="flex flex-1 flex-col p-6">
                                        <span class="inline-flex rounded-full bg-maklos-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-maklos-600">{{ $product['category'] ?? 'Portfolio' }}</span>
                                        <h3 class="mt-4 font-display text-xl text-charcoal">{{ $product['name'] ?? 'Maklos Product' }}</h3>
                                        <p class="mt-3 flex-1 text-sm text-charcoal/70">{{ $product['excerpt'] ?? 'Discover more about this Maklos innovation.' }}</p>
                                        <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-maklos-600">
                                            View details
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Contact Section -->
            <section class="bg-maklos-900 py-24 text-white">
                <div class="mx-auto max-w-5xl space-y-8 px-6 text-center">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-white/70">Let's Connect</p>
                    <h2 class="font-display text-3xl sm:text-4xl">Ready to Partner with Maklos?</h2>
                    <p class="text-base text-white/75">
                        Our team supports retailers, distributors, and hospitality partners throughout Ethiopia and beyond. Share your requirements and we'll curate a product program aligned to your brand.
                    </p>
                    <div class="flex flex-wrap justify-center gap-4 text-sm font-semibold">
                        <a href="https://wa.me/{{ config('app.whatsapp_number', '251000000000') }}" class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-maklos-700 shadow-lg shadow-black/10 transition hover:-translate-y-0.5 hover:bg-maklos-100">
                            WhatsApp our team
                        </a>
                        <a href="mailto:{{ config('app.contact_email', 'info@maklostrader.com') }}" class="inline-flex items-center gap-2 rounded-full border border-white/60 px-6 py-3 text-white/90 transition hover:border-white hover:text-white">
                            Email Maklos
                        </a>
                    </div>
                </div>
            </section>
        </main>

        <footer class="bg-maklos-900 py-12 text-center text-sm text-white/70">
            © {{ now()->year }} Maklos Trader. All rights reserved.
        </footer>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Category filtering
                const categoryFilters = document.querySelectorAll('.category-filter');
                const productCards = document.querySelectorAll('.product-card');
                
                categoryFilters.forEach(filter => {
                    filter.addEventListener('click', function() {
                        const category = this.dataset.category;
                        
                        // Update active state
                        categoryFilters.forEach(f => f.classList.remove('active', 'bg-maklos-600', 'text-white'));
                        this.classList.add('active', 'bg-maklos-600', 'text-white');
                        
                        // Filter products
                        productCards.forEach(card => {
                            if (category === 'all' || card.dataset.category === category) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        });
                    });
                });
                
                // Set initial active state
                document.querySelector('.category-filter[data-category="all"]').classList.add('bg-maklos-600', 'text-white');
            });
        </script>
    </body>
</html>
