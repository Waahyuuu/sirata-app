<div class="w-72 mt-6 bg-[#BFC3C9] rounded-r-[30px] flex flex-col justify-between overflow-hidden">

    <div>

        <!-- Profile -->
        <div class="p-6">
            <div class="flex items-center gap-3 mb-5">

                <!-- Avatar -->
                <div
                    class="w-12 h-12 flex items-center justify-center rounded-full bg-slate-700 text-white font-bold text-lg shadow-sm">
                    {{ $initial }}
                </div>

                <!-- Info -->
                <div class="leading-tight">
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
                <span>Dashboard</span>
            </a>

            <!-- Biodata -->
            <a href="/mahasiswa/biodata" class="menu-item {{ request()->is('mahasiswa/biodata') ? 'active' : '' }}">
                <span>Biodata Mahasiswa</span>
            </a>

            <!-- Hasil Studi -->
            <a href="/mahasiswa/hasil-studi"
                class="menu-item {{ request()->is('mahasiswa/hasil-studi') ? 'active' : '' }}">
                <span>Hasil Studi</span>
            </a>

            <!-- Nilai Prestasi -->
            <a href="/mahasiswa/nilai-prestasi-akademik"
                class="menu-item {{ request()->is('mahasiswa/nilai-prestasi-akademik') ? 'active' : '' }}">
                <span>Nilai Prestasi Akademik</span>
            </a>

            <!-- Jadwal -->
            <a href="/mahasiswa/jadwal" class="menu-item {{ request()->is('mahasiswa/jadwal') ? 'active' : '' }}">
                <span>Jadwal Kuliah</span>
            </a>

            <!-- Kehadiran -->
            <a href="#" class="menu-item">
                <span>Kehadiran</span>
            </a>

            <!-- UKT -->
            <a href="#" class="menu-item">
                <span>UKT</span>
            </a>

        </div>
    </div>

    <!-- LOGOUT -->
    <div class="mb-6">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item w-full text-left flex items-center gap-2">
                <span>Keluar</span>
            </button>
        </form>
    </div>

</div>