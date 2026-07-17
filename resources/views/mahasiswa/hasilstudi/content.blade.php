<div class="space-y-6">

    <!-- CARD ATAS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="rounded-2xl p-6 text-white relative overflow-hidden"
            style="background: linear-gradient(135deg, #ff6900 0%, #f54a00 100%);">
            <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-4 -left-4 w-16 h-16 rounded-full bg-white/10"></div>

            <div class="relative flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <p class="text-sm font-medium text-white/80">IPK Kumulatif</p>
                    </div>
                    <h1 class="text-5xl font-extrabold">
                        {{ number_format($khs['ipk'] ?? 0, 2) }}
                    </h1>
                    <p class="text-sm text-white/60 mt-1">Dari 4.00</p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-white/20 backdrop-blur-sm flex items-center justify-center">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                </div>
            </div>
        </div>

        <div class="rounded-2xl p-6 relative overflow-hidden"
            style="background: linear-gradient(135deg, #fff5e9 0%, #ffe0b2 100%); border: 1px solid #ffd180;">
            <div class="absolute -top-6 -right-6 w-24 h-24 rounded-full bg-[#ff6900]/5"></div>

            <div class="relative flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-5 h-5" style="color: #ff6900;" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <p class="text-sm font-medium" style="color: #6b7280;">Total SKS Lulus</p>
                    </div>
                    <h1 class="text-5xl font-extrabold" style="color: #2d2d2d;">
                        {{ $khs['total_sks_lulus'] ?? 0 }}
                    </h1>
                    <p class="text-sm mt-1" style="color: #6b7280;">
                        Dari {{ $khs['total_sks_diambil'] ?? 0 }} SKS
                    </p>
                </div>
                <div class="w-14 h-14 rounded-2xl bg-white flex items-center justify-center shadow-sm">
                    <svg class="w-7 h-7" style="color: #ff6900;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
        </div>

    </div>

    <div class="space-y-4">
        @forelse ($khs['semester'] ?? [] as $index => $smt)
        <div class="faq-item border rounded-2xl bg-white overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300"
            style="border-color: #ffd180;">

            <button class="faq-question w-full flex justify-between items-center p-6 text-left transition-colors"
                style="background-color: #fff8f0;" onmouseover="this.style.backgroundColor='#fff5e9';"
                onmouseout="this.style.backgroundColor='#fff8f0';">
                <div class="flex items-center gap-3">
                    <div>
                        <h2 class="font-bold text-lg" style="color: #2d2d2d;">
                            {{ $smt['nama'] ?? '-' }}
                        </h2>
                        <p class="text-sm" style="color: #6b7280;">
                            {{ ($smt['period'] ?? '-') . ' - ' . ($smt['year'] ?? '') }}
                        </p>
                    </div>
                </div>

                <div class="flex gap-4 md:gap-8 text-center items-center pr-1">
                    <div class="hidden sm:block">
                        <p class="text-xs uppercase font-medium" style="color: #ffd180;">SKS</p>
                        <p class="font-bold" style="color: #2d2d2d;">{{ $smt['sks'] ?? 0 }}</p>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-xs uppercase font-medium" style="color: #ffd180;">IP</p>
                        <p class="font-bold" style="color: #2d2d2d;">{{ number_format($smt['ip'] ?? 0, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs uppercase font-medium" style="color: #ffd180;">IPK</p>
                        <p class="font-bold" style="color: #ff6900;">{{ number_format($smt['ipk'] ?? 0, 2) }}</p>
                    </div>
                    <span class="khs-icon flex items-center gap-2" style="color: #6b7280;">
                        <span class="detail-text text-sm">Lihat Detail</span>

                        {{-- Mata Terbuka --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 eye-open">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>

                        {{-- Mata Tertutup --}}
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6 eye-closed">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </span>
                </div>
            </button>

            <div class="faq-content bg-white">
                <div class="p-6 pt-6">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead>
                                <tr class="border-b text-xs uppercase tracking-wider"
                                    style="border-color: #ffd180; color: #6b7280;">
                                    <th class="pb-3 font-semibold">Kode MK</th>
                                    <th class="pb-3 font-semibold">Nama Matkul</th>
                                    <th class="pb-3 font-semibold text-center">SKS</th>
                                    <th class="pb-3 font-semibold text-center">Nilai</th>
                                    <th class="pb-3 font-semibold text-center">Bobot</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y" style="border-color: #fff5e9;">
                                @forelse($smt['items'] ?? [] as $item)
                                <tr class="transition-colors" style="border-color: #fff5e9;"
                                    onmouseover="this.style.backgroundColor='#fff8f0';"
                                    onmouseout="this.style.backgroundColor='transparent';">
                                    <td class="py-3 font-mono text-xs" style="color: #6b7280;">
                                        {{ $item['course']['code'] ?? ($item['course_code'] ?? '-') }}
                                    </td>
                                    <td class="py-3 font-medium" style="color: #2d2d2d;">
                                        {{ $item['course']['name'] ?? ($item['course_name'] ?? '-') }}
                                    </td>
                                    <td class="py-3 text-center" style="color: #2d2d2d;">
                                        {{ $item['course']['credits'] ?? ($item['credits'] ?? 0) }}
                                    </td>
                                    <td class="py-3 text-center">
                                        <span
                                            class="font-bold {{ ($item['predicate'] ?? '-') == '-' ? 'text-gray-400' : 'text-[#ff6900]' }}">
                                            {{ $item['predicate'] ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center" style="color: #6b7280;">
                                        {{ number_format($item['grade_point'] ?? 0, 2) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center italic" style="color: #6b7280;">
                                        Belum ada mata kuliah yang terdaftar.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
        @empty
        <div class="text-center py-10 rounded-2xl border border-dashed"
            style="background-color: #fff8f0; border-color: #ffd180; color: #6b7280;">
            <svg class="w-12 h-12 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                style="color: #ffd180;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
            </svg>
            Data KHS belum tersedia
        </div>
        @endforelse
    </div>

</div>