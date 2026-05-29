<div class="space-y-6">

    <!-- SUMMARY -->
    <div class="grid md:grid-cols-2 gap-4">

        <div class="bg-gray-100 rounded-3xl p-5 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">
                    Hadir
                </p>

                <h2 class="text-5xl font-bold mt-2">
                    {{ $summary['hadir_percent'] }}%
                </h2>
            </div>

            <div class="w-12 h-12 bg-green-500 rounded-xl flex items-center justify-center text-white text-xl">
                ✓
            </div>
        </div>

        <div class="bg-gray-100 rounded-3xl p-5 flex justify-between items-start">
            <div>
                <p class="text-gray-500 text-sm">
                    Tidak Hadir
                </p>

                <h2 class="text-5xl font-bold mt-2">
                    {{ $summary['tidak_hadir_percent'] }}%
                </h2>
            </div>

            <div class="w-12 h-12 bg-red-500 rounded-xl flex items-center justify-center text-white text-xl">
                ✕
            </div>
        </div>

    </div>

    <!-- STATUS -->
    <div class="bg-gray-100 rounded-3xl p-6">
        <h3 class="font-semibold text-gray-700 mb-2">
            Status Kehadiran :
            <span class="text-green-600">
                {{ $summary['status'] }}
            </span>
        </h3>

        <p class="text-green-600 leading-relaxed">
            {{ $summary['message'] }}
        </p>
    </div>

    <!-- KEHADIRAN PER MTK -->
    <div>
        <div class="flex justify-between items-center mb-3">
            <div>
                <h2 class="text-xl font-bold">
                    Kehadiran Per Mata Kuliah
                </h2>

                <p class="text-gray-500 text-sm">
                    Semester Ganjil 2024/2025
                </p>
            </div>

            <p class="text-sm text-gray-500">
                Informasi Cekal:
                <span class="text-green-600">
                    Aman (>75%)
                </span>
                |
                <span class="text-red-500">
                    Cekal (<75%) </span>
            </p>
        </div>

        <div class="overflow-x-auto bg-white border rounded-xl">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">Kode MTK</th>
                        <th class="p-3 border">Nama MTK</th>
                        <th class="p-3 border">Hadir</th>
                        <th class="p-3 border">Tidak Hadir</th>
                        <th class="p-3 border">Presentase</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($kehadiranMatkul as $item)
                    <tr>
                        <td class="p-3 border text-center">
                            {{ $item['kode'] }}
                        </td>

                        <td class="p-3 border">
                            {{ $item['nama'] }}
                        </td>

                        <td class="p-3 border text-center">
                            {{ $item['hadir'] }}
                        </td>

                        <td class="p-3 border text-center">
                            {{ $item['tidak_hadir'] }}
                        </td>

                        <td class="p-3 border text-center font-semibold">
                            {{ $item['presentase'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- RIWAYAT -->
    <div>
        <h2 class="text-xl font-bold mb-3">
            Riwayat Kehadiran Terbaru
        </h2>

        <div class="overflow-x-auto bg-white border rounded-xl">
            <table class="w-full text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">Tanggal</th>
                        <th class="p-3 border">Mata Kuliah</th>
                        <th class="p-3 border">Waktu</th>
                        <th class="p-3 border">Status</th>
                        <th class="p-3 border">Keterangan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($riwayatKehadiran as $item)
                    <tr>
                        <td class="p-3 border">
                            {{ $item['tanggal'] }}
                        </td>

                        <td class="p-3 border">
                            {{ $item['mata_kuliah'] }}
                        </td>

                        <td class="p-3 border">
                            {{ $item['waktu'] }}
                        </td>

                        <td class="p-3 border text-center">
                            {{ $item['status'] }}
                        </td>

                        <td class="p-3 border text-center">
                            {{ $item['keterangan'] }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>