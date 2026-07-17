<div class="space-y-6">

    <!-- HEADER -->
    <div class="bg-gradient-to-r from-[#ff6900] to-[#f54a00] rounded-2xl p-6 shadow-lg" style="box-shadow: 0 4px 14px rgba(255, 143, 0, 0.25);">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-white">

            <div class="space-y-2">
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-white font-medium">Nama</span> : {{ $transkrip['nama'] }}
                </p>
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                    </svg>
                    <span class="text-white font-medium">NIM</span> : {{ $transkrip['nim'] }}
                </p>
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-white font-medium">Tempat, Tgl Lahir</span> : {{ $transkrip['ttl'] }}
                </p>
            </div>

            <div class="space-y-2">
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/>
                    </svg>
                    <span class="text-white font-medium">Program Studi</span> : {{ $transkrip['prodi'] }}
                </p>
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <span class="text-white font-medium">Thn. Akademik Masuk</span> : {{ $transkrip['angkatan'] }}
                </p>
                <p class="flex items-center gap-2">
                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <span class="text-white font-medium">Dosen Wali</span> : {{ $transkrip['advisor'] }}
                </p>
            </div>

        </div>
    </div>

    <!-- TABLE CARD -->
    <div class="bg-white rounded-2xl border p-6 shadow-sm" style="border-color: #ffd180;">

        <div class="flex items-center gap-3 mb-5 pb-4 border-b" style="border-color: #ffd180;">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center" style="background-color: #fff5e9;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <div>
                <h2 class="font-semibold text-lg" style="color: #2d2d2d;">Daftar Mata Kuliah</h2>
                <p class="text-xs" style="color: #6b7280;">Riwayat nilai semester</p>
            </div>
        </div>

        <div x-data="{ showInfo: false }" class="relative">

            <!-- TABEL -->
            <div class="overflow-auto rounded-xl">
                <table class="w-full text-sm">
                    <thead>
                        <tr style="background-color: #fff5e9;">
                            <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider rounded-tl-xl" style="color: #ff6900;">
                                <span class="flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                                    No.
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #ff6900;">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                                    Kode MTK
                                </span>
                            </th>
                            <th class="px-4 py-3 text-left text-xs font-bold uppercase tracking-wider" style="color: #ff6900;">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                                    Nama MTK
                                </span>
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider" style="color: #ff6900;">
                                <span class="flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    SKS
                                </span>
                            </th>
                            <th class="px-4 py-3 text-center text-xs font-bold uppercase tracking-wider rounded-tr-xl" style="color: #ff6900;">
                                <span class="flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    Nilai
                                </span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($transkrip['matkul'] as $i => $mk)
                        <tr class="transition-colors duration-200" onmouseover="this.style.backgroundColor='#fff8f0';" onmouseout="this.style.backgroundColor='transparent';">
                            <td class="px-4 py-3 text-center text-sm" style="color: #6b7280;">
                                {{ $i + 1 }}
                            </td>

                            <td class="px-4 py-3 font-mono text-xs" style="color: #6b7280;">
                                {{ $mk['kode'] }}
                            </td>

                            <td class="px-4 py-3 font-medium text-sm" style="color: #2d2d2d;">
                                {{ $mk['nama'] }}
                            </td>

                            <td class="px-4 py-3 text-center">
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-lg text-xs font-bold" style="background-color: #fff5e9; color: #ff6900;">
                                    {{ $mk['sks'] }}
                                </span>
                            </td>

                            <td class="px-4 py-3 text-center">
                                @php
                                    $nilai = $mk['nilai'];
                                    $isGood = in_array($nilai, ['A', 'A-', 'B+', 'B', 'B-']);
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold {{ $isGood ? 'text-white' : 'text-gray-500' }}" style="{{ $isGood ? 'background: linear-gradient(135deg, #ff6900, #f54a00);' : 'background-color: #f3f4f6;' }}">
                                    {{ $nilai }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- ICON INFO -->
            <div class="mt-4 flex justify-end">
                <button @click="showInfo = !showInfo"
                    class="w-8 h-8 flex items-center justify-center rounded-full shadow transition-all duration-200 hover:scale-110" style="background: linear-gradient(135deg, #ff6900, #f54a00); color: white;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </button>
            </div>

            <!-- BUBBLE INFO -->
            <div x-show="showInfo" @click.outside="showInfo = false" x-transition class="absolute bottom-14 right-0
                bg-white border shadow-lg rounded-2xl p-4
                w-72 sm:w-80 md:w-96
                max-w-[90vw]
                text-sm z-50" style="border-color: #ffd180;">

                <div class="flex items-start gap-3">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center shrink-0" style="background-color: #fff5e9;">
                        <svg class="w-4 h-4" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="leading-relaxed" style="color: #6b7280;">
                        Data ini berdasarkan matakuliah yang diambil. Scroll untuk melihat lebih banyak data.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <div class="bg-white rounded-2xl border p-6 flex flex-col md:flex-row justify-between items-center gap-4 shadow-sm" style="border-color: #ffd180;">

        <div class="text-sm space-y-2">
            <p class="flex items-center gap-2" style="color: #6b7280;">
                <svg class="w-4 h-4" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
                Total SKS Yang Ditempuh : <span class="font-bold" style="color: #2d2d2d;">{{ $transkrip['total_sks_tempuh'] }}</span>
            </p>
            <p class="flex items-center gap-2" style="color: #6b7280;">
                <svg class="w-4 h-4" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Total SKS Yang Telah Lulus : <span class="font-bold" style="color: #2d2d2d;">{{ $transkrip['total_sks_lulus'] }}</span>
            </p>
        </div>

        <div class="text-right bg-[#fff8f0] rounded-2xl border px-6 py-4" style="border-color: #ffd180;">
            <p class="text-sm font-medium" style="color: #6b7280;">IPK Kumulatif</p>
            <h1 class="text-4xl font-extrabold" style="color: #ff6900;">{{ number_format($transkrip['ipk'], 2) }}</h1>
            <p class="text-xs mt-1" style="color: #6b7280;">Dari 4.00</p>
        </div>

    </div>

</div>