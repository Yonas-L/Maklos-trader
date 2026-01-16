@props(['manufacturingSteps' => []])

<section id="manufacturing-mobile"
    class="lg:hidden relative bg-gradient-to-br from-slate-50 via-white to-blue-50 overflow-hidden pt-12 pb-2">
    <!-- Floating bubbles background -->
    <div class="js-manufacturing-bubbles-mobile pointer-events-none absolute inset-0 overflow-hidden z-0">
        @foreach (range(1, 8) as $i)
            <span
                class="js-manufacturing-bubble-mobile absolute inline-flex rounded-full bg-[#1f58be]/10 ring-1 ring-[#1f58be]/20 opacity-60"></span>
        @endforeach
    </div>

    <div class="relative z-10 px-4">
        <!-- Header -->
        <div class="text-center mb-10">
            {{-- <p class="text-xs font-semibold uppercase tracking-widest text-[#1f58be]/70 mb-3"
                data-animate="fade-in">
                Manufacturing Excellence
            </p> --}}
            <h2 class="text-4xl font-bold leading-tight text-center flex flex-wrap items-center justify-center gap-x-2 mb-3"
                data-animate="split-text">
                <span class="text-black">Precision</span>
                <span class="text-black">in</span>
                <span class="text-black">Every</span>
                <span style="color: #0d9488;">Bar</span>
            </h2>
            <p class="text-sm text-slate-600 max-w-md mx-auto leading-relaxed" data-animate="fade-in" data-delay="0.2">
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
                        class="relative rounded-2xl overflow-hidden bg-white border border-slate-100 shadow-xl shadow-slate-200/50">

                        <!-- Image section -->
                        <div class="relative h-48 overflow-hidden">
                            <!-- Glow effect -->
                            <div
                                class="absolute -inset-4 bg-gradient-to-r from-[#1f58be]/10 via-[#0d9488]/10 to-purple-500/10 blur-xl">
                            </div>

                            <!-- Image -->
                            <img src="{{ $step['image'] }}" alt="{{ $step['title'] }}"
                                class="relative w-full h-full object-cover" loading="lazy" />

                            <!-- Overlay gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/40 via-transparent to-transparent">
                            </div>

                            <!-- Step number badge -->
                            <div
                                class="absolute top-3 left-3 inline-flex items-center justify-center w-10 h-10 rounded-xl bg-white text-[#1f58be] text-lg font-bold shadow-lg ring-1 ring-slate-100">
                                {{ $step['step_number'] }}
                            </div>

                            <!-- Badge -->
                            <div
                                class="absolute top-3 right-3 inline-flex items-center px-3 py-1 rounded-full border border-[#0d9488]/20 bg-white/95 backdrop-blur-md text-xs font-bold uppercase tracking-wider text-[#0d9488] shadow-sm">
                                {{ $step['badge'] }}
                            </div>
                        </div>

                        <!-- Content section -->
                        <div class="p-5 space-y-3">
                            <!-- Title -->
                            <h3 class="text-2xl font-bold text-slate-900 leading-tight" data-animate="fade-in"
                                data-delay="{{ $index * 0.15 + 0.1 }}">
                                {{ $step['title'] }}
                            </h3>

                            <!-- Description -->
                            <p class="text-sm text-slate-600 leading-relaxed" data-animate="fade-in"
                                data-delay="{{ $index * 0.15 + 0.15 }}">
                                {{ $step['description'] }}
                            </p>

                            <!-- Features -->
                            <div class="space-y-2 pt-2" data-animate="fade-in" data-delay="{{ $index * 0.15 + 0.2 }}">
                                @foreach ($step['features'] as $featureIndex => $feature)
                                    <div class="flex items-start gap-2 text-xs text-slate-500 font-medium">
                                        <span
                                            class="inline-flex mt-1.5 h-1.5 w-1.5 rounded-full bg-[#1f58be] flex-shrink-0"></span>
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
        <div class="text-center mt-6" data-animate="fade-in" data-delay="0.5">
            <p class="text-xs text-slate-400 uppercase tracking-wider">
                Quality you can trust, every single time
            </p>
        </div>
    </div>
</section>