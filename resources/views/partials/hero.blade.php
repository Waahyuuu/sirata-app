<section class="hero-scroll-container" id="fanSection">

    <div class="hero-wrapper hero-sticky-element">

        <div class="hero-bg">
            <img src="{{ asset('images/Hasil.png') }}" alt="Gedung STIMATA">
        </div>

        <div class="hero-overlay"></div>

        <div class="absolute z-10 inset-0 grid grid-cols-1 lg:grid-cols-2 items-center gap-8
                    px-[20px] md:px-[40px] lg:px-[60px] xl:px-[110px] 
                    pt-[40px] md:pt-[50px] lg:pt-[60px] ">

            <div class="max-w-[650px] text-left mobile-text-center">
                <p class="uppercase tracking-wide font-bold text-white
                           text-[clamp(16px,2vw,28px)]
                           [text-shadow:0_2px_8px_rgba(0,0,0,.5),0_4px_20px_rgba(0,0,0,.4)]">
                    APLIKASI RAPOR SIRATA
                </p>

                <h1 class="mt-2 text-white font-black leading-[0.95] md:leading-[0.92]
                           text-[clamp(30px,5vw,64px)]
                           [text-shadow:0_2px_8px_rgba(0,0,0,.5),0_4px_20px_rgba(0,0,0,.4)]">
                    SISTEM RAPOR <br class="hidden sm:inline">
                    STIMATA
                </h1>

                <p class="mt-4 md:mt-5 text-white/95 font-semibold leading-[1.3] md:leading-[1.2]
                           text-[clamp(13px,1.3vw,18px)]
                           [text-shadow:0_2px_8px_rgba(0,0,0,.5),0_4px_20px_rgba(0,0,0,.4)]">
                    Memudahkan Orang Tua/Wali Untuk Memonitoring
                    <br class="hidden sm:inline">
                    Perkembangan Anak Secara Online dan Real-Time
                </p>
            </div>

            <div class="flex justify-center items-center w-full relative h-full mockup-container-responsive">
                <div class="mockup-animation-track">
                    @include('components.mockup')
                </div>
            </div>

        </div>

        <div class="hero-menu-wrapper">
            <div class="menu-corner-top"></div>
            <div class="hero-menu">
                <a href="#sirata" class="menu-item">SIRATA</a>
                <a href="#manfaat" class="menu-item">MANFAAT</a>
                <a href="#faq" class="menu-item">FAQ</a>
            </div>
            <div class="menu-corner-bottom"></div>
        </div>

    </div>

</section>

<style>
    /* TRACKER HEIGHT */
    .hero-scroll-container {
        height: 220vh;
        position: relative;
    }

    /* CENTERING MANAGEMENT AGAR TIDAK TERPOTONG */
    .hero-sticky-element {
        position: sticky !important;
        top: 24px !important;
        z-index: 10;
    }

    .mockup-animation-track {
        position: relative;
        width: 100%;
        max-width: 450px;
        height: 420px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* KODE KELAS ASLI STABLE ANDA */
    .hero-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 25px;
        min-height: 760px;
    }

    .hero-bg {
        position: absolute;
        inset: 0;
        z-index: 1;
    }

    .hero-bg img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        z-index: 2;
        background: linear-gradient(to right, rgba(0, 0, 0, .45), rgba(0, 0, 0, .25), rgba(0, 0, 0, .15));
    }

    .hero-menu-wrapper {
        position: absolute;
        bottom: 0;
        left: 0;
        z-index: 20;
    }

    .hero-menu {
        position: relative;
        width: 740px;
        height: 110px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 40px;
        border-top: 12px solid white;
        border-right: 12px solid white;
        border-top-right-radius: 40px;
    }

    .hero-menu::after {
        content: "";
        position: absolute;
        left: 0;
        top: -61.5px;
        width: 50px;
        height: 50px;
        background: transparent;
        border-bottom-left-radius: 25px;
        box-shadow: -5px 5px 0 5px white;
        z-index: -1;
        pointer-events: none;
    }

    .hero-menu::before {
        content: "";
        position: absolute;
        right: -61.5px;
        bottom: 0;
        width: 50px;
        height: 50px;
        background: transparent;
        border-bottom-left-radius: 25px;
        box-shadow: -5px 5px 0 5px white;
        z-index: -1;
        pointer-events: none;
    }

    .menu-corner-bottom {
        position: absolute;
        right: 11.5px;
        bottom: 0;
        width: 50px;
        height: 50px;
        background: transparent;
        border-bottom-right-radius: 50%;
        box-shadow: 5px 5px 0 5px white;
        pointer-events: none;
    }

    .menu-corner-top {
        position: absolute;
        top: 11.5px;
        left: 0;
        width: 50px;
        height: 50px;
        background: transparent;
        border-top-left-radius: 25px;
        box-shadow: -5px -5px 0 5px white;
        pointer-events: none;
    }

    .menu-item {
        width: 130px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: white;
        text-decoration: none;
        font-size: 15px;
        font-weight: 600;
        letter-spacing: .5px;
        box-shadow: inset 0 1px 1px rgba(255, 255, 255, 0.2), 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .menu-item:hover {
        background: rgba(255, 143, 0, 0.18);
        border-color: rgba(255, 143, 0, 0.5);
    }

    /* LAYER TAMBAHAN MEDIA QUERIES RESPONSIVE */
    @media (max-width: 1023px) {
        .hero-sticky-element {
            top: max(0px, calc((100vh - 850px) / 2)) !important;
        }

        .hero-wrapper {
            min-height: 850px;
        }

        .mobile-text-center {
            text-align: center !important;
            margin: 0 auto;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .mockup-container-responsive {
            margin-top: -10px;
        }
    }

    @media (max-width: 768px) {
        .hero-sticky-element {
            top: 24px !important;
        }

        .hero-wrapper {
            min-height: 740px;
            border-radius: 15px;
        }

        .hero-menu-wrapper {
            width: 100%;
        }

        .hero-menu {
            width: 100vw;
            height: 90px;
            gap: 15px;
            padding: 0 16px;
            border-right: none;
            border-top-right-radius: 0px;
            border-top: 6px solid white;
        }

        .hero-menu::before,
        .hero-menu::after,
        .menu-corner-top,
        .menu-corner-bottom {
            display: none !important;
        }

        .menu-item {
            width: 100px;
            height: 38px;
            font-size: 12px;
        }
    }

    @media (max-width: 480px) {
        .hero-wrapper {
            min-height: 680px;
        }

        .mockup-container-responsive {
            margin-top: -30px;
        }
    }
</style>