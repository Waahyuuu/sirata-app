<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes progress {
        0% {
            width: 0%;
        }

        50% {
            width: 70%;
        }

        100% {
            width: 100%;
        }
    }

    .animate-progress {
        animation: progress 1.5s ease-in-out infinite;
    }
</style>

<div id="loadingOverlay"
    class="fixed inset-0 bg-black/30 backdrop-blur-md flex items-center justify-center z-50 hidden transition-all duration-300">

    <div
        class="bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl px-8 py-6 flex flex-col items-center gap-5 animate-fadeIn">

        <div class="relative">
            <div class="w-16 h-16 border-4 border-blue-200 rounded-full"></div>
            <div
                class="w-16 h-16 border-4 border-blue-600 border-t-transparent rounded-full animate-spin absolute top-0 left-0">
            </div>
        </div>

        <p class="text-gray-800 font-semibold text-lg text-center">
            {{ $text ?? 'Sedang memproses data mahasiswa...' }}
        </p>

        <p class="text-gray-500 text-sm">
            Mohon tunggu sebentar...
        </p>

        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
            <div class="h-full bg-blue-600 animate-progress"></div>
        </div>

    </div>
</div>