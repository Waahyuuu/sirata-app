<div class="space-y-6">

    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5">

        <div
            class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-blue-50 flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="m227.79 52.62l-96-32a11.85 11.85 0 0 0-7.58 0l-96 32A12 12 0 0 0 20 63.37a6 6 0 0 0 0 .63v80a12 12 0 0 0 24 0V80.65l23.71 7.9a67.92 67.92 0 0 0 18.42 85A100.36 100.36 0 0 0 46 209.44a12 12 0 1 0 20.1 13.11C80.37 200.59 103 188 128 188s47.63 12.59 61.95 34.55a12 12 0 1 0 20.1-13.11a100.36 100.36 0 0 0-40.18-35.92a67.92 67.92 0 0 0 18.42-85l39.5-13.17a12 12 0 0 0 0-22.76Zm-99.79-8L186.05 64L128 83.35L70 64ZM172 120a44 44 0 1 1-81.06-23.71l33.27 11.09a11.9 11.9 0 0 0 7.58 0l33.27-11.09A43.85 43.85 0 0 1 172 120" />
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase italic">Total</span>
                </div>
            </div>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Mahasiswa</p>
            <h2 class="counter text-3xl font-black text-slate-800 mt-1 tracking-tight"
                data-value="{{ $stats[0]['value'] ?? 0 }}">
                0
            </h2>
        </div>

        <div
            class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-emerald-50 flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 256 256">
                        <path fill="currentColor"
                            d="M225.86 102.82c-3.77-3.94-7.67-8-9.14-11.57c-1.36-3.27-1.44-8.69-1.52-13.94c-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52c-3.56-1.47-7.63-5.37-11.57-9.14C146.28 23.51 138.44 16 128 16s-18.27 7.51-25.18 14.14c-3.94 3.77-8 7.67-11.57 9.14c-3.25 1.36-8.69 1.44-13.94 1.52c-9.76.15-20.82.31-28.51 8s-7.8 18.75-8 28.51c-.08 5.25-.16 10.67-1.52 13.94c-1.47 3.56-5.37 7.63-9.14 11.57C23.51 109.72 16 117.56 16 128s7.51 18.27 14.14 25.18c3.77 3.94 7.67 8 9.14 11.57c1.36 3.27 1.44 8.69 1.52 13.94c.15 9.76.31 20.82 8 28.51s18.75 7.85 28.51 8c5.25.08 10.67.16 13.94 1.52c3.56 1.47 7.63 5.37 11.57 9.14c6.9 6.63 14.74 14.14 25.18 14.14s18.27-7.51 25.18-14.14c3.94-3.77 8-7.67 11.57-9.14c3.27-1.36 8.69-1.44 13.94-1.52c9.76-.15 20.82-.31 28.51-8s7.85-18.75 8-28.51c.08-5.25.16-10.67 1.52-13.94c1.47-3.56 5.37-7.63 9.14-11.57c6.63-6.9 14.14-14.74 14.14-25.18s-7.51-18.27-14.14-25.18m-52.2 6.84l-56 56a8 8 0 0 1-11.32 0l-24-24a8 8 0 0 1 11.32-11.32L112 148.69l50.34-50.35a8 8 0 0 1 11.32 11.32" />
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase italic">Item</span>
                </div>
            </div>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Manfaat</p>
            <h2 class="counter text-3xl font-black text-slate-800 mt-1 tracking-tight"
                data-value="{{ $stats[1]['value'] ?? 0 }}">
                0
            </h2>
        </div>

        <div
            class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center text-amber-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 16 16">
                        <g fill="currentColor">
                            <path
                                d="M12.243 3.757a2 2 0 0 0-2.829 0L7.293 5.88L5.879 4.464L8 2.344a4 4 0 0 1 5.657 0l.707.706l-.09.09A4 4 0 0 1 13.658 8l-2.121 2.121l-1.415-1.414l2.122-2.121a2 2 0 0 0 0-2.829Zm-8.486 8.486a2 2 0 0 0 2.829 0l2.121-2.122l1.414 1.415L8 13.655a4 4 0 0 1-5.657 0l-.707-.706l.09-.09A4 4 0 0 1 2.342 8l2.121-2.121L5.88 7.293L3.757 9.414a2 2 0 0 0 0 2.829" />
                            <path d="M10.828 6.586L9.414 5.172L5.172 9.414l1.414 1.414z" />
                        </g>
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase italic">Item</span>
                </div>
            </div>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Link</p>
            <h2 class="counter text-3xl font-black text-slate-800 mt-1 tracking-tight"
                data-value="{{ $stats[2]['value'] ?? 0 }}">
                0
            </h2>
        </div>

        <div
            class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-rose-50 flex items-center justify-center text-rose-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 26 26">
                        <path fill="currentColor"
                            d="M13 0c-1.7 0-3 1.3-3 3v6c0 1.7 1.3 3 3 3h6l4 4v-4c1.7 0 3-1.3 3-3V3c0-1.7-1.3-3-3-3zm4.188 3h1.718l1.688 6h-1.5l-.407-1.5h-1.5L16.813 9H15.5zM18 4c-.1.4-.212.888-.313 1.188l-.28 1.312h1.187l-.282-1.313C18.113 4.888 18 4.4 18 4M3 10c-1.7 0-3 1.3-3 3v6c0 1.7 1.3 3 3 3v4l4-4h6c1.7 0 3-1.3 3-3v-6h-3c-1.9 0-3.406-1.3-3.906-3zm4.594 2.906c1.7 0 2.5 1.4 2.5 3c0 1.4-.481 2.288-1.281 2.688c.4.2.874.306 1.374.406l-.374 1c-.7-.2-1.426-.512-2.126-.813c-.1-.1-.275-.093-.375-.093C6.112 18.994 5 18 5 16c0-1.7.994-3.094 2.594-3.094m0 1.094c-.8 0-1.188.9-1.188 2c0 1.2.388 2 1.188 2s1.218-.9 1.218-2s-.418-2-1.218-2" />
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase italic">Item</span>
                </div>
            </div>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">FAQ</p>
            <h2 class="counter text-3xl font-black text-slate-800 mt-1 tracking-tight"
                data-value="{{ $stats[3]['value'] ?? 0 }}">
                0
            </h2>
        </div>

        <div
            class="group bg-white p-5 rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
            <div class="flex items-center justify-between mb-4">
                <div
                    class="w-12 h-12 rounded-2xl bg-violet-50 flex items-center justify-center text-violet-600 group-hover:scale-110 transition-transform">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                        <path fill="currentColor"
                            d="M17 3a1 1 0 1 0-2 0v1h-4.75A3.25 3.25 0 0 0 7 7.25v5.5A3.25 3.25 0 0 0 10.25 16h7.093A8.96 8.96 0 0 1 23 14q.863.001 1.68.157c.205-.426.32-.903.32-1.407v-5.5A3.25 3.25 0 0 0 21.75 4H17zM8.25 19h6.685A8.96 8.96 0 0 0 14 23a8.98 8.98 0 0 0 3.298 6.964Q16.667 30 16 30c-3.366 0-6.08-.698-7.987-1.968C6.077 26.742 5 24.871 5 22.7v-.45A3.25 3.25 0 0 1 8.25 19m4.25-7.25a1.75 1.75 0 1 1 0-3.5a1.75 1.75 0 0 1 0 3.5M21.25 10a1.75 1.75 0 1 1-3.5 0a1.75 1.75 0 0 1 3.5 0M23 30.5a7.5 7.5 0 1 0 0-15a7.5 7.5 0 0 0 0 15m1-12.25V22h3.75a.75.75 0 0 1 0 1.5H24v3.75a.75.75 0 0 1-1.5 0V23.5h-3.75a.75.75 0 0 1 0-1.5h3.75v-3.75a.75.75 0 0 1 1.5 0" />
                    </svg>
                </div>
                <div class="flex flex-col items-end">
                    <span class="text-[10px] font-bold text-slate-400 tracking-widest uppercase italic">Rules</span>
                </div>
            </div>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-wider">Chatbot</p>
            <h2 class="counter text-3xl font-black text-slate-800 mt-1 tracking-tight"
                data-value="{{ $stats[4]['value'] ?? 0 }}">
                0
            </h2>
        </div>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 pb-1">

        <div
            class="lg:col-span-7 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm flex flex-col justify-center relative overflow-hidden">
            <div class="absolute -right-10 -bottom-10 pointer-events-none rotate-12">
                <img src="/images/download.svg" alt="Logo SIRATA Background"
                    class="w-48 h-48 object-contain opacity-20">
            </div>

            <div class="relative z-10">
                <h3 class="font-black text-2xl text-slate-800 mb-2">SIRATA <span
                        class="text-indigo-600 italic">Core</span></h3>
                <p class="text-slate-500 leading-relaxed mb-6 max-w-md">
                    Selamat bekerja kembali! Gunakan panel di sebelah kanan untuk manajemen cepat atau navigasi sidebar
                    untuk kontrol penuh. Sistem saat ini terhubung ke API Kampus dengan status optimal.
                </p>

                <div class="flex flex-wrap gap-4">
                    <div
                        class="px-5 py-3 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-3 shadow-sm">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-sm font-bold text-slate-700">Database Encrypted</span>
                    </div>
                    <div
                        class="px-5 py-3 rounded-2xl bg-slate-50 border border-slate-100 flex items-center gap-3 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-indigo-500" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                        <span class="text-sm font-bold text-slate-700">API Server</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-5 bg-white p-8 rounded-3xl border border-slate-100 shadow-sm">
            <h3 class="font-bold text-xl text-slate-800 mb-6 flex items-center gap-2">
                Akses Cepat
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <a href="{{ route('admin.konten', ['tab' => 'faq']) }}"
                    class="group flex flex-col p-4 bg-slate-50 hover:bg-indigo-600 rounded-2xl transition-all duration-300 shadow-sm border border-transparent">
                    <span
                        class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 26 26">
                            <path fill="currentColor"
                                d="M13 0c-1.7 0-3 1.3-3 3v6c0 1.7 1.3 3 3 3h6l4 4v-4c1.7 0 3-1.3 3-3V3c0-1.7-1.3-3-3-3zm4.188 3h1.718l1.688 6h-1.5l-.407-1.5h-1.5L16.813 9H15.5zM18 4c-.1.4-.212.888-.313 1.188l-.28 1.312h1.187l-.282-1.313C18.113 4.888 18 4.4 18 4M3 10c-1.7 0-3 1.3-3 3v6c0 1.7 1.3 3 3 3v4l4-4h6c1.7 0 3-1.3 3-3v-6h-3c-1.9 0-3.406-1.3-3.906-3zm4.594 2.906c1.7 0 2.5 1.4 2.5 3c0 1.4-.481 2.288-1.281 2.688c.4.2.874.306 1.374.406l-.374 1c-.7-.2-1.426-.512-2.126-.813c-.1-.1-.275-.093-.375-.093C6.112 18.994 5 18 5 16c0-1.7.994-3.094 2.594-3.094m0 1.094c-.8 0-1.188.9-1.188 2c0 1.2.388 2 1.188 2s1.218-.9 1.218-2s-.418-2-1.218-2" />
                        </svg>
                    </span>
                    <span class="font-bold text-slate-700 group-hover:text-white transition-colors text-sm">Kelola
                        FAQ</span>
                </a>

                <a href="{{ route('admin.konten', ['tab' => 'manfaat']) }}"
                    class="group flex flex-col p-4 bg-slate-50 hover:bg-emerald-600 rounded-2xl transition-all duration-300 shadow-sm border border-transparent">
                    <span
                        class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="25" viewBox="0 0 256 256">
                            <path fill="currentColor"
                                d="M225.86 102.82c-3.77-3.94-7.67-8-9.14-11.57c-1.36-3.27-1.44-8.69-1.52-13.94c-.15-9.76-.31-20.82-8-28.51s-18.75-7.85-28.51-8c-5.25-.08-10.67-.16-13.94-1.52c-3.56-1.47-7.63-5.37-11.57-9.14C146.28 23.51 138.44 16 128 16s-18.27 7.51-25.18 14.14c-3.94 3.77-8 7.67-11.57 9.14c-3.25 1.36-8.69 1.44-13.94 1.52c-9.76.15-20.82.31-28.51 8s-7.8 18.75-8 28.51c-.08 5.25-.16 10.67-1.52 13.94c-1.47 3.56-5.37 7.63-9.14 11.57C23.51 109.72 16 117.56 16 128s7.51 18.27 14.14 25.18c3.77 3.94 7.67 8 9.14 11.57c1.36 3.27 1.44 8.69 1.52 13.94c.15 9.76.31 20.82 8 28.51s18.75 7.85 28.51 8c5.25.08 10.67.16 13.94 1.52c3.56 1.47 7.63 5.37 11.57 9.14c6.9 6.63 14.74 14.14 25.18 14.14s18.27-7.51 25.18-14.14c3.94-3.77 8-7.67 11.57-9.14c3.27-1.36 8.69-1.44 13.94-1.52c9.76-.15 20.82-.31 28.51-8s7.85-18.75 8-28.51c.08-5.25.16-10.67 1.52-13.94c1.47-3.56 5.37-7.63 9.14-11.57c6.63-6.9 14.14-14.74 14.14-25.18s-7.51-18.27-14.14-25.18m-52.2 6.84l-56 56a8 8 0 0 1-11.32 0l-24-24a8 8 0 0 1 11.32-11.32L112 148.69l50.34-50.35a8 8 0 0 1 11.32 11.32" />
                        </svg>
                    </span>
                    <span class="font-bold text-slate-700 group-hover:text-white transition-colors text-sm">Kelola
                        Manfaat</span>
                </a>

                <a href="{{ route('admin.konten', ['tab' => 'link']) }}"
                    class="group flex flex-col p-4 bg-slate-50 hover:bg-amber-500 rounded-2xl transition-all duration-300 shadow-sm border border-transparent">
                    <span
                        class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 16 16">
                            <g fill="currentColor">
                                <path
                                    d="M12.243 3.757a2 2 0 0 0-2.829 0L7.293 5.88L5.879 4.464L8 2.344a4 4 0 0 1 5.657 0l.707.706l-.09.09A4 4 0 0 1 13.658 8l-2.121 2.121l-1.415-1.414l2.122-2.121a2 2 0 0 0 0-2.829Zm-8.486 8.486a2 2 0 0 0 2.829 0l2.121-2.122l1.414 1.415L8 13.655a4 4 0 0 1-5.657 0l-.707-.706l.09-.09A4 4 0 0 1 2.342 8l2.121-2.121L5.88 7.293L3.757 9.414a2 2 0 0 0 0 2.829" />
                                <path d="M10.828 6.586L9.414 5.172L5.172 9.414l1.414 1.414z" />
                            </g>
                        </svg>
                    </span>
                    <span class="font-bold text-slate-700 group-hover:text-white transition-colors text-sm">Kelola
                        Link</span>
                </a>

                <a href="{{ route('admin.pesan', ['tab' => 'setting']) }}"
                    class="group flex flex-col p-4 bg-slate-50 hover:bg-violet-600 rounded-2xl transition-all duration-300 shadow-sm border border-transparent">
                    <span
                        class="text-2xl mb-2 group-hover:scale-110 transition-transform origin-left group-hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 32 32">
                            <path fill="currentColor"
                                d="M17 3a1 1 0 1 0-2 0v1h-4.75A3.25 3.25 0 0 0 7 7.25v5.5A3.25 3.25 0 0 0 10.25 16h7.093A8.96 8.96 0 0 1 23 14q.863.001 1.68.157c.205-.426.32-.903.32-1.407v-5.5A3.25 3.25 0 0 0 21.75 4H17zM8.25 19h6.685A8.96 8.96 0 0 0 14 23a8.98 8.98 0 0 0 3.298 6.964Q16.667 30 16 30c-3.366 0-6.08-.698-7.987-1.968C6.077 26.742 5 24.871 5 22.7v-.45A3.25 3.25 0 0 1 8.25 19m4.25-7.25a1.75 1.75 0 1 1 0-3.5a1.75 1.75 0 0 1 0 3.5M21.25 10a1.75 1.75 0 1 1-3.5 0a1.75 1.75 0 0 1 3.5 0M23 30.5a7.5 7.5 0 1 0 0-15a7.5 7.5 0 0 0 0 15m1-12.25V22h3.75a.75.75 0 0 1 0 1.5H24v3.75a.75.75 0 0 1-1.5 0V23.5h-3.75a.75.75 0 0 1 0-1.5h3.75v-3.75a.75.75 0 0 1 1.5 0" />
                        </svg>
                    </span>
                    <span class="font-bold text-slate-700 group-hover:text-white transition-colors text-sm">Chatbot
                        Rules</span>
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

    // animasi hanya saat terlihat (lebih smooth UX)
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