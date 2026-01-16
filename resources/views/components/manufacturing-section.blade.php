\<section
  class="js-manufacturing-section hidden lg:flex relative bg-gradient-to-br from-slate-50 via-white to-blue-50 overflow-hidden py-8 md:py-10 lg:py-10 items-center justify-center">

  <!-- 1. Ambient Background Effects (Matches other sections) -->
  <div class="pointer-events-none absolute inset-0 z-0">
    <!-- Floating Orbs -->
    <div class="absolute top-0 left-1/4 w-[600px] h-[600px] bg-[#1f58be]/5 rounded-full blur-[100px] animate-pulse">
    </div>
    <div class="absolute bottom-0 right-1/4 w-[600px] h-[600px] bg-[#0d9488]/5 rounded-full blur-[100px] animate-pulse"
      style="animation-delay: 2s;"></div>
    <!-- Noise Texture -->
    <div
      class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 mix-blend-multiply">
    </div>
  </div>

  <!-- Bubbles (Updated color for light background) -->
  <div class="js-manufacturing-bubbles pointer-events-none absolute inset-0 overflow-hidden z-0">
    @foreach (range(1, 14) as $i)
      <span
        class="js-manufacturing-bubble absolute inline-flex rounded-full bg-[#1f58be]/10 ring-1 ring-[#1f58be]/20 opacity-0 shadow-sm"></span>
    @endforeach
  </div>

  <!-- Content -->
  <div class="relative z-10 mx-auto max-w-6xl px-4 js-manufacturing-pin">

    <!-- Header -->
    <div class="text-center mb-16 lg:mb-0 relative z-20">
      <div class="flex items-center justify-center h-12 lg:h-24">
        <h2
          class="js-manufacturing-title text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-center flex flex-wrap items-center justify-center gap-x-3">
          <span class="js-manufacturing-word inline-flex text-black">Precision</span>
          <span class="js-manufacturing-word inline-flex text-black">in</span>
          <span class="js-manufacturing-word inline-flex text-black">Every</span>
          <span class="js-manufacturing-word inline-flex" style="color: #0d9488;">Bar</span>
        </h2>
      </div>
    </div>

    <!-- Track -->
    <div
      class="js-manufacturing-track relative h-[45vh] md:h-[50vh] lg:h-[55vh] flex overflow-visible will-change-transform">

      @foreach ($manufacturingSteps as $index => $step)
        <article class="js-manufacturing-card relative min-w-full flex items-center justify-between gap-8">

          <!-- Text Column -->
          <div class="w-full lg:w-1/2 lg:pr-10">
            <div class="inline-flex items-center gap-3 mb-5">
              <!-- Step Number -->
              <div
                class="js-manufacturing-step-number inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-white text-[#1f58be] text-xl font-bold shadow-lg shadow-slate-200 ring-1 ring-slate-100">
                {{ $step['step_number'] }}
              </div>
              <!-- Badge -->
              <span
                class="js-manufacturing-badge inline-flex items-center px-4 py-1.5 rounded-full border border-[#0d9488]/20 bg-[#0d9488]/5 text-sm font-bold uppercase tracking-[0.16em] text-[#0d9488]">
                {{ $step['badge'] }}
              </span>
            </div>

            <h3 class="js-manufacturing-step-title text-3xl sm:text-4xl lg:text-5xl font-medium text-slate-900 mb-4">
              {{ $step['title'] }}
            </h3>

            <p class="js-manufacturing-step-description text-sm lg:text-base text-slate-600 leading-relaxed mb-5">
              {{ $step['description'] }}
            </p>

            <div class="space-y-2.5 text-base text-slate-500 font-medium">
              @foreach ($step['features'] as $feature)
                <p class="js-manufacturing-feature flex items-center gap-3">
                  <span class="inline-flex h-2 w-2 rounded-full bg-[#1f58be]"></span>
                  {{ $feature }}
                </p>
              @endforeach
            </div>
          </div>

          <!-- Image Column -->
          <div class="w-full lg:w-1/2 lg:pl-10 h-[220px] sm:h-[260px] md:h-[300px] lg:h-[360px] relative">
            <div class="js-manufacturing-image absolute inset-0">
              <div class="relative w-full h-full group">

                <!-- Main Glow (Updated colors for light theme compatibility) -->
                <div
                  class="absolute -inset-4 bg-gradient-to-r from-[#1f58be]/20 via-[#0d9488]/20 to-purple-500/20 rounded-3xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700">
                </div>

                <!-- Image container -->
                <div
                  class="js-manufacturing-image-wrapper relative w-full h-full rounded-3xl overflow-hidden shadow-2xl shadow-slate-200 ring-4 ring-white">

                  <img src="{{ $step['image'] }}" alt="{{ $step['title'] }}"
                    class="w-full h-full object-cover transform transition-all duration-700 group-hover:scale-105"
                    style="min-height: 260px; display: block !important; visibility: visible !important;"
                    onerror="console.error('Image failed to load:', this.src);"
                    onload="console.log('Image loaded OK:', this.src);" />

                  <!-- Edge overlays (lighter) -->
                  <div
                    class="absolute inset-0 bg-gradient-to-tr from-transparent via-transparent to-white/30 pointer-events-none">
                  </div>

                  <!-- Animated border shine effect -->
                  <div
                    class="absolute inset-0 rounded-3xl bg-gradient-to-r from-transparent via-white/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-1000 pointer-events-none mix-blend-overlay">
                  </div>

                  <!-- Corner accents (Colored) -->
                  <div
                    class="absolute top-4 left-4 w-8 h-8 border-t-2 border-l-2 border-white/80 rounded-tl-lg shadow-sm">
                  </div>
                  <div
                    class="absolute top-4 right-4 w-8 h-8 border-t-2 border-r-2 border-white/80 rounded-tr-lg shadow-sm">
                  </div>
                  <div
                    class="absolute bottom-4 left-4 w-8 h-8 border-b-2 border-l-2 border-white/80 rounded-bl-lg shadow-sm">
                  </div>
                  <div
                    class="absolute bottom-4 right-4 w-8 h-8 border-b-2 border-r-2 border-white/80 rounded-br-lg shadow-sm">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </article>
      @endforeach

    </div>
  </div>
</section>