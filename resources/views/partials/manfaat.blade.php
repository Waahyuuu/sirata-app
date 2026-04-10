<section id="manfaat" class="py-24 bg-white px-4">

    <div class="max-w-6xl mx-auto text-center">

        <h2 class="text-2xl font-bold mb-16">
            Manfaat SIRATA Bagi Orang Tua
        </h2>

        <!-- GRID -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-10">

            @forelse($manfaats as $manfaat)

                <div class="bg-white rounded-2xl p-8 w-full flex flex-col items-center text-center
                    hover:shadow-xl
                    transition-all duration-300 hover:-translate-y-3">

                    <!-- ICON -->
                    <div class="w-24 h-24 flex items-center justify-center mb-6 text-blue-500">

                        @if(Str::contains($manfaat->icon,'<svg')) {!! $manfaat->icon !!}
                            @else
                            <img src="{{ asset('storage/'.$manfaat->icon) }}" class="w-24 h-24 object-contain">
                            @endif

                    </div>

                    <!-- TITLE -->
                    <p class="font-semibold text-gray-800 mb-2 text-lg">
                        {{ $manfaat->title }}
                    </p>

                    <!-- DESCRIPTION -->
                    <p class="text-gray-500 text-sm">
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