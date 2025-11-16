<section id="manufacturing"
    class="js-manufacturing-section relative bg-[#030c24] overflow-hidden py-12 md:py-16 lg:py-20">

    <!-- White fade blending with surrounding sections -->
    <div class="pointer-events-none absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-white via-white/80 to-transparent"></div>
    <div class="pointer-events-none absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-white via-white/80 to-transparent"></div>

    <!-- Floating bubbles backdrop -->
    <div class="js-manufacturing-bubbles pointer-events-none absolute inset-0 overflow-hidden">
        @foreach (range(1, 14) as $i)
            <span
                class="js-manufacturing-bubble absolute inline-flex rounded-full bg-white/10 ring-1 ring-white/30 opacity-0 shadow-[0_15px_45px_rgba(2,6,23,0.45)]"></span>
        @endforeach
    </div>

    <div class="relative z-10 mx-auto max-w-7xl px-6 js-manufacturing-pin">

        <!-- Section Header -->
        <div class="text-center mb-12 md:mb-16">
            <p
                class="js-manufacturing-label text-sm font-semibold uppercase tracking-[0.25em] text-white/70 mb-6">
                Manufacturing Excellence
            </p>

            <h2
                class="js-manufacturing-title font-display text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-6 leading-tight flex flex-wrap items-center justify-center gap-x-3 gap-y-2">
                <span class="js-manufacturing-word inline-flex">Precision</span>
                <span class="js-manufacturing-word inline-flex">in</span>
                <span class="js-manufacturing-word inline-flex">Every</span>
                <span class="js-manufacturing-word inline-flex">Bar</span>
            </h2>

            <p class="js-manufacturing-description text-lg sm:text-xl text-white/80 max-w-3xl mx-auto leading-relaxed">
                A streamlined process built on science, consistency, and relentless quality checks.
            </p>
        </div>

        <!-- Horizontal Cards Track -->
        <div
            class="js-manufacturing-track relative h-[55vh] md:h-[60vh] lg:h-[65vh] flex overflow-visible will-change-transform">

            @foreach ([
                [
                    'step' => '01',
                    'title' => 'Formulation & Sourcing',
                    'description' => 'Premium raw materials paired with controlled formulation for stable, high-quality soap bars.',
                    'badge' => 'Input & Chemistry',
                ],
                [
                    'step' => '02',
                    'title' => 'Molding & Curing',
                    'description' => 'Precision molding and timed curing ensure durability, consistency, and long-lasting performance.',
                    'badge' => 'Shape & Structure',
                ],
                [
                    'step' => '03',
                    'title' => 'Packaging & Quality Control',
                    'description' => 'Every batch is tested for weight, moisture, fragrance strength, and overall stability.',
                    'badge' => 'Final Touch & Testing',
                ],
            ] as $index => $step)

            <article
                class="js-manufacturing-card relative min-w-full flex items-center justify-between gap-8 lg:gap-14 xl:gap-20">

                <div class="w-full lg:w-1/2 max-w-xl">
                    <div class="inline-flex items-center gap-3 mb-6">
                        <div
                            class="js-manufacturing-step-number inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-white/15 text-white text-lg font-semibold shadow-lg ring-1 ring-white/30">
                            {{ $step['step'] }}
                        </div>
                        <span
                            class="js-manufacturing-badge inline-flex items-center px-3 py-1 rounded-full border border-white/30 bg-white/10 text-xs font-medium uppercase tracking-[0.16em] text-white/80">
                            {{ $step['badge'] }}
                        </span>
                    </div>

                    <h3 class="js-manufacturing-step-title text-4xl md:text-6xl font-bold text-white mb-4">
                        {{ $step['title'] }}
                    </h3>

                    <p class="js-manufacturing-step-description text-lg md:text-xl text-white/90 leading-relaxed mb-5">
                        {{ $step['description'] }}
                    </p>

                    <div class="space-y-2 text-base text-white/85">
                        <p class="js-manufacturing-feature flex items-center gap-2">
                            <span class="inline-flex h-1.5 w-1.5 rounded-full bg-white/80"></span>
                            Tight process controls, logged parameters, and recipe locking.
                        </p>
                        <p class="js-manufacturing-feature flex items-center gap-2">
                            <span class="inline-flex h-1.5 w-1.5 rounded-full bg-white/80"></span>
                            Built for repeatability at scale, not one-off batches.
                        </p>
                        <p class="js-manufacturing-feature flex items-center gap-2">
                            <span class="inline-flex h-1.5 w-1.5 rounded-full bg-white/80"></span>
                            Inline checks at every stage before moving to the next step.
                        </p>
                    </div>
                </div>

                <div class="w-full lg:w-1/2 h-[260px] sm:h-[320px] md:h-[380px] lg:h-[460px] xl:h-[520px]">
                    <div class="js-manufacturing-image relative h-full w-full"></div>
                </div>

            </article>

            @endforeach
        </div>

    </div>
</section>

