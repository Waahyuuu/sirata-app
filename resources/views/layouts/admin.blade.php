<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SIRATA - @yield('title')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white flex flex-col min-h-screen">

    <!-- MAIN WRAPPER -->
    <div class="flex flex-1 min-h-0">

        <!-- Sidebar -->
        @include('component.admin-sidebar')

        <!-- Main Content -->
        <div class="flex flex-col flex-1 min-h-0">

            <!-- Header -->
            <div class="p-6">
                <div class="bg-[#BFC3C9] rounded-2xl px-6 py-4 text-xl font-semibold shadow">
                    @yield('title')
                </div>
            </div>

            <!-- Content Area -->
            <div class="flex-1 px-6 pb-6 overflow-y-auto relative">

                <!-- FLOATING ALERT -->
                <div class="fixed top-5 right-5 z-50 space-y-2 w-80">

                    @if(session('success'))
                    @include('component.alert', [
                    'type' => 'success',
                    'message' => session('success')
                    ])
                    @endif

                    @if(session('error'))
                    @include('component.alert', [
                    'type' => 'error',
                    'message' => session('error')
                    ])
                    @endif

                    @if ($errors->any())
                    @include('component.alert', [
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
    @include('component.footer')

</body>

</html>