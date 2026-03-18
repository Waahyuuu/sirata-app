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

            <!-- Content -->
            <div class="flex-1 px-6">
                @yield('content')
            </div>

        </div>

    </div>

    <!-- Footer -->
    @include('component.footer')

</body>

</html>