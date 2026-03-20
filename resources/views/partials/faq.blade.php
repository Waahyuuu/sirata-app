<section id="faq" class="py-24 bg-white px-6">

    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-start">

        <!-- Kiri -->
        <div class="text-center flex flex-col items-center">

            <h2 class="text-3xl font-bold mb-8">
                Frequently Asked Questions
            </h2>

            <img src="{{ asset('images/undraw_faq_pgxi.svg') }}" alt="FAQ Image" class="w-full max-w-md">

        </div>

        <!-- Kanan -->
        <div class="space-y-4" id="faqContainer">

            @forelse($faqs as $faq)
            <div class="faq-item border rounded-xl bg-white shadow-sm">

                <button class="faq-question w-full flex justify-between items-center p-4 font-semibold">
                    {{ $faq->question }}
                    <span class="faq-icon transition-transform duration-300">▼</span>
                </button>

                <div class="faq-content px-4 text-gray-600">
                    <div class="pb-4">
                        {{ $faq->answer }}
                    </div>
                </div>

            </div>
            @empty
            <p class="text-gray-400 italic">Belum ada FAQ yang disetting</p>
            @endforelse

        </div>

    </div>

    </div>

</section>