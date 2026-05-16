<section id="manfaat" class="py-24 bg-white px-4">

    <div class="max-w-6xl mx-auto text-center">

        <div class="max-w-5xl mx-auto text-center mb-16 px-4">

            <div class="flex justify-center mb-4">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-[var(--primary-color)] bg-white">

                    <span class="w-2 h-2 rounded-full bg-[var(--primary-color)]"></span>

                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.18em] text-[var(--text-dark)]">
                        Manfaat
                    </span>
                </div>
            </div>

            <h1
                class="text-2xl md:text-3xl lg:text-4xl font-bold mb-6 tracking-tight text-[var(--text-dark)] leading-tight">
                Wujudkan Transparansi Akademik dengan SIRATA.
            </h1>

            <p class="max-w-3xl mx-auto text-base md:text-lg text-gray-600 leading-relaxed">
                Jembatan informasi antara kampus dan orang tua untuk mengawal efektivitas studi mahasiswa secara
                berkelanjutan dan akurat.
            </p>

        </div>

        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($manfaats as $manfaat)

            <!-- CARD -->
            <div class="bg-white rounded-2xl p-8 w-full flex flex-col items-center text-center
                    transition-all duration-300 hover:-translate-y-3 hover:shadow-[var(--shadow-primary)]">

                <!-- ICON -->
                <div class="w-40 h-40 flex items-center justify-center mb-6">

                    @if(Str::contains($manfaat->icon,'<svg')) {!! $manfaat->icon !!}
                        @else
                        <img src="{{ asset('storage/'.$manfaat->icon) }}" class="w-40 h-40 object-contain">
                        @endif

                </div>

                <!-- TITLE -->
                <p class="font-semibold text-[var(--text-dark)] mb-2 text-lg break-words w-full">
                    {{ $manfaat->title }}
                </p>

                <!-- DESCRIPTION -->
                <p class="text-gray-500 text-md break-words w-full leading-relaxed">
                    {{ $manfaat->description }}
                </p>

            </div>

            @empty

            <p class="text-gray-400 italic col-span-3">
                Belum ada manfaat
            </p>

            @endforelse

        </div>

    </div>

</section>