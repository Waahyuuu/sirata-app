@extends('layouts.error_master')

@section('title', '404 - Halaman Tidak Ditemukan')

@section('content')
<div
    class="flex h-full min-h-[80vh] flex-col items-center justify-center overflow-hidden px-6 py-8 text-center translate-y-10">
    <!-- Wrapper Animasi -->
    <div class="relative mb-8 flex flex-col items-center">

        <!-- Shadow -->
        <div class="shadow-bounce absolute bottom-0 h-5 w-36 rounded-full bg-black/10 blur-xl"></div>

        <!-- Ilustrasi -->
        <div class="animate-float relative z-10">
            <img src="{{ asset('images/404.svg') }}" alt="404 Illustration"
                class="w-60 md:w-72 lg:w-80 drop-shadow-2xl">
        </div>

        <!-- Glow -->
        <div
            class="absolute top-1/2 left-1/2 -z-10 h-48 w-48 -translate-x-1/2 -translate-y-1/2 rounded-full bg-blue-100 blur-3xl opacity-60">
        </div>
    </div>

    <!-- Text -->
    <div class="max-w-lg">
        <h2 class="mb-4 text-3xl font-extrabold text-gray-800 md:text-4xl">
            Waduh! Kamu Terlalu Jauh.
        </h2>

        <p class="mb-8 text-base leading-relaxed text-gray-500 md:text-lg">
            Halaman yang kamu tuju sepertinya sedang bersembunyi atau sudah pindah alamat.
            Yuk, balik ke jalan yang benar!
        </p>
    </div>

    <!-- Buttons -->
    <div class="flex flex-col gap-3 sm:flex-row">

        <a href="{{ url('/') }}"
            class="group inline-flex items-center justify-center rounded-full bg-blue-600 px-7 py-3 font-semibold text-white transition-all duration-300 hover:-translate-y-1 hover:bg-blue-700 hover:shadow-xl hover:shadow-blue-300/40 active:scale-95">

            <svg xmlns="http://www.w3.org/2000/svg"
                class="mr-2 h-5 w-5 transition-transform duration-300 group-hover:-translate-x-1" fill="none"
                viewBox="0 0 24 24" stroke="currentColor">

                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>

            Balik ke Beranda
        </a>

        <button onclick="window.history.back()"
            class="rounded-full border-2 border-gray-200 bg-white px-7 py-3 font-semibold text-gray-600 transition-all duration-300 hover:-translate-y-1 hover:border-gray-300 hover:bg-gray-50 hover:shadow-lg active:scale-95">

            Kembali Sebelumnya
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
            transform: translateY(-18px);
        }
    }

    .animate-float {
        animation: float 4s ease-in-out infinite;
    }

    @keyframes shadow {

        0%,
        100% {
            transform: scale(1);
            opacity: .2;
        }

        50% {
            transform: scale(.8);
            opacity: .12;
        }
    }

    .shadow-bounce {
        animation: shadow 4s ease-in-out infinite;
    }
</style>
@endsection