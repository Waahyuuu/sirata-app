<div class="space-y-6" x-data="{ showInfo: false }">

    <!-- JADWAL HARI INI -->
    <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">

        <div class="flex items-center justify-between mb-5 pb-4 border-b" style="border-color: #ffd180;">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 20H6a4 4 0 0 1-4-4V7a4 4 0 0 1 4-4h11a4 4 0 0 1 4 4v3M8 2v2m7-2v2M2 8h19m-2.5 7.643l-1.5 1.5" />
                        <circle cx="17" cy="17" r="5" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg" style="color: #2d2d2d;">Jadwal Hari Ini</h2>
                    <p class="text-sm" style="color: #6b7280;">{{ $tanggalHariIni }}</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

            @forelse ($jadwalHariIni as $item)
            <div class="bg-[#fff8f0] border rounded-xl p-4 transition-all duration-200 hover:bg-white hover:border-[#ff6900] hover:shadow-md cursor-pointer"
                style="border-color: #ffd180;">
                <div class="flex items-start justify-between mb-2">
                    <p class="font-semibold text-sm" style="color: #2d2d2d;">
                        {{ $item['nama'] }}
                    </p>
                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium"
                        style="background-color: #fff5e9; color: #ff6900; border: 1px solid #ffd180;">
                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $item['jam'] }}
                    </span>
                </div>

                <div class="space-y-1.5">
                    <p class="text-xs flex items-center gap-1.5" style="color: #6b7280;">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: #ffd180;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Ruangan: {{ $item['ruangan'] }}
                    </p>

                    <p class="text-xs flex items-center gap-1.5" style="color: #6b7280;">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: #ffd180;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        {{ $item['dosen'] }}
                    </p>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="bg-[#fff8f0] border rounded-xl p-6 text-center" style="border-color: #ffd180;">
                    <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-sm" style="color: #6b7280;">Tidak ada jadwal hari ini</p>
                </div>
            </div>
            @endforelse

        </div>
    </div>

    <!-- JADWAL PER HARI -->
    <div class="bg-white rounded-2xl border p-6 shadow-sm relative" style="border-color: #ffd180;">

        @php
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        @endphp

        <div class="flex items-center justify-between mb-5 pb-4 border-b" style="border-color: #ffd180;">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg" style="color: #2d2d2d;">Daftar Jadwal</h2>
                </div>
            </div>
        </div>

        @foreach ($hari as $h)
        <div class="mb-6 last:mb-0">
            <h3 class="font-semibold text-sm mb-3" style="color: #2d2d2d;">
                {{ $h }}
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">

                @forelse ($jadwal[$h] ?? [] as $item)
                <div class="bg-[#fff8f0] border rounded-xl p-4 transition-all duration-200 hover:bg-white hover:border-[#ff6900] hover:shadow-md"
                    style="border-color: #ffd180;">
                    <div class="flex items-start justify-between mb-2">
                        <p class="font-semibold text-sm" style="color: #2d2d2d;">
                            {{ $item['nama'] }}
                        </p>
                        <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium"
                            style="background-color: #fff5e9; color: #ff6900; border: 1px solid #ffd180;">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ $item['jam'] }}
                        </span>
                    </div>

                    <div class="space-y-1.5">
                        <p class="text-xs flex items-center gap-1.5" style="color: #6b7280;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="color: #ff6900;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            Ruangan: {{ $item['ruangan'] }}
                        </p>

                        <p class="text-xs flex items-center gap-1.5" style="color: #6b7280;">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="color: #ff6900;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            {{ $item['dosen'] }}
                        </p>
                    </div>
                </div>
                @empty
                <div class="col-span-full">
                    <div class="bg-[#fff8f0] border rounded-xl p-4 text-center" style="border-color: #ffd180;">
                        <p class="text-sm" style="color: #6b7280;">Tidak ada jadwal</p>
                    </div>
                </div>
                @endforelse

            </div>
        </div>
        @endforeach

        <!-- INFO BUTTON -->
        <div class="absolute top-6 right-6">
            <button @click="showInfo = !showInfo"
                class="w-8 h-8 flex items-center justify-center rounded-full shadow transition-all duration-200 hover:scale-110"
                style="background: linear-gradient(135deg, #ff6900, #f54a00); color: white;">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
        </div>

        <!-- POPUP -->
        <div x-show="showInfo" @click.outside="showInfo = false" x-transition
            class="absolute top-16 right-6 bg-white border shadow-lg rounded-2xl p-4 w-72 text-sm z-50"
            style="border-color: #ffd180;">

            <div class="flex items-start gap-3">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0"
                    style="background-color: #fff5e9;">
                    <svg class="w-4 h-4" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <p class="font-semibold mb-1" style="color: #2d2d2d;">Informasi Jadwal</p>
                    <p class="leading-relaxed" style="color: #6b7280;">
                        Jadwal ini merupakan jadwal kuliah aktif semester berjalan. Perubahan bisa terjadi tergantung
                        Dosen-nya.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>