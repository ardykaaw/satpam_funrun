<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Satpam Fun Run 5K — Rayakan Ketangguhan Satpam</title>
    <meta name="description" content="Satpam Fun Run 5K menghadirkan pengalaman lari bertema korps satpam dengan rute 5K, hiburan, dan komunitas solid. Daftar sekarang!">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ url('/assets/SATPAM/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ url('/assets/style.css') }}">
    <style>
      /* Remove background and border effects from logo-wrapper */
      .logo-wrapper[style*="background: transparent"]::before {
        display: none !important;
      }
      /* Fix text visibility in sections */
      .section h2 {
        color: #2b2621 !important;
      }
      .section p {
        color: #5d5141 !important;
      }
      .promo-title {
        color: #fff !important;
        text-shadow: 0 2px 8px rgba(0,0,0,.3) !important;
      }
      .promo-subtitle {
        color: rgba(255,255,255,.9) !important;
        text-shadow: 0 1px 4px rgba(0,0,0,.2) !important;
      }
      .promo-panel {
        background: rgba(255,255,255,.15) !important;
        backdrop-filter: blur(10px) !important;
        border: 1px solid rgba(255,255,255,.2) !important;
      }
      .promo-panel span {
        color: rgba(255,255,255,.8) !important;
      }
      .promo-panel strong {
        color: #fff !important;
      }
      .category-block {
        background: rgba(255,255,255,.95) !important;
        border: 1px solid rgba(200,177,120,.4) !important;
        color: #2b2621 !important;
      }
      .category-name {
        color: #2b2621 !important;
      }
      .category-price {
        color: #282061 !important;
      }
      .route-legend {
        color: #5d5141 !important;
      }
      .route-legend div {
        color: #5d5141 !important;
      }
      .timeline-card {
        background: rgba(255,252,235,.9) !important;
        color: #2b2621 !important;
      }
      .timeline-card span {
        color: #282061 !important;
      }
      .timeline-card strong {
        color: #2b2621 !important;
      }
      .timeline-card p {
        color: #5d5141 !important;
      }
      .faq summary {
        color: #2b2621 !important;
      }
      .faq p {
        color: #5d5141 !important;
      }
      .card h3 {
        color: #2b2621 !important;
      }
      .card p {
        color: #5d5141 !important;
      }
      .card a {
        color: #282061 !important;
      }
      .card a:hover {
        color: #665d6c !important;
      }
      /* SOLUSI LANGSUNG: Buat countdown-wrapper benar-benar transparan dan tidak menambah spacing */
      /* Body harus relative untuk absolute positioning */
      body {
        position: relative;
      }
      
      /* Countdown-wrapper harus absolute positioned agar tidak menambah spacing */
      .countdown-wrapper {
        position: absolute !important;
        top: 80px !important;
        right: 0 !important;
        left: auto !important;
        width: auto !important;
        height: 0 !important;
        min-height: 0 !important;
        max-height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
        padding-top: 8px !important;
        padding-right: 24px !important;
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
        border: none !important;
        box-shadow: none !important;
        line-height: 0 !important;
        overflow: visible !important;
        z-index: 99;
        pointer-events: none;
      }
      
      .top-countdown {
        position: relative;
        pointer-events: auto;
      }
      
      /* Pastikan main langsung dimulai dari bawah header tanpa spacing */
      main {
        margin: 0 !important;
        margin-top: 0 !important;
        padding: 0 !important;
        padding-top: 0 !important;
      }
      
      /* Pastikan hero langsung dimulai */
      .hero {
        margin: 0 !important;
        margin-top: 0 !important;
        padding-top: 80px !important;
      }
      
      /* Perbaiki spasi putih di bawah navbar - HILANGKAN SEMUA SPASI PUTIH */
      /* Pastikan body dan html tidak memiliki background putih */
      html, body {
        background-color: transparent !important;
      }
      
      /* Pastikan header tidak ada spacing di bawah */
      .site-header {
        margin: 0 !important;
        margin-bottom: 0 !important;
        padding: 0 !important;
        padding-bottom: 0 !important;
      }
      
      /* Pastikan header-inner tidak menambah spacing */
      .header-inner {
        margin: 0 !important;
        margin-bottom: 0 !important;
        padding-top: 12px !important;
        padding-bottom: 12px !important;
      }
      
      /* Pastikan tidak ada spacing antara header dan countdown - HILANGKAN SEMUA SPASI */
      header.site-header + .countdown-wrapper {
        margin: 0 !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        padding: 0 !important;
        padding-top: 8px !important;
        padding-bottom: 0 !important;
        padding-left: 0 !important;
        padding-right: 24px !important;
        line-height: 0 !important;
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
        background-color: transparent !important;
        background-image: none !important;
      }
      
      /* Pastikan tidak ada spacing vertikal dari line-height atau font-size */
      header.site-header + .countdown-wrapper::before,
      header.site-header + .countdown-wrapper::after {
        display: none !important;
        content: none !important;
        height: 0 !important;
        line-height: 0 !important;
      }
      
      /* Pastikan countdown-wrapper tidak memiliki background putih */
      .countdown-wrapper {
        background: transparent !important;
        background-color: transparent !important;
      }
      
      /* Pastikan tidak ada elemen yang menambah spacing di antara header dan main */
      header.site-header ~ *:not(.countdown-wrapper) {
        margin-top: 0 !important;
      }
      
      /* Pastikan main tidak ada margin-top yang menyebabkan spacing */
      main {
        margin: 0 !important;
        margin-top: 0 !important;
        padding: 0 !important;
        padding-top: 0 !important;
      }
      
      /* Pastikan hero tidak menambah spacing di atas dan langsung mulai dari atas */
      .hero {
        margin: 0 !important;
        margin-top: 0 !important;
        padding-top: 80px !important;
        position: relative;
      }
      
      /* Pastikan container tidak menambah spacing */
      .container {
        margin-top: 0 !important;
      }
      
      /* Pastikan tidak ada elemen yang memiliki background putih di antara header dan hero */
      header.site-header ~ .countdown-wrapper ~ main .hero,
      header.site-header ~ main .hero {
        margin-top: 0 !important;
        padding-top: 80px !important;
      }
      
      /* Pastikan countdown-wrapper tidak menambah tinggi yang menyebabkan spasi putih */
      .countdown-wrapper {
        height: auto !important;
        min-height: 0 !important;
        max-height: none !important;
        line-height: 0 !important;
      }
      
      /* Pastikan main langsung dimulai dari bawah header tanpa spasi */
      header.site-header + .countdown-wrapper + main {
        margin: 0 !important;
        margin-top: 0 !important;
        margin-bottom: 0 !important;
        padding: 0 !important;
        padding-top: 0 !important;
        padding-bottom: 0 !important;
        line-height: normal !important;
      }
      
      /* Pastikan tidak ada spacing dari main::before atau main::after */
      main::before,
      main::after {
        display: none !important;
        content: none !important;
        height: 0 !important;
        line-height: 0 !important;
      }
      
      /* Pastikan hero langsung dimulai tanpa spasi di atas */
      main > .hero:first-child {
        margin-top: 0 !important;
        padding-top: 80px !important;
      }
      
      /* Pastikan tidak ada elemen yang memiliki background putih di area countdown */
      .countdown-wrapper * {
        line-height: normal !important;
      }
      
      /* Pastikan countdown-item tidak menambah spacing vertikal */
      .countdown-item {
        line-height: normal !important;
        vertical-align: top !important;
      }

      /* === Perbesar logo navbar === */
      .brand-logo {
        width: 160px !important;
        height: 64px !important;
        object-fit: contain;
      }
      
      /* === Perbaiki alignment menu navbar - Desktop view === */
      @media (min-width: 769px) {
        /* Container header-inner */
        .header-inner {
          display: flex !important;
          justify-content: space-between !important;
          align-items: center !important;
          width: 100% !important;
          max-width: 100% !important;
        }
        
        /* Brand di kiri - tidak mengambil terlalu banyak ruang */
        .brand {
          flex: 0 0 auto !important;
          margin-right: auto !important;
          order: 1;
          max-width: 200px;
        }
        
        /* Nav menu di kanan - pastikan benar-benar di kanan */
        .nav {
          flex: 0 0 auto !important;
          margin-left: auto !important;
          margin-right: 0 !important;
          order: 2;
          display: flex !important;
          align-items: center !important;
        }
        
        .nav-links {
          flex: 0 0 auto !important;
          display: flex !important;
        }
        
        .nav-cta {
          flex: 0 0 auto !important;
          margin-left: 16px !important;
          display: flex !important;
        }
        
        /* Pastikan burger menu tidak muncul di desktop */
        .burger-menu {
          display: none !important;
        }
        
        /* Pastikan nav-overlay tidak mengganggu di desktop */
        .nav-overlay {
          display: none !important;
        }
      }
      
      @media (max-width: 768px) {
        .brand-logo {
          width: 120px !important;
          height: 60px !important;
        }
        .header-inner {
          padding-top: 10px !important;
          padding-bottom: 10px !important;
        }
      }

      
      .top-countdown {
        display: flex;
        flex-direction: row;
        gap: 16px;
        pointer-events: auto;
      }
      
      .top-countdown .countdown-item {
        background: rgba(255,255,255,.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(238,223,157,.25);
        border-radius: 16px;
        padding: 16px 20px;
        min-width: 80px;
        text-align: center;
        box-shadow: 0 8px 24px rgba(0,0,0,.3);
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0;
      }
      
      .top-countdown .countdown-number {
        font-size: 32px;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        display: block;
        margin-bottom: 6px;
      }
      
      .top-countdown .countdown-label {
        font-size: 11px;
        color: rgba(255,255,255,.8);
        text-transform: uppercase;
        letter-spacing: .1em;
        font-weight: 600;
      }
      
      /* Mobile: Countdown di bawah navbar, full width - TANPA BACKGROUND PUTIH */
      @media (max-width: 768px) {
        .site-header {
          margin: 0 !important;
          margin-bottom: 0 !important;
          padding: 0 !important;
          padding-bottom: 0 !important;
        }
        
        .header-inner {
          margin: 0 !important;
          margin-bottom: 0 !important;
          padding-top: 10px !important;
          padding-bottom: 10px !important;
        }
        
        .countdown-wrapper {
          position: absolute !important;
          top: 60px !important;
          right: 0 !important;
          left: 0 !important;
          width: 100% !important;
          height: 0 !important;
          min-height: 0 !important;
          max-height: 0 !important;
          padding: 0 !important;
          padding-top: 8px !important;
          margin: 0 !important;
          background: transparent !important;
          background-color: transparent !important;
          background-image: none !important;
          border: none !important;
          box-shadow: none !important;
          line-height: 0 !important;
          overflow: visible !important;
          z-index: 98;
        }
        
        /* Pastikan tidak ada spacing dari pseudo-elements di mobile */
        .countdown-wrapper::before,
        .countdown-wrapper::after {
          display: none !important;
          content: none !important;
          height: 0 !important;
          line-height: 0 !important;
        }
        
        main {
          margin: 0 !important;
          margin-top: 0 !important;
          padding: 0 !important;
          padding-top: 0 !important;
        }
        
        .hero {
          margin: 0 !important;
          margin-top: 0 !important;
          padding-top: 60px !important;
        }
        
        .top-countdown {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
          gap: 0;
          padding: 0 !important;
          padding-left: 4px !important;
          padding-right: 4px !important;
          padding-top: 0 !important;
          padding-bottom: 0 !important;
          margin: 0 !important;
          width: 100%;
          background: transparent !important;
          background-color: transparent !important;
          background-image: none !important;
          border: none !important;
          box-shadow: none !important;
          line-height: 0 !important;
          height: auto !important;
          min-height: 0 !important;
          max-height: none !important;
        }
        
        /* Pastikan tidak ada spacing dari pseudo-elements di mobile */
        .top-countdown::before,
        .top-countdown::after {
          display: none !important;
          content: none !important;
          height: 0 !important;
          line-height: 0 !important;
        }
        
        .top-countdown .countdown-item {
          background: transparent;
          backdrop-filter: none;
          border: none;
          border-radius: 0;
          padding: 8px 4px;
          box-shadow: none;
        }
        
        .top-countdown .countdown-number {
          font-size: 28px;
          color: #282061;
          font-weight: 900;
          letter-spacing: -0.5px;
        }
        
        .top-countdown .countdown-label {
          font-size: 8px;
          font-weight: 700;
          color: #665d6c;
          letter-spacing: 0.2px;
        }
      }
    </style>
  </head>
  <body>
    <header class="site-header">
      <div class="container header-inner">
        <a href="/" class="brand">
          <div class="logo-wrapper" style="background: transparent; padding: 0; border: none; animation: none;">
            <img src="{{ url('/assets/SATPAM/logo-navbar.png') }}" alt="Satpam Fun Run Logo" class="brand-logo" width="160" height="64" style="filter: none;">
          </div>
          <span class="brand-name"></span>
        </a>
        <button class="burger-menu" id="burgerMenu" aria-label="Toggle menu" aria-expanded="false">
          <span></span>
          <span></span>
          <span></span>
        </button>
        <div class="nav-overlay" id="navOverlay"></div>
        <nav class="nav" id="mainNav">
          <button class="nav-close" id="navClose" aria-label="Close menu" onclick="closeMobileMenu()">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="6" x2="6" y2="18"></line>
              <line x1="6" y1="6" x2="18" y2="18"></line>
            </svg>
          </button>
          <div class="nav-links">
          <a href="#tentang" onclick="closeMobileMenu()">Tentang</a>
          <a href="#rute" onclick="closeMobileMenu()">Rute</a>
          <a href="#jadwal" onclick="closeMobileMenu()">Jadwal</a>
          <a href="#faq" onclick="closeMobileMenu()">FAQ</a>
          </div>
          <div class="nav-cta">
            <span class="nav-badge">Edisi 2025</span>
            <a href="{{ route('registration.check') }}" class="btn btn-ghost btn-sm" onclick="closeMobileMenu()">Cek Status</a>
            <a href="{{ url('/event/register') }}" class="btn btn-cta btn-sm" onclick="closeMobileMenu()" style="background: linear-gradient(135deg, #eedf9d, #d4c48a) !important; color: #232324 !important; border: none !important; font-weight: 800 !important;">Daftar</a>
          </div>
        </nav>
      </div>
    </header>

    <!-- Countdown Timer - Di bawah navbar, kanan (Desktop) / pertama sebelum logo (Mobile) -->
    <div class="countdown-wrapper">
      <div class="top-countdown" id="topCountdown">
        <div class="countdown-item">
          <span class="countdown-number" id="top-days">00</span>
          <span class="countdown-label">Days</span>
        </div>
        <div class="countdown-item">
          <span class="countdown-number" id="top-hours">00</span>
          <span class="countdown-label">Hours</span>
        </div>
        <div class="countdown-item">
          <span class="countdown-number" id="top-minutes">00</span>
          <span class="countdown-label">Minutes</span>
        </div>
        <div class="countdown-item">
          <span class="countdown-number" id="top-seconds">00</span>
          <span class="countdown-label">Seconds</span>
        </div>
      </div>
    </div>

    <main>
      <section class="hero">
        <div class="container hero-inner">
          <div class="hero-copy">
            <span class="eyebrow">Satpam Fun Run 5K</span>
            <h1>Sigap Siaga Sehat Solid</h1>
            {{-- <p>Ajang lari 5K yang menghadirkan disiplin dan kebanggaan korps Satpam lewat rute aman, pengamanan penuh, dan panggung selebrasi khusus.</p> --}}
            <div class="hero-meta">
              <div class="info-pill">
                <span>Tanggal</span>
                <strong>4 Januari 2026</strong>
            </div>
              <div class="info-pill">
                <span>Lokasi</span>
                <strong>Coming Soon</strong>
              </div>
            </div>
            <div class="hero-cta">
              <a href="{{ url('/event/register') }}" class="btn btn-cta">Daftar Sekarang</a>
              <a href="#tentang" class="btn btn-ghost">Detail Agenda</a>
            </div>
            <ul class="badges">
              
              
            </ul>
          </div>
          <div class="hero-visual">
            <img src="{{ url('/assets/SATPAM/Logo.png') }}" alt="Satpam Crest">
          </div>
        </div>
      </section>

      <section class="section event-promo" style="background-image: url('{{ url('/assets/SATPAM/Materi-Website.png') }}');">
        <div class="container">
          <div class="promo-content">
            <h2 class="promo-title" style="color: #fff !important; text-shadow: 0 2px 8px rgba(0,0,0,.4) !important;">Solidaritas Satpam, Satu Garis Start!</h2>
            <p class="promo-subtitle" style="color: rgba(255,255,255,.95) !important; text-shadow: 0 1px 4px rgba(0,0,0,.3) !important;">Satpam Fun Run adalah platform apresiasi, pelatihan, dan perayaan untuk penjaga keamanan di seluruh Indonesia.</p>
            {{-- <div class="promo-grid">
              <div class="promo-panel" style="background: rgba(255,255,255,.15) !important; backdrop-filter: blur(10px) !important; border: 1px solid rgba(255,255,255,.2) !important;">
                <span style="color: rgba(255,255,255,.8) !important;">Highlight Stage</span>
                <strong style="color: #fff !important;">Upacara Penghormatan Korps & Live Band</strong>
              </div>
              <div class="promo-panel" style="background: rgba(255,255,255,.15) !important; backdrop-filter: blur(10px) !important; border: 1px solid rgba(255,255,255,.2) !important;">
                <span style="color: rgba(255,255,255,.8) !important;">Pelayanan</span>
                <strong style="color: #fff !important;">Medical & hydration checkpoint setiap 1 km</strong>
              </div>
              <div class="promo-panel" style="background: rgba(255,255,255,.15) !important; backdrop-filter: blur(10px) !important; border: 1px solid rgba(255,255,255,.2) !important;">
                <span style="color: rgba(255,255,255,.8) !important;">Community</span>
                <strong style="color: #fff !important;">Networking Satpam Nasional dan Fun Expo</strong>
              </div>
            </div> --}}
            <div class="categories-pricing">
              <div class="category-block" style="background: rgba(255,255,255,.95) !important; border: 1px solid rgba(200,177,120,.4) !important;">
                <div class="category-distance" style="color: #eedf9d !important;">5K</div>
                <div class="category-name" style="color: #2b2621 !important;">Korps Satpam</div>
                <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 16px;">
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #5d5141; font-size: 14px;">Biaya Registrasi</span>
                    <div class="category-price" style="font-size: 24px; font-weight: 700; color: #282061 !important;">Rp 170.000</div>
                  </div>
                  <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(165,154,130,.2); text-align: left;">
                    <p style="margin: 0; color: #5d5141; font-size: 13px; line-height: 1.6;">
                      <strong>Benefit :</strong> BIB, Jersey, Medali Finisher, Refreshment
                    </p>
                  </div>
                  <p style="margin: 0; margin-top: 12px; color: #5d5141; font-size: 14px;">Untuk anggota Korps Satpam</p>
                </div>
              </div>
              <div class="category-block" style="background: rgba(255,255,255,.95) !important; border: 1px solid rgba(200,177,120,.4) !important;">
                <div class="category-distance" style="color: #eedf9d !important;">5K</div>
                <div class="category-name" style="color: #2b2621 !important;">Umum</div>
                <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 16px;">
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #5d5141; font-size: 14px;">Biaya Registrasi</span>
                    <div class="category-price" style="font-size: 24px; font-weight: 700; color: #282061 !important;">Rp 180.000</div>
                  </div>
                  <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(165,154,130,.2); text-align: left;">
                    <p style="margin: 0; color: #5d5141; font-size: 13px; line-height: 1.6;">
                      <strong>Benefit :</strong> BIB, Jersey, Medali Finisher, Refreshment
                    </p>
                  </div>
                  <p style="margin: 0; margin-top: 12px; color: #5d5141; font-size: 14px;">Untuk peserta umum</p>
                </div>
              </div>
            </div>

            <div class="promo-cta">
              <a href="{{ url('/event/register') }}" class="btn btn-promo">Amankan Slot Anda Sekarang</a>
            </div>
          </div>
        </div>
      </section>

      <section id="tentang" class="section">
        <div class="container">
          <div class="story-grid">
            
          </div>
            
            <div class="story-highlight">
              <div class="stat-chip">
                <span>Lokasi</span>
                <strong>Coming Soon</strong>
              </div>
              <div class="stat-chip">
                <span>Tanggal</span>
                <strong>Minggu, 4 Januari 2026</strong>
              </div>
              <div class="stat-chip">
                <span>Race Kit</span>
                <strong>Coming Soon</strong>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="racekit" class="section racekit-section">
        <div class="container">
          <h2 class="racekit-title" style="color: #fff !important; text-align: center; margin-bottom: 48px; font-size: 42px; font-weight: 800; text-shadow: 0 2px 8px rgba(0,0,0,.4);">Race Kit</h2>
          <div class="racekit-grid">
            <div class="racekit-item">
              <div class="racekit-icon-wrapper">
                <img src="{{ url('/assets/SATPAM/icon/jersey.png') }}" alt="Jersey" class="racekit-icon">
              </div>
              <h3 class="racekit-item-title" style="color: #fff !important; margin-top: 16px; margin-bottom: 8px; font-size: 18px; font-weight: 700;">Jersey</h3>
              <p class="racekit-item-desc" style="color: rgba(255,255,255,.85) !important; font-size: 13px; line-height: 1.5;">Kaos Eksklusif Untuk Peserta dengan Desain Khusus Event Ini.</p>
            </div>
            
            <div class="racekit-item">
              <div class="racekit-icon-wrapper">
                <img src="{{ url('/assets/SATPAM/icon/no-dada.png') }}" alt="Nomor Dada" class="racekit-icon">
              </div>
              <h3 class="racekit-item-title" style="color: #fff !important; margin-top: 16px; margin-bottom: 8px; font-size: 18px; font-weight: 700;">BIB</h3>
              <p class="racekit-item-desc" style="color: rgba(255,255,255,.85) !important; font-size: 13px; line-height: 1.5;">Nomor Unik Peserta Sebagai Tanda Keikutsertaan dalam Perlombaan.</p>
            </div>
            
            <div class="racekit-item">
              <div class="racekit-icon-wrapper">
                <img src="{{ url('/assets/SATPAM/icon/totebag.png') }}" alt="Tote Bag" class="racekit-icon">
              </div>
              <h3 class="racekit-item-title" style="color: #fff !important; margin-top: 16px; margin-bottom: 8px; font-size: 18px; font-weight: 700;">Tote Bag</h3>
              <p class="racekit-item-desc" style="color: rgba(255,255,255,.85) !important; font-size: 13px; line-height: 1.5;">Tas Eksklusif Untuk Menyimpan Perlengkapan Peserta.</p>
            </div>
            
            <div class="racekit-item">
              <div class="racekit-icon-wrapper">
                <img src="{{ url('/assets/SATPAM/icon/medali.png') }}" alt="Medali Finisher" class="racekit-icon">
              </div>
              <h3 class="racekit-item-title" style="color: #fff !important; margin-top: 16px; margin-bottom: 8px; font-size: 18px; font-weight: 700;">Medali Finisher</h3>
              <p class="racekit-item-desc" style="color: rgba(255,255,255,.85) !important; font-size: 13px; line-height: 1.5;">Penghargaan Khusus Bagi Peserta yang Berhasil Menyelesaikan Lomba.</p>
            </div>
          </div>
        </div>
      </section>

      <section id="rute" class="section alt">
        <div class="container">
          <h2 style="color: #2b2621;">Rute Lomba</h2>
          <p style="color: #5d5141;">Rute akan diumumkan segera. Informasi detail lokasi start dan finish akan tersedia dalam waktu dekat.</p>
          <div class="route-card">
            <div class="route-map" style="display: flex; align-items: center; justify-content: center; min-height: 320px; background: rgba(40,32,97,.25); border: 1px solid rgba(238,223,157,.25); border-radius: 20px; padding: 48px;">
              <div style="text-align: center;">
                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #5d5141; margin-bottom: 16px; opacity: 0.6;">
                  <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                  <path d="M12 2v20" />
                  <path d="M2 12h20" />
                </svg>
                <p style="margin: 0; color: #5d5141; font-size: 18px; font-weight: 500;">Race Course: Soon</p>
              </div>
            </div>
            <div class="route-legend" style="color: #5d5141;">
              <div style="color: #5d5141;"><span class="dot km5"></span> Rute 5K</div>
              
            </div>
          </div>
        </div>
      </section>

      <section id="jadwal" class="section">
        <div class="container">
          <h2 style="color: #2b2621;">Jadwal Kegiatan</h2>
          <div class="timeline-grid" style="margin-top: 24px;">
            <div class="timeline-card" style="background: rgba(255,252,235,.9) !important; color: #2b2621 !important; text-align: center; padding: 40px 24px;">
              <span style="color: #282061 !important; font-size: 18px;">Coming Soon</span>
              <strong style="color: #2b2621 !important; display: block; margin-top: 12px;">Jadwal Kegiatan</strong>
              <p style="color: #5d5141 !important; margin-top: 8px;">Jadwal lengkap kegiatan akan diumumkan segera.</p>
            </div>
          </div>
          <div class="center" style="margin-top: 32px;">
            <a class="btn btn-primary" href="{{ url('/event/register') }}" style="background: linear-gradient(135deg, #eedf9d, #d4c48a) !important; color: #232324 !important; border: none !important; font-weight: 700 !important;">Amankan Slot Anda</a>
          </div>
        </div>
      </section>

      <section id="faq" class="section alt">
        <div class="container grid-2">
          <div>
            <h2 style="color: #2b2621;">Pertanyaan Umum</h2>
            <details class="faq"><summary style="color: #2b2621 !important;">Bagaimana cara mengambil race pack?</summary><p style="color: #5d5141 !important;">Informasi waktu dan lokasi pengambilan race pack akan diumumkan segera.</p></details>
            <details class="faq"><summary style="color: #2b2621 !important;">Apakah anak-anak boleh ikut?</summary><p style="color: #5d5141 !important;">Boleh! Anak di bawah 12 tahun wajib didampingi oleh orang tua atau wali saat berlari.</p></details>
            <details class="faq"><summary style="color: #2b2621 !important;">Apakah ada batas waktu?</summary><p style="color: #5d5141 !important;">Cut-off time 1 jam setelah start untuk memastikan seluruh jalur kembali aman.</p></details>
          </div>
          <div class="card" style="background: rgba(255,252,235,.9) !important; color: #2b2621 !important;">
            <h3 style="color: #2b2621 !important;">Butuh Bantuan?</h3>
            <p style="color: #5d5141 !important;">Hubungi panitia di <a href="mailto:satpamfunrun@uho.ac.id" style="color: #282061 !important; text-decoration: underline;">satpamfunrun@gmail.com</a>.</p>
            <p style="color: #5d5141 !important;">Kami akan membalas maksimal 1x24 jam kerja.</p>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="container footer-inner">
        <div class="footer-brand">
          <div class="logo-wrapper footer-logo-wrapper" style="background: transparent; padding: 0; border: none; animation: none;">
            <img src="{{ url('/assets/SATPAM/logo-navbar.png') }}" alt="Satpam Fun Run" width="120" height="60" class="footer-logo" style="filter: none;">
          </div>
        </div>
        <div class="footer-links">
          <a href="#tentang">Tentang</a>
          <a href="#rute">Rute</a>
          <a href="#jadwal">Jadwal</a>
          <a href="#faq">FAQ</a>
          <a href="{{ url('/event/register') }}" class="btn btn-sm">Daftar</a>
        </div>
      </div>
    </footer>

    <script src="{{ url('/assets/script.js') }}" defer></script>
    <script>
      // Burger Menu Toggle
      const burgerMenu = document.getElementById('burgerMenu');
      const mainNav = document.getElementById('mainNav');
      const navOverlay = document.getElementById('navOverlay');
      
      function toggleMenu() {
        const isActive = burgerMenu.classList.contains('active');
        burgerMenu.classList.toggle('active');
        mainNav.classList.toggle('active');
        if (navOverlay) {
          navOverlay.classList.toggle('active');
        }
        burgerMenu.setAttribute('aria-expanded', !isActive);
        document.body.style.overflow = !isActive ? 'hidden' : '';
      }
      
      function closeMobileMenu() {
        burgerMenu.classList.remove('active');
        mainNav.classList.remove('active');
        if (navOverlay) {
          navOverlay.classList.remove('active');
        }
        burgerMenu.setAttribute('aria-expanded', 'false');
        document.body.style.overflow = '';
      }
      
      if (burgerMenu) {
        burgerMenu.addEventListener('click', toggleMenu);
      }
      
      if (navOverlay) {
        navOverlay.addEventListener('click', closeMobileMenu);
      }
      
      // Close menu on escape key
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && mainNav && mainNav.classList.contains('active')) {
          closeMobileMenu();
        }
      });
      
      // Countdown Timer untuk Event 4 Januari 2026 06:00 WITA
      (function() {
        const eventDate = new Date('2026-01-04T06:00:00+08:00').getTime();
        
        function updateCountdown() {
          const now = new Date().getTime();
          const distance = eventDate - now;
          
          if (distance < 0) {
            // Update top countdown
            document.getElementById('top-days').textContent = '00';
            document.getElementById('top-hours').textContent = '00';
            document.getElementById('top-minutes').textContent = '00';
            document.getElementById('top-seconds').textContent = '00';
            return;
          }
          
          const days = Math.floor(distance / (1000 * 60 * 60 * 24));
          const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((distance % (1000 * 60)) / 1000);
          
          // Update top countdown
          document.getElementById('top-days').textContent = String(days).padStart(2, '0');
          document.getElementById('top-hours').textContent = String(hours).padStart(2, '0');
          document.getElementById('top-minutes').textContent = String(minutes).padStart(2, '0');
          document.getElementById('top-seconds').textContent = String(seconds).padStart(2, '0');
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
      })();
    </script>
  </body>
  </html>


