<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gray-100 rounded-3xl p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-6">

        <div>
            <h2 class="text-2xl font-semibold mb-2">
                {{ $nama }}
            </h2>

            <div class="space-y-1 text-gray-600 text-sm">
                <p>NIM : {{ $nim }}</p>

                <p>
                    {{ $prodi }}
                </p>

                <p>
                    Semester {{ $semesterAktif }}
                </p>
            </div>
        </div>

        <!-- IPK -->
        <div class="bg-white rounded-2xl border px-6 py-5 text-center shadow-sm min-w-[180px]">
            <p class="text-gray-500 text-sm">
                IPK Kumulatif
            </p>

            <h1 class="text-4xl font-bold">
                {{ number_format($ipk, 2) }}
            </h1>

            <p class="text-xs text-gray-500">
                Dari 4.00
            </p>
        </div>
    </div>

    <!-- CARD INFO -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- TOTAL SKS -->
        <div class="bg-gray-100 rounded-2xl border p-5">

            <p class="text-gray-500">
                Total SKS Lulus
            </p>

            <h1 class="text-4xl font-bold mt-1">
                {{ $totalSksLulus ?? 0 }}
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Dari Total {{ $totalSksDiambil ?? 0 }} SKS
            </p>

        </div>

        <!-- KEHADIRAN -->
        <div class="bg-gray-100 p-5 rounded-2xl border">
            <p class="text-gray-500">
                Kehadiran Semester Ini
            </p>

            <h1 class="text-3xl font-bold mt-1">
                99%
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Tidak ada cekal
            </p>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- MATA KULIAH -->
        <div class="bg-gray-100 rounded-2xl border p-5">

            <div class="flex items-start justify-between gap-4 mb-4">

                <div>
                    <h2 class="font-semibold text-lg">
                        Mata Kuliah Semester Ini
                    </h2>

                    <p class="text-sm text-gray-500">
                        {{ count($mataKuliahSemesterIni) }}
                        Mata Kuliah
                    </p>
                </div>

            </div>

            <div class="space-y-3 max-h-[570px] overflow-auto pr-1">

                @forelse ($mataKuliahSemesterIni as $mk)

                <div class="bg-white border rounded-xl p-4 hover:bg-gray-50 transition">

                    <p class="font-medium">
                        {{ $mk['course']['course_name'] ?? '-' }}
                    </p>

                    <div class="mt-1 text-sm text-gray-500">
                        <p>
                            {{ $mk['lecturer']['name'] ?? 'Dosen belum tersedia' }}
                        </p>

                        <p>
                            {{ $mk['course']['credits'] ?? 0 }} SKS
                        </p>
                    </div>
                </div>

                @empty

                <div class="bg-white border rounded-xl p-4 text-sm text-gray-500">
                    Tidak ada mata kuliah semester ini
                </div>

                @endforelse

            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="space-y-6">

            <!-- JADWAL -->
            <div class="bg-gray-100 rounded-2xl border p-5">

                <h2 class="font-semibold text-lg">
                    Jadwal Hari Ini
                </h2>

                <p class="text-sm text-gray-500 mb-4">
                    {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                </p>

                <div class="space-y-3">

                    @forelse ($jadwalHariIni as $jadwal)

                    <div class="bg-white border rounded-xl p-4">

                        <p class="font-medium">
                            {{ $jadwal['nama'] }}
                        </p>

                        <p class="text-sm text-gray-500">
                            {{ $jadwal['jam'] }}
                        </p>
                    </div>

                    @empty

                    <div class="bg-white border rounded-xl p-4 text-sm text-gray-500">
                        Tidak ada jadwal hari ini
                    </div>

                    @endforelse

                </div>
            </div>

            <!-- GRAFIK -->
            <div class="bg-gray-100 rounded-2xl border p-5">

                <div class="flex items-center justify-between mb-4">

                    <div>
                        <h2 class="font-semibold text-lg">
                            Grafik Perkembangan
                        </h2>

                        <p class="text-sm text-gray-500">
                            IP dan IPK tiap semester
                        </p>
                    </div>

                </div>

                <div class="h-[300px]">
                    <canvas id="ipChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- CHART -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('ipChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                    label: 'IP Semester',
                    data: @json($chartIP),
                    tension: 0.3
                },
                {
                    label: 'IPK',
                    data: @json($chartIPK),
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>