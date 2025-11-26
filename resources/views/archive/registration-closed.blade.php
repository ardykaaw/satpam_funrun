<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Ditutup - Satpam Fun Run 5K</title>
    <meta name="description" content="Pendaftaran Satpam Fun Run 5K saat ini sudah ditutup. Nantikan informasi gelombang berikutnya.">
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
    </style>
  </head>
  <body>
    <header class="site-header sub">
      <div class="container header-inner">
        <a href="/" class="brand">
          <div class="logo-wrapper" style="background: transparent; padding: 0; border: none; animation: none;">
            <img src="{{ url('/assets/SATPAM/Logo.png') }}" alt="Satpam Fun Run Logo" class="brand-logo" width="40" height="40" style="filter: none;">
          </div>
          <span class="brand-name">Satpam Fun Run 5K</span>
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
          <a href="/" onclick="closeMobileMenu()">Beranda</a>
            <a href="{{ route('registration.check') }}" onclick="closeMobileMenu()">Cek Status</a>
          </div>
          <div class="nav-cta">
            <span class="nav-badge">Edisi 2025</span>
            <a href="{{ url('/event/register') }}" class="btn btn-cta btn-sm" onclick="closeMobileMenu()">Daftar</a>
          </div>
        </nav>
      </div>
    </header>

    <main>
      <section class="section">
        <div class="container" style="max-width: 760px;">
          <div class="form-panel" style="text-align: center;">
            <!-- Icon -->
            <div style="margin-bottom: 24px;">
              <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--warning);">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="12" y1="8" x2="12" y2="12"></line>
                <line x1="12" y1="16" x2="12.01" y2="16"></line>
              </svg>
            </div>

            <!-- Title -->
            <h1 style="margin-bottom: 16px; color: var(--text);">Pendaftaran Ditutup</h1>
            
            <!-- Message -->
            <p class="muted" style="font-size: 18px; margin-bottom: 32px; max-width: 600px; margin-left: auto; margin-right: auto;">
              Maaf, pendaftaran untuk <strong>Satpam Fun Run 5K</strong> saat ini sudah ditutup.
            </p>

            <!-- Additional Info -->
            <div style="background: rgba(238,223,157,.1); border: 1px solid var(--border); border-radius: 12px; padding: 24px; margin-bottom: 32px;">
              <p style="margin: 0; color: var(--text);">
                <strong>Event Details:</strong><br>
                📅 <strong>Tanggal:</strong> 4 Januari 2026<br>
                🏃 <strong>Kategori:</strong> Korps Satpam & Umum<br>
                📍 <strong>Lokasi:</strong> Coming Soon
              </p>
            </div>

            <!-- Actions -->
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
              <a href="/" class="btn btn-primary">
                Kembali ke Beranda
              </a>
              <a href="{{ route('registration.check') }}" class="btn btn-ghost">
                Cek Status Pendaftaran
              </a>
            </div>

            <!-- Contact Info -->
            <div style="margin-top: 48px; padding-top: 32px; border-top: 1px solid var(--border);">
              <p class="muted" style="font-size: 14px;">
                Jika Anda sudah mendaftar sebelumnya, Anda dapat mengecek status pendaftaran Anda.
                <br>
                Untuk informasi lebih lanjut, silakan hubungi panitia.
              </p>
            </div>
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
          <a href="/">Beranda</a>
        </div>
      </div>
    </footer>

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
      
      document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape' && mainNav && mainNav.classList.contains('active')) {
          closeMobileMenu();
        }
      });
    </script>
  </body>
</html>

