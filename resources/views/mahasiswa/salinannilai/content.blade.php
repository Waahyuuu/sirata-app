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
                <p><strong>Dosen Wali :</strong> {{ $transkrip['advisor'] }}</p>
            </div>

        </div>

        <hr class="my-4">

        <div x-data="{ showInfo: false }" class="relative">

            <!-- TABEL -->
            <div class="overflow-auto md:max-h-[400px] lg:max-h-[328px]">
                <table class="w-full border-collapse text-sm">
                    <thead class="bg-gray-200 sticky top-0 z-10">
                        <tr>
                            <th class="border px-2 py-2">No.</th>
                            <th class="border px-2 py-2">Kode MTK</th>
                            <th class="border px-2 py-2">Nama MTK</th>
                            <th class="border px-2 py-2">SKS</th>
                            <th class="border px-2 py-2">Nilai</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transkrip['matkul'] as $i => $mk)
                        <tr class="text-center hover:bg-gray-50">
                            <td class="border px-2 py-1">{{ $i + 1 }}</td>

                            <td class="border px-2 py-1">
                                {{ $mk['kode'] }}
                            </td>

                            <td class="border px-2 py-1 text-left">
                                {{ $mk['nama'] }}
                            </td>

                            <td class="border px-2 py-1">
                                {{ $mk['sks'] }}
                            </td>

                            <td class="border px-2 py-1 font-semibold">
                                {{ $mk['nilai'] }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- ICON INFO -->
            <div class="mt-4 flex justify-end">
                <button @click="showInfo = !showInfo"
                    class="w-6 h-6 flex items-center justify-center bg-blue-500 text-white rounded-full shadow hover:bg-blue-600 transition">
                    !
                </button>
            </div>

            <!-- BUBBLE INFO -->
            <div x-show="showInfo" @click.outside="showInfo = false" x-transition class="absolute bottom-14 right-0
                bg-white border shadow-lg rounded-2xl p-4
                w-72 sm:w-80 md:w-96
                max-w-[90vw]
                text-sm z-50">

                <p class="text-gray-600 leading-relaxed">
                    Data ini berdasarkan matakuliah yang diambil. Scroll untuk melihat lebih banyak data.
                </p>
            </div>

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