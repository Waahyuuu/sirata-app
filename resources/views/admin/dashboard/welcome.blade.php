@php
// Opsional: Logika ucapan berdasarkan waktu (Pagi/Siang/Sore/Malam)
$jam = date('H');
if ($jam >= 5 && $jam < 11) $sapaan='Pagi' ; elseif ($jam>= 11 && $jam < 15) $sapaan='Siang' ; elseif ($jam>= 15 && $jam
        < 18) $sapaan='Sore' ; else $sapaan='Malam' ; @endphp <div class="pb-6">
            <div
                class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-indigo-950 to-slate-900 text-white p-7 rounded-3xl shadow-xl border border-white/10">

                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 bg-indigo-500/20 rounded-full blur-3xl">
                </div>
                <div class="absolute bottom-0 left-0 -ml-12 -mb-12 w-32 h-32 bg-violet-500/10 rounded-full blur-2xl">
                </div>

                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-center gap-4">
                        <div>
                            <h1 class="text-2xl md:text-3xl font-bold tracking-tight">
                                Selamat {{ $sapaan }}, <span class="text-indigo-400">{{ auth()->user()->name }}</span>
                            </h1>
                            <p class="text-indigo-200/70 text-sm mt-1 font-medium italic">
                                Selamat Datang di Admin Panel SIRATA, Pusat kelola data dan pesan.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex items-center gap-4 bg-white/5 backdrop-blur-xl border border-white/10 p-3 rounded-2xl shadow-inner">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold">{{ now()->isoFormat('D MMMM Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            </div>