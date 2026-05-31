<section class="hero-section">

    <div class="hero-wrapper">

        <!-- Background -->
        <div class="hero-bg">
            <img src="{{ asset('images/Hasil.png') }}" alt="Gedung STIMATA">
        </div>

        <!-- Overlay -->
        <div class="hero-overlay"></div>

        <!-- Text Layer -->
        <div class="hero-content">

            <p class="hero-label">
                APLIKASI RAPOR SIRATA
            </p>

            <h1 class="hero-title">
                SISTEM RAPOR <br>
                STIMATA
            </h1>

            <p class="hero-description">
                Memudahkan Orang Tua/Wali Untuk Memonitoring
                <br>
                Perkembangan Anak Secara Online dan Real-Time
            </p>

        </div>

        <!-- Union Menu -->
        <div class="hero-menu-wrapper">

            <div class="menu-corner-top"></div>

            <div class="hero-menu">

                <a href="#sirata" class="menu-item">
                    SIRATA
                </a>

                <a href="#manfaat" class="menu-item">
                    MANFAAT
                </a>

                <a href="#faq" class="menu-item">
                    FAQ
                </a>

            </div>

            <div class="menu-corner-bottom"></div>
        </div>

    </div>

</section>

<style>
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

        background:
            linear-gradient(to right,
                rgba(0, 0, 0, .25),
                rgba(0, 0, 0, .12),
                transparent);
    }

    .hero-label,
    .hero-title,
    .hero-description {
        text-shadow:
            0 2px 8px rgba(0, 0, 0, .5),
            0 4px 20px rgba(0, 0, 0, .4);
    }

    .hero-content {
        position: absolute;
        z-index: 10;

        top: 120px;
        left: 110px;

        max-width: 900px;
    }

    .hero-label {
        font-size: 32px;
        font-weight: 700;
        color: white;
        letter-spacing: 1px;
        text-transform: uppercase;
    }

    .hero-title {
        margin-top: 10px;

        font-size: 72px;
        line-height: .92;
        font-weight: 900;
        color: white;
    }

    .hero-description {
        margin-top: 18px;

        font-size: 20px;
        line-height: 1.2;
        font-weight: 600;

        color: rgba(255, 255, 255, .95);
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

        box-shadow:
            5px 5px 0 5px white;

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

        box-shadow:
            inset 0 1px 1px rgba(255, 255, 255, 0.2),
            0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .menu-item:hover {
        background: rgba(255, 143, 0, 0.18);
        border-color: rgba(255, 143, 0, 0.5);
    }

    /* ==========================
   RESPONSIVE
========================== */

    @media (max-width: 1200px) {

        .hero-wrapper {
            min-height: 650px;
        }

        .hero-content {
            left: 60px;
            top: 100px;
        }

        .hero-label {
            font-size: 36px;
        }

        .hero-title {
            font-size: 82px;
        }

        .hero-description {
            font-size: 22px;
        }
    }

    @media (max-width: 768px) {

        .hero-wrapper {
            min-height: 550px;
        }

        .hero-content {
            left: 30px;
            top: 80px;
            right: 20px;
        }

        .hero-label {
            font-size: 22px;
        }

        .hero-title {
            font-size: 52px;
        }

        .hero-description {
            font-size: 16px;
        }

        .hero-menu {
            width: 100vw;
            gap: 10px;
            padding: 0 16px;
        }

        .menu-item {
            width: 110px;
            height: 42px;
            font-size: 13px;
        }
    }
</style>