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
</head>

<body class="h-screen bg-white flex flex-col">

    <!-- MAIN WRAPPER -->
    <div class="flex flex-1 overflow-hidden">

        <!-- Sidebar -->
        @include('components.admin-sidebar')

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">

            <!-- Header -->
            <div class="p-6">
                <div class="bg-[#BFC3C9] rounded-2xl px-6 py-4 text-xl font-semibold shadow">
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

</body>

</html>