@props(['slides' => [], 'heroContent' => null])

<section id="home" class="js-home-hero relative overflow-hidden bg-gradient-to-b from-maklos-50/50 via-white to-maklos-50/30">
    {{-- Animated Soap Bubbles Background --}}
    @include('partials.bubble-overlay')

    {{-- Animated blob gradient background --}}
    <div class="pointer-events-none absolute inset-0 z-0 overflow-hidden">
        {{-- Large background blobs - more visible --}}
        <div class="absolute -left-32 top-[-15%] h-[520px] w-[520px] animate-aurora rounded-full bg-gradient-to-br from-eucalyptus/70 via-maklos-400/60 to-maklos-200/50 blur-3xl"></div>
        <div class="absolute -right-40 bottom-[-20%] h-[580px] w-[580px] animate-aurora rounded-full bg-gradient-to-tr from-maklos-300/75 via-eucalyptus/65 to-maklos-100/55 blur-3xl" style="animation-delay: -6s"></div>
        
        {{-- Medium blobs - more visible --}}
        <div class="absolute left-1/3 top-1/4 h-[380px] w-[380px] animate-aurora rounded-full bg-gradient-to-br from-eucalyptus/65 via-maklos-300/55 to-maklos-100/40 blur-3xl" style="animation-delay: -3s"></div>
        <div class="absolute right-1/4 top-1/3 h-[440px] w-[440px] animate-aurora rounded-full bg-gradient-to-bl from-maklos-200/60 via-eucalyptus/55 to-maklos-50/45 blur-[140px]" style="animation-delay: -9s"></div>
        
        {{-- Additional animated blobs for depth - more visible --}}
        <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 h-[600px] w-[600px] animate-aurora rounded-full bg-gradient-to-r from-maklos-400/50 via-eucalyptus/45 to-maklos-200/40 blur-[120px]" style="animation-delay: -4.5s"></div>
        <div class="absolute left-0 top-2/3 h-[450px] w-[450px] animate-aurora rounded-full bg-gradient-to-tr from-eucalyptus/55 via-maklos-300/45 to-maklos-100/35 blur-3xl" style="animation-delay: -7s"></div>
        <div class="absolute right-1/3 bottom-1/4 h-[500px] w-[500px] animate-aurora rounded-full bg-gradient-to-bl from-maklos-500/50 via-eucalyptus/45 to-maklos-100/40 blur-[130px]" style="animation-delay: -1.5s"></div>
        <div class="absolute left-2/3 top-0 h-[350px] w-[350px] animate-aurora rounded-full bg-gradient-to-br from-eucalyptus/60 via-maklos-400/50 to-maklos-200/40 blur-2xl" style="animation-delay: -5s"></div>
        <div class="absolute right-0 top-1/2 h-[400px] w-[400px] animate-aurora rounded-full bg-gradient-to-l from-maklos-300/55 via-eucalyptus/50 to-maklos-100/40 blur-3xl" style="animation-delay: -2s"></div>
    </div>

    {{-- Content wrapper --}}
    <div class="relative z-20">
        <div class="mx-auto grid max-w-7xl gap-12 px-6 pb-8 lg:gap-24 lg:grid-cols-[minmax(0,1.1fr)_minmax(0,1fr)] lg:items-start">
            <div class="js-hero-copy max-w-4xl space-y-10 pt-48    ">
                <h1 class="js-hero-title font-display text-4xl font-bold leading-[1.2] tracking-tight text-charcoal sm:text-5xl lg:text-6xl">
                 
                    {{ $heroContent->title ?? '' }}
                </h1>
                <p class="js-hero-description text-base leading-relaxed text-charcoal/70 sm:text-lg text-justify">{{ $heroContent->description ?? '' }}</p>
                <div class="js-hero-buttons flex flex-wrap items-center gap-5 text-base font-semibold">
                    @if($heroContent->button_primary_label)
                        <a href="{{ $heroContent->button_primary_url }}" class="hero-button inline-flex items-center rounded-full bg-maklos-500 px-7 py-3 text-white shadow-lg shadow-maklos-500/30 transition-all duration-300 hover:-translate-y-0.5 hover:bg-maklos-400 hover:shadow-xl">
                            {{ $heroContent->button_primary_label }}
                        </a>
                    @endif
                    @if($heroContent->button_secondary_label)
                        <a href="{{ $heroContent->button_secondary_url }}" class="hero-button inline-flex items-center rounded-full border border-maklos-200 px-7 py-3 text-maklos-700/85 transition-all duration-300 hover:border-maklos-400 hover:text-maklos-500 hover:bg-maklos-50/50">
                            {{ $heroContent->button_secondary_label }}
                        </a>
                    @endif
                </div>
                
                {{-- Social Icons --}}
                @if($heroContent->show_social_icons && ($heroContent->facebook_url || $heroContent->instagram_url || $heroContent->twitter_url || $heroContent->linkedin_url))
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
                
                <div class="social-bar" role="navigation" aria-label="Social media links">
                  @if($heroContent->facebook_url)
                  <a
                    href="{{ $heroContent->facebook_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="social-btn"
                    aria-label="Visit us on Facebook"
                  >
                    <i class="icon fab fa-facebook-f"></i>
                  </a>
                  @endif

                  @if($heroContent->instagram_url)
                  <a
                    href="{{ $heroContent->instagram_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="social-btn"
                    aria-label="Visit us on Instagram"
                  >
                    <i class="icon fab fa-instagram"></i>
                  </a>
                  @endif

                  @if($heroContent->twitter_url)
                  <a
                    href="{{ $heroContent->twitter_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="social-btn"
                    aria-label="Visit us on X (formerly Twitter)"
                  >
                    <i class="icon fab fa-twitter"></i>
                  </a>
                  @endif

                  @if($heroContent->linkedin_url)
                  <a
                    href="{{ $heroContent->linkedin_url }}"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="social-btn"
                    aria-label="Visit us on LinkedIn"
                  >
                    <i class="icon fab fa-linkedin-in"></i>
                  </a>
                  @endif
                </div>
                @endif

                <style>
                  /* Container: spacing, alignment, responsiveness */
                  .social-bar {
                    display: flex;
                    align-items: center;
                    gap: 0.6rem;
                    padding-top: 0.5rem;
                    max-width: 48rem;
                    flex-wrap: wrap;
                  }

                  /* Button base: soft glassmorphism + gradient ring on hover */
                  .social-btn {
                    --g1: #4dbb90;
                    --g2: #2f74e6;
                    position: relative;
                    width: 42px;
                    height: 42px;
                    display: grid;
                    place-items: center;
                    border-radius: 999px;
                    color: #fff;
                    text-decoration: none;
                    background: rgba(255, 255, 255, 0.02);
                    border: 1px solid rgba(255, 255, 255, 0.08);
                    backdrop-filter: saturate(140%) blur(6px);
                    -webkit-backdrop-filter: saturate(140%) blur(6px);
                    box-shadow:
                      0 2px 8px rgba(0, 0, 0, 0.15),
                      inset 0 0 0 0 rgba(77, 187, 144, 0); /* animated later */
                    transition:
                      transform 220ms ease,
                      box-shadow 220ms ease,
                      background 220ms ease;
                    overflow: hidden;
                    isolation: isolate; /* keep pseudo behind icon */
                  }

                  /* Subtle gradient glow ring using ::before */
                  .social-btn::before {
                    content: "";
                    position: absolute;
                    inset: -2px;
                    border-radius: inherit;
                    background: conic-gradient(from 180deg, var(--g1), var(--g2), var(--g1));
                    filter: blur(10px);
                    opacity: 0.0;
                    transition: opacity 220ms ease, filter 220ms ease;
                    z-index: 0;
                  }

                  /* Inner gradient sheen using ::after */
                  .social-btn::after {
                    content: "";
                    position: absolute;
                    inset: 1px;
                    border-radius: inherit;
                    background: radial-gradient(120% 120% at 20% 0%,
                      rgba(77, 187, 144, 0.18),
                      rgba(47, 116, 230, 0.18) 40%,
                      rgba(0, 0, 0, 0) 70%);
                    opacity: 0.5;
                    z-index: 0;
                    transition: opacity 220ms ease;
                  }

                  /* Icon */
                  .icon {
                    font-size: 18px;
                    display: block;
                    z-index: 1;
                    color: var(--g1);
                    transition: transform 220ms ease, color 220ms ease;
                  }

                  /* Hover/focus effects: scale, brighten, gradient ring visible */
                  .social-btn:hover,
                  .social-btn:focus-visible {
                    transform: translateY(-2px) scale(1.05);
                    box-shadow:
                      0 6px 16px rgba(0, 0, 0, 0.2),
                      inset 0 0 0 1px rgba(255, 255, 255, 0.06);
                  }

                  .social-btn:hover::before,
                  .social-btn:focus-visible::before {
                    opacity: 0.6;
                    filter: blur(12px);
                  }

                  .social-btn:hover::after,
                  .social-btn:focus-visible::after {
                    opacity: 0.7;
                  }

                  .social-btn:hover .icon,
                  .social-btn:focus-visible .icon {
                    color: #ffffff;
                  }

                  .social-btn:active {
                    transform: translateY(0) scale(0.98);
                    box-shadow:
                      0 3px 10px rgba(0, 0, 0, 0.18),
                      inset 0 0 0 1px rgba(255, 255, 255, 0.08);
                  }

                  /* Optional color variants per network (keeps your green/blue vibe while hinting brand) */
                  .social-btn:nth-child(1) { --g1:#4dbb90; --g2:#2f74e6; } /* Facebook */
                  .social-btn:nth-child(2) { --g1:#e1306c; --g2:#f7b733; } /* Instagram vibe */
                  .social-btn:nth-child(3) { --g1:#1da1f2; --g2:#4dbb90; } /* X/Twitter */
                  .social-btn:nth-child(4) { --g1:#0a66c2; --g2:#4dbb90; } /* LinkedIn */

                  /* Reduced motion accessibility */
                  @media (prefers-reduced-motion: reduce) {
                    .social-btn,
                    .icon,
                    .social-btn::before,
                    .social-btn::after {
                      transition: none;
                    }
                    .social-btn:hover,
                    .social-btn:focus-visible {
                      transform: none;
                    }
                  }
                </style>
            </div>

            <div class="relative flex w-full justify-center lg:w-auto mt-12 lg:mt-32">
                <div class="absolute -inset-10 rounded-full bg-maklos-100 blur-3xl"></div>
                <div
                    x-data="heroCarousel({ slides: @js($slides), interval: 5000 })"
                    x-init="start()"
                    @mouseenter="stop()"
                    @mouseleave="start()"
                    class="js-hero-carousel relative flex h-[560px] w-full max-w-2xl items-center justify-center"
                >
                    <template x-for="(slide, index) in slides" :key="index">
                        <figure
                            @click="goTo(index)"
                            class="js-hero-carousel-item hero-carousel-card absolute flex h-[520px] w-96 flex-col overflow-hidden rounded-[3.5rem] border border-white/60 bg-white shadow-2xl transition-all duration-700 ease-out cursor-pointer"
                            :class="classes(index)"
                            :style="classes(index).includes('opacity-0') ? 'visibility:hidden;' : 'visibility:visible;'"
                        >
                            <div class="relative h-[380px] overflow-hidden">
                                <img
                                    :src="slideImage(slide)"
                                    :alt="slideTitle(slide)"
                                    class="h-full w-full object-cover"
                                />
                            </div>
                            <figcaption class="flex flex-1 flex-col gap-3 px-8 py-6">
                                <h3 class="font-display text-2xl text-charcoal" x-text="slideTitle(slide)"></h3>
                                <p class="text-base text-charcoal/60" x-text="slideCaption(slide)"></p>
                            </figcaption>
                        </figure>
                    </template>

                    <div class="absolute -bottom-16 flex items-center gap-4">
                        <template x-for="(slide, index) in slides" :key="`indicator-${index}`">
                            <button
                                type="button"
                                class="h-3 rounded-full transition-all duration-300"
                                :class="indicatorClasses(index)"
                                @click="current = index"
                                :aria-label="`Show slide ${index + 1}`"
                            ></button>
                        </template>
                    </div>
                </div>
            </div>

            {{-- Shape divider directly under the carousel to reduce gap --}}
            <div class="mt-6 w-full lg:col-span-2">
                @include('partials.shape-divider')
            </div>
        </div>
    </div>

    {{-- Removed bottom wave divider to eliminate extra gap --}}
</section>
