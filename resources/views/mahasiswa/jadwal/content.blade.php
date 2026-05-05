<div class="space-y-6" x-data="{ showInfo: false }">

    <!-- JADWAL PER HARI -->
    <div class="bg-gray-100 rounded-3xl p-6 relative">

        @php
        $hari = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat'];
        @endphp

        @foreach ($hari as $h)
        <div class="mb-6">
            <h2 class="font-semibold mb-2">Jadwal {{ $h }}</h2>
            <hr class="mb-3">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                @for ($i = 0; $i < 3; $i++) <div class="bg-white rounded-xl p-3 shadow-sm">
                    <p class="font-medium">Nama Mata Kuliah</p>
                    <p class="text-sm text-gray-500">Jam Mata Kuliah</p>
            </div>
            @endfor
        </div>
    </div>
    @endforeach

    <!-- ICON INFO -->
    <div class="absolute bottom-3 right-8">
        <button @click="showInfo = !showInfo"
            class="w-6 h-6 flex items-center justify-center bg-blue-500 text-white rounded-full shadow">
            !
        </button>
    </div>

    <!-- BUBBLE INFO -->
    <div x-show="showInfo" @click.outside="showInfo = false" x-transition
        class="absolute bottom-14 right-8 bg-white border shadow-lg rounded-xl p-4 w-64 text-sm">

        <p class="font-semibold mb-1">Informasi Jadwal</p>
        <p class="text-gray-600">
            Jadwal ini merupakan jadwal kuliah aktif semester berjalan.
            Silakan cek perubahan jadwal secara berkala.
        </p>
    </div>

</div>

<!-- JADWAL HARI INI -->
<div class="bg-gray-100 rounded-3xl p-6">

    <h2 class="font-semibold">Jadwal Hari Ini</h2>
    <p class="text-sm text-gray-500 mb-3">Rabu, 00 Bulan 2026</p>

    <hr class="mb-3">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        @for ($i = 0; $i < 3; $i++) <div class="bg-white rounded-xl p-3 shadow-sm">
            <p class="font-medium">Nama Mata Kuliah</p>
            <p class="text-sm text-gray-500">Jam Mata Kuliah</p>
    </div>
    @endfor
</div>

</div>

</div>