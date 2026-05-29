<div class="w-20 lg:w-72 mt-6 bg-[#BFC3C9] rounded-r-[30px] flex flex-col justify-between overflow-hidden">

    <div>

        <!-- Profile -->
        <div class="p-4 lg:p-6">
            <div class="flex items-center gap-3 mb-5">

                <!-- Avatar -->
                <div
                    class="w-12 h-12 flex-shrink-0 flex items-center justify-center rounded-full bg-slate-700 text-white font-bold text-lg shadow-sm">
                    {{ $initial }}
                </div>

                <!-- Info -->
                <div class="hidden lg:block leading-tight">
                    <div class="font-bold text-md text-slate-800 capitalize">
                        {{ $nama }}
                    </div>

                    <div class="text-sm font-medium text-gray-500">
                        NIM : {{ $nim }}
                    </div>
                </div>

            </div>
        </div>

        <div class="space-y-3">

            <!-- Dashboard -->
            <a href="/mahasiswa/dashboard" class="menu-item {{ request()->is('mahasiswa/dashboard') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M8.557 2.75H4.682A1.93 1.93 0 0 0 2.75 4.682v3.875a1.94 1.94 0 0 0 1.932 1.942h3.875a1.94 1.94 0 0 0 1.942-1.942V4.682A1.94 1.94 0 0 0 8.557 2.75m10.761 0h-3.875a1.94 1.94 0 0 0-1.942 1.932v3.875a1.943 1.943 0 0 0 1.942 1.942h3.875a1.94 1.94 0 0 0 1.932-1.942V4.682a1.93 1.93 0 0 0-1.932-1.932M8.557 13.5H4.682a1.943 1.943 0 0 0-1.932 1.943v3.875a1.93 1.93 0 0 0 1.932 1.932h3.875a1.94 1.94 0 0 0 1.942-1.932v-3.875a1.94 1.94 0 0 0-1.942-1.942m8.818-.001a3.875 3.875 0 1 0 0 7.75a3.875 3.875 0 0 0 0-7.75" />
                </svg>

                <span class="lg:inline">Dashboard</span>
            </a>

            <!-- Biodata -->
            <a href="/mahasiswa/biodata" class="menu-item {{ request()->is('mahasiswa/biodata') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                    <path fill="currentColor" stroke-width="2"
                        d="M8 8.5c3.85 0 7 2.5 7 4.5a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2c0-2 3.15-4.5 7-4.5M8 10c-1.61 0-3.064.526-4.092 1.234C2.798 12.001 2.5 12.733 2.5 13a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5c0-.267-.297-1-1.408-1.766C11.064 10.526 9.609 10 8 10m0-9a3.5 3.5 0 1 1 0 7a3.5 3.5 0 0 1 0-7m0 1.5a2 2 0 1 0 0 4a2 2 0 0 0 0-4" />
                </svg>

                <span>Biodata Mahasiswa</span>
            </a>

            <!-- Hasil Studi -->
            <a href="/mahasiswa/hasil-studi"
                class="menu-item {{ request()->is('mahasiswa/hasil-studi') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2.2">
                        <path d="m2 14l6-6l4 4l9-9" />
                        <path d="M15 3h6v6m-6 12h6v-6m0 6l-6-6" />
                    </g>
                </svg>

                <span class="lg:inline">Hasil Studi</span>
            </a>

            <!-- Nilai Prestasi -->
            <a href="/mahasiswa/nilai-prestasi-akademik"
                class="menu-item {{ request()->is('mahasiswa/nilai-prestasi-akademik') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M20 3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2m0 5.25H10V5h10zm-10 2h10v3.5H10zm-2 3.5H4v-3.5h4zM8 5v3.25H4V5zM4 19v-3.25h4V19zm6 0v-3.25h10V19z" />
                </svg>

                <span class="lg:inline">Nilai Prestasi Akademik</span>
            </a>

            <!-- Jadwal -->
            <a href="/mahasiswa/jadwal" class="menu-item {{ request()->is('mahasiswa/jadwal') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2.2">
                        <path
                            d="M16 14v2.2l1.6 1M16 2v4m5 1.5V6a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h3.5M3 10h5m0-8v4" />
                        <circle cx="16" cy="16" r="6" />
                    </g>
                </svg>

                <span class="lg:inline">Jadwal Kuliah</span>
            </a>

            <!-- Kehadiran -->
            <a href="/mahasiswa/kehadiran" class="menu-item">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2.2">
                        <path d="M8 2v4m8-4v4" />
                        <rect width="18" height="18" x="3" y="4" rx="2" />
                        <path d="M3 10h18M9 16l2 2l4-4" />
                    </g>
                </svg>

                <span class="lg:inline">Kehadiran</span>
            </a>

            <!-- UKT -->
            <a href="/mahasiswa/spp" class="menu-item">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16">
                    <path fill="currentColor"
                        d="M4.75 2A1.75 1.75 0 0 0 3 3.75V8h1V3.75A.75.75 0 0 1 4.75 3h5.5a.75.75 0 0 1 .75.75v9.75q0 .257-.05.5h1.55a2.5 2.5 0 0 0 2.5-2.5V10h-3V3.75A1.75 1.75 0 0 0 10.25 2zM8.5 8c.34 0 .666.068.962.192A.5.5 0 0 0 9 7.5H6a.5.5 0 0 0-.5.5zm3.5 3h2v.5a1.5 1.5 0 0 1-1.5 1.5H12zM5.5 5.5A.5.5 0 0 1 6 5h3a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5m4.5 5A1.5 1.5 0 0 0 8.5 9h-6A1.5 1.5 0 0 0 1 10.5v3A1.5 1.5 0 0 0 2.5 15h6a1.5 1.5 0 0 0 1.5-1.5zm-1 2v1a.5.5 0 0 0-.5.5h-1A1.5 1.5 0 0 1 9 12.5M8.5 10a.5.5 0 0 0 .5.5v1A1.5 1.5 0 0 1 7.5 10zm-6.5.5a.5.5 0 0 0 .5-.5h1A1.5 1.5 0 0 1 2 11.5zm.5 3.5a.5.5 0 0 0-.5-.5v-1A1.5 1.5 0 0 1 3.5 14zM4 12a1.5 1.5 0 1 1 3 0a1.5 1.5 0 0 1-3 0"
                        stroke-width="0.4" stroke="currentColor" />
                </svg>

                <span class="lg:inline">UKT</span>
            </a>

        </div>
    </div>

    <!-- LOGOUT -->
    <div class="mb-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item w-full text-left flex items-center gap-2">

                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2.2"
                        d="M16 4h3a2 2 0 0 1 2 2v1m-5 13h3a2 2 0 0 0 2-2v-1M4.425 19.428l6 1.8A2 2 0 0 0 13 19.312V4.688a2 2 0 0 0-2.575-1.916l-6 1.8A2 2 0 0 0 3 6.488v11.024a2 2 0 0 0 1.425 1.916M16.001 12h5m0 0l-2-2m2 2l-2 2" />
                </svg>

                <span>Keluar</span>
            </button>
        </form>
    </div>

</div>