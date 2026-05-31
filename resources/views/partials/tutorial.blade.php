<section class="relative py-20 md:py-28 overflow-hidden">

    {{-- Background Blur --}}
    <div class="absolute top-0 left-0 w-72 md:w-96 h-72 md:h-96 bg-orange-300/20 blur-[120px] rounded-full"></div>
    <div
        class="absolute bottom-0 right-0 w-[280px] md:w-[500px] h-[280px] md:h-[500px] bg-amber-200/20 blur-[140px] rounded-full">
    </div>

    <div class="max-w-6xl mx-auto px-4 relative z-10">

        {{-- Heading --}}
        <div class="text-center mb-12 md:mb-16">

            <div class="flex justify-center mb-4">
                <div
                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg border border-[var(--primary-color)] bg-white">

                    <span class="w-2 h-2 rounded-full bg-[var(--primary-color)]"></span>

                    <span class="text-[10px] md:text-xs font-bold uppercase tracking-[0.18em] text-[var(--text-dark)]">
                        Tutorial
                    </span>
                </div>
            </div>

            <h2 class="text-3xl md:text-5xl font-extrabold text-slate-800 mb-5 leading-tight">
                Tutorial
                <span class="text-orange-500">
                    SIRATA
                </span>
            </h2>

            <p class="text-slate-500 max-w-2xl mx-auto text-base md:text-lg">
                Ikuti langkah berikut untuk mengakses Sistem
                Rapor STIMATA dengan mudah dan cepat.
            </p>
        </div>

        @php
        $steps = [
        [
        'title' => 'Bantuan NIM',
        'subtitle' => 'Hubungi Chat Bantuan',
        'desc' =>
        'Jika Nomor Induk Mahasiswa (NIM) belum diketahui, gunakan chat bantuan untuk meminta informasi NIM mahasiswa.',
        'type' => 'chat',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="18px" height="18px" viewBox="0 0 12 12">
            <path d="M0 0h12v12H0z" fill="none" />
            <path fill="currentColor"
                d="M1 6a5 5 0 1 1 2.59 4.382l-1.944.592a.5.5 0 0 1-.624-.624l.592-1.947A5 5 0 0 1 1 6m3-.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5M4.5 7a.5.5 0 0 0 0 1h2a.5.5 0 0 0 0-1z" />
        </svg>
        ',
        ],
        [
        'title' => 'Akses Informasi',
        'subtitle' => 'Lengkapi Formulir',
        'desc' =>
        'Lengkapi form akses informasi sesuai data mahasiswa.',
        'type' => 'form',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 28 28">
            <path d="M0 0h28v28H0z" fill="none" />
            <path fill="currentColor"
                d="M8.5 11.5a1 1 0 1 0 0 2a1 1 0 0 0 0-2m-1 8a1 1 0 1 1 2 0a1 1 0 0 1-2 0M3 6.75A3.75 3.75 0 0 1 6.75 3h14.5A3.75 3.75 0 0 1 25 6.75v14.5A3.75 3.75 0 0 1 21.25 25H6.75A3.75 3.75 0 0 1 3 21.25zm3 5.75a2.5 2.5 0 1 0 5 0a2.5 2.5 0 0 0-5 0M8.5 17a2.5 2.5 0 1 0 0 5a2.5 2.5 0 0 0 0-5m4.5-4.75c0 .414.336.75.75.75h7.5a.75.75 0 0 0 0-1.5h-7.5a.75.75 0 0 0-.75.75m.75 6.25a.75.75 0 0 0 0 1.5h7.5a.75.75 0 0 0 0-1.5zM6 6.75c0 .414.336.75.75.75h14.5a.75.75 0 0 0 0-1.5H6.75a.75.75 0 0 0-.75.75" />
        </svg>
        ',
        ],
        [
        'title' => 'Cari Informasi',
        'subtitle' => 'Tunggu Sistem Memproses',
        'desc' =>
        'Klik tombol cari informasi lalu tunggu sistem memproses data.',
        'type' => 'loading',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" viewBox="0 0 80 80">
            <path d="M0 0h80v80H0z" fill="none" />
            <path fill="currentColor" fill-rule="evenodd"
                d="M13.578 30.724a24.249 24.249 0 1 1 46.844 12.552a24.249 24.249 0 0 1-46.844-12.552m38.51 25.259l12.573 12.572a3 3 0 1 0 4.242-4.243L56.288 51.697a24.3 24.3 0 0 1-4.2 4.286M36.996 19.278a17.72 17.72 0 0 0-17.717 17.719a3 3 0 0 0 6 0a11.72 11.72 0 0 1 11.718-11.72a3 3 0 1 0 0-6"
                clip-rule="evenodd" />
        </svg>
        ',
        ],
        [
        'title' => 'Dashboard',
        'subtitle' => 'Berhasil Masuk Sistem',
        'desc' =>
        'Jika data berhasil ditemukan, Anda akan diarahkan ke dashboard.',
        'type' => 'dashboard',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 12 12">
            <path d="M0 0h12v12H0z" fill="none" />
            <path fill="currentColor"
                d="M1 6a5 5 0 1 1 10 0A5 5 0 0 1 1 6m7.354-.896a.5.5 0 1 0-.708-.708L5.5 6.543L4.354 5.396a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
        </svg>
        ',
        ],
        ];
        @endphp

        <div x-data="{ step: 0, total: {{ count($steps) }} }" class="max-w-5xl mx-auto">

            {{-- Progress --}}
            <div class="mb-8 md:mb-10">

                <div class="flex justify-between text-sm text-slate-500 mb-3">
                    <span>
                        Langkah
                        <span x-text="step + 1"></span>
                    </span>

                    <span>
                        {{ count($steps) }} Langkah
                    </span>
                </div>

                <div class="h-2 bg-orange-100 rounded-full overflow-hidden">

                    <div class="h-full bg-orange-500 rounded-full transition-all duration-500"
                        :style="'width:' + ((step + 1) / total * 100) + '%'">
                    </div>

                </div>
            </div>

            @foreach ($steps as $index => $step)
            <div x-show="step === {{ $index }}" x-transition:enter="transition ease-out duration-500"
                x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0"
                class="group relative overflow-hidden rounded-[32px] md:rounded-[40px]
                    border border-white/50 bg-white/80 backdrop-blur-xl
                    shadow-[0_20px_60px_rgba(15,23,42,0.08)]">

                {{-- Glow --}}
                <div class="absolute -top-20 md:-top-32 -right-20 md:-right-32
                        w-56 md:w-72 h-56 md:h-72
                        bg-orange-300/20 blur-[90px] rounded-full">
                </div>

                <div class="relative z-10 p-5 md:p-10">

                    {{-- Header --}}
                    <div class="mb-6 flex items-center justify-between">

                        <div
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-orange-100 text-orange-600 font-semibold text-sm">

                            {!! $step['icon'] !!}
                            Step {{ $index + 1 }}
                        </div>

                        <div class="text-4xl md:text-6xl font-black text-orange-100">
                            0{{ $index + 1 }}
                        </div>

                    </div>

                    {{-- Content --}}
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">

                        {{-- Preview --}}
                        <div>

                            {{-- CHAT --}}
                            @if ($step['type'] == 'chat')
                            <div class="bg-slate-50 rounded-[28px] p-5 border border-slate-200">

                                <div class="space-y-4">

                                    <div class="flex justify-start">
                                        <div class="bg-white rounded-2xl px-4 py-3 shadow-sm max-w-[85%] text-sm">
                                            Halo 👋 Ada yang bisa kami bantu?
                                        </div>
                                    </div>

                                    <div class="flex justify-end">
                                        <div class="bg-orange-500 text-white rounded-2xl px-4 py-3 max-w-[85%] text-sm">
                                            Saya lupa NIM mahasiswa.
                                        </div>
                                    </div>

                                </div>

                            </div>
                            @endif

                            {{-- FORM --}}
                            @if ($step['type'] == 'form')
                            <div class="space-y-4">

                                <div
                                    class="h-14 rounded-2xl bg-slate-100 flex items-center px-4 text-slate-400 text-sm">
                                    Nama Ibu Kandung
                                </div>

                                <div
                                    class="h-14 rounded-2xl bg-slate-100 flex items-center px-4 text-slate-400 text-sm">
                                    DD/MM/YYYY
                                </div>

                                <div
                                    class="h-14 rounded-2xl bg-slate-100 flex items-center px-4 text-slate-400 text-sm">
                                    NIM Mahasiswa
                                </div>

                            </div>
                            @endif

                            {{-- LOADING --}}
                            @if ($step['type'] == 'loading')
                            <div class="flex flex-col items-center py-8 md:py-10">

                                <div class="w-16 md:w-20 h-16 md:h-20 border-[6px]
                                            border-orange-200 border-t-orange-500
                                            rounded-full animate-spin mb-5">
                                </div>

                                <h4 class="font-bold text-slate-800 text-lg md:text-xl">
                                    Mencari Data Mahasiswa...
                                </h4>

                            </div>
                            @endif

                            {{-- DASHBOARD --}}
                            @if ($step['type'] == 'dashboard')
                            <div class="grid grid-cols-2 gap-4">

                                <div class="bg-orange-50 rounded-2xl p-4 md:p-5">
                                    <p class="text-sm text-slate-500">
                                        Semester
                                    </p>

                                    <h4 class="text-xl md:text-2xl font-bold text-orange-500">
                                        4
                                    </h4>
                                </div>

                                <div class="bg-blue-50 rounded-2xl p-4 md:p-5">
                                    <p class="text-sm text-slate-500">
                                        Status
                                    </p>

                                    <h4 class="text-xl md:text-2xl font-bold text-blue-500">
                                        Aktif
                                    </h4>
                                </div>

                            </div>
                            @endif
                        </div>

                        {{-- Text --}}
                        <div class="text-center lg:text-left">

                            <span class="text-orange-500 font-bold uppercase tracking-[3px] text-xs md:text-sm">
                                {{ $step['subtitle'] }}
                            </span>

                            <h3 class="text-3xl md:text-4xl font-extrabold text-slate-800 mt-3 mb-5 leading-tight">
                                {{ $step['title'] }}
                            </h3>

                            <p class="text-slate-500 text-base md:text-lg leading-relaxed">
                                {{ $step['desc'] }}
                            </p>

                        </div>

                    </div>

                    {{-- Navigation --}}
                    <div class="flex justify-between items-center mt-10 gap-4">

                        <button x-show="step > 0" @click="step--"
                            class="flex-1 md:flex-none px-5 md:px-6 py-3 rounded-2xl border border-slate-200 hover:bg-slate-50 transition">

                            ← Sebelumnya
                        </button>

                        <button x-show="step < total - 1" @click="step++"
                            class="flex-1 md:flex-none px-5 md:px-6 py-3 rounded-2xl bg-orange-500 text-white hover:bg-orange-600 transition">

                            Selanjutnya →
                        </button>

                    </div>

                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>