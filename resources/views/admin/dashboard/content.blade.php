<div class="space-y-6">

    <!-- STAT CARDS -->
    <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-4">

        <!-- Mahasiswa -->
        <div class="group bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300"
            style="border-color: #ffd180;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform"
                    style="background-color: #fff5e9; color: #ff6900;">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold tracking-widest uppercase" style="color: #9ca3af;">Total</span>
                </div>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider" style="color: #6b7280;">Mahasiswa</p>
            <h2 class="counter text-3xl font-black mt-1 tracking-tight" style="color: #2d2d2d;"
                data-value="{{ $stats[0]['value'] ?? 0 }}">
                0
            </h2>
        </div>

        <!-- Manfaat -->
        <div class="group bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300"
            style="border-color: #ffd180;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform"
                    style="background-color: #fff5e9; color: #ff6900;">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold tracking-widest uppercase" style="color: #9ca3af;">Item</span>
                </div>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider" style="color: #6b7280;">Manfaat</p>
            <h2 class="counter text-3xl font-black mt-1 tracking-tight" style="color: #2d2d2d;"
                data-value="{{ $stats[1]['value'] ?? 0 }}">
                0
            </h2>
        </div>

        <!-- Link -->
        <div class="group bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300"
            style="border-color: #ffd180;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform"
                    style="background-color: #fff5e9; color: #ff6900;">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold tracking-widest uppercase" style="color: #9ca3af;">Item</span>
                </div>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider" style="color: #6b7280;">Link</p>
            <h2 class="counter text-3xl font-black mt-1 tracking-tight" style="color: #2d2d2d;"
                data-value="{{ $stats[2]['value'] ?? 0 }}">
                0
            </h2>
        </div>

        <!-- FAQ -->
        <div class="group bg-white p-5 rounded-2xl border shadow-sm hover:shadow-md hover:-translate-y-1 transition-all duration-300"
            style="border-color: #ffd180;">
            <div class="flex items-center justify-between mb-4">
                <div class="w-12 h-12 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform"
                    style="background-color: #fff5e9; color: #ff6900;">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold tracking-widest uppercase" style="color: #9ca3af;">Item</span>
                </div>
            </div>
            <p class="text-xs font-bold uppercase tracking-wider" style="color: #6b7280;">FAQ</p>
            <h2 class="counter text-3xl font-black mt-1 tracking-tight" style="color: #2d2d2d;"
                data-value="{{ $stats[3]['value'] ?? 0 }}">
                0
            </h2>
        </div>

    </div>

    <!-- CONTENT GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-1">

        <!-- LEFT: SIRATA Core Info -->
        <div class="lg:col-span-7 bg-white p-8 rounded-2xl border shadow-sm flex flex-col justify-center relative overflow-hidden"
            style="border-color: #ffd180;">
            <div class="absolute -right-10 -bottom-10 pointer-events-none rotate-12 opacity-10">
                <svg class="w-48 h-48" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>

            <div class="relative z-10">
                <h3 class="font-black text-2xl mb-2" style="color: #2d2d2d;">
                    SIRATA <span style="color: #ff6900; font-style: italic;">Core</span>
                </h3>
                <p class="leading-relaxed mb-6 max-w-lg" style="color: #6b7280;">
                    Kelola layanan
                    <span class="font-semibold" style="color: #2d2d2d;">SIRATA</span>
                    dengan lebih mudah melalui integrasi
                    <span class="font-medium" style="color: #2d2d2d;">API Kampus</span>
                    untuk sinkronisasi data akademik serta fitur
                    <span class="font-medium" style="color: #2d2d2d;">backup sistem</span>
                    guna menjaga keamanan database dan dokumen penting.
                </p>

                <div class="flex flex-wrap gap-4">
                    <div class="px-5 py-3 rounded-2xl flex items-center gap-3 shadow-sm border"
                        style="background-color: #fff8f0; border-color: #ffd180;">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <span class="text-sm font-bold" style="color: #2d2d2d;">API Server</span>
                    </div>

                    <a href="{{ route('admin.backup') }}" onclick="return confirm('Backup semua data sekarang?')"
                        class="px-5 py-3 rounded-2xl text-white shadow-sm transition flex items-center gap-3 hover:shadow-md"
                        style="background: linear-gradient(135deg, #ff6900, #f54a00);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        <span class="text-sm font-bold">Backup Data</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- RIGHT: Quick Access -->
        <div class="lg:col-span-5 bg-white p-8 rounded-2xl border shadow-sm" style="border-color: #ffd180;">
            <h3 class="font-bold text-xl mb-6 flex items-center gap-2" style="color: #2d2d2d;">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #ff6900;">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
                Akses Cepat
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.konten', ['tab' => 'faq']) }}"
                    class="group flex flex-col p-4 rounded-2xl transition-all duration-300 shadow-sm border hover:shadow-md"
                    style="background-color: #fff8f0; border-color: #ffd180;"
                    onmouseover="this.style.backgroundColor='#ffffff'; this.style.borderColor='#ff6900';"
                    onmouseout="this.style.backgroundColor='#fff8f0'; this.style.borderColor='#ffd180';">
                    <span class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left" style="color: #ff6900;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </span>
                    <span class="font-bold transition-colors text-sm" style="color: #2d2d2d;"
                        onmouseover="this.style.color='#ff6900';"
                        onmouseout="this.style.color='#2d2d2d';">Kelola FAQ</span>
                </a>

                <a href="{{ route('admin.konten', ['tab' => 'manfaat']) }}"
                    class="group flex flex-col p-4 rounded-2xl transition-all duration-300 shadow-sm border hover:shadow-md"
                    style="background-color: #fff8f0; border-color: #ffd180;"
                    onmouseover="this.style.backgroundColor='#ffffff'; this.style.borderColor='#ff6900';"
                    onmouseout="this.style.backgroundColor='#fff8f0'; this.style.borderColor='#ffd180';">
                    <span class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left" style="color: #ff6900;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </span>
                    <span class="font-bold transition-colors text-sm" style="color: #2d2d2d;"
                        onmouseover="this.style.color='#ff6900';"
                        onmouseout="this.style.color='#2d2d2d';">Kelola Manfaat</span>
                </a>

                <a href="{{ route('admin.konten', ['tab' => 'link']) }}"
                    class="group flex flex-col p-4 rounded-2xl transition-all duration-300 shadow-sm border hover:shadow-md"
                    style="background-color: #fff8f0; border-color: #ffd180;"
                    onmouseover="this.style.backgroundColor='#ffffff'; this.style.borderColor='#ff6900';"
                    onmouseout="this.style.backgroundColor='#fff8f0'; this.style.borderColor='#ffd180';">
                    <span class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left" style="color: #ff6900;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"/>
                        </svg>
                    </span>
                    <span class="font-bold transition-colors text-sm" style="color: #2d2d2d;"
                        onmouseover="this.style.color='#ff6900';"
                        onmouseout="this.style.color='#2d2d2d';">Kelola Link</span>
                </a>

                <a href="{{ route('admin.pesan', ['tab' => 'message']) }}"
                    class="group flex flex-col p-4 rounded-2xl transition-all duration-300 shadow-sm border hover:shadow-md"
                    style="background-color: #fff8f0; border-color: #ffd180;"
                    onmouseover="this.style.backgroundColor='#ffffff'; this.style.borderColor='#ff6900';"
                    onmouseout="this.style.backgroundColor='#fff8f0'; this.style.borderColor='#ffd180';">
                    <span class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left" style="color: #ff6900;">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z"/>
                        </svg>
                    </span>
                    <span class="font-bold transition-colors text-sm" style="color: #2d2d2d;"
                        onmouseover="this.style.color='#ff6900';"
                        onmouseout="this.style.color='#2d2d2d';">Pesan</span>
                </a>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll('.counter');

        const animateCounter = (el) => {
            const target = parseInt(el.dataset.value) || 0;
            let current = 0;

            const duration = 1500;
            const stepTime = 16;
            const totalSteps = duration / stepTime;
            const easeOut = (t) => 1 - Math.pow(1 - t, 3);

            let step = 0;

            const update = () => {
                step++;
                const progress = step / totalSteps;
                current = target * easeOut(progress);

                if (step < totalSteps) {
                    el.innerText = Math.floor(current).toLocaleString();
                    requestAnimationFrame(update);
                } else {
                    el.innerText = target.toLocaleString();
                }
            };

            update();
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.6 });

        counters.forEach(counter => observer.observe(counter));
    });
</script>