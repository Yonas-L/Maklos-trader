<section id="faq" class="scroll-mt-24 bg-white py-12 lg:py-24 text-charcoal relative z-30">
    <div class="relative z-20 mx-auto max-w-5xl px-4 sm:px-6">
        {{-- Header matching Manufacturing section style --}}
        <div class="text-center mb-8 lg:mb-10">
            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight" style="color: #0d9488;">FAQ</h2>
        </div>
        <div class="mt-8 lg:mt-10 space-y-4 lg:space-y-6">
            @foreach ($faqItems as $index => $faq)
                <article x-data="{ open: false }"
                    class="faq-card rounded-2xl lg:rounded-3xl border border-maklos-100 bg-white overflow-hidden shadow-sm transition hover:border-maklos-200 hover:shadow-md relative">

                    {{-- Question - Clickable to toggle --}}
                    <button type="button" @click.stop="open = !open"
                        class="faq-button w-full min-h-[56px] px-4 py-4 lg:px-6 lg:py-5 text-left flex items-center justify-between gap-4 cursor-pointer relative z-10 select-none active:bg-slate-50">
                        <h3 class="font-display text-lg lg:text-xl text-charcoal flex-1">{{ $faq['question'] }}</h3>

                        {{-- Chevron icon --}}
                        <svg class="w-5 h-5 text-maklos-500 transition-transform duration-300 flex-shrink-0 pointer-events-none"
                            :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    {{-- Answer - Collapsed by default, toggled open --}}
                    <div x-show="open" x-collapse.duration.300ms class="px-4 pb-4 lg:px-6 lg:pb-5 lg:pt-0">
                        <p class="text-sm text-charcoal/70 leading-relaxed">{{ $faq['answer'] }}</p>
                    </div>
                </article>
            @endforeach
        </div>
    </div>

    <style>
        /* Mobile touch optimization */
        .faq-button {
            -webkit-tap-highlight-color: transparent;
            touch-action: manipulation;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            user-select: none;
        }

        .faq-card {
            isolation: isolate;
        }
    </style>
</section>