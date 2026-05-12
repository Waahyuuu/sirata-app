<style>
    /* BACKDROP */
    #loadingOverlay {
        transition: all 0.3s ease;
    }

    /* CARD */
    .loading-card {
        animation: fadeScale 0.35s ease;
        box-shadow:
            0 20px 40px rgba(0, 0, 0, 0.12),
            0 8px 16px rgba(0, 0, 0, 0.08);
    }

    @keyframes fadeScale {
        from {
            opacity: 0;
            transform: translateY(10px) scale(0.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* DOTS */
    .loading-dots span {
        animation: bounce 1.4s infinite ease-in-out both;
    }

    .loading-dots span:nth-child(1) {
        animation-delay: -0.32s;
    }

    .loading-dots span:nth-child(2) {
        animation-delay: -0.16s;
    }

    @keyframes bounce {

        0%,
        80%,
        100% {
            transform: scale(0);
            opacity: 0.4;
        }

        40% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* PROGRESS */
    .loading-progress::before {
        content: '';
        position: absolute;
        inset: 0;
        width: 40%;
        border-radius: 9999px;
        background: linear-gradient(90deg,
                transparent,
                rgba(255, 255, 255, 0.8),
                transparent);
        animation: slide 1.5s infinite;
    }

    @keyframes slide {
        from {
            transform: translateX(-120%);
        }

        to {
            transform: translateX(320%);
        }
    }

    /* RING */
    .ring-loader {
        position: relative;
        width: 70px;
        height: 70px;
    }

    .ring-loader div {
        box-sizing: border-box;
        position: absolute;
        width: 70px;
        height: 70px;
        border: 4px solid #2563eb;
        border-radius: 50%;
        animation: ringRotate 1.2s linear infinite;
        border-color: #2563eb transparent transparent transparent;
    }

    .ring-loader div:nth-child(1) {
        animation-delay: -0.45s;
    }

    .ring-loader div:nth-child(2) {
        animation-delay: -0.3s;
    }

    .ring-loader div:nth-child(3) {
        animation-delay: -0.15s;
    }

    @keyframes ringRotate {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }
</style>

<!-- LOADING OVERLAY -->
<div id="loadingOverlay"
    class="fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50 hidden">

    <div class="loading-card bg-white rounded-3xl px-10 py-8 w-[320px] flex flex-col items-center">

        <!-- ANIMATION -->
        <div class="ring-loader mb-6">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- TEXT -->
        <h2 class="text-lg font-semibold text-gray-800 text-center">
            {{ $text ?? 'Memuat Data Mahasiswa' }}
        </h2>

        <p class="text-sm text-gray-500 mt-1 text-center">
            Sistem sedang mengambil data akademik
        </p>

        <!-- DOTS -->
        <div class="loading-dots flex gap-2 mt-5">
            <span class="w-3 h-3 bg-blue-600 rounded-full"></span>
            <span class="w-3 h-3 bg-blue-600 rounded-full"></span>
            <span class="w-3 h-3 bg-blue-600 rounded-full"></span>
        </div>

    </div>
</div>