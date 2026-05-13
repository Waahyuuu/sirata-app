@extends('layouts.error_master')

@section('title', '403 - Akses Ditolak')

@section('content')
<div
    class="flex h-full min-h-[80vh] translate-y-10 flex-col items-center justify-center overflow-hidden px-6 text-center">

    <!-- Wrapper -->
    <div class="relative mb-8 flex flex-col items-center">

        <!-- Shadow -->
        <div class="shadow-bounce absolute bottom-0 h-5 w-40 rounded-full bg-red-900/10 blur-xl"></div>

        <div class="animate-float relative z-10">

            <img src="{{ asset('images/403.svg') }}" alt="403 Forbidden" class="w-64 md:w-72 lg:w-80 drop-shadow-2xl">

        </div>

        <!-- Glow -->
        <div
            class="absolute top-1/2 left-1/2 -z-10 h-56 w-56 -translate-x-1/2 -translate-y-1/2 rounded-full bg-green-100 blur-3xl opacity-70">
        </div>
    </div>

    <!-- Text -->
    <div class="max-w-lg">

        <h2 class="mb-4 text-3xl font-extrabold text-gray-800 md:text-4xl">
            Akses Ditolak
        </h2>

        <p class="mb-8 text-base leading-relaxed text-gray-500 md:text-lg">
            Maaf, kamu tidak memiliki izin untuk mengakses halaman admin ini.
            Silakan kembali ke halaman sebelumnya atau hubungi administrator.
        </p>
    </div>

    <!-- Buttons -->
    <div class="flex flex-col gap-3 sm:flex-row">

        <!-- Dashboard -->
        <a href="{{ url('/admin/dashboard') }}"
            class="group inline-flex items-center justify-center rounded-full bg-red-600 px-7 py-3 font-semibold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-red-700 hover:shadow-xl hover:shadow-red-300/40 active:scale-95">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="mr-2 h-5 w-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            Kembali ke Dashboard
        </a>

        <!-- Back -->
        <button onclick="window.history.back()"
            class="rounded-full border-2 border-gray-200 bg-white px-7 py-3 font-semibold text-gray-600 transition-all duration-300 hover:-translate-y-1 hover:border-gray-300 hover:bg-gray-50 hover:shadow-lg active:scale-95">

            Halaman Sebelumnya
        </button>

    </div>
</div>

<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-15px);
        }
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    @keyframes shadow {

        0%,
        100% {
            transform: scale(1);
            opacity: .18;
        }

        50% {
            transform: scale(.82);
            opacity: .1;
        }
    }

    .shadow-bounce {
        animation: shadow 4s ease-in-out infinite;
    }
</style>
@endsection