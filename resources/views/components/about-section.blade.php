<section id="about" class="js-about-section relative bg-gradient-to-br from-maklos-50 via-white to-eucalyptus-50 overflow-hidden py-12 lg:py-20">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-20 -left-20 w-96 h-96 bg-maklos-200/30 rounded-full blur-3xl animate-aurora"></div>
        <div class="absolute bottom-20 -right-20 w-96 h-96 bg-eucalyptus-200/30 rounded-full blur-3xl animate-aurora" style="animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] bg-maklos-100/20 rounded-full blur-3xl animate-aurora" style="animation-delay: 4s;"></div>
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6">
        <div class="text-center mb-12 lg:mb-24">
            <!-- Section header styled like Product header -->
            <div class="js-about-header mb-8 lg:mb-10 flex items-center justify-center h-12 lg:h-24">
                <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-center">
                    <span class="text-black">About</span>
                    <span class="ml-3" style="color: #0d9488;">Us</span>
                </h2>
            </div>
            <div class="js-about-expertise-wrapper space-y-6">
                <h2 class="js-about-expertise font-display text-3xl sm:text-4xl lg:text-6xl font-extrabold leading-[1.1] tracking-tight px-4">
                    <span class="js-about-expertise-number inline-flex items-baseline gap-2 bg-gradient-to-r from-maklos-600 to-eucalyptus-600 bg-clip-text text-transparent">{{ $aboutContent->experience_years ?? 11 }}</span>
                    <span class="js-about-expertise-text inline-flex items-baseline ml-2 sm:ml-3 text-charcoal font-light">years of expertise</span>
                </h2>
                <p class="js-about-description text-justify lg:text-justify text-sm sm:text-base lg:text-lg text-charcoal/70 max-w-3xl mx-auto px-4 leading-relaxed">
                    {{ $aboutContent->description ?? 'Maklos Trading is a high-quality soap manufacturing company serving Africa and beyond. We design, manufacture, and supply premium bathing soaps with a focus on natural freshness, consistent quality, and export-ready packaging. Our signature product line, Future Eucalyptus Soap, delivers a clean, refreshing experience with natural antibacterial and antifungal benefits.' }}
                </p>
            </div>
        </div>
        <!-- Interconnected Mission, Vision, Values Section -->
        <div class="js-mvv-section relative mb-12 lg:mb-20">
            <!-- SVG Lines Container for connecting lines -->
            <svg class="js-mvv-lines absolute inset-0 w-full h-full pointer-events-none z-0" style="overflow: visible;">
                <defs>
                    <linearGradient id="mvvLineGradient" x1="0%" y1="0%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#1f58be;stop-opacity:0.7" />
                        <stop offset="50%" style="stop-color:#0d9488;stop-opacity:0.9" />
                        <stop offset="100%" style="stop-color:#1f58be;stop-opacity:0.7" />
                    </linearGradient>
                    <filter id="glow">
                        <feGaussianBlur stdDeviation="3" result="coloredBlur"/>
                        <feMerge>
                            <feMergeNode in="coloredBlur"/>
                            <feMergeNode in="SourceGraphic"/>
                        </feMerge>
                    </filter>
                </defs>
                <!-- Connecting lines will be drawn here by GSAP -->
                <path class="js-mvv-line-1" d="" stroke="url(#mvvLineGradient)" stroke-width="2" fill="none" opacity="0" filter="url(#glow)"/>
                <path class="js-mvv-line-2" d="" stroke="url(#mvvLineGradient)" stroke-width="2" fill="none" opacity="0" filter="url(#glow)"/>
            </svg>

            <!-- Floating Bubbles Container -->
            <div class="js-mvv-bubbles absolute inset-0 pointer-events-none z-0"></div>

            <!-- 3 Column Grid -->
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-4 lg:gap-12 px-4 sm:px-0">
                <!-- Mission Column -->
                <div class="js-mvv-column js-mvv-mission group relative perspective-1000">
                    <div class="js-mvv-card-wrapper relative h-[380px] lg:h-[520px] preserve-3d">
                        <!-- Front Face -->
                        <div class="js-mvv-card js-mvv-card-front absolute inset-0 w-full h-full rounded-2xl border-2 border-eucalyptus-500/50 bg-gradient-to-br from-white via-eucalyptus-50/30 to-white p-5 lg:p-10 shadow-2xl shadow-eucalyptus-500/20 cursor-pointer overflow-hidden" style="backface-visibility: hidden; transform-style: preserve-3d;">
                            <!-- Content -->
                            <div class="relative z-10 h-full flex flex-col items-center justify-center text-center">

                                <!-- Title -->
                                <h3 class="js-mvv-title font-display text-xl lg:text-4xl font-bold text-eucalyptus-600 mb-2 lg:mb-4 drop-shadow-lg" style="color: #0d9488;">
                                    {{ $aboutContent->mission_title ?? 'Our Mission' }}
                                </h3>

                                <!-- Default Description -->
                                <div class="js-mvv-default">
                                    <p class="text-xs lg:text-lg leading-snug lg:leading-relaxed max-w-xs px-1" style="color: #0d9488;">
                                        {{ $aboutContent->mission_description ?? 'To be Africa\'s trusted source of high-quality, affordable, and safe bathing soaps.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Back Face -->
                        <div class="js-mvv-card js-mvv-card-back absolute inset-0 w-full h-full rounded-2xl border-2 border-eucalyptus-500/50 bg-gradient-to-br from-white via-eucalyptus-50/30 to-white p-6 lg:p-8 shadow-2xl shadow-eucalyptus-500/20 cursor-pointer overflow-hidden" style="backface-visibility: hidden; transform: rotateY(180deg); transform-style: preserve-3d;">
                            <!-- Expanded Content -->
                            <div class="js-mvv-expanded relative z-10 h-full flex flex-col justify-center">
                                <div class="text-center mb-4">
                                    <h3 class="font-display text-2xl lg:text-3xl font-bold mb-3 drop-shadow-lg" style="color: #0d9488;">
                                        {{ $aboutContent->mission_title ?? 'Our Mission' }}
                                    </h3>
                                    <p class="text-sm leading-relaxed mb-4" style="color: #0d9488;">
                                        {{ $aboutContent->mission_description ?? 'To be Africa\'s trusted source of high-quality, affordable, and safe bathing soaps.' }}
                    </p>
                                </div>
                                <div class="space-y-2">
                        @if ($aboutContent && $aboutContent->mission_highlights)
                            @foreach (json_decode($aboutContent->mission_highlights, true) as $item)
                                        <div class="rounded-xl border border-eucalyptus-600/30 bg-eucalyptus-600/10 backdrop-blur-sm p-2.5 shadow-sm">
                                            <p class="text-xs font-semibold uppercase tracking-[0.1em] mb-0.5" style="color: #0d9488;">{{ $item['label'] }}</p>
                                            <p class="text-xs leading-tight" style="color: #0d9488;">{{ $item['copy'] }}</p>
                            </div>
                        @endforeach
                        @else
                            @foreach ([
                                ['label' => 'Quality Control', 'copy' => 'Every formulation is tested for purity, stability, and consistency.'],
                                ['label' => 'Affordable Care', 'copy' => 'Pricing remains accessible without compromising performance.'],
                            ] as $item)
                                        <div class="rounded-xl border border-eucalyptus-600/30 bg-eucalyptus-600/10 backdrop-blur-sm p-2.5 shadow-sm">
                                            <p class="text-xs font-semibold uppercase tracking-[0.1em] mb-0.5" style="color: #0d9488;">{{ $item['label'] }}</p>
                                            <p class="text-xs leading-tight" style="color: #0d9488;">{{ $item['copy'] }}</p>
                            </div>
                        @endforeach
                        @endif
                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vision Column -->
                <div class="js-mvv-column js-mvv-vision group relative perspective-1000">
                    <div class="js-mvv-card-wrapper relative h-[380px] lg:h-[520px] preserve-3d">
                        <!-- Front Face -->
                        <div class="js-mvv-card js-mvv-card-front absolute inset-0 w-full h-full rounded-2xl border-2 border-eucalyptus-500/50 bg-gradient-to-br from-white via-eucalyptus-50/30 to-white p-5 lg:p-10 shadow-2xl shadow-eucalyptus-500/20 cursor-pointer overflow-hidden" style="backface-visibility: hidden; transform-style: preserve-3d;">
                            <!-- Content -->
                            <div class="relative z-10 h-full flex flex-col items-center justify-center text-center">

                                <!-- Title -->
                                <h3 class="js-mvv-title font-display text-xl lg:text-4xl font-bold mb-2 lg:mb-4 drop-shadow-lg" style="color: #0d9488;">
                                    {{ $aboutContent->vision_title ?? 'Our Vision' }}
                                </h3>

                                <!-- Default Description -->
                                <div class="js-mvv-default">
                                    <p class="text-xs lg:text-lg leading-snug lg:leading-relaxed max-w-xs px-1" style="color: #0d9488;">
                                        {{ $aboutContent->vision_description ?? 'To lead the region\'s soap manufacturing industry through sustainable innovation.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Back Face -->
                        <div class="js-mvv-card js-mvv-card-back absolute inset-0 w-full h-full rounded-2xl border-2 border-eucalyptus-500/50 bg-gradient-to-br from-white via-eucalyptus-50/30 to-white p-6 lg:p-8 shadow-2xl shadow-eucalyptus-500/20 cursor-pointer overflow-hidden" style="backface-visibility: hidden; transform: rotateY(180deg); transform-style: preserve-3d;">
                            <!-- Expanded Content -->
                            <div class="js-mvv-expanded relative z-10 h-full flex flex-col justify-center">
                                <div class="text-center mb-4">
                                    <h3 class="font-display text-2xl lg:text-3xl font-bold mb-3 drop-shadow-lg" style="color: #0d9488;">
                                        {{ $aboutContent->vision_title ?? 'Our Vision' }}
                                    </h3>
                                    <p class="text-sm leading-relaxed mb-4" style="color: #0d9488;">
                                        {{ $aboutContent->vision_description ?? 'To lead the region\'s soap manufacturing industry through sustainable innovation, customer partnership, and export excellence.' }}
                    </p>
                                </div>
                                <div class="space-y-2">
                        @if ($aboutContent && $aboutContent->vision_highlights)
                            @foreach (json_decode($aboutContent->vision_highlights, true) as $point)
                                        <div class="rounded-xl border border-eucalyptus-600/30 bg-eucalyptus-600/10 backdrop-blur-sm p-2.5 shadow-sm">
                                            <p class="text-xs font-semibold mb-0.5" style="color: #0d9488;">{{ $point['title'] }}</p>
                                            <p class="text-xs leading-tight" style="color: #0d9488;">{{ $point['detail'] }}</p>
                                        </div>
                                    @endforeach
                                @else
                                    @foreach ([
                                        ['title' => 'Sustainable Innovation', 'detail' => 'Scale greener production systems that elevate quality while reducing waste.'],
                                        ['title' => 'Customer Partnership', 'detail' => 'Co-create OEM and white-label runs tailored to regional market shifts.'],
                                    ] as $point)
                                        <div class="rounded-xl border border-eucalyptus-600/30 bg-eucalyptus-600/10 backdrop-blur-sm p-2.5 shadow-sm">
                                            <p class="text-xs font-semibold mb-0.5" style="color: #0d9488;">{{ $point['title'] }}</p>
                                            <p class="text-xs leading-tight" style="color: #0d9488;">{{ $point['detail'] }}</p>
                                        </div>
                                    @endforeach
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Values Column -->
                <div class="js-mvv-column js-mvv-values group relative perspective-1000">
                    <div class="js-mvv-card-wrapper relative h-[380px] lg:h-[520px] preserve-3d">
                        <!-- Front Face -->
                        <div class="js-mvv-card js-mvv-card-front absolute inset-0 w-full h-full rounded-2xl border-2 border-eucalyptus-500/50 bg-gradient-to-br from-white via-eucalyptus-50/30 to-white p-5 lg:p-10 shadow-2xl shadow-eucalyptus-500/20 cursor-pointer overflow-hidden" style="backface-visibility: hidden; transform-style: preserve-3d;">
                            <!-- Content -->
                            <div class="relative z-10 h-full flex flex-col items-center justify-center text-center">

                                <!-- Title -->
                                <h3 class="js-mvv-title font-display text-xl lg:text-4xl font-bold mb-2 lg:mb-4 drop-shadow-lg" style="color: #0d9488;">
                                    {{ $aboutContent->values_title ?? 'Our Values' }}
                                </h3>

                                <!-- Default Description -->
                                <div class="js-mvv-default">
                                    <p class="text-xs lg:text-lg leading-snug lg:leading-relaxed max-w-xs px-1" style="color: #0d9488;">
                                        {{ $aboutContent->values_description ?? 'These pillars guide every Maklos partnership—from R&D to on-time fulfilment.' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Back Face -->
                        <div class="js-mvv-card js-mvv-card-back absolute inset-0 w-full h-full rounded-2xl border-2 border-eucalyptus-500/50 bg-gradient-to-br from-white via-eucalyptus-50/30 to-white p-6 lg:p-8 shadow-2xl shadow-eucalyptus-500/20 cursor-pointer overflow-hidden" style="backface-visibility: hidden; transform: rotateY(180deg); transform-style: preserve-3d;">
                            <!-- Expanded Content -->
                            <div class="js-mvv-expanded relative z-10 h-full flex flex-col justify-center">
                                <div class="text-center mb-4">
                                    <h3 class="font-display text-2xl lg:text-3xl font-bold mb-3 drop-shadow-lg" style="color: #0d9488;">
                                        {{ $aboutContent->values_title ?? 'Our Values' }}
                                    </h3>
                                    <p class="text-sm leading-relaxed mb-4" style="color: #0d9488;">
                        {{ $aboutContent->values_description ?? 'These pillars guide every Maklos partnership—from R&D to on-time fulfilment.' }}
                    </p>
                                </div>
                                <div class="space-y-2">
                        @if ($aboutValues && $aboutValues->count() > 0)
                            @foreach ($aboutValues as $value)
                                        <div class="rounded-xl border border-eucalyptus-600/30 bg-eucalyptus-600/10 backdrop-blur-sm p-2.5 shadow-sm">
                                            <p class="text-xs font-semibold uppercase tracking-[0.1em] mb-0.5" style="color: #0d9488;">{{ $value->title }}</p>
                                            <p class="text-xs leading-tight" style="color: #0d9488;">{{ $value->summary }}</p>
                            </div>
                        @endforeach
                        @else
                            @foreach ([
                                ['name' => 'Quality', 'desc' => 'Every batch is tested for purity, stability, and consistency.'],
                                ['name' => 'Integrity', 'desc' => 'Ethical sourcing and transparent operations with every supplier.'],
                                ['name' => 'Innovation', 'desc' => 'Product development driven by science and market feedback loops.'],
                            ] as $value)
                                        <div class="rounded-xl border border-eucalyptus-600/30 bg-eucalyptus-600/10 backdrop-blur-sm p-2.5 shadow-sm">
                                            <p class="text-xs font-semibold uppercase tracking-[0.1em] mb-0.5" style="color: #0d9488;">{{ $value['name'] }}</p>
                                            <p class="text-xs leading-tight" style="color: #0d9488;">{{ $value['desc'] }}</p>
                            </div>
                        @endforeach
                        @endif
            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="js-about-cta text-center mt-16">
            <div class="inline-block rounded-3xl bg-gradient-to-r from-maklos-500 to-eucalyptus-500 p-[2px] shadow-2xl">
                <div class="rounded-3xl bg-white px-8 py-6">
                    <p class="text-lg font-semibold text-charcoal mb-2">Ready to partner with us?</p>
                    <a href="mailto:{{ config('app.contact_email', 'info@maklostrader.com') }}" class="inline-flex items-center gap-2 text-maklos-600 font-semibold hover:gap-4 transition-all duration-300 group">
                        Get in touch
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transition-transform duration-300 group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div> --}}
    </div>
</section>