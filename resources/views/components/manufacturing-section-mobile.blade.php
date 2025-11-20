@props(['manufacturingSteps' => []])

<section id="manufacturing-mobile"
    class="lg:hidden relative bg-[#030c24] overflow-hidden py-12">

    <!-- Floating bubbles background -->
    <div class="js-manufacturing-bubbles-mobile pointer-events-none absolute inset-0 overflow-hidden z-0">
        @foreach (range(1, 8) as $i)
            <span
                class="js-manufacturing-bubble-mobile absolute inline-flex rounded-full bg-white/5 ring-1 ring-white/20 opacity-60"></span>
        @endforeach
    </div>

    <div class="relative z-10 px-4">
        <!-- Header -->
        <div class="text-center mb-10">
            <p class="text-xs font-semibold uppercase tracking-widest text-white/70 mb-3" data-animate="fade-in">
                Manufacturing Excellence
            </p>
            <h2 class="font-display text-3xl font-bold text-white mb-3 leading-tight" data-animate="split-text">
                Precision in Every Bar
            </h2>
            <p class="text-sm text-white/80 max-w-md mx-auto leading-relaxed" data-animate="fade-in" data-delay="0.2">
                A streamlined process built on science, consistency, and relentless quality checks.
            </p>
        </div>

        <!-- Manufacturing Steps -->
        <div class="space-y-8">
            @foreach ($manufacturingSteps as $index => $step)
                <article class="js-manufacturing-mobile-card relative" data-animate="fade-up"
                    data-delay="{{ $index * 0.15 }}">

                    <!-- Card container -->
                    <div
                        class="relative rounded-2xl overflow-hidden bg-gradient-to-br from-white/10 to-white/5 backdrop-blur-sm border border-white/20 shadow-2xl">

                        <!-- Image section -->
                        <div class="relative h-48 overflow-hidden">
                            <!-- Glow effect -->
                            <div
                                class="absolute -inset-4 bg-gradient-to-r from-blue-600/20 via-purple-600/20 to-pink-600/20 blur-xl">
                            </div>

                            <!-- Image -->
                            <img src="{{ $step['image'] }}" alt="{{ $step['title'] }}"
                                class="relative w-full h-full object-cover" loading="lazy" />

                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#030c24] via-transparent to-transparent">
                            </div>

                            <!-- Step number badge -->
                            <div
                                class="absolute top-3 left-3 inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white/20 backdrop-blur-md text-white text-lg font-bold shadow-lg ring-1 ring-white/30">
                                {{ $step['step_number'] }}
                            </div>

                            <!-- Badge -->
                            <div
                                class="absolute top-3 right-3 inline-flex items-center px-3 py-1 rounded-full border border-white/30 bg-white/15 backdrop-blur-md text-xs font-medium uppercase tracking-wider text-white/90 shadow-lg">
                                {{ $step['badge'] }}
                            </div>
                        </div>

                        <!-- Content section -->
                        <div class="p-5 space-y-3">
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-white leading-tight" data-animate="fade-in"
                                data-delay="{{ $index * 0.15 + 0.1 }}">
                                {{ $step['title'] }}
                            </h3>

                            <!-- Description -->
                            <p class="text-sm text-white/85 leading-relaxed" data-animate="fade-in"
                                data-delay="{{ $index * 0.15 + 0.15 }}">
                                {{ $step['description'] }}
                            </p>

                            <!-- Features -->
                            <div class="space-y-2 pt-2" data-animate="fade-in" data-delay="{{ $index * 0.15 + 0.2 }}">
                                @foreach ($step['features'] as $featureIndex => $feature)
                                    <div class="flex items-start gap-2 text-xs text-white/80">
                                        <span class="inline-flex mt-1.5 h-1 w-1 rounded-full bg-white/70 flex-shrink-0"></span>
                                        <span class="flex-1">{{ $feature }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>

        <!-- Optional CTA or footer -->
        <div class="text-center mt-10" data-animate="fade-in" data-delay="0.5">
            <p class="text-xs text-white/60 uppercase tracking-wider">
                Quality you can trust, every single time
            </p>
        </div>
    </div>
</section>