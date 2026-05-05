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
                {{ $khs['total_sks'] ?? 0 }}
            </h1>
            <p class="text-sm text-gray-500">Dari Total SKS</p>
        </div>

    </div>

    <!-- LIST SEMESTER -->
    <div class="space-y-4">

        @forelse ($khs['semester'] ?? [] as $smt)
        <div class="bg-gray-100 rounded-2xl border p-4 flex justify-between items-center">

            <div>
                <h2 class="font-semibold">
                    {{ $smt['nama'] ?? '-' }}
                </h2>
                <p class="text-sm text-gray-500">
                    {{ $smt['periode'] ?? '-' }}
                </p>
            </div>

            <div class="flex gap-8 text-right pr-4">

                <div>
                    <p class="text-sm text-gray-500">SKS</p>
                    <p class="font-bold">
                        {{ $smt['sks'] ?? 0 }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">IP</p>
                    <p class="font-bold">
                        {{ number_format($smt['ip'] ?? 0, 2) }}
                    </p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">IPK</p>
                    <p class="font-bold">
                        {{ number_format($smt['ipk'] ?? 0, 2) }}
                    </p>
                </div>

            </div>

        </div>
        @empty
        <div class="text-center text-gray-500 py-10">
            Data KHS belum tersedia
        </div>
        @endforelse

    </div>

</div>