<div class="space-y-6">

    <!-- CARD ATAS -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

        <div class="bg-gray-100 rounded-3xl p-6">
            <p class="text-gray-500">IPK Kumulatif</p>
            <h1 class="text-4xl font-bold">
                {{ number_format($khs['ipk'] ?? 0, 2) }}
            </h1>
            <p class="text-sm text-gray-500">Dari 4.00</p>
        </div>

        <div class="bg-gray-100 rounded-3xl p-6">
            <p class="text-gray-500">Total SKS Lulus</p>
            <h1 class="text-4xl font-bold">
                {{ $khs['total_sks_lulus'] ?? 0 }}
            </h1>
            <p class="text-sm text-gray-500">
                Dari Total {{ $khs['total_sks_diambil'] ?? 0 }} SKS
            </p>
        </div>

    </div>

    <!-- LIST SEMESTER -->
    <div class="space-y-4">
        @forelse ($khs['semester'] ?? [] as $smt)
        <div class="faq-item border rounded-2xl bg-gray-100 overflow-hidden shadow-sm">

            <button
                class="faq-question w-full flex justify-between items-center p-6 text-left transition-colors hover:bg-gray-200">
                <div>
                    <h2 class="font-bold text-lg">
                        {{ $smt['nama'] ?? '-' }}
                    </h2>
                    <p class="text-sm text-gray-500">
                        {{ ($smt['period'] ?? '-') . ' - ' . ($smt['year'] ?? '') }}
                    </p>
                </div>

                <div class="flex gap-4 md:gap-8 text-center items-center pr-1">
                    <div class="hidden sm:block">
                        <p class="text-xs text-gray-400 uppercase">SKS</p>
                        <p class="font-bold">{{ $smt['sks'] ?? 0 }}</p>
                    </div>
                    <div class="hidden sm:block">
                        <p class="text-xs text-gray-400 uppercase">IP</p>
                        <p class="font-bold">{{ number_format($smt['ip'] ?? 0, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400 uppercase">IPK</p>
                        <p class="font-bold">{{ number_format($smt['ipk'] ?? 0, 2) }}</p>
                    </div>
                    <span class="khs-icon text-gray-400">
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
                                <tr class="border-b text-gray-500 text-xs uppercase tracking-wider">
                                    <th class="pb-3 font-semibold">Kode MK</th>
                                    <th class="pb-3 font-semibold">Nama Matkul</th>
                                    <th class="pb-3 font-semibold text-center">SKS</th>
                                    <th class="pb-3 font-semibold text-center">Nilai</th>
                                    <th class="pb-3 font-semibold text-center">Bobot</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($smt['items'] ?? [] as $item)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="py-3 font-mono text-xs text-gray-600">
                                        {{ $item['course']['code'] ?? ($item['course_code'] ?? '-') }}
                                    </td>
                                    <td class="py-3 font-medium text-gray-800">
                                        {{ $item['course']['name'] ?? ($item['course_name'] ?? '-') }}
                                    </td>
                                    <td class="py-3 text-center">
                                        {{ $item['course']['credits'] ?? ($item['credits'] ?? 0) }}
                                    </td>
                                    <td class="py-3 text-center">
                                        <span
                                            class="font-bold {{ ($item['predicate'] ?? '-') == '-' ? 'text-gray-400' : 'text-blue-600' }}">
                                            {{ $item['predicate'] ?? '-' }}
                                        </span>
                                    </td>
                                    <td class="py-3 text-center text-gray-500">
                                        {{ number_format($item['grade_point'] ?? 0, 2) }}
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="py-6 text-center text-gray-400 italic">
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
        <div class="text-center text-gray-500 py-10 bg-gray-50 rounded-2xl border border-dashed">
            Data KHS belum tersedia
        </div>
        @endforelse
    </div>

</div>