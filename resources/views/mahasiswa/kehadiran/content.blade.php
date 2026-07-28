<div class="space-y-6">

    {{-- ============================================= --}}
    {{-- STATISTIC CARDS --}}
    {{-- ============================================= --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- HADIR -->
        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden"
            style="border-color: #ffd180;">
            <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-[#10b981]/5"></div>

            <div class="relative flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        <p class="text-sm font-medium" style="color: #6b7280;">Persentase Hadir</p>
                    </div>
                    <h1 class="text-5xl font-extrabold" style="color: #10b981;">
                        {{ $summary['hadir_percent'] }}%
                    </h1>
                    <p class="text-sm mt-2" style="color: #6b7280;">Dari total seluruh pertemuan</p>
                </div>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white text-2xl ml-4 shrink-0"
                    style="background: linear-gradient(135deg, #10b981, #059669);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- TIDAK HADIR -->
        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition-shadow duration-300 relative overflow-hidden"
            style="border-color: #ffd180;">
            <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-[#ef4444]/5"></div>

            <div class="relative flex items-center justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-2 mb-3">
                        <p class="text-sm font-medium" style="color: #6b7280;">Persentase Tidak Hadir</p>
                    </div>
                    <h1 class="text-5xl font-extrabold" style="color: #ef4444;">
                        {{ $summary['tidak_hadir_percent'] }}%
                    </h1>
                    <p class="text-sm mt-2" style="color: #6b7280;">Dari total seluruh pertemuan</p>
                </div>
                <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white text-2xl ml-4 shrink-0"
                    style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    {{-- ============================================= --}}
    {{-- PESAN STATUS --}}
    {{-- ============================================= --}}
    <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">
        <div class="flex items-start gap-4">
            <div class="flex-1">
                <h3 class="font-bold text-lg mb-1" style="color: #2d2d2d;">
                    Status Kehadiran : {{ $summary['status'] }}
                </h3>
                <p class="text-sm leading-relaxed" style="color: #6b7280;">
                    {{ $summary['message'] }}
                </p>
                @if($summary['status'] === 'Tidak Cekal')
                <div class="mt-3 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-white"
                        style="background: linear-gradient(135deg, #10b981, #059669);">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Kehadiran Sangat Baik
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold"
                        style="background: #fff5e9; color: #ff6900; border: 1px solid #ffd180;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Minimal {{ $summary['batas_minimal'] ?? 75 }}%
                    </span>
                </div>
                @else
                <div class="mt-3 flex items-center gap-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-white"
                        style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        Perlu Perhatian
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold"
                        style="background: #fff5e9; color: #ff6900; border: 1px solid #ffd180;">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Minimal {{ $summary['batas_minimal'] ?? 75 }}%
                    </span>
                </div>
                @endif
            </div>
        </div>

        @if($summary['status'] === 'Cekal' && !empty($summary['cekal_matkul']))
        <div class="mt-5 p-5 rounded-xl" style="background: #fff5e9; border: 1px solid #ffd180;">
            <div class="flex items-center gap-2 mb-4">
                <svg class="w-5 h-5" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
                <p class="text-sm font-bold" style="color: #dc2626;">Detail Mata Kuliah yang Terancam Cekal</p>
            </div>
            <div class="space-y-3">
                @foreach($summary['cekal_matkul'] as $matkul)
                <div class="flex items-center gap-3 p-3 rounded-xl bg-white border transition-all hover:shadow-sm"
                    style="border-color: #ffd180;">
                    <div class="w-10 h-10 rounded-lg flex items-center justify-center shrink-0"
                        style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                        <span class="text-white font-bold text-sm">{{ $loop->iteration }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm truncate" style="color: #2d2d2d;">
                            {{ $matkul['kode'] }} - {{ $matkul['nama'] }}
                        </p>
                        <p class="text-xs mt-0.5" style="color: #6b7280;">
                            Hadir: {{ $matkul['hadir'] }} dari {{ $matkul['total_pertemuan'] }} pertemuan
                        </p>
                    </div>
                    <div class="text-right shrink-0">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white"
                            style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                            {{ $matkul['presentase'] }}
                        </span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- ============================================= --}}
    {{-- KEHADIRAN PER MATA KULIAH --}}
    {{-- ============================================= --}}
    <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">
        <div class="flex flex-wrap justify-between items-center gap-4 mb-6 pb-4 border-b"
            style="border-color: #ffd180;">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <div>
                    <h2 class="font-semibold text-lg" style="color: #2d2d2d;">Kehadiran Per Mata Kuliah</h2>
                    <p class="text-xs" style="color: #6b7280;">Semester {{ $summary['semester_aktif'] ?? 'Aktif' }}
                        2024/2025</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-white"
                    style="background: linear-gradient(135deg, #10b981, #059669);">
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    Tidak Cekal ≥75%
                </span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full text-xs font-bold text-white"
                    style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <span class="w-1.5 h-1.5 rounded-full bg-white"></span>
                    Cekal &lt;75%
                </span>
            </div>
        </div>

        <div class="overflow-auto rounded-xl">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background-color: #fff5e9;">
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider rounded-tl-xl"
                            style="color: #ff6900;">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                </svg>
                                Kode
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Mata Kuliah
                            </span>
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">Hadir</th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">Tidak Hadir</th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">Total</th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">Presentase</th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider rounded-tr-xl"
                            style="color: #ff6900;">Status</th>
                    </tr>
                </thead>

                <tbody class="divide-y" style="border-color: #fff5e9;">
                    @foreach ($kehadiranMatkul as $item)
                    <tr class="transition-colors duration-200" onmouseover="this.style.backgroundColor='#fff8f0';"
                        onmouseout="this.style.backgroundColor='transparent';" style="border-color: #fff5e9;">
                        <td class="px-4 py-3 font-mono text-xs" style="color: #6b7280;">
                            {{ $item['kode'] }}
                        </td>
                        <td class="px-4 py-3 font-medium" style="color: #2d2d2d;">
                            {{ $item['nama'] }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-bold text-white"
                                style="background: linear-gradient(135deg, #10b981, #059669);">
                                {{ $item['hadir'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span
                                class="inline-flex items-center justify-center w-8 h-8 rounded-lg text-xs font-bold text-white"
                                style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                {{ $item['tidak_hadir'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center font-medium" style="color: #2d2d2d;">
                            {{ $item['total_pertemuan'] }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-sm font-bold"
                                style="color: {{ $item['is_cekal'] ? '#ef4444' : '#10b981' }};">
                                {{ $item['presentase'] }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($item['is_cekal'])
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold text-white"
                                style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                                Cekal
                            </span>
                            @else
                            <span
                                class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold text-white"
                                style="background: linear-gradient(135deg, #10b981, #059669);">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Tidak Cekal
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- RIWAYAT KETIDAK HADIRAN --}}
    {{-- ============================================= --}}
    <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">
        <div class="flex items-center gap-3 mb-6 pb-4 border-b" style="border-color: #ffd180;">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <div>
                <h2 class="font-semibold text-lg" style="color: #2d2d2d;">Riwayat Ketidak Hadiran</h2>
                <p class="text-xs" style="color: #6b7280;">Daftar absensi terbaru yang tidak hadir</p>
            </div>
        </div>

        @if(!empty($riwayatKetidakHadiran))
        <div class="overflow-auto rounded-xl">
            <table class="w-full text-sm">
                <thead>
                    <tr style="background-color: #fff5e9;">
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider rounded-tl-xl"
                            style="color: #ff6900;">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Tanggal
                            </span>
                        </th>
                        <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                                Mata Kuliah
                            </span>
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">
                            <span class="flex items-center justify-center gap-1.5">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Waktu
                            </span>
                        </th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider"
                            style="color: #ff6900;">Status</th>
                        <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider rounded-tr-xl"
                            style="color: #ff6900;">Keterangan</th>
                    </tr>
                </thead>

                <tbody class="divide-y" style="border-color: #fff5e9;">
                    @foreach ($riwayatKetidakHadiran as $item)
                    <tr class="transition-colors duration-200" onmouseover="this.style.backgroundColor='#fff8f0';"
                        onmouseout="this.style.backgroundColor='transparent';" style="border-color: #fff5e9;">
                        <td class="px-4 py-3 font-medium" style="color: #2d2d2d;">
                            {{ $item['tanggal'] }}
                        </td>
                        <td class="px-4 py-3" style="color: #2d2d2d;">
                            {{ $item['mata_kuliah'] }}
                        </td>
                        <td class="px-4 py-3 text-center" style="color: #6b7280;">
                            {{ $item['waktu'] }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold text-white"
                                style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Tidak Hadir
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($item['keterangan'] === '-')
                            <span class="text-gray-400 text-xs">-</span>
                            @else
                            <span
                                class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold text-white"
                                style="background: linear-gradient(135deg, #f59e0b, #d97706);">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                {{ $item['keterangan'] }}
                            </span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="text-center py-12 rounded-2xl border-2 border-dashed"
            style="background-color: #fff8f0; border-color: #ffd180;">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4"
                style="background-color: #fff5e9;">
                <svg class="w-8 h-8" style="color: #ffd180;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <p class="text-base font-medium" style="color: #6b7280;">Tidak ada riwayat ketidak hadiran</p>
            <p class="text-sm mt-1" style="color: #9ca3af;">Kehadiran Anda sangat baik! Pertahankan!</p>
        </div>
        @endif
    </div>

</div>