<div class="space-y-6">

    <div class="bg-gray-100 rounded-3xl p-6 flex justify-between items-center">
        <div>
            <h2 class="text-xl font-semibold mb-2">Nama Mahasiswa</h2>
            <p class="text-gray-600">NIM : 16237163</p>
            <p class="text-gray-600">Nama Prodi - Prodi</p>
            <p class="text-gray-600">Semester Sekarang</p>
        </div>

        <div class="bg-white rounded-2xl border px-6 py-4 text-center shadow-sm">
            <p class="text-gray-500 text-sm">IPK Kumulatif</p>
            <h1 class="text-3xl font-bold">4.00</h1>
            <p class="text-xs text-gray-500">Dari 4.00</p>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-gray-100 p-5 rounded-2xl border">
            <p class="text-gray-500">Total SKS</p>
            <h1 class="text-2xl font-bold">100 SKS</h1>
            <p class="text-sm text-gray-500">Dari Total SKS</p>
        </div>

        <div class="bg-gray-100 p-5 rounded-2xl border">
            <p class="text-gray-500">IP Semester Sekarang</p>
            <h1 class="text-2xl font-bold">4.00</h1>
            <p class="text-sm text-gray-500">Dari Total SKS</p>
        </div>

        <div class="bg-gray-100 p-5 rounded-2xl border">
            <p class="text-gray-500">Kehadiran Semester ini</p>
            <h1 class="text-2xl font-bold">99%</h1>
            <p class="text-sm text-gray-500">Tidak ada cekal</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <div class="bg-gray-100 rounded-2xl border p-5">
            <h2 class="font-semibold mb-2">Mata Kuliah Semester Ini</h2>
            <p class="text-sm text-gray-500 mb-4">Total Matakuliah - Jumlah SKS</p>

            <div class="space-y-3">
                @for ($i = 0; $i < 7; $i++) <div class="bg-white border rounded-xl p-3">
                    <p class="font-medium">Nama Mata Kuliah</p>
                    <p class="text-sm text-gray-500">Nama Dosen - Jumlah SKS</p>
            </div>
            @endfor
        </div>
    </div>

    <div class="space-y-6">

        <!-- JADWAL -->
        <div class="bg-gray-100 rounded-2xl border p-5">
            <h2 class="font-semibold">Jadwal Hari Ini</h2>
            <p class="text-sm text-gray-500 mb-4">Rabu, 00 Bulan 2026</p>

            <div class="space-y-3">
                @for ($i = 0; $i < 3; $i++) <div class="bg-white border rounded-xl p-3">
                    <p class="font-medium">Nama Mata Kuliah</p>
                    <p class="text-sm text-gray-500">Jam Mata Kuliah</p>
            </div>
            @endfor
        </div>
    </div>

    <!-- GRAFIK -->
    <div class="bg-gray-100 rounded-2xl border p-5 h-[250px]">
        <h2 class="font-semibold mb-2">Grafik Perkembangan Tiap Semester</h2>

        <div class="h-full flex items-center justify-center text-gray-400">
            (Area Grafik)
        </div>
    </div>

</div>

</div>

</div>