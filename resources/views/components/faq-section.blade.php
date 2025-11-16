<section id="faq" class="bg-white py-24 text-charcoal">
    <div class="mx-auto max-w-5xl px-6">
        <p class="text-sm font-semibold uppercase tracking-[0.3em] text-maklos-500">FAQ</p>
        <h2 class="mt-4 font-display text-3xl text-charcoal sm:text-4xl">Answers for quick decision-making</h2>
        <div class="mt-10 space-y-6">
            @foreach ([
                ['question' => 'Do you offer private labeling?', 'answer' => 'Yes, we collaborate with retailers to create custom packages and fragrances aligned with brand guidelines.'],
                ['question' => 'How soon can we receive a product catalog?', 'answer' => 'Catalogs and samples are available upon request—contact us via WhatsApp or email for tailored selections.'],
                ['question' => 'What logistics support is available?', 'answer' => 'We ship nationwide with reliable distributors and can coordinate recurring delivery schedules.'],
            ] as $faq)
                <article class="rounded-3xl border border-maklos-100 bg-white px-6 py-5 shadow-sm transition hover:border-maklos-200 hover:shadow-md">
                    <h3 class="font-display text-xl text-charcoal">{{ $faq['question'] }}</h3>
                    <p class="mt-2 text-sm text-charcoal/70">{{ $faq['answer'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>