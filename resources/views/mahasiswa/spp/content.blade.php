<div class="space-y-6">

    {{-- LIST TAGIHAN --}}
    <div class="space-y-5">

        @forelse ($tagihanFormatted as $tagihan)

        <div class="bg-white rounded-[28px] border p-6">

            {{-- HEADER --}}
            <div class="flex justify-between items-start">

                <div>
                    <h2 class="text-xl font-bold text-slate-800">
                        Semester {{ $tagihan['semester'] }}
                    </h2>

                    <p class="text-sm text-gray-500">
                        Dibuat:
                        {{ $tagihan['tanggal'] }}
                    </p>
                </div>

                <span class="px-4 py-2 rounded-full text-sm font-semibold
                        {{ $tagihan['status'] === 'Lunas'
                            ? 'bg-green-100 text-green-700'
                            : 'bg-red-100 text-red-700' }}">

                    {{ $tagihan['status'] }}
                </span>
            </div>

            {{-- RINGKASAN --}}
            <div class="grid md:grid-cols-3 gap-4 mt-6">

                <div class="bg-slate-100 rounded-2xl p-4">
                    <p class="text-sm text-gray-500">
                        Total Tagihan
                    </p>

                    <h3 class="text-2xl font-bold">
                        Rp {{ number_format($tagihan['total'], 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-green-50 rounded-2xl p-4">
                    <p class="text-sm text-gray-500">
                        Sudah Dibayar
                    </p>

                    <h3 class="text-2xl font-bold text-green-600">
                        Rp {{ number_format($tagihan['dibayar'], 0, ',', '.') }}
                    </h3>
                </div>

                <div class="bg-red-50 rounded-2xl p-4">
                    <p class="text-sm text-gray-500">
                        Sisa Tagihan
                    </p>

                    <h3 class="text-2xl font-bold text-red-600">
                        Rp {{ number_format($tagihan['sisa'], 0, ',', '.') }}
                    </h3>
                </div>
            </div>

            {{-- DETAIL --}}
            <div class="mt-6 overflow-x-auto">

                <table class="w-full">

                    <thead>
                        <tr class="border-b text-left text-gray-500 text-sm">
                            <th class="pb-3">Jenis</th>
                            <th class="pb-3">Total</th>
                            <th class="pb-3">Dibayar</th>
                            <th class="pb-3">Sisa</th>
                            <th class="pb-3">Status</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($tagihan['details'] as $detail)

                        <tr class="border-b">

                            <td class="py-4 font-medium">
                                {{ $detail['jenis'] }}
                            </td>

                            <td>
                                Rp {{ number_format($detail['total'], 0, ',', '.') }}
                            </td>

                            <td>
                                Rp {{ number_format($detail['dibayar'], 0, ',', '.') }}
                            </td>

                            <td>
                                Rp {{ number_format($detail['sisa'], 0, ',', '.') }}
                            </td>

                            <td>
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                            {{ $detail['lunas']
                                                ? 'bg-green-100 text-green-700'
                                                : 'bg-red-100 text-red-700' }}">

                                    {{ $detail['lunas']
                                    ? 'Lunas'
                                    : 'Belum Lunas' }}
                                </span>
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>

        </div>

        @empty

        <div class="bg-white rounded-[28px] border p-10 text-center text-gray-500">
            Tidak ada tagihan ditemukan
        </div>

        @endforelse

    </div>
</div>