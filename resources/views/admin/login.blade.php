<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login SIRATA</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="bg-gray-200 min-h-screen flex items-center justify-center p-6">

    <div class="w-full max-w-6xl min-h-[75vh] bg-white rounded-2xl shadow-2xl border flex overflow-hidden">

        <div class="w-2/3 bg-gray-100 p-8 flex flex-col justify-between">

            <div>
                <h2 class="text-2xl font-bold flex items-center gap-2 mb-10">

                    <img src="/images/download.svg" alt="Logo SIRATA" class="w-8 h-8 object-contain">

                    SIRATA

                </h2>

                <div class="flex justify-center items-center flex-1">
                    <img src="/images/undraw_secure-login_m11a.svg" alt="Preview Sistem" class="w-[420px]">
                </div>
            </div>

            <a href="/"
                class="text-sm text-gray-500 hover:text-black transition duration-300 flex items-center gap-2 group">

                <span class="transform transition group-hover:-translate-x-1">
                    ←
                </span>

                Back to home

            </a>

        </div>

        <div
            class="w-3/3 bg-gray-50 p-10 flex flex-col items-center justify-center text-center relative overflow-hidden">

            <div class="absolute inset-0 opacity-30 
                [background-image:radial-gradient(#d1d5db_1px,transparent_1px)] 
                [background-size:18px_18px]">
            </div>

            <span class="bg-yellow-300 px-4 py-1 rounded-full text-sm font-semibold mb-4">
                ADMIN PANEL
            </span>

            <h1 class="text-4xl font-bold mb-2">
                Welcome to SIRATA!
            </h1>

            <p class="text-gray-500 mb-8 max-w-md">
                Stimata Malang Reporting System.
                Please sign in to access dashboard panel.
            </p>

            <!-- LOGIN CARD -->
            <div class="bg-white shadow-xl rounded-2xl p-10 w-full max-w-md border border-gray-100 z-10">

                @if(session('error'))
                <div class="bg-red-100 text-red-700 p-3 rounded-lg mb-5 text-sm">
                    {{ session('error') }}
                </div>
                @endif

                <form method="POST" action="/admin/login" class="space-y-6">
                    @csrf

                    <!-- Username -->
                    <div class="relative">
                        <input type="text" name="username" id="username" placeholder=" "
                            class="peer w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-green-500 focus:outline-none">

                        <label for="username" class="absolute left-3 -top-2 text-sm text-gray-500 bg-white px-1 
                            transition-all
                            peer-placeholder-shown:top-3.5 
                            peer-placeholder-shown:text-base 
                            peer-placeholder-shown:text-gray-400
                            peer-focus:-top-2.5 
                            peer-focus:text-sm 
                            peer-focus:text-green-500">
                            Username
                        </label>
                    </div>

                    <!-- Password -->
                    <div class="relative">
                        <input type="password" name="password" id="password" placeholder=" "
                            class="peer w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-green-500 focus:outline-none">

                        <label for="password" class="absolute left-3 -top-2 text-sm text-gray-500 bg-white px-1 
                            transition-all
                            peer-placeholder-shown:top-3.5 
                            peer-placeholder-shown:text-base 
                            peer-placeholder-shown:text-gray-400
                            peer-focus:-top-2.5 
                            peer-focus:text-sm 
                            peer-focus:text-green-500">
                            Password
                        </label>
                    </div>

                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-semibold py-3 rounded-lg shadow-md transition duration-300">
                        Sign In to Continue
                    </button>

                </form>

            </div>

        </div>

    </div>

</body>

</html>