<div class="space-y-6">

    {{-- LIST TAGIHAN --}}
    <div class="space-y-5">

        @forelse ($tagihanFormatted as $tagihan)

        <div class="bg-white rounded-2xl border p-6 shadow-sm hover:shadow-md transition-shadow duration-300"
            style="border-color: #ffd180;">

            {{-- HEADER --}}
            <div class="flex justify-between items-start mb-5 pb-4 border-b" style="border-color: #ffd180;">

                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                        style="background-color: #fff5e9;">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: #ff6900;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="font-semibold text-lg" style="color: #2d2d2d;">
                            Semester {{ $tagihan['semester'] }}
                        </h2>
                        <p class="text-sm" style="color: #6b7280;">
                            Dibuat: {{ $tagihan['tanggal'] }}
                        </p>
                    </div>
                </div>

                {{-- BADGE STATUS --}}
                @if($tagihan['is_lunas'])
                <span class="px-3 py-1 rounded-full text-xs font-bold text-white flex items-center gap-1"
                    style="background: linear-gradient(135deg, #10b981, #059669);">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    Lunas
                </span>
                @else
                <span class="px-3 py-1 rounded-full text-xs font-bold text-white flex items-center gap-1"
                    style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    Belum Lunas
                </span>
                @endif
            </div>

            {{-- RINGKASAN --}}
            <div class="grid md:grid-cols-3 gap-4">

                <div class="bg-[#fff8f0] border rounded-2xl p-4" style="border-color: #ffd180;">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: #ff6900;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                        </svg>
                        <p class="text-sm font-medium" style="color: #6b7280;">Total Tagihan</p>
                    </div>
                    <h3 class="text-2xl font-bold" style="color: #2d2d2d;">
                        Rp {{ number_format($tagihan['total'], 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-[#fff8f0] border rounded-2xl p-4" style="border-color: #ffd180;">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: #10b981;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium" style="color: #6b7280;">Sudah Dibayar</p>
                    </div>
                    <h3 class="text-2xl font-bold" style="color: #10b981;">
                        Rp {{ number_format($tagihan['dibayar'], 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-[#fff8f0] border rounded-2xl p-4" style="border-color: #ffd180;">
                    <div class="flex items-center gap-2 mb-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            style="color: #ef4444;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-sm font-medium" style="color: #6b7280;">Sisa Tagihan</p>
                    </div>
                    <h3 class="text-2xl font-bold" style="color: #ef4444;">
                        Rp {{ number_format($tagihan['sisa'], 0, ',', '.') }}
                    </h3>
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="mt-6 overflow-x-auto">

                <table class="w-full text-sm">

                    <thead>
                        <tr class="text-left text-xs uppercase tracking-wider" style="color: #6b7280;">
                            <th class="pb-3 font-semibold">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #ff6900;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                    </svg>
                                    Jenis
                                </span>
                            </th>
                            <th class="pb-3 font-semibold">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #ff6900;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Total
                                </span>
                            </th>
                            <th class="pb-3 font-semibold">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #ff6900;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Dibayar
                                </span>
                            </th>
                            <th class="pb-3 font-semibold">
                                <span class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #ff6900;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Sisa
                                </span>
                            </th>
                            <th class="pb-3 font-semibold text-center">
                                <span class="flex items-center justify-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        style="color: #ff6900;">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Status
                                </span>
                            </th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($tagihan['details'] as $detail)

                        <tr class="transition-colors duration-200" onmouseover="this.style.backgroundColor='#fff8f0';"
                            onmouseout="this.style.backgroundColor='transparent';">

                            <td class="py-3 font-medium" style="color: #2d2d2d;">
                                {{ $detail['jenis'] }}
                            </td>

                            <td class="py-3" style="color: #6b7280;">
                                Rp {{ number_format($detail['total'], 0, ',', '.') }}
                            </td>

                            <td class="py-3" style="color: #6b7280;">
                                Rp {{ number_format($detail['dibayar'], 0, ',', '.') }}
                            </td>

                            <td class="py-3" style="color: #6b7280;">
                                Rp {{ number_format($detail['sisa'], 0, ',', '.') }}
                            </td>

                            <td class="py-3 text-center">
                                @if($detail['lunas'])
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold text-white"
                                    style="background: linear-gradient(135deg, #10b981, #059669);">
                                    Lunas
                                </span>
                                @else
                                <span
                                    class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold text-white"
                                    style="background: linear-gradient(135deg, #ef4444, #dc2626);">
                                    Belum Dibayar
                                </span>
                                @endif
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        @empty

        <div class="text-center py-12 rounded-2xl border-2 border-dashed"
            style="background-color: #fff8f0; border-color: #ffd180;">
            <div class="w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-3"
                style="background-color: #fff5e9;">
                <svg class="w-8 h-8" style="color: #ffd180;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                </svg>
            </div>
            <p class="text-base font-medium" style="color: #6b7280;">Tidak ada tagihan ditemukan</p>
            <p class="text-sm mt-1" style="color: #9ca3af;">Semua pembayaran sudah lunas</p>
        </div>

        @endforelse

    </div>
</div>