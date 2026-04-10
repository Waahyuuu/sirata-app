<section id="manfaat" class="py-24 bg-white px-4">

    <div class="max-w-6xl mx-auto text-center">

        <h2 class="text-2xl font-bold mb-16">
            Manfaat SIRATA Bagi Orang Tua
        </h2>

        <div class="swiper manfaatSwiper relative">

            <div class="swiper-wrapper items-stretch flex">

                @forelse($manfaats as $manfaat)

                <div class="swiper-slide h-full flex">

                    <div
                        class="bg-gray-100 rounded-2xl p-6 min-h-[260px] flex flex-col items-center justify-center text-center transform transition-all duration-300 hover:-translate-y-3 w-full">
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
                        <p class="text-gray-500 text-sm line-clamp-3">
                            {{ $manfaat->description }}
                        </p>

                    </div>

                </div>

                @empty

                <p class="text-gray-400 italic">Belum ada manfaat</p>

                @endforelse

            </div>

            <div class="swiper-button-next !text-gray-700"></div>
            <div class="swiper-button-prev !text-gray-700"></div>

        </div>

    </div>

</section>