<section id="faq" class="py-24 bg-white px-6">

    <div class="max-w-6xl mx-auto grid md:grid-cols-2 gap-12 items-start">

        <!-- Left -->
        <div class="text-center flex flex-col items-center md:sticky md:top-24">

            <!-- Title -->
            <h1
                class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6 tracking-tight text-[var(--text-dark)] leading-tight">
                Frequently Asked Questions
            </h1>

            <!-- Description -->
            <p class="text-gray-600 mx-auto text-base md:text-lg max-w-lg mb-8 leading-relaxed">
                Temukan jawaban dari pertanyaan yang sering ditanyakan mengenai penggunaan aplikasi SIRATA.
            </p>

            <!-- Image -->
            <img src="{{ asset('images/FAQ.svg') }}" alt="FAQ Image" class="w-full max-w-md">

        </div>

        <!-- Right -->
        <div class="space-y-4" id="faqContainer">

            @forelse($faqs as $faq)

            <div
                class="faq-item bg-white border border-[var(--border-color)] rounded-2xl overflow-hidden transition-all duration-300 hover:shadow-[var(--shadow-primary)]">

                <!-- Question -->
                <button
                    class="faq-question bg-[var(--bg-light)] w-full flex justify-between items-center p-5 text-left font-semibold text-[var(--text-dark)]">

                    {{ $faq->question }}

                    <span class="faq-icon transition-transform duration-300 text-[var(--primary-color)]">
                        ▼
                    </span>
                </button>

                <!-- Answer -->
                <div class="faq-content px-5 text-gray-600">
                    <div class="pb-5 pt-4 leading-relaxed">
                        {{ $faq->answer }}
                    </div>
                </div>

            </div>

            @empty

            <p class="text-gray-400 italic">
                Belum ada FAQ yang disetting
            </p>

            @endforelse

        </div>

    </div>

</section>