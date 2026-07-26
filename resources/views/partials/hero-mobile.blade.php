<section class="block md:hidden">
    <div class="relative overflow-hidden rounded-[30px] min-h-[600px] px-8 py-10 flex flex-col justify-between">
        
        <!-- Background Image -->
        <div class="absolute inset-0 z-1">
            <img src="{{ asset('images/Hasil.png') }}" alt="Gedung STIMATA" class="w-full h-full object-cover">
        </div>
        
        <!-- Overlay -->
        <div class="absolute inset-0 z-2 bg-gradient-to-b from-black/60 via-black/40 to-black/50"></div>

        <!-- Content -->
        <div class="relative z-10 w-full text-left">
            <p class="text-[10px] font-bold tracking-widest text-white/90 uppercase [text-shadow:0_2px_8px_rgba(0,0,0,.5)]">
                APLIKASI RAPOR SIRATA
            </p>

            <h1 class="text-3xl font-extrabold leading-tight mt-3 text-white [text-shadow:0_2px_8px_rgba(0,0,0,.5)]">
                SISTEM RAPOR <br>
                <span class="text-white">STIMATA</span>
            </h1>

            <p class="mt-4 text-sm text-white/90 leading-relaxed [text-shadow:0_2px_8px_rgba(0,0,0,.5)]">
                Memudahkan Orang Tua/Wali Untuk Memonitoring
                Perkembangan Anak Secara Online dan Real-Time
            </p>
        </div>

        <!-- Mockup Component -->
        <div class="relative z-10 w-full flex justify-center mt-6">
            <div class="mockup-animation-track-mobile">
                <!-- Kiri -->
                <div class="fan-blade fan-blade-left">
                    <div class="mockup-phone">
                        @include('components.mockup')
                    </div>
                </div>
                <!-- Tengah -->
                <div class="fan-center">
                    <div class="mockup-phone-center">
                        @include('components.mockup')
                    </div>
                </div>
                <!-- Kanan -->
                <div class="fan-blade fan-blade-right">
                    <div class="mockup-phone">
                        @include('components.mockup')
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<style>
    /* Container utama */
    .mockup-animation-track-mobile {
        position: relative;
        width: 100%;
        max-width: 500px; /* Diperbesar dari 400px */
        height: 380px; /* Diperbesar dari 300px */
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 30px; /* Diperbesar dari 20px */
    }

    /* Blade kiri dan kanan */
    .fan-blade {
        position: relative;
        opacity: 0;
        transform-origin: center center;
    }

    .fan-blade-left {
        animation: fanOpenLeft 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        transform-origin: right center;
    }

    .fan-blade-right {
        animation: fanOpenRight 1.2s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        transform-origin: left center;
    }

    /* Tengah tetap */
    .fan-center {
        position: relative;
        z-index: 2;
        flex-shrink: 0;
    }

    /* Animasi kipas kiri - membuka ke kiri */
    @keyframes fanOpenLeft {
        0% {
            opacity: 0;
            transform: scale(0.3) rotate(60deg) translateX(-30px);
        }
        60% {
            opacity: 1;
            transform: scale(1.05) rotate(-5deg) translateX(0px);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg) translateX(0px);
        }
    }

    /* Animasi kipas kanan - membuka ke kanan */
    @keyframes fanOpenRight {
        0% {
            opacity: 0;
            transform: scale(0.3) rotate(-60deg) translateX(30px);
        }
        60% {
            opacity: 1;
            transform: scale(1.05) rotate(5deg) translateX(0px);
        }
        100% {
            opacity: 1;
            transform: scale(1) rotate(0deg) translateX(0px);
        }
    }

    /* Scale up mockup untuk mobile - DIPERBESAR */
    .mockup-animation-track-mobile .mockup-phone,
    .mockup-animation-track-mobile .mockup-phone-center {
        transform: scale(0.85); /* Diperbesar dari 0.6 */
        transform-origin: center;
    }

    /* Efek floating setelah animasi selesai */
    .fan-blade-left .mockup-phone {
        animation: floatLeft 3s ease-in-out infinite 1.2s;
    }

    .fan-blade-right .mockup-phone {
        animation: floatRight 3s ease-in-out infinite 1.2s;
    }

    .fan-center .mockup-phone-center {
        animation: floatCenter 3s ease-in-out infinite 1.2s;
    }

    @keyframes floatLeft {
        0%, 100% { transform: scale(0.85) translateY(0px) rotate(0deg); }
        50% { transform: scale(0.85) translateY(-10px) rotate(-3deg); }
    }

    @keyframes floatRight {
        0%, 100% { transform: scale(0.85) translateY(0px) rotate(0deg); }
        50% { transform: scale(0.85) translateY(-10px) rotate(3deg); }
    }

    @keyframes floatCenter {
        0%, 100% { transform: scale(0.85) translateY(0px); }
        50% { transform: scale(0.85) translateY(-12px); }
    }

    /* Responsif untuk layar lebih kecil */
    @media (max-width: 480px) {
        .mockup-animation-track-mobile {
            max-width: 420px; /* Diperbesar dari 320px */
            height: 320px; /* Diperbesar dari 240px */
            gap: 15px; /* Diperbesar dari 5px */
        }
        .mockup-animation-track-mobile .mockup-phone,
        .mockup-animation-track-mobile .mockup-phone-center {
            transform: scale(0.7); /* Diperbesar dari 0.45 */
        }
        @keyframes floatLeft {
            0%, 100% { transform: scale(0.7) translateY(0px) rotate(0deg); }
            50% { transform: scale(0.7) translateY(-8px) rotate(-3deg); }
        }
        @keyframes floatRight {
            0%, 100% { transform: scale(0.7) translateY(0px) rotate(0deg); }
            50% { transform: scale(0.7) translateY(-8px) rotate(3deg); }
        }
        @keyframes floatCenter {
            0%, 100% { transform: scale(0.7) translateY(0px); }
            50% { transform: scale(0.7) translateY(-10px); }
        }
    }

    /* Untuk layar sangat kecil */
    @media (max-width: 380px) {
        .mockup-animation-track-mobile {
            max-width: 360px;
            height: 280px;
            gap: 10px;
        }
        .mockup-animation-track-mobile .mockup-phone,
        .mockup-animation-track-mobile .mockup-phone-center {
            transform: scale(0.6);
        }
        @keyframes floatLeft {
            0%, 100% { transform: scale(0.6) translateY(0px) rotate(0deg); }
            50% { transform: scale(0.6) translateY(-6px) rotate(-3deg); }
        }
        @keyframes floatRight {
            0%, 100% { transform: scale(0.6) translateY(0px) rotate(0deg); }
            50% { transform: scale(0.6) translateY(-6px) rotate(3deg); }
        }
        @keyframes floatCenter {
            0%, 100% { transform: scale(0.6) translateY(0px); }
            50% { transform: scale(0.6) translateY(-8px); }
        }
    }
</style>