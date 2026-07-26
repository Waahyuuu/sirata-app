<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIRATA - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="h-screen bg-white flex flex-col">

    <!-- ============================================ -->
    <!-- MOBILE HEADER (Muncul hanya di mobile) -->
    <!-- ============================================ -->
    <header class="bg-white shadow-sm px-4 py-3 flex items-center justify-between lg:hidden fixed top-0 left-0 right-0 z-40">
        <button id="hamburgerBtn" class="p-2 rounded-lg hover:bg-gray-100 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="font-bold text-lg text-[#f54a00]">SIRATA</div>
        <div class="w-10"></div>
    </header>

    <!-- MAIN WRAPPER -->
    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar - Desktop -->
        <div class="hidden lg:flex">
            @include('components.user-sidebar')
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">

            <!-- Header -->
            <div class="p-6 mt-14 lg:mt-0">
                <div class="bg-[var(--sidebar-primary-color)] rounded-2xl px-6 py-4 text-xl font-semibold shadow">
                    @yield('title')
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 px-6 overflow-y-auto relative">

                <!-- FLOATING ALERT -->
                <div class="fixed top-5 right-5 z-50 space-y-2 w-80">

                    @if(session('success'))
                    @include('components.alert', [
                    'type' => 'success',
                    'message' => session('success')
                    ])
                    @endif

                    @if(session('error'))
                    @include('components.alert', [
                    'type' => 'error',
                    'message' => session('error')
                    ])
                    @endif

                    @if ($errors->any())
                    @include('components.alert', [
                    'type' => 'error',
                    'message' => $errors->first()
                    ])
                    @endif

                </div>

                @yield('content')

            </div>

        </div>

    </div>

    <!-- Footer -->
    <div class="w-full pt-6">
        @include('components.footer')
    </div>

    @include('partials.chatbot-button')

    <x-mobile-menu 
        :initial="$initial ?? 'U'" 
        :nama="$nama ?? 'User'" 
        :nim="$nim ?? 'NIM'" 
    />

    <script src="//unpkg.com/alpinejs" defer></script>
    @stack('scripts')
</body>

</html>