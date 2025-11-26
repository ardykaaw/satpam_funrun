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
    </style>
  </head>
  <body>
    <header class="site-header">
      <div class="container header-inner">
        <a href="/" class="brand">
          <div class="logo-wrapper" style="background: transparent; padding: 0; border: none; animation: none;">
            <img src="{{ url('/assets/SATPAM/Logo.png') }}" alt="Satpam Fun Run Logo" class="brand-logo" width="40" height="40" style="filter: none;">
          </div>
          <span class="brand-name">Satpam </span>
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

    <main>
      <section class="hero">
        <div class="container hero-inner">
          <div class="hero-copy">
            <span class="eyebrow">Satpam Fun Run 5K</span>
            <h1>Solidarity Run for National Guardians</h1>
            <p>Ajang lari 5K yang menghadirkan disiplin dan kebanggaan korps Satpam lewat rute aman, pengamanan penuh, dan panggung selebrasi khusus.</p>
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
            <div class="hero-countdown">
                <div class="countdown-item">
                  <span class="countdown-number" id="days">00</span>
                  <span class="countdown-label">Hari</span>
                </div>
                <div class="countdown-item">
                  <span class="countdown-number" id="hours">00</span>
                  <span class="countdown-label">Jam</span>
                </div>
                <div class="countdown-item">
                  <span class="countdown-number" id="minutes">00</span>
                  <span class="countdown-label">Menit</span>
                </div>
                <div class="countdown-item">
                  <span class="countdown-number" id="seconds">00</span>
                  <span class="countdown-label">Detik</span>
                </div>
              </div>
            <div class="hero-cta">
              <a href="{{ url('/event/register') }}" class="btn btn-cta">Daftar Sekarang</a>
              <a href="#tentang" class="btn btn-ghost">Detail Agenda</a>
            </div>
            <ul class="badges">
              <li>Korps Satpam</li>
              <li>5 Kilometer</li>
              <li>Trisula Challenge</li>
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
            <div class="promo-grid">
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
            </div>
            <div class="categories-pricing">
              <div class="category-block" style="background: rgba(255,255,255,.95) !important; border: 1px solid rgba(200,177,120,.4) !important;">
                <div class="category-distance" style="color: #eedf9d !important;">5K</div>
                <div class="category-name" style="color: #2b2621 !important;">Korps Satpam</div>
                <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 16px;">
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #5d5141; font-size: 14px;">Investasi Partisipasi</span>
                    <div class="category-price" style="font-size: 24px; font-weight: 700; color: #282061 !important;">Rp 170.000</div>
                  </div>
                  <p style="margin: 0; color: #5d5141; font-size: 14px;">Untuk anggota Korps Satpam</p>
                </div>
              </div>
              <div class="category-block" style="background: rgba(255,255,255,.95) !important; border: 1px solid rgba(200,177,120,.4) !important;">
                <div class="category-distance" style="color: #eedf9d !important;">5K</div>
                <div class="category-name" style="color: #2b2621 !important;">Umum</div>
                <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 16px;">
                  <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="color: #5d5141; font-size: 14px;">Investasi Partisipasi</span>
                    <div class="category-price" style="font-size: 24px; font-weight: 700; color: #282061 !important;">Rp 180.000</div>
                  </div>
                  <p style="margin: 0; color: #5d5141; font-size: 14px;">Untuk peserta umum</p>
                </div>
              </div>
            </div>

            <div class="promo-cta">
              <a href="{{ url('/event/register') }}" class="btn btn-promo">Daftar Sekarang</a>
            </div>
          </div>
        </div>
      </section>

      <section id="tentang" class="section">
        <div class="container">
          <div class="story-grid">
            <div class="story-card glass-card">
              <span class="story-label">Misi Utama</span>
              <h3>Merayakan Peran Satpam Indonesia</h3>
              <p>Fun run ini menggabungkan disiplin korps Satpam dengan semangat festival kota. Setiap peserta merasakan bagaimana Satpam menjaga keamanan, sekaligus menikmati hiburan dan penghargaan khusus.</p>
              <ul class="story-list">
                <li>Upacara pembukaan bergaya apel Satpam</li>
                <li>Pengawalan rute oleh regu Satpam berpengalaman</li>
                <li>Expo perlengkapan & komunitas pengamanan</li>
            </ul>
          </div>
            <div class="story-card light">
              <span class="story-label">Agenda Lapangan</span>
              <div class="story-steps">
                <div>
                  <strong>Coming Soon</strong>
                  <p>Jadwal lengkap kegiatan akan diumumkan segera.</p>
                </div>
              </div>
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
              <div style="margin-top: 12px; padding-top: 12px; border-top: 1px solid rgba(165,154,130,.3); color: #5d5141;">
                <p style="margin: 0; color: #5d5141; font-size: 14px;"><strong style="color: #2b2621;">📍 Lokasi:</strong> Coming Soon</p>
                <p style="margin: 5px 0 0; color: #5d5141; font-size: 14px;">Informasi lokasi akan diumumkan segera.</p>
              </div>
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
            <p style="color: #5d5141 !important;">Hubungi panitia di <a href="mailto:satpamfunrun@uho.ac.id" style="color: #282061 !important; text-decoration: underline;">satpamfunrun@uho.ac.id</a>.</p>
            <p style="color: #5d5141 !important;">Kami akan membalas maksimal 2x24 jam kerja.</p>
          </div>
        </div>
      </section>
    </main>

    <footer class="site-footer">
      <div class="container footer-inner">
        <div class="footer-brand">
          <div class="logo-wrapper footer-logo-wrapper" style="background: transparent; padding: 0; border: none; animation: none;">
            <img src="{{ url('/assets/SATPAM/Logo.png') }}" alt="Satpam Fun Run" width="28" height="28" class="footer-logo" style="filter: none;">
          </div>
          <span>Satpam Fun Run 5K</span>
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
            document.getElementById('days').textContent = '00';
            document.getElementById('hours').textContent = '00';
            document.getElementById('minutes').textContent = '00';
            document.getElementById('seconds').textContent = '00';
            return;
          }
          
          const days = Math.floor(distance / (1000 * 60 * 60 * 24));
          const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
          const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((distance % (1000 * 60)) / 1000);
          
          document.getElementById('days').textContent = String(days).padStart(2, '0');
          document.getElementById('hours').textContent = String(hours).padStart(2, '0');
          document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
          document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
        }
        
        updateCountdown();
        setInterval(updateCountdown, 1000);
      })();
    </script>
  </body>
  </html>


