<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-[#ff6900] to-[#f54a00] rounded-2xl p-6 flex flex-col md:flex-row md:justify-between md:items-center gap-6 shadow-lg" style="box-shadow: 0 4px 14px rgba(255, 143, 0, 0.25);">

        <div>
            <h2 class="text-2xl font-bold text-white mb-2">
                {{ $nama }}
            </h2>

            <div class="space-y-1 text-white/80 text-sm">
                <p><span class="text-white/60">NIM</span> : {{ $nim }}</p>

                <p>
                    <span class="text-white/60">Prodi</span> : {{ $prodi }}
                </p>

                <p>
                    <span class="text-white/60">Semester</span> {{ $semesterAktif }}
                </p>
            </div>
        </div>

        <!-- IPK -->
        <div class="bg-white/15 backdrop-blur-md rounded-2xl border border-white/30 px-8 py-6 text-center shadow-xl min-w-[180px]">
            <p class="text-white/70 text-sm font-medium">
                IPK Kumulatif
            </p>

            <h1 class="text-5xl font-extrabold text-white mt-1">
                {{ number_format($ipk, 2) }}
            </h1>

            <p class="text-xs text-white/60 mt-1">
                Dari 4.00
            </p>
        </div>
    </div>

    <!-- CARD INFO -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- TOTAL SKS -->
        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition-shadow duration-300" style="border-color: #ffd180;">

            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <p class="text-sm font-medium" style="color: #6b7280;">
                    Total SKS Lulus
                </p>
            </div>

            <h1 class="text-4xl font-bold mt-1" style="color: #2d2d2d;">
                {{ $totalSksLulus ?? 0 }}
            </h1>

            <p class="text-sm mt-2" style="color: #6b7280;">
                Dari Total {{ $totalSksDiambil ?? 0 }} SKS
            </p>

        </div>

        <!-- KEHADIRAN -->
        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition-shadow duration-300" style="border-color: #ffd180;">

            <div class="flex items-center gap-3 mb-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <p class="text-sm font-medium" style="color: #6b7280;">
                    Kehadiran Semester Ini
                </p>
            </div>

            <h1 class="text-4xl font-bold mt-1" style="color: #ff6900;">
                99%
            </h1>

            <p class="text-sm mt-2" style="color: #6b7280;">
                Tidak ada cekal
            </p>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- MATA KULIAH -->
        <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">

            <div class="flex items-start justify-between gap-4 mb-5">

                <div>
                    <h2 class="font-semibold text-lg" style="color: #2d2d2d;">
                        Mata Kuliah Semester {{ $semesterAktif }}
                    </h2>

                    <p class="text-sm mt-0.5" style="color: #6b7280;">
                        {{ count($mataKuliahSemesterIni) }} Mata Kuliah
                    </p>
                </div>

            </div>

            <div class="space-y-3 max-h-[680px] overflow-auto pr-1 custom-scrollbar">

                @forelse ($mataKuliahSemesterIni as $mk)

                <div class="border rounded-xl p-4 transition-all duration-200 cursor-pointer group" style="background-color: #fff8f0; border-color: #ffd180;" onmouseover="this.style.backgroundColor='#ffffff'; this.style.borderColor='#ff6900'; this.style.boxShadow='0 4px 14px rgba(255, 143, 0, 0.15)';" onmouseout="this.style.backgroundColor='#fff8f0'; this.style.borderColor='#ffd180'; this.style.boxShadow='none';">

                    <div class="flex items-start justify-between">
                        <p class="font-semibold transition-colors" style="color: #2d2d2d;" onmouseover="this.style.color='#ff6900';" onmouseout="this.style.color='#2d2d2d';">
                            {{ $mk['course']['course_name'] ?? '-' }}
                        </p>
                        <span class="text-xs font-medium rounded-lg px-2 py-0.5 border" style="color: #6b7280; background-color: #ffffff; border-color: #ffd180;">
                            {{ $mk['course']['credits'] ?? 0 }} SKS
                        </span>
                    </div>

                    <div class="mt-2 text-sm flex items-center gap-4" style="color: #6b7280;">
                        <span class="flex items-center gap-1">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            {{ $mk['lecturer']['name'] ?? 'Dosen belum tersedia' }}
                        </span>
                    </div>
                </div>

                @empty

                <div class="border rounded-xl p-6 text-center" style="background-color: #fff8f0; border-color: #ffd180;">
                    <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffd180;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    <p class="text-sm" style="color: #6b7280;">Tidak ada mata kuliah semester ini</p>
                </div>

                @endforelse

            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="space-y-6">

            <!-- JADWAL -->
            <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">

                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="font-semibold text-lg" style="color: #2d2d2d;">
                            Jadwal Hari Ini
                        </h2>

                        <p class="text-sm mt-0.5" style="color: #6b7280;">
                            {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}
                        </p>
                    </div>
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background-color: #fff5e9;">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <div class="space-y-3">

                    @forelse ($jadwalHariIni as $jadwal)

                    <div class="border rounded-xl p-4 transition-all duration-200" style="background-color: #fff8f0; border-color: #ffd180;" onmouseover="this.style.backgroundColor='#ffffff'; this.style.borderColor='#ff6900'; this.style.boxShadow='0 4px 14px rgba(255, 143, 0, 0.15)';" onmouseout="this.style.backgroundColor='#fff8f0'; this.style.borderColor='#ffd180'; this.style.boxShadow='none';">

                        <div class="flex items-start justify-between">
                            <p class="font-semibold" style="color: #2d2d2d;">
                                {{ $jadwal['nama'] ?? '-' }}
                            </p>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium border" style="background-color: #fff5e9; color: #ff6900; border-color: #ffd180;">
                                {{ $jadwal['jam'] ?? '-' }}
                            </span>
                        </div>

                        <div class="mt-2 space-y-1">
                            @if (!empty($jadwal['ruangan']))
                            <p class="text-xs flex items-center gap-1" style="color: #6b7280;">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                                Ruangan: {{ $jadwal['ruangan'] }}
                            </p>
                            @endif

                            @if (!empty($jadwal['dosen']))
                            <p class="text-xs flex items-center gap-1" style="color: #6b7280;">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                </svg>
                                Dosen: {{ $jadwal['dosen'] }}
                            </p>
                            @endif
                        </div>

                    </div>

                    @empty

                    <div class="border rounded-xl p-6 text-center" style="background-color: #fff8f0; border-color: #ffd180;">
                        <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ffd180;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm" style="color: #6b7280;">Tidak ada jadwal hari ini</p>
                    </div>

                    @endforelse

                </div>
            </div>

            <!-- GRAFIK -->
            <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">

                <div class="flex items-center justify-between mb-5">

                    <div>
                        <h2 class="font-semibold text-lg" style="color: #2d2d2d;">
                            Grafik Perkembangan
                        </h2>

                        <p class="text-sm mt-0.5" style="color: #6b7280;">
                            IP dan IPK tiap semester
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <span class="flex items-center gap-1 text-xs" style="color: #6b7280;">
                            <span class="w-2 h-2 rounded-full" style="background-color: #ff6900;"></span> IP
                        </span>
                        <span class="flex items-center gap-1 text-xs" style="color: #6b7280;">
                            <span class="w-2 h-2 rounded-full" style="background-color: #ffb74d;"></span> IPK
                        </span>
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
                    borderColor: '#ff6900',
                    backgroundColor: 'rgba(255, 105, 0, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ff6900',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                },
                {
                    label: 'IPK',
                    data: @json($chartIPK),
                    borderColor: '#ffb74d',
                    backgroundColor: 'rgba(255, 183, 77, 0.1)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: '#ffb74d',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#2d2d2d',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: {
                        size: 13
                    },
                    bodyFont: {
                        size: 12
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        }
                    }
                },
                y: {
                    min: 0,
                    max: 4,
                    grid: {
                        color: '#fff5e9',
                        drawBorder: false
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 11
                        },
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>