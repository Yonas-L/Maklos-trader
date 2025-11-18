<section id="manufacturing"
  class="js-manufacturing-section relative bg-[#030c24] overflow-hidden py-9 md:py-12 lg:py-16">

  <!-- Decorative fades (behind content) -->
  <div class="pointer-events-none absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-white via-white/80 to-transparent z-0"></div>
  <div class="pointer-events-none absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-white via-white/80 to-transparent z-0"></div>

  <!-- Bubbles (behind content) -->
  <div class="js-manufacturing-bubbles pointer-events-none absolute inset-0 overflow-hidden z-0">
    @foreach (range(1, 14) as $i)
      <span class="js-manufacturing-bubble absolute inline-flex rounded-full bg-white/10 ring-1 ring-white/30 opacity-0 shadow-[0_15px_45px_rgba(2,6,23,0.45)]"></span>
    @endforeach
  </div>

  <!-- Content above decorative layers -->
  <div class="relative z-50 mx-auto max-w-7xl px-6 js-manufacturing-pin">

    <!-- Header -->
    <div class="text-center mb-10 md:mb-14">
      <p class="js-manufacturing-label text-sm font-semibold uppercase tracking-[0.25em] text-white/70 mb-6">
        Manufacturing Excellence
      </p>
      <h2 class="js-manufacturing-title font-display text-4xl sm:text-5xl lg:text-6xl xl:text-7xl font-bold text-white mb-6 leading-tight flex flex-wrap items-center justify-center gap-x-3 gap-y-2">
        <span class="js-manufacturing-word inline-flex">Precision</span>
        <span class="js-manufacturing-word inline-flex">in</span>
        <span class="js-manufacturing-word inline-flex">Every</span>
        <span class="js-manufacturing-word inline-flex">Bar</span>
      </h2>
      <p class="js-manufacturing-description text-lg sm:text-xl text-white/80 max-w-3xl mx-auto leading-relaxed">
        A streamlined process built on science, consistency, and relentless quality checks.
      </p>
    </div>

    <!-- Track -->
    <div class="js-manufacturing-track relative h-[48vh] md:h-[54vh] lg:h-[58vh] flex overflow-visible will-change-transform">

      @foreach ($manufacturingSteps as $index => $step)
      <article class="js-manufacturing-card relative min-w-full flex items-center justify-between">
        <!-- Text -->
        <div class="w-full lg:w-1/2 lg:pr-12 xl:pr-16">
          <div class="inline-flex items-center gap-3 mb-6">
            <div class="js-manufacturing-step-number inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-white/15 text-white text-lg font-semibold shadow-lg ring-1 ring-white/30">
              {{ $step['step_number'] }}
            </div>
            <span class="js-manufacturing-badge inline-flex items-center px-3 py-1 rounded-full border border-white/30 bg-white/10 text-xs font-medium uppercase tracking-[0.16em] text-white/80">
              {{ $step['badge'] }}
            </span>
          </div>
          <h3 class="js-manufacturing-step-title text-4xl md:text-6xl font-bold text-white mb-4">{{ $step['title'] }}</h3>
          <p class="js-manufacturing-step-description text-lg md:text-xl text-white/90 leading-relaxed mb-5">{{ $step['description'] }}</p>
          <div class="space-y-2 text-base text-white/85">
            @foreach ($step['features'] as $feature)
              <p class="js-manufacturing-feature flex items-center gap-2">
                <span class="inline-flex h-1.5 w-1.5 rounded-full bg-white/80"></span>
                {{ $feature }}
              </p>
            @endforeach
          </div>
        </div>

        <!-- Image with amazing styling -->
        <div class="w-full lg:w-1/2 lg:pl-12 xl:pl-16 h-[260px] sm:h-[320px] md:h-[380px] lg:h-[460px] xl:h-[520px] relative">
          <div class="js-manufacturing-image absolute inset-0">
            <div class="relative w-full h-full group">
              <!-- Main glow background -->
              <div class="absolute -inset-4 bg-gradient-to-r from-blue-600/30 via-purple-600/30 to-pink-600/30 rounded-3xl blur-2xl opacity-75 group-hover:opacity-100 transition-opacity duration-700"></div>
              
              <!-- Secondary glow for depth -->
              <div class="absolute inset-0 bg-gradient-to-br from-cyan-500/20 via-blue-500/20 to-indigo-500/20 rounded-3xl blur-xl opacity-60"></div>
              
              <!-- Image container with fancy border -->
              <div class="js-manufacturing-image-wrapper relative w-full h-full rounded-3xl overflow-hidden shadow-2xl ring-1 ring-white/20 backdrop-blur-sm">
                <img
                  src="{{ $step['image'] }}"
                  alt="{{ $step['title'] }}"
                  class="w-full h-full object-cover transform transition-all duration-700 group-hover:scale-105"
                  style="min-height: 260px; display: block !important; visibility: visible !important;"
                  onerror="console.error('Image failed to load:', this.src);"
                  onload="console.log('Image loaded OK:', this.src);"
                />
                
                <!-- Edge blending overlays -->
                <div class="absolute inset-0 bg-gradient-to-tr from-transparent via-transparent to-white/15 pointer-events-none"></div>
                <div class="absolute inset-0 bg-gradient-to-bl from-transparent via-transparent to-black/25 pointer-events-none"></div>
                
                <!-- Animated border shine effect -->
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-r from-transparent via-white/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000 pointer-events-none"></div>
                
                <!-- Corner accents -->
                <div class="absolute top-2 left-2 w-8 h-8 border-t-2 border-l-2 border-white/40 rounded-tl-lg"></div>
                <div class="absolute top-2 right-2 w-8 h-8 border-t-2 border-r-2 border-white/40 rounded-tr-lg"></div>
                <div class="absolute bottom-2 left-2 w-8 h-8 border-b-2 border-l-2 border-white/40 rounded-bl-lg"></div>
                <div class="absolute bottom-2 right-2 w-8 h-8 border-b-2 border-r-2 border-white/40 rounded-br-lg"></div>
              </div>
            </div>
          </div>
        </div>
      </article>
      @endforeach

    </div>
  </div>
</section>