@props([
    'imageUrl' => asset('storage/assets/products/allproducts.jpeg'),
    'heading' => 'Crafted to Captivate. Engineered to Perform.',
])

<section id="manufacturing-image-promo" class="relative bg-white overflow-hidden py-12 md:py-16">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="js-mip-header mb-16 flex items-center justify-center min-h-[4rem]">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-center">
                @php
                    $parts = explode('—', $heading, 2);
                    $part1 = $parts[0] ?? $heading;
                    $part2 = isset($parts[1]) ? '—' . $parts[1] : '';
                @endphp
                <span class="text-black">{{ $part1 }}</span>
                @if($part2)
                    <span class="lg:ml-3 block lg:inline" style="color: #0d9488;">{{ $part2 }}</span>
                @endif
            </h2>
        </div>

        <div class="relative w-full max-w-[95%] mx-auto">
            <!-- Soft glow background (subtle for white) -->
            <div class="pointer-events-none absolute -inset-6 md:-inset-10 bg-gradient-to-r from-cyan-500/10 via-blue-500/10 to-indigo-500/10 blur-2xl rounded-[2rem]"></div>

            <div class="js-mip-image-wrapper relative rounded-3xl overflow-hidden shadow-2xl ring-1 ring-black/10 bg-white w-full">
                <img
                    src="{{ $imageUrl }}"
                    alt="All Products"
                    class="js-mip-image block w-full h-auto object-contain select-none"
                    loading="lazy"
                    onerror="this.style.display='none'; this.closest('.js-mip-image-wrapper').classList.add('bg-gradient-to-br','from-gray-100','to-gray-200');"
                />

                <!-- Glooming Animation (Pulsing White Vignette) -->
                <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle,transparent_60%,white_100%)] animate-pulse opacity-80"></div>
                
                <!-- subtle overlay for shine -->
                <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-black/5 via-transparent to-transparent"></div>
                <div class="pointer-events-none absolute inset-0 rounded-3xl ring-1 ring-black/5"></div>
            </div>
        </div>
    </div>
</section>
