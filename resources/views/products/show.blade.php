<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $product['name'] ?? config('app.name', 'Maklos Trader') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white font-sans text-charcoal antialiased">
    @include('layouts.navigation')

    @php
        $gallery = collect($product->gallery ?? [])->map(function ($path) {
            return Str::startsWith($path, 'storage/') ? asset($path) : asset('storage/' . $path);
        });

        $heroImage = $product->hero_image
            ? (Str::startsWith($product->hero_image, 'storage/') ? asset($product->hero_image) : asset('storage/' . $product->hero_image))
            : asset('storage/assets/IMG_6745.JPG');

        $secondaryImage = $product->secondary_image
            ? (Str::startsWith($product->secondary_image, 'storage/') ? asset($product->secondary_image) : asset('storage/' . $product->secondary_image))
            : null;
    @endphp

    <main class="pt-24">
        <section class="relative overflow-hidden bg-gradient-to-br from-maklos-50/70 via-white to-maklos-100/40">
            <div class="pointer-events-none absolute inset-0">
                <div
                    class="absolute left-[-10%] top-[-25%] h-[520px] w-[520px] animate-blob rounded-full bg-gradient-to-br from-eucalyptus/40 via-maklos-200/25 to-white/0 blur-[220px]">
                </div>
                <div class="absolute right-[-15%] bottom-[-20%] h-[620px] w-[620px] animate-blob-slow rounded-full bg-gradient-to-tr from-maklos-200/35 via-eucalyptus/30 to-white/10 blur-[240px]"
                    style="animation-delay:-6s"></div>
            </div>
            <div class="mx-auto grid max-w-7xl gap-16 px-6 py-28 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,1fr)] lg:items-center js-product-hero"
                data-animate="hero">
                <div class="space-y-8">
                    <div
                        class="inline-flex items-center gap-3 rounded-full border border-maklos-200/60 bg-white/70 px-4 py-2 text-xs font-semibold uppercase tracking-[0.3em] text-maklos-600">
                        {{ $product->category }}
                    </div>
                    <h1 class="font-display text-4xl font-semibold text-charcoal sm:text-5xl lg:text-6xl">
                        {{ $product->name }}
                    </h1>
                    <p class="max-w-2xl text-lg text-charcoal/70 sm:text-xl">
                        {{ $product->description ?? $product->excerpt }}
                    </p>
                    <div class="flex flex-wrap items-center gap-4 text-sm font-semibold">
                        <a href="mailto:{{ config('app.contact_email', 'info@maklostrader.com') }}"
                            class="inline-flex items-center gap-2 rounded-full bg-maklos-500 px-6 py-3 text-white shadow-lg shadow-maklos-500/30 transition hover:-translate-y-0.5 hover:bg-maklos-400">
                            Request wholesale
                        </a>
                        <a href="https://wa.me/{{ config('app.whatsapp_number', '251000000000') }}"
                            class="inline-flex items-center gap-2 rounded-full border border-maklos-200 px-6 py-3 text-maklos-700/90 transition hover:border-maklos-400 hover:text-maklos-500">
                            Chat on WhatsApp
                        </a>
                    </div>
                </div>

                <div class="relative flex justify-center lg:justify-end">
                    <div
                        class="relative h-[480px] w-[360px] overflow-hidden rounded-[3rem] border border-white/60 bg-white shadow-2xl shadow-maklos-200/40 js-product-hero-image">
                        <img src="{{ $heroImage }}" alt="{{ $product->name }}" class="h-full w-full object-cover" />
                    </div>
                    @if($secondaryImage)
                        <div
                            class="absolute -bottom-10 -left-10 hidden h-40 w-40 overflow-hidden rounded-3xl border border-white/60 bg-white shadow-lg shadow-maklos-100/60 sm:block">
                            <img src="{{ $secondaryImage }}" alt="{{ $product->name }} detail"
                                class="h-full w-full object-cover" />
                        </div>
                    @endif
                </div>
            </div>
        </section>

        @if($gallery->isNotEmpty())
            <section class="bg-white py-16">
                <div class="mx-auto grid max-w-6xl gap-6 px-6 sm:grid-cols-2 lg:grid-cols-4 js-product-gallery">
                    @foreach ($gallery as $image)
                        <div
                            class="overflow-hidden rounded-3xl border border-maklos-100 bg-white shadow-sm shadow-maklos-100/40">
                            <img src="{{ $image }}" alt="{{ $product->name }} gallery" class="h-52 w-full object-cover"
                                loading="lazy" />
                        </div>
                    @endforeach
                </div>
            </section>
        @endif

        <section class="bg-maklos-50 py-24 js-product-section">
            <div class="mx-auto grid max-w-6xl gap-12 px-6 lg:grid-cols-[1.2fr_1fr] lg:items-center">
                <div class="space-y-6">
                    <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500">Why it matters</p>
                    <h2 class="font-display text-3xl text-charcoal sm:text-4xl">What makes {{ $product->name }} special
                    </h2>
                    <p class="text-base text-charcoal/70">
                        {{ $product->description }}
                    </p>
                    <ul class="space-y-4">
                        @foreach(($product->key_points ?? []) as $point)
                            <li
                                class="flex items-start gap-3 rounded-2xl border border-white/60 bg-white/80 p-4 text-charcoal/80 shadow-sm js-product-point">
                                <span
                                    class="mt-1 inline-flex h-8 w-8 flex-none items-center justify-center rounded-full bg-maklos-500/15 text-maklos-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                    </svg>
                                </span>
                                <span>{{ $point }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

                @if(isset($product->sourcing))
                    <div class="rounded-[2.5rem] border border-white bg-white/80 p-8 shadow-xl shadow-maklos-100/60">
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500">Sourcing</p>
                        <h3 class="mt-4 font-display text-2xl text-charcoal">
                            {{ $product->sourcing['title'] ?? 'Crafted with care' }}</h3>
                        <p class="mt-4 text-sm text-charcoal/70">
                            {{ $product->sourcing['body'] ?? 'Maklos partners with trusted growers and suppliers to ensure every ingredient meets our sustainability commitments.' }}
                        </p>
                    </div>
                @endif
            </div>
        </section>

        <section class="bg-white py-24 js-product-section">
            <div class="mx-auto max-w-6xl px-6">
                <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500">Formats</p>
                        <h2 class="font-display text-3xl text-charcoal sm:text-4xl">How we provide this product</h2>
                    </div>
                    <a href="mailto:{{ config('app.contact_email', 'info@maklostrader.com') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-maklos-200 px-6 py-3 text-sm font-semibold text-maklos-700 transition hover:border-maklos-400 hover:text-maklos-500">
                        Request pricing deck
                    </a>
                </div>
                <div class="grid gap-6 md:grid-cols-3 js-product-availability">
                    @foreach(($product->availability ?? []) as $availability)
                        <article
                            class="rounded-3xl border border-maklos-100 bg-maklos-50/40 p-6 shadow-sm shadow-maklos-100/50">
                            <h3 class="font-display text-xl text-charcoal">{{ $availability['label'] ?? 'Offering' }}</h3>
                            <p class="mt-2 text-sm text-charcoal/70">
                                {{ $availability['description'] ?? 'Tailored solutions available upon request.' }}</p>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="bg-maklos-900 py-24 text-white js-product-section">
            <div class="mx-auto max-w-5xl space-y-8 px-6 text-center">
                <p class="text-sm font-semibold uppercase tracking-[0.3em] text-white/70">Let’s get in touch</p>
                <h2 class="font-display text-3xl sm:text-4xl">Partner with Maklos to grow your portfolio</h2>
                <p class="text-base text-white/75">
                    Our team supports retailers, distributors, and hospitality partners throughout Ethiopia and beyond.
                    Share your requirements and we’ll curate a product program aligned to your brand.
                </p>
                <div class="flex flex-wrap justify-center gap-4 text-sm font-semibold">
                    <a href="https://wa.me/{{ config('app.whatsapp_number', '251000000000') }}"
                        class="inline-flex items-center gap-2 rounded-full bg-white px-6 py-3 text-maklos-700 shadow-lg shadow-black/10 transition hover:-translate-y-0.5 hover:bg-maklos-100">
                        WhatsApp our team
                    </a>
                    <a href="mailto:{{ config('app.contact_email', 'info@maklostrader.com') }}"
                        class="inline-flex items-center gap-2 rounded-full border border-white/60 px-6 py-3 text-white/90 transition hover:border-white hover:text-white">
                        Email Maklos
                    </a>
                </div>
            </div>
        </section>

        @if(($relatedProducts ?? collect())->isNotEmpty())
            <section class="bg-white py-16">
                <div class="mx-auto max-w-6xl px-6">
                    <div class="mb-10 flex items-center justify-between">
                        <h2 class="font-display text-2xl text-charcoal">Explore other products</h2>
                        <a href="{{ route('welcome') }}#products"
                            class="text-sm font-semibold text-maklos-600 transition hover:text-maklos-500">Back to all
                            products</a>
                    </div>
                    <div class="grid gap-6 md:grid-cols-3">
                        @foreach($relatedProducts as $related)
                            <a href="{{ route('products.show', $related->slug) }}"
                                class="group flex flex-col overflow-hidden rounded-3xl border border-maklos-100 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                                <div class="aspect-[4/3] overflow-hidden bg-maklos-50">
                                    <img src="{{ $related->hero_image ? (Str::startsWith($related->hero_image, 'storage/') ? asset($related->hero_image) : asset('storage/' . $related->hero_image)) : asset('storage/assets/IMG_6745.JPG') }}"
                                        alt="{{ $related->name }}"
                                        class="h-full w-full object-cover transition duration-500 group-hover:scale-105" />
                                </div>
                                <div class="flex flex-1 flex-col p-6">
                                    <span
                                        class="inline-flex rounded-full bg-maklos-50 px-3 py-1 text-xs font-semibold uppercase tracking-[0.3em] text-maklos-600">{{ $related->category }}</span>
                                    <h3 class="mt-4 font-display text-xl text-charcoal">{{ $related->name }}</h3>
                                    <p class="mt-3 flex-1 text-sm text-charcoal/70">{{ $related->excerpt }}</p>
                                    <div class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-maklos-600">
                                        View details
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 transition group-hover:translate-x-1" fill="none" viewBox="0 0 24 24"
                                            stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
    </main>

    <footer class="bg-maklos-900 py-12 text-center text-sm text-white/70">
        © {{ now()->year }} Maklos Trader. All rights reserved.
    </footer>
</body>

</html>