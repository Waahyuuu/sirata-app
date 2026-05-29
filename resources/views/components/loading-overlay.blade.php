<style>
    /* OVERLAY */
    #loadingOverlay {
        transition: all .35s ease;
        backdrop-filter: blur(10px);
    }

    /* CARD */
    .loading-card {
        animation: fadeScale .4s ease;
        box-shadow:
            0 20px 60px rgba(15, 23, 42, .12),
            0 10px 30px rgba(249, 115, 22, .10);
    }

    @keyframes fadeScale {
        from {
            opacity: 0;
            transform: translateY(12px) scale(.95);
        }

        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    /* RING LOADER */
    .ring-loader {
        position: relative;
        width: 78px;
        height: 78px;
    }

    .ring-loader div {
        position: absolute;
        inset: 0;
        border-radius: 999px;
        border: 4px solid transparent;
        border-top-color: #f97316;
        animation: spin 1.2s linear infinite;
    }

    .ring-loader div:nth-child(1) {
        animation-delay: -0.45s;
        opacity: 1;
    }

    .ring-loader div:nth-child(2) {
        animation-delay: -0.3s;
        opacity: .7;
    }

    .ring-loader div:nth-child(3) {
        animation-delay: -0.15s;
        opacity: .4;
    }

    .ring-loader div:nth-child(4) {
        opacity: .2;
    }

    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }

    /* DOTS */
    .loading-dots span {
        animation: pulseDot 1.4s infinite ease-in-out;
    }

    .loading-dots span:nth-child(1) {
        animation-delay: 0s;
    }

    .loading-dots span:nth-child(2) {
        animation-delay: .2s;
    }

    .loading-dots span:nth-child(3) {
        animation-delay: .4s;
    }

    @keyframes pulseDot {

        0%,
        80%,
        100% {
            transform: scale(.75);
            opacity: .4;
        }

        40% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* GLOW */
    .loading-glow {
        position: absolute;
        width: 220px;
        height: 220px;
        background: rgba(249, 115, 22, .15);
        filter: blur(80px);
        border-radius: 999px;
        top: -80px;
        right: -80px;
        pointer-events: none;
    }
</style>

<!-- LOADING OVERLAY -->
<div id="loadingOverlay" class="fixed inset-0 bg-slate-950/40 flex items-center justify-center z-[9999] hidden px-5">

    <div class="loading-card relative overflow-hidden
        w-full max-w-[360px]
        rounded-[34px]
        border border-white/50
        bg-white/80 backdrop-blur-xl
        px-8 py-10 flex flex-col items-center text-center">

        <!-- glow -->
        <div class="loading-glow"></div>

        <!-- Loader -->
        <div class="ring-loader mb-6 relative z-10">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- Title -->
        <h2 class="relative z-10 text-xl font-bold text-slate-800">
            {{ $text ?? 'Mencari Data Mahasiswa' }}
        </h2>

        <!-- Subtitle -->
        <p class="relative z-10 text-sm text-slate-500 mt-2 leading-relaxed max-w-[260px]">
            Sistem sedang memproses dan menyesuaikan
            data akademik mahasiswa.
        </p>

    </div>
</div>