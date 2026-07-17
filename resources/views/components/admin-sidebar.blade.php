<div
    class="w-20 lg:w-72 mt-6 bg-[var(--sidebar-primary-color)] rounded-r-[20px] lg:rounded-r-[30px] flex flex-col justify-between overflow-hidden transition-all duration-300">

    <div>

        <!-- Profile -->
        <div class="p-4 lg:p-6">
            <div class="flex items-center justify-center lg:justify-start gap-0 lg:gap-3 mb-5">

                <div class="w-14 h-14 flex items-center justify-center overflow-hidden shrink-0">
                    <img src="/images/download.svg" alt="Logo SIRATA" class="w-14 h-14 object-contain">
                </div>

                <!-- Nama & Role -->
                <div class="hidden lg:block">
                    {{-- Mengambil Nama User --}}
                    <div class="font-bold text-md text-slate-800 capitalize">
                        {{ auth()->user()->name ?? 'Administrator' }}
                    </div>

                    {{-- Mengambil Role User --}}
                    <div class="text-xs font-medium text-[var(--primary-color)] uppercase tracking-wider">
                        {{ auth()->user()->role ?? 'Admin' }}
                    </div>
                </div>

            </div>
        </div>

        <div class="space-y-3">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}" class="menu-item flex items-center justify-center lg:justify-start gap-3
                {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">

                <!-- Icon Dashboard -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 shrink-0">
                    <path fill-rule="evenodd"
                        d="M3 6a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3V6Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3v2.25a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3V6ZM3 15.75a3 3 0 0 1 3-3h2.25a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3H6a3 3 0 0 1-3-3v-2.25Zm9.75 0a3 3 0 0 1 3-3H18a3 3 0 0 1 3 3V18a3 3 0 0 1-3 3h-2.25a3 3 0 0 1-3-3v-2.25Z"
                        clip-rule="evenodd" />
                </svg>

                <span class="lg:inline">Dashboard</span>
            </a>

            <!-- Pesan dengan Badge Notifikasi -->
            <a href="{{ route('admin.pesan') }}" id="pesanMenuLink" class="menu-item flex items-center justify-center lg:justify-start gap-3 relative
                {{ request()->routeIs('admin.pesan*') ? 'active' : '' }}">

                <!-- Icon Pesan -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 shrink-0">
                    <path
                        d="M4.913 2.658c2.075-.27 4.19-.408 6.337-.408 2.147 0 4.262.139 6.337.408 1.922.25 3.291 1.861 3.405 3.727a4.403 4.403 0 0 0-1.032-.211 50.89 50.89 0 0 0-8.42 0c-2.358.196-4.04 2.19-4.04 4.434v4.286a4.47 4.47 0 0 0 2.433 3.984L7.28 21.53A.75.75 0 0 1 6 21v-4.03a48.527 48.527 0 0 1-1.087-.128C2.905 16.58 1.5 14.833 1.5 12.862V6.638c0-1.97 1.405-3.718 3.413-3.979Z" />
                    <path
                        d="M15.75 7.5c-1.376 0-2.739.057-4.086.169C10.124 7.797 9 9.103 9 10.609v4.285c0 1.507 1.128 2.814 2.67 2.94 1.243.102 2.5.157 3.768.165l2.782 2.781a.75.75 0 0 0 1.28-.53v-2.39l.33-.026c1.542-.125 2.67-1.433 2.67-2.94v-4.286c0-1.505-1.125-2.811-2.664-2.94A49.392 49.392 0 0 0 15.75 7.5Z" />
                </svg>

                <span class="lg:inline">Manajemen Pesan</span>

                <!-- Badge Notifikasi -->
                <span id="unreadBadge"
                    class="absolute -top-1 -right-1 lg:static lg:ml-auto bg-red-500 text-white text-[10px] font-bold rounded-full min-w-[20px] h-5 flex items-center justify-center px-1.5 shadow-lg ring-2 ring-white hidden">
                    0
                </span>
            </a>

            <!-- Mahasiswa -->
            <a href="{{ route('admin.mahasiswa') }}" class="menu-item flex items-center justify-center lg:justify-start gap-3
                {{ request()->routeIs('admin.mahasiswa') ? 'active' : '' }}">

                <!-- Icon Mahasiswa -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 shrink-0">
                    <path
                        d="M11.7 2.805a.75.75 0 0 1 .6 0A60.65 60.65 0 0 1 22.83 8.72a.75.75 0 0 1-.231 1.337 49.948 49.948 0 0 0-9.902 3.912l-.003.002c-.114.06-.227.119-.34.18a.75.75 0 0 1-.707 0A50.88 50.88 0 0 0 7.5 12.173v-.224c0-.131.067-.248.172-.311a54.615 54.615 0 0 1 4.653-2.52.75.75 0 0 0-.65-1.352 56.123 56.123 0 0 0-4.78 2.589 1.858 1.858 0 0 0-.859 1.228 49.803 49.803 0 0 0-4.634-1.527.75.75 0 0 1-.231-1.337A60.653 60.653 0 0 1 11.7 2.805Z" />
                    <path
                        d="M13.06 15.473a48.45 48.45 0 0 1 7.666-3.282c.134 1.414.22 2.843.255 4.284a.75.75 0 0 1-.46.711 47.87 47.87 0 0 0-8.105 4.342.75.75 0 0 1-.832 0 47.87 47.87 0 0 0-8.104-4.342.75.75 0 0 1-.461-.71c.035-1.442.121-2.87.255-4.286.921.304 1.83.634 2.726.99v1.27a1.5 1.5 0 0 0-.14 2.508c-.09.38-.222.753-.397 1.11.452.213.901.434 1.346.66a6.727 6.727 0 0 0 .551-1.607 1.5 1.5 0 0 0 .14-2.67v-.645a48.549 48.549 0 0 1 3.44 1.667 2.25 2.25 0 0 0 2.12 0Z" />
                    <path
                        d="M4.462 19.462c.42-.419.753-.89 1-1.395.453.214.902.435 1.347.662a6.742 6.742 0 0 1-1.286 1.794.75.75 0 0 1-1.06-1.06Z" />
                </svg>

                <span class="lg:inline">Data Mahasiswa</span>
            </a>

            <!-- Konten -->
            <a href="{{ route('admin.konten') }}" class="menu-item flex items-center justify-center lg:justify-start gap-3
                {{ request()->routeIs('admin.konten*') ? 'active' : '' }}">

                <!-- Icon Konten -->
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 6.75a5.25 5.25 0 0 1 6.775-5.025.75.75 0 0 1 .313 1.248l-3.32 3.319c.063.475.276.934.641 1.299.365.365.824.578 1.3.64l3.318-3.319a.75.75 0 0 1 1.248.313 5.25 5.25 0 0 1-5.472 6.756c-1.018-.086-1.87.1-2.309.634L7.344 21.3A3.298 3.298 0 1 1 2.7 16.657l8.684-7.151c.533-.44.72-1.291.634-2.309A5.342 5.342 0 0 1 12 6.75ZM4.117 19.125a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z"
                        clip-rule="evenodd" />
                    <path
                        d="m10.076 8.64-2.201-2.2V4.874a.75.75 0 0 0-.364-.643l-3.75-2.25a.75.75 0 0 0-.916.113l-.75.75a.75.75 0 0 0-.113.916l2.25 3.75a.75.75 0 0 0 .643.364h1.564l2.062 2.062 1.575-1.297Z" />
                    <path fill-rule="evenodd"
                        d="m12.556 17.329 4.183 4.182a3.375 3.375 0 0 0 4.773-4.773l-3.306-3.305a6.803 6.803 0 0 1-1.53.043c-.394-.034-.682-.006-.867.042a.589.589 0 0 0-.167.063l-3.086 3.748Zm3.414-1.36a.75.75 0 0 1 1.06 0l1.875 1.876a.75.75 0 1 1-1.06 1.06L15.97 17.03a.75.75 0 0 1 0-1.06Z"
                        clip-rule="evenodd" />
                </svg>

                <span class="lg:inline">Manajemen Content</span>
            </a>

            @if(auth()->check() && auth()->user()->is_protected)
            <!-- Management Akun -->
            <a href="{{ route('admin.akun.index') }}" class="menu-item flex items-center justify-center lg:justify-start gap-3
                {{ request()->routeIs('admin.akun*') ? 'active' : '' }}">

                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 shrink-0">
                    <path fill="currentColor"
                        d="M12 5.5A3.5 3.5 0 0 1 15.5 9a3.5 3.5 0 0 1-3.5 3.5A3.5 3.5 0 0 1 8.5 9A3.5 3.5 0 0 1 12 5.5M5 8c.56 0 1.08.15 1.53.42c-.15 1.43.27 2.85 1.13 3.96C7.16 13.34 6.16 14 5 14a3 3 0 0 1-3-3a3 3 0 0 1 3-3m14 0a3 3 0 0 1 3 3a3 3 0 0 1-3 3c-1.16 0-2.16-.66-2.66-1.62a5.54 5.54 0 0 0 1.13-3.96c.45-.27.97-.42 1.53-.42M5.5 18.25c0-2.07 2.91-3.75 6.5-3.75s6.5 1.68 6.5 3.75V20h-13zM0 20v-1.5c0-1.39 1.89-2.56 4.45-2.9c-.59.68-.95 1.62-.95 2.65V20zm24 0h-3.5v-1.75c0-1.03-.36-1.97-.95-2.65c2.56.34 4.45 1.51 4.45 2.9z" />
                </svg>

                <span class="lg:inline">Management Akun</span>
            </a>
            @endif

        </div>
    </div>

    <!-- Logout -->
    <div class="mb-6 px-2">
        <form action="{{ route('admin.logout') }}" method="POST" onsubmit="sessionStorage.removeItem('activeTab')">
            @csrf

            <button type="submit"
                class="menu-item w-full text-left flex items-center justify-center lg:justify-start gap-3">

                <!-- Icon Logout -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    class="size-7 shrink-0">
                    <path fill="currentColor" fill-rule="evenodd"
                        d="M9.707 2.409C9 3.036 9 4.183 9 6.476v11.048c0 2.293 0 3.44.707 4.067s1.788.439 3.95.062l2.33-.406c2.394-.418 3.591-.627 4.302-1.505c.711-.879.711-2.149.711-4.69V8.948c0-2.54 0-3.81-.71-4.689c-.712-.878-1.91-1.087-4.304-1.504l-2.328-.407c-2.162-.377-3.243-.565-3.95.062"
                        clip-rule="evenodd" />
                    <path fill="currentColor"
                        d="M7.547 4.5c-2.058.003-3.131.048-3.815.732C3 5.964 3 7.142 3 9.5v5c0 2.357 0 3.535.732 4.268c.684.683 1.757.729 3.815.732c-.047-.624-.047-1.344-.047-2.123V6.623c0-.78 0-1.5.047-2.123" />
                </svg>

                <span class="lg:inline">Keluar</span>
            </button>
        </form>
    </div>

</div>

<!-- Script untuk Update Badge -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const badge = document.getElementById('unreadBadge');
        
        // Fungsi untuk update jumlah pesan belum dibaca
        function updateUnreadCount() {
            fetch('/chatbot/unread-count')
                .then(response => response.json())
                .then(data => {
                    const count = data.unread || 0;
                    if (count > 0) {
                        badge.textContent = count > 99 ? '99+' : count;
                        badge.classList.remove('hidden');
                        
                        // Animasi badge
                        badge.style.transition = 'transform 0.3s ease';
                        badge.style.transform = 'scale(1.3)';
                        setTimeout(() => {
                            badge.style.transform = 'scale(1)';
                        }, 300);
                    } else {
                        badge.classList.add('hidden');
                    }
                })
                .catch(error => {
                    console.error('Error fetching unread count:', error);
                });
        }

        // Update pertama kali
        updateUnreadCount();

        // Update setiap 5 detik
        setInterval(updateUnreadCount, 5000);

        // Jika di halaman pesan, update badge saat pesan dibaca
        if (window.location.pathname.includes('/admin/pesan')) {
            // Reset badge saat di halaman pesan
            badge.classList.add('hidden');
            
            // Update badge saat ada perubahan pada chat
            document.addEventListener('chatRead', function() {
                updateUnreadCount();
            });
        }
    });
</script>