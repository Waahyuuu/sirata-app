<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gray-100 rounded-3xl p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">

            <div>
                <p><strong>Nama :</strong> {{ $transkrip['nama'] }}</p>
                <p><strong>NIM :</strong> {{ $transkrip['nim'] }}</p>
                <p><strong>Tempat, Tgl Lahir :</strong> {{ $transkrip['ttl'] }}</p>
            </div>

            <div>
                <p><strong>Program Studi :</strong> {{ $transkrip['prodi'] }}</p>
                <p><strong>Thn. Akademik Masuk :</strong> {{ $transkrip['angkatan'] }}</p>
            </div>

        </div>

        <hr class="my-4">

        <!-- TABEL -->
        <div class="overflow-auto">
            <table class="w-full border text-sm">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="border px-2 py-1">No.</th>
                        <th class="border px-2 py-1">Kode MTK</th>
                        <th class="border px-2 py-1">Nama MTK</th>
                        <th class="border px-2 py-1">SKS</th>
                        <th class="border px-2 py-1">Nilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transkrip['matkul'] as $i => $mk)
                    <tr class="text-center">
                        <td class="border px-2 py-1">{{ $i + 1 }}</td>
                        <td class="border px-2 py-1">{{ $mk['kode'] }}</td>
                        <td class="border px-2 py-1 text-left">{{ $mk['nama'] }}</td>
                        <td class="border px-2 py-1">{{ $mk['sks'] }}</td>
                        <td class="border px-2 py-1">{{ $mk['nilai'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- BUTTON -->
        <div class="mt-4 flex justify-end">
            <button class="bg-white border px-4 py-2 rounded-xl shadow-sm hover:bg-gray-50">
                📄 Lihat Detail
            </button>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="bg-gray-100 rounded-3xl p-6 flex justify-between items-center">

        <div class="text-sm">
            <p>Total SKS Yang Ditempuh : {{ $transkrip['total_sks_tempuh'] }}</p>
            <p>Total SKS Yang Telah Lulus : {{ $transkrip['total_sks_lulus'] }}</p>
        </div>

        <div class="text-right">
            <p class="text-gray-500">IPK Kumulatif</p>
            <h1 class="text-3xl font-bold">{{ number_format($transkrip['ipk'], 2) }}</h1>
            <p class="text-xs text-gray-500">Dari 4.00</p>
        </div>

    </div>

</div>