<div class="space-y-6" x-data="{ showInfo: false }">

    <!-- JADWAL HARI INI -->
    <div class="bg-gray-100 rounded-3xl p-6">

        <h2 class="font-semibold">
            Jadwal Hari Ini
        </h2>

        <p class="text-sm text-gray-500 mb-3">
            {{ $tanggalHariIni }}
        </p>

        <hr class="mb-3">

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

            @forelse ($jadwalHariIni as $item)
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <p class="font-semibold">
                    {{ $item['nama'] }}
                </p>

                <p class="text-sm text-gray-500">
                    {{ $item['jam'] }}
                </p>

                <p class="text-xs text-gray-400 mt-2">
                    Ruangan:
                    {{ $item['ruangan'] }}
                </p>

                <p class="text-xs text-gray-400">
                    {{ $item['dosen'] }}
                </p>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-white rounded-xl p-4 text-center text-gray-500">
                    Tidak ada jadwal hari ini
                </div>
            </div>
            @endforelse

        </div>
    </div>

    <!-- JADWAL PER HARI -->
    <div class="bg-gray-100 rounded-3xl p-6 relative">

        @php
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        @endphp

        @foreach ($hari as $h)
        <div class="mb-6">
            <h2 class="font-semibold mb-2">
                Jadwal {{ $h }}
            </h2>

            <hr class="mb-3">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                @forelse ($jadwal[$h] ?? [] as $item)
                <div class="bg-white rounded-xl p-4 shadow-sm">
                    <p class="font-semibold">
                        {{ $item['nama'] }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $item['jam'] }}
                    </p>

                    <p class="text-xs text-gray-400 mt-2">
                        Ruangan:
                        {{ $item['ruangan'] }}
                    </p>

                    <p class="text-xs text-gray-400">
                        {{ $item['dosen'] }}
                    </p>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="bg-white rounded-xl p-4 text-center text-gray-500">
                        Tidak ada jadwal
                    </div>
                </div>
                @endforelse

            </div>
        </div>
        @endforeach

        <!-- INFO -->
        <div class="absolute bottom-3 right-8">
            <button @click="showInfo = !showInfo"
                class="w-6 h-6 flex items-center justify-center bg-blue-500 text-white rounded-full shadow">
                !
            </button>
        </div>

        <!-- POPUP -->
        <div x-show="showInfo" @click.outside="showInfo = false" x-transition
            class="absolute bottom-14 right-8 bg-white border shadow-lg rounded-xl p-4 w-64 text-sm">

            <p class="font-semibold mb-1">
                Informasi Jadwal
            </p>

            <p class="text-gray-600">
                Jadwal ini merupakan jadwal kuliah aktif semester berjalan.
                Silakan cek perubahan jadwal secara berkala.
            </p>
        </div>
    </div>

</div>