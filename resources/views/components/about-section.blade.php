@props(['aboutContent' => null, 'aboutValues' => []])

<section id="about"
    class="js-about-section relative bg-gradient-to-br from-slate-50 via-white to-teal-50 overflow-hidden py-16 lg:py-24">

    {{-- 1. ORIGINAL ATMOSPHERE (Aurora Background) --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 -left-20 w-96 h-96 bg-[#1f58be]/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 -right-20 w-96 h-96 bg-[#0d9488]/10 rounded-full blur-3xl animate-pulse"
            style="animation-delay: 2s;"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6">

        {{-- 2. HEADER SECTION --}}
        <div class="text-center mb-16">
            <h2 class="text-4xl lg:text-5xl font-bold mb-6">
                <span class="text-slate-900">About</span>
                <span class="text-[#0d9488]">Us</span>
            </h2>

            <div class="flex flex-col items-center justify-center">
                <h2
                    class="font-display text-2xl lg:text-3xl font-bold tracking-tight mb-4 flex items-center justify-center gap-2">
                    <span
                        class="bg-gradient-to-r from-[#1f58be] via-[#0d9488] to-[#1f58be] bg-clip-text text-transparent font-extrabold">
                        {{ $aboutContent->experience_years ?? 10 }}
                    </span>
                    <span class="text-slate-400 font-light">Plus Years of Experience in the Market</span>
                </h2>
                <p class="text-slate-600 text-sm lg:text-lg max-w-3xl mx-auto leading-relaxed">
                    {{ $aboutContent->description ?? 'Maklos Trading designs, manufactures, and supplies premium bathing soaps with a focus on natural freshness and export-ready quality.' }}
                </p>
            </div>
        </div>

        {{-- 3. INTERCONNECTED CARDS SECTION --}}
        <div class="relative">

            {{-- Connecting Lines (Visual only) --}}
            <svg class="absolute top-1/2 left-0 w-full h-20 -translate-y-1/2 hidden lg:block pointer-events-none z-0"
                style="overflow: visible;">
                <defs>
                    <linearGradient id="lineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#1f58be;stop-opacity:0" />
                        <stop offset="50%" style="stop-color:#0d9488;stop-opacity:0.4" />
                        <stop offset="100%" style="stop-color:#1f58be;stop-opacity:0" />
                    </linearGradient>
                </defs>
                <line x1="10%" y1="50%" x2="90%" y2="50%" stroke="url(#lineGradient)" stroke-width="1"
                    stroke-dasharray="6 6" />
            </svg>

            {{-- THE CARDS GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 relative z-10">

                {{-- CARD 1: MISSION --}}
                <div class="group relative perspective-1000 h-[340px]">
                    <div
                        class="relative w-full h-full preserve-3d transition-transform duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:rotate-y-180">

                        {{-- FRONT --}}
                        <div
                            class="absolute inset-0 backface-hidden rounded-2xl border-2 border-[#0d9488]/20 bg-white shadow-xl shadow-[#0d9488]/5 flex flex-col items-center justify-center p-6 text-center">
                            {{-- Inner "Border Perfect" Frame --}}
                            <div
                                class="absolute inset-3 border border-dashed border-[#0d9488]/20 rounded-xl pointer-events-none">
                            </div>

                            <div
                                class="w-14 h-14 rounded-full bg-[#0d9488]/10 flex items-center justify-center mb-4 text-[#0d9488]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800 mb-3">
                                {{ $aboutContent->mission_title ?? 'Our Mission' }}
                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed px-4 line-clamp-3">
                                {{ $aboutContent->mission_description ?? 'To be Africa\'s trusted source of high-quality, affordable, and safe bathing soaps.' }}
                            </p>
                            <span
                                class="absolute bottom-6 text-[10px] font-bold text-[#0d9488] uppercase tracking-widest opacity-60 group-hover:opacity-100 transition-opacity">Hover
                                to View</span>
                        </div>

                        {{-- BACK --}}
                        <div
                            class="absolute inset-0 backface-hidden rotate-y-180 rounded-2xl border-2 border-[#0d9488] bg-[#f0fdfa] flex flex-col justify-center p-6 shadow-2xl overflow-hidden">
                            <h3
                                class="text-lg font-bold text-[#0d9488] mb-4 text-center border-b border-[#0d9488]/20 pb-2">
                                Mission Highlights</h3>
                            <div class="space-y-3">
                                @php
                                    $missionPoints = $aboutContent && $aboutContent->mission_highlights
                                        ? json_decode($aboutContent->mission_highlights, true)
                                        : [['label' => 'Quality', 'copy' => 'Tested for purity & safety.'], ['label' => 'Affordability', 'copy' => 'Accessible premium care.']];
                                @endphp
                                @foreach($missionPoints as $item)
                                    <div
                                        class="flex items-start gap-3 bg-white/60 p-2.5 rounded-lg border border-[#0d9488]/20">
                                        <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#0d9488] flex-shrink-0"></div>
                                        <div>
                                            <span
                                                class="block text-[11px] font-bold text-[#0d9488] uppercase">{{ $item['label'] }}</span>
                                            <span class="text-xs text-slate-600 leading-tight">{{ $item['copy'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 2: VISION --}}
                <div class="group relative perspective-1000 h-[340px]">
                    <div
                        class="relative w-full h-full preserve-3d transition-transform duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:rotate-y-180">

                        {{-- FRONT --}}
                        <div
                            class="absolute inset-0 backface-hidden rounded-2xl border-2 border-[#1f58be]/20 bg-white shadow-xl shadow-[#1f58be]/5 flex flex-col items-center justify-center p-6 text-center">
                            <div
                                class="absolute inset-3 border border-dashed border-[#1f58be]/20 rounded-xl pointer-events-none">
                            </div>

                            <div
                                class="w-14 h-14 rounded-full bg-[#1f58be]/10 flex items-center justify-center mb-4 text-[#1f58be]">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800 mb-3">
                                {{ $aboutContent->vision_title ?? 'Our Vision' }}
                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed px-4 line-clamp-3">
                                {{ $aboutContent->vision_description ?? 'To lead the region\'s soap industry through sustainable innovation.' }}
                            </p>
                            <span
                                class="absolute bottom-6 text-[10px] font-bold text-[#1f58be] uppercase tracking-widest opacity-60 group-hover:opacity-100 transition-opacity">Hover
                                to View</span>
                        </div>

                        {{-- BACK --}}
                        <div
                            class="absolute inset-0 backface-hidden rotate-y-180 rounded-2xl border-2 border-[#1f58be] bg-[#eff6ff] flex flex-col justify-center p-6 shadow-2xl overflow-hidden">
                            <h3
                                class="text-lg font-bold text-[#1f58be] mb-4 text-center border-b border-[#1f58be]/20 pb-2">
                                Future Goals</h3>
                            <div class="space-y-3">
                                @php
                                    $visionPoints = $aboutContent && $aboutContent->vision_highlights
                                        ? json_decode($aboutContent->vision_highlights, true)
                                        : [['title' => 'Innovation', 'detail' => 'Greener production systems.'], ['title' => 'Growth', 'detail' => 'Pan-African distribution.']];
                                @endphp
                                @foreach($visionPoints as $item)
                                    <div
                                        class="flex items-start gap-3 bg-white/60 p-2.5 rounded-lg border border-[#1f58be]/20">
                                        <div class="mt-1 w-1.5 h-1.5 rounded-full bg-[#1f58be] flex-shrink-0"></div>
                                        <div>
                                            <span
                                                class="block text-[11px] font-bold text-[#1f58be] uppercase">{{ $item['title'] }}</span>
                                            <span class="text-xs text-slate-600 leading-tight">{{ $item['detail'] }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- CARD 3: VALUES --}}
                <div class="group relative perspective-1000 h-[340px]">
                    <div
                        class="relative w-full h-full preserve-3d transition-transform duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] group-hover:rotate-y-180">

                        {{-- FRONT --}}
                        <div
                            class="absolute inset-0 backface-hidden rounded-2xl border-2 border-slate-200 bg-white shadow-xl shadow-slate-200/50 flex flex-col items-center justify-center p-6 text-center">
                            <div
                                class="absolute inset-3 border border-dashed border-slate-200 rounded-xl pointer-events-none">
                            </div>

                            <div
                                class="w-14 h-14 rounded-full bg-slate-100 flex items-center justify-center mb-4 text-slate-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-800 mb-3">
                                {{ $aboutContent->values_title ?? 'Our Values' }}
                            </h3>
                            <p class="text-slate-500 text-sm leading-relaxed px-4 line-clamp-3">
                                {{ $aboutContent->values_description ?? 'Pillars guiding every partnership—from R&D to on-time fulfilment.' }}
                            </p>
                            <span
                                class="absolute bottom-6 text-[10px] font-bold text-slate-400 uppercase tracking-widest opacity-60 group-hover:opacity-100 transition-opacity">Hover
                                to View</span>
                        </div>

                        {{-- BACK --}}
                        <div
                            class="absolute inset-0 backface-hidden rotate-y-180 rounded-2xl border-2 border-slate-400 bg-slate-50 flex flex-col justify-center p-6 shadow-2xl overflow-hidden">
                            <h3
                                class="text-lg font-bold text-slate-700 mb-4 text-center border-b border-slate-200 pb-2">
                                Core Principles</h3>
                            <div class="space-y-3">
                                @php
                                    $vals = $aboutValues ?? [];
                                    $defaults = [
                                        (object) ['title' => 'Integrity', 'summary' => 'Transparent Ops'],
                                        (object) ['title' => 'Quality', 'summary' => 'Consistent output']
                                    ];
                                    $displayValues = count($vals) > 0 ? $vals : $defaults;
                                @endphp
                                @foreach($displayValues as $val)
                                    @if($loop->index < 2) {{-- Limit to 2 items to ensure fit in reduced height --}}
                                        <div class="flex items-start gap-3 bg-white p-2.5 rounded-lg border border-slate-200">
                                            <div class="mt-1 w-1.5 h-1.5 rounded-full bg-slate-600 flex-shrink-0"></div>
                                            <div>
                                                <span
                                                    class="block text-[11px] font-bold text-slate-700 uppercase">{{ $val->title }}</span>
                                                <span class="text-xs text-slate-500 leading-tight">{{ $val->summary }}</span>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- REQUIRED CSS FOR 3D FLIP --}}
    <style>
        .perspective-1000 {
            perspective: 1000px;
        }

        .preserve-3d {
            transform-style: preserve-3d;
        }

        .backface-hidden {
            backface-visibility: hidden;
        }

        .rotate-y-180 {
            transform: rotateY(180deg);
        }
    </style>
</section>