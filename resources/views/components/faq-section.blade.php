<section id="faq" class="scroll-mt-24 bg-white py-12 lg:py-24 text-charcoal">
    <div class="relative z-20 mx-auto max-w-5xl px-4 sm:px-6">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500">FAQ</p>
        <h2 class="mt-4 font-display text-3xl text-charcoal sm:text-4xl">Answers for quick decision-making</h2>
        <div class="mt-8 lg:mt-10 space-y-4 lg:space-y-6">
            @foreach ($faqItems as $index => $faq)
                <article x-data="{ open: false }"
                    class="rounded-2xl lg:rounded-3xl border border-maklos-100 bg-white overflow-hidden shadow-sm transition hover:border-maklos-200 hover:shadow-md">

                    {{-- Question - Always visible, clickable on mobile --}}
                    {{-- Question - Clickable to toggle --}}
                    <button @click="open = !open"
                        class="w-full px-4 py-4 lg:px-6 lg:py-5 text-left flex items-center justify-between gap-4 cursor-pointer">
                        <h3 class="font-display text-lg lg:text-xl text-charcoal flex-1">{{ $faq['question'] }}</h3>

                        {{-- Chevron icon --}}
                        <svg class="w-5 h-5 text-maklos-500 transition-transform duration-300 flex-shrink-0"
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
</section>