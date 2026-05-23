@extends('layouts.landing')

@section('title', 'SIRATA — Sistem Rapor Stimata')
@section('description', 'Memudahkan orang tua/wali untuk memonitoring perkembangan akademik mahasiswa secara online dan real-time.')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
@endpush

@section('content')

  {{-- NAVBAR --}}
  <header class="navbar">
    <div class="container">
      <nav class="navbar-inner">
        <a href="#hero" class="navbar-logo">
          <div class="logo-mark">S</div>
          <span class="logo-word">SIRATA</span>
        </a>
        <ul class="navbar-links">
          <li><a href="#search">Cari Data</a></li>
          <li><a href="#features">Manfaat</a></li>
          <li><a href="#faq">FAQ</a></li>
        </ul>
        <a href="#search" class="btn btn-primary" style="font-size:13px; padding:10px 20px;">
          Cari Informasi
        </a>
        <button class="navbar-hamburger" id="hamburgerBtn" aria-label="Buka menu">
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
          <span class="hamburger-line"></span>
        </button>
      </nav>
    </div>
    <div class="mobile-nav" id="mobileNav">
      <a href="#search" onclick="closeMobileNav()">Cari Data</a>
      <a href="#features" onclick="closeMobileNav()">Manfaat</a>
      <a href="#faq" onclick="closeMobileNav()">FAQ</a>
      <a href="#search" class="btn btn-primary" onclick="closeMobileNav()">Cari Informasi</a>
    </div>
  </header>

  {{-- HERO --}}
  <section class="hero" id="hero">
    <div class="glow-center"></div>
    <div class="hero-grid-overlay"></div>
    <div class="hero-content">
      <div class="eyebrow">
        <span class="eyebrow-dot"></span>
        Sistem Rapor Stimata
      </div>
      <h1>
        Pantau Akademik Mahasiswa <span class="accent">STIMATA</span>
      </h1>
      <p class="hero-sub">
        Memudahkan orang tua/wali untuk memonitoring perkembangan anak
        secara online, kapan saja dan di mana saja — tanpa perlu datang ke kampus.
      </p>
      <div class="hero-btns">
        <a href="#search" class="btn btn-primary">
          <i class="ti ti-search"></i>
          Cari Informasi Sekarang
        </a>
        <a href="#features" class="btn btn-ghost">
          Pelajari Manfaat
          <i class="ti ti-arrow-right"></i>
        </a>
      </div>
      <div class="hero-trust">
        <div class="trust-item"><span class="trust-dot"></span> Data langsung dari SIAKAD</div>
        <div class="trust-item"><span class="trust-dot"></span> Akses 24/7</div>
        <div class="trust-item"><span class="trust-dot"></span> Tanpa registrasi</div>
      </div>

      <div class="hero-card glass">
        <div class="hero-card-header">
          <div class="hero-card-avatar">AF</div>
          <div>
            <div class="hero-card-name">Ahmad Fauzi</div>
            <div class="hero-card-nim">NIM: 22010001 · Teknik Informatika</div>
          </div>
          <div class="hero-card-badge">● Aktif</div>
        </div>
        <div class="hero-card-grid">
          <div class="hero-card-stat">
            <div class="hero-card-stat-val">3.42<span> IPK</span></div>
            <div class="hero-card-stat-label">Indeks Prestasi</div>
          </div>
          <div class="hero-card-stat">
            <div class="hero-card-stat-val">87<span>%</span></div>
            <div class="hero-card-stat-label">Kehadiran</div>
          </div>
          <div class="hero-card-stat">
            <div class="hero-card-stat-val">112<span> SKS</span></div>
            <div class="hero-card-stat-label">SKS Tempuh</div>
          </div>
        </div>
        <div class="hero-glow-under"></div>
      </div>
    </div>
  </section>

  {{-- SEARCH FORM --}}
  <section class="search-section" id="search">
    <div class="glow-center" style="opacity:.6"></div>
    <div class="container">
      <div class="search-inner">
        <div class="search-text fade-up">
          <div class="section-label">Akses Informasi</div>
          <h2>Cari Data<br>Mahasiswa</h2>
          <p>Masukkan data verifikasi untuk mengakses informasi akademik secara lengkap dan akurat.</p>
          <div class="search-bullet">
            <div class="search-bullet-dot"><i class="ti ti-check"></i></div>
            <span>Nilai per mata kuliah & IPK kumulatif</span>
          </div>
          <div class="search-bullet">
            <div class="search-bullet-dot"><i class="ti ti-check"></i></div>
            <span>Persentase kehadiran & jadwal kuliah</span>
          </div>
          <div class="search-bullet">
            <div class="search-bullet-dot"><i class="ti ti-check"></i></div>
            <span>Status akademik & riwayat per semester</span>
          </div>
        </div>

        <div class="fade-up">
          <div class="form-card glass">
            <form id="searchForm" action="{{ route('mahasiswa.cari') }}" method="POST">
              @csrf
              <div class="form-group">
                <label class="form-label" for="namaIbu">Nama Ibu Kandung</label>
                <input class="form-input" type="text" id="namaIbu" name="nama_ibu"
                  placeholder="Masukkan nama ibu kandung" required />
              </div>
              <div class="form-group">
                <label class="form-label" for="tanggalLahir">Tanggal Lahir Mahasiswa</label>
                <input class="form-input" type="date" id="tanggalLahir" name="tanggal_lahir" required />
              </div>
              <div class="form-group">
                <label class="form-label" for="nim">NIM Mahasiswa</label>
                <input class="form-input" type="text" id="nim" name="nim"
                  placeholder="Contoh: 22010001" required />
              </div>
              <button type="submit" class="btn btn-primary form-submit">
                <i class="ti ti-search"></i>
                <span id="submitLabel">Cari Informasi</span>
              </button>
              <div class="form-note">
                <i class="ti ti-lock"></i>
                Data Anda dijaga kerahasiaannya dan hanya digunakan untuk verifikasi.
              </div>
            </form>
            <div class="result-card" id="resultCard">
              <div class="result-header">
                <i class="ti ti-circle-check"></i>
                Data Mahasiswa Ditemukan
              </div>
              <div class="result-grid">
                <div class="result-row">Nama <strong data-field="nama"></strong></div>
                <div class="result-row">NIM <strong data-field="nim"></strong></div>
                <div class="result-row">Program Studi <strong data-field="prodi"></strong></div>
                <div class="result-row">Semester <strong data-field="semester"></strong></div>
                <div class="result-row">IPK <strong data-field="ipk"></strong></div>
                <div class="result-row">Kehadiran <strong data-field="kehadiran"></strong></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- FEATURES / TABS --}}
  <section class="features-section" id="features">
    <div class="container">
      <div class="features-header fade-up">
        <div class="section-label">Fitur & Manfaat</div>
        <h2>Semua yang Dibutuhkan<br>Orang Tua Mahasiswa</h2>
        <p>Dirancang untuk kemudahan akses informasi akademik secara transparan, akurat, dan real-time.</p>
      </div>

      <div class="tab-nav" id="tabNav">
        <button class="tab-btn active" data-tab="transparansi">Transparansi</button>
        <button class="tab-btn" data-tab="monitoring">Monitoring</button>
        <button class="tab-btn" data-tab="akses">Akses Mudah</button>
        <button class="tab-btn" data-tab="realtime">Data Real-Time</button>
      </div>

      <div class="tab-panel active" id="tab-transparansi">
        <div class="tab-content">
          <h3>Keterbukaan Informasi Akademik Penuh</h3>
          <p>Informasi antara kampus dan orang tua disampaikan secara terbuka, akurat, dan dapat diakses kapan saja tanpa perlu menghubungi pihak kampus.</p>
          <div class="tab-bullets">
            <div class="tab-bullet">Nilai per mata kuliah yang sedang ditempuh</div>
            <div class="tab-bullet">Status kelulusan dan kemajuan studi</div>
            <div class="tab-bullet">Riwayat akademik lengkap per semester</div>
            <div class="tab-bullet">Laporan IPK kumulatif dan SKS tempuh</div>
          </div>
        </div>
        <div class="tab-visual glass">
          <div class="mini-card"><span class="mini-card-label">Algoritma & Pemrograman</span><span class="mini-card-val green">A</span></div>
          <div class="mini-card"><span class="mini-card-label">Basis Data Lanjut</span><span class="mini-card-val green">B+</span></div>
          <div class="mini-card"><span class="mini-card-label">Jaringan Komputer</span><span class="mini-card-val orange">B</span></div>
          <div class="mini-card"><span class="mini-card-label">IPK Kumulatif</span><span class="mini-card-val">3.42</span></div>
        </div>
      </div>

      <div class="tab-panel" id="tab-monitoring">
        <div class="tab-content">
          <h3>Pantau Kehadiran & Hasil Studi</h3>
          <p>Lihat jadwal perkuliahan dan data kehadiran mahasiswa secara detail dari semester awal hingga akhir, tanpa perlu datang ke kampus.</p>
          <div class="tab-bullets">
            <div class="tab-bullet">Persentase kehadiran per mata kuliah</div>
            <div class="tab-bullet">Jadwal kuliah aktif semester berjalan</div>
            <div class="tab-bullet">Rekap kehadiran per semester</div>
            <div class="tab-bullet">Indikator kehadiran di bawah batas minimum</div>
          </div>
        </div>
        <div class="tab-visual glass">
          <div class="mini-card"><span class="mini-card-label">Senin — Algoritma</span><span class="mini-card-val">08.00</span></div>
          <div class="mini-card"><span class="mini-card-label">Kehadiran Basis Data</span><span class="mini-card-val green">92%</span></div>
          <div class="mini-card"><span class="mini-card-label">Kehadiran Jaringan</span><span class="mini-card-val orange">76%</span></div>
          <div class="mini-card"><span class="mini-card-label">Rata-rata Kehadiran</span><span class="mini-card-val">87%</span></div>
        </div>
      </div>

      <div class="tab-panel" id="tab-akses">
        <div class="tab-content">
          <h3>Akses dari Perangkat Apapun</h3>
          <p>Platform berbasis web yang responsif — bisa dibuka di smartphone, tablet, atau laptop tanpa perlu menginstall aplikasi apapun.</p>
          <div class="tab-bullets">
            <div class="tab-bullet">Tanpa install aplikasi tambahan</div>
            <div class="tab-bullet">Tampilan optimal di semua ukuran layar</div>
            <div class="tab-bullet">Akses 24 jam tanpa batas waktu operasional</div>
            <div class="tab-bullet">Tidak memerlukan login atau registrasi akun</div>
          </div>
        </div>
        <div class="tab-visual glass">
          <div class="mini-card"><span class="mini-card-label">Smartphone</span><span class="mini-card-val green">✓ Optimal</span></div>
          <div class="mini-card"><span class="mini-card-label">Tablet</span><span class="mini-card-val green">✓ Optimal</span></div>
          <div class="mini-card"><span class="mini-card-label">Laptop / PC</span><span class="mini-card-val green">✓ Optimal</span></div>
          <div class="mini-card"><span class="mini-card-label">Waktu Akses</span><span class="mini-card-val">24 / 7</span></div>
        </div>
      </div>

      <div class="tab-panel" id="tab-realtime">
        <div class="tab-content">
          <h3>Data Langsung dari Sistem SIAKAD</h3>
          <p>Seluruh informasi yang ditampilkan ditarik langsung dari SIAKAD kampus secara real-time — bukan input manual, selalu akurat dan terkini.</p>
          <div class="tab-bullets">
            <div class="tab-bullet">Sinkronisasi otomatis dengan sistem SIAKAD</div>
            <div class="tab-bullet">Akurasi data terjamin dari sumber resmi</div>
            <div class="tab-bullet">Pembaruan data real-time setiap sesi</div>
            <div class="tab-bullet">Tidak ada risiko data kadaluarsa atau tidak akurat</div>
          </div>
        </div>
        <div class="tab-visual glass">
          <div class="mini-card"><span class="mini-card-label">Sumber Data</span><span class="mini-card-val orange">SIAKAD</span></div>
          <div class="mini-card"><span class="mini-card-label">Status Sinkronisasi</span><span class="mini-card-val green">● Live</span></div>
          <div class="mini-card"><span class="mini-card-label">Akurasi Data</span><span class="mini-card-val">100%</span></div>
          <div class="mini-card"><span class="mini-card-label">Update Terakhir</span><span class="mini-card-val">Real-time</span></div>
        </div>
      </div>
    </div>
  </section>

  {{-- STATS --}}
  <section class="stats-section" id="stats">
    <div class="stats-glow"></div>
    <div class="container">
      <div class="stats-grid">
        <div class="stat-item">
          <div class="stat-num">
            <span class="count" data-target="6">0</span><span class="suffix">+</span>
          </div>
          <div class="stat-label">Jenis informasi akademik tersedia</div>
        </div>
        <div class="stat-item">
          <div class="stat-num">
            <span class="count" data-target="24">0</span><span class="suffix">/7</span>
          </div>
          <div class="stat-label">Akses tanpa batas waktu operasional</div>
        </div>
        <div class="stat-item">
          <div class="stat-num">
            <span class="count" data-target="100">0</span><span class="suffix">%</span>
          </div>
          <div class="stat-label">Data bersumber dari SIAKAD resmi kampus</div>
        </div>
      </div>
    </div>
  </section>

  {{-- HOW IT WORKS --}}
  <section class="howitworks-section" id="howitworks">
    <div class="container">
      <div class="howitworks-header fade-up">
        <div class="section-label">Cara Kerja</div>
        <h2>Informasi dalam 3 Langkah</h2>
        <p>Proses yang sederhana — tidak perlu daftar akun atau download aplikasi.</p>
      </div>
      <div class="steps-grid">
        <div class="step-card glass fade-up">
          <div class="step-num">01</div>
          <div class="step-icon"><i class="ti ti-edit"></i></div>
          <h3>Isi Data Verifikasi</h3>
          <p>Masukkan nama ibu kandung, tanggal lahir mahasiswa, dan NIM mahasiswa pada form pencarian.</p>
        </div>
        <div class="step-arrow">
          <i class="ti ti-arrow-right"></i>
        </div>
        <div class="step-card glass fade-up">
          <div class="step-num">02</div>
          <div class="step-icon"><i class="ti ti-search"></i></div>
          <h3>Klik Cari Informasi</h3>
          <p>Sistem memverifikasi identitas secara otomatis menggunakan data yang tersimpan di SIAKAD.</p>
        </div>
        <div class="step-arrow">
          <i class="ti ti-arrow-right"></i>
        </div>
        <div class="step-card glass fade-up">
          <div class="step-num">03</div>
          <div class="step-icon"><i class="ti ti-file-text"></i></div>
          <h3>Lihat Rapor Mahasiswa</h3>
          <p>Akses nilai, kehadiran, jadwal, dan seluruh informasi akademik mahasiswa secara lengkap.</p>
        </div>
      </div>
    </div>
  </section>

  {{-- FAQ — data dari admin panel via $faqs --}}
  <section class="faq-section" id="faq">
    <div class="container">
      <div class="faq-inner">
        <div class="fade-up">
          <div class="section-label">FAQ</div>
          <h2>Pertanyaan yang Sering Ditanyakan</h2>
          <p style="margin-top:14px">Temukan jawaban seputar penggunaan dan keamanan SIRATA.</p>
        </div>
        <div class="faq-list">
          @forelse($faqs as $faq)
          <div class="faq-item {{ $loop->first ? 'open' : '' }}">
            <button class="faq-q">{{ $faq->pertanyaan }} <span class="faq-icon">+</span></button>
            <div class="faq-a">
              <div class="faq-a-inner">{{ $faq->jawaban }}</div>
            </div>
          </div>
          @empty
          <p style="color: var(--color-text-muted-light); text-align:center; padding: 24px 0;">
            Belum ada FAQ tersedia.
          </p>
          @endforelse
        </div>
      </div>
    </div>
  </section>

  {{-- CTA BANNER --}}
  <section class="cta-section">
    <div class="container">
      <div class="cta-card fade-up">
        <div class="cta-glow"></div>
        <div class="section-label">Mulai Sekarang</div>
        <h2>Siap Memantau Perkembangan Akademik?</h2>
        <p>Akses informasi akademik mahasiswa sekarang. Gratis, mudah, dan aman tanpa perlu mendaftar akun.</p>
        <a href="#search" class="btn btn-primary" style="font-size:15px; padding:14px 32px;">
          Cari Informasi Sekarang
          <i class="ti ti-arrow-right"></i>
        </a>
      </div>
    </div>
  </section>

  {{-- FOOTER --}}
  <footer class="footer">
    <div class="container">
      <div class="footer-top">
        <div>
          <div class="footer-brand-name">SIR<span>ATA</span></div>
          <p class="footer-tagline">Sistem Rapor Stimata — Transparansi informasi akademik untuk orang tua dan wali mahasiswa.</p>
          <div class="footer-socials">
            <a href="#" class="social-btn" aria-label="Instagram">
              <i class="ti ti-brand-instagram"></i>
            </a>
            <a href="#" class="social-btn" aria-label="YouTube">
              <i class="ti ti-brand-youtube"></i>
            </a>
            <a href="#" class="social-btn" aria-label="Facebook">
              <i class="ti ti-brand-facebook"></i>
            </a>
            <a href="#" class="social-btn" aria-label="TikTok">
              <i class="ti ti-brand-tiktok"></i>
            </a>
          </div>
        </div>
        <div>
          <div class="footer-col-title">Menu</div>
          <div class="footer-links">
            <a href="#search">Form SIRATA</a>
            <a href="#features">Manfaat</a>
            <a href="#faq">FAQ</a>
            <a href="#howitworks">Cara Kerja</a>
          </div>
        </div>
        <div>
          <div class="footer-col-title">Kontak</div>
          <div class="footer-contact-item">
            <i class="ti ti-mail"></i>
            info@stimata.ac.id
          </div>
          <div class="footer-contact-item">
            <i class="ti ti-phone"></i>
            +62 xxx-xxxx-xxxx
          </div>
          <div class="footer-contact-item">
            <i class="ti ti-map-pin"></i>
            Jl. [Alamat Kampus Stimata]
          </div>
        </div>
      </div>
      <div class="footer-bottom">
        <span>&copy; {{ date('Y') }} Sistem Rapor Stimata. All rights reserved.</span>
        <span>Dikembangkan oleh Tim IT Stimata</span>
      </div>
    </div>
  </footer>

@endsection
