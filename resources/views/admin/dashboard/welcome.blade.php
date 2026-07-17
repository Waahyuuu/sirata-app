@php
// Opsional: Logika ucapan berdasarkan waktu (Pagi/Siang/Sore/Malam)
$jam = date('H');
if ($jam >= 5 && $jam < 11) $sapaan='Pagi';
elseif ($jam >= 11 && $jam < 15) $sapaan='Siang';
elseif ($jam >= 15 && $jam < 18) $sapaan='Sore';
else $sapaan='Malam';
@endphp

<div class="pb-6">
    <div class="relative overflow-hidden bg-gradient-to-br from-[#ff6900] via-[#f54a00] to-[#e65100] text-white p-7 rounded-2xl shadow-lg"
        style="box-shadow: 0 4px 14px rgba(255, 143, 0, 0.25);">

        <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full blur-3xl" style="background: rgba(255, 255, 255, 0.1);"></div>
        <div class="absolute bottom-0 left-0 -ml-12 -mb-12 w-32 h-32 rounded-full blur-2xl" style="background: rgba(255, 255, 255, 0.05);"></div>

        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
                        Selamat {{ $sapaan }}, <span style="color: #ffe0b2;">{{ auth()->user()->name }}</span>
                    </h1>
                    <p class="text-sm mt-1 font-medium" style="color: rgba(255, 255, 255, 0.7);">
                        Selamat Datang di Admin Panel SIRATA, Pusat kelola data dan pesan.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-3 shrink-0"
                style="background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.2); padding: 12px 20px; border-radius: 16px;">
                <svg class="w-5 h-5" style="color: rgba(255, 255, 255, 0.8);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <p class="text-sm font-semibold">{{ now()->isoFormat('D MMMM Y') }}</p>
            </div>
        </div>
    </div>
</div>