<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIRATA - @yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white flex flex-col min-h-screen">

    <div class="flex flex-1">

        <!-- Sidebar -->
        @include('component.admin-sidebar')

        <!-- Main -->
        <div class="flex-1 flex flex-col">

            <!-- Header -->
            <div class="p-6">
                <div class="bg-[#BFC3C9] rounded-2xl px-6 py-4 text-xl font-semibold shadow">
                    @yield('title')
                </div>
            </div>

            <div class="flex-1 px-6 mb-6 flex flex-col overflow-hidden">

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

                <div class="flex-1 overflow-hidden">
                    @yield('content')
                </div>

            </div>

        </div>

    </div>

    <!-- Footer -->
    @include('component.footer')

</body>

</html>