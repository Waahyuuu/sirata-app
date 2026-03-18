<div class="w-72 mt-6 mb-6 bg-[#BFC3C9] rounded-r-[30px] flex flex-col justify-between overflow-hidden">

    <div>

        <!-- Profile (pakai padding) -->
        <div class="p-6">
            <div class="flex items-center gap-4 mb-5">
                <img src="https://i.pravatar.cc/60" class="w-14 h-14 rounded-full">
                <div>
                    <div class="font-semibold text-sm">User Name</div>
                    <div class="text-xs text-gray-600">Admin</div>
                </div>
            </div>
        </div>

        <div class="space-y-3">

            <!-- Dashboard -->
            <a href="{{ route('admin.dashboard') }}"
                class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span>Dashboard</span>
            </a>

            <!-- Pesan -->
            <a href="{{ route('admin.pesan') }}"
                class="menu-item {{ request()->routeIs('admin.pesan') ? 'active' : '' }}">
                <span>Chatting</span>
            </a>

            <!-- Mahasiswa -->
            <a href="{{ route('admin.mahasiswa') }}"
                class="menu-item {{ request()->routeIs('admin.mahasiswa') ? 'active' : '' }}">
                <span>Data Mahasiswa</span>
            </a>

            <!-- Konten -->
            <a href="{{ route('admin.konten') }}"
                class="menu-item {{ request()->routeIs('admin.konten*') ? 'active' : '' }}">
                <span>Manajemen Content</span>
            </a>

        </div>
    </div>

    <div class="mb-6">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="menu-item w-full text-left">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <path d="M16 17l5-5-5-5M21 12H9" />
                </svg>
                <span>Keluar</span>
            </button>
        </form>
    </div>

</div>