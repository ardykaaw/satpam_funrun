<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pendaftaran - Satpam Fun Run 5K</title>
    <meta name="description" content="Detail lengkap pendaftaran Satpam Fun Run 5K">
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
      
      /* Improve registration detail layout */
      .detail-section {
        margin-bottom: 32px;
      }
      
      .detail-item {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 16px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 8px;
        margin-bottom: 12px;
        word-wrap: break-word;
        overflow-wrap: break-word;
      }
      
      .detail-item-label {
        font-size: 14px;
        color: #2b2621;
        font-weight: 500;
        margin-bottom: 4px;
      }
      
      .detail-item-value {
        font-size: 16px;
        color: #1a1612;
        font-weight: 600;
        word-break: break-word;
        line-height: 1.6;
      }
      
      .detail-item-full {
        display: flex;
        flex-direction: column;
        gap: 8px;
        padding: 16px;
        background: rgba(255,255,255,.08);
        border: 1px solid rgba(255,255,255,.1);
        border-radius: 8px;
        margin-bottom: 12px;
      }
      
      @media (min-width: 768px) {
        .detail-item {
          flex-direction: row;
          justify-content: space-between;
          align-items: flex-start;
        }
        
        .detail-item-label {
          min-width: 160px;
          margin-bottom: 0;
        }
        
        .detail-item-value {
          text-align: right;
          flex: 1;
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
          <a href="/#tentang" onclick="closeMobileMenu()">Tentang</a>
          <a href="/#rute" onclick="closeMobileMenu()">Rute</a>
          <a href="/#jadwal" onclick="closeMobileMenu()">Jadwal</a>
          <a href="/#faq" onclick="closeMobileMenu()">FAQ</a>
          </div>
          <div class="nav-cta">
            <span class="nav-badge">Edisi 2025</span>
            <a href="{{ url('/event/register') }}" class="btn btn-cta btn-sm" onclick="closeMobileMenu()" style="background: linear-gradient(135deg, #eedf9d, #d4c48a) !important; color: #232324 !important; border: none !important; font-weight: 800 !important;">Daftar</a>
          </div>
        </nav>
      </div>
    </header>

    <main>
      <section class="section">
        <div class="container narrow">
          <div style="text-align: center; margin-bottom: 32px;">
            <div style="width: 80px; height: 80px; margin: 0 auto 16px; background: linear-gradient(135deg, var(--ok), #5be588); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #0b0f1a; font-weight: 900;">
              ✓
            </div>
            <h1 style="margin-bottom: 8px;">Detail Pendaftaran</h1>
            <p class="muted">Nomor Pendaftaran: <strong>{{ $registration->registration_number }}</strong></p>
          </div>

          <div class="form-panel" style="margin-bottom: 24px;">
            <div style="background: rgba(238,223,157,.1); border: 1px solid var(--primary); border-radius: 12px; padding: 20px; margin-bottom: 24px;">
              <h3 style="margin-bottom: 16px; color: #2b2621; font-size: 18px; font-weight: 700;">📋 Informasi Event</h3>
              <div style="display: grid; gap: 8px;">
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(43,38,33,.1);">
                  <span style="color: #5d5141; font-size: 14px;">Event:</span>
                  <strong style="color: #2b2621; font-size: 15px;">Satpam Fun Run 5K</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(43,38,33,.1);">
                  <span style="color: #5d5141; font-size: 14px;">Tanggal:</span>
                  <strong style="color: #2b2621; font-size: 15px;">Minggu, 4 Januari 2026</strong>
                </div>
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(43,38,33,.1);">
                  <span style="color: #5d5141; font-size: 14px;">Kategori:</span>
                  <strong style="color: #2b2621; font-size: 15px;">{{ $registration->category }}</strong>
                </div>
                @if($registration->category_type === 'satpam' && $registration->kta_number)
                <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid rgba(43,38,33,.1);">
                  <span style="color: #5d5141; font-size: 14px;">No. KTA:</span>
                  <strong style="color: #2b2621; font-size: 15px;">{{ $registration->kta_number }}</strong>
                </div>
                @endif
                <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                  <span style="color: #5d5141; font-size: 14px;">Nomor BIB:</span>
                  <strong style="color: #2b2621; font-size: 15px;">{{ $registration->bib_name }}</strong>
                </div>
              </div>
            </div>

            <h3 style="margin-bottom: 16px; color: #2b2621; font-size: 18px; font-weight: 700;">👤 Data Pribadi</h3>
            <div class="detail-section">
              <div class="detail-item">
                <span class="detail-item-label">Nama Lengkap:</span>
                <span class="detail-item-value">{{ $registration->full_name }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Email:</span>
                <span class="detail-item-value">{{ $registration->email }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Nomor Telepon:</span>
                <span class="detail-item-value">{{ $registration->phone }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Tanggal Lahir:</span>
                <span class="detail-item-value">{{ $registration->birth_date->format('d F Y') }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Jenis Kelamin:</span>
                <span class="detail-item-value">{{ $registration->gender }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Pekerjaan:</span>
                <span class="detail-item-value">{{ $registration->occupation }}</span>
              </div>
            </div>

            <h3 style="margin-bottom: 16px; color: #2b2621; font-size: 18px; font-weight: 700;">🏠 Alamat</h3>
            <div class="detail-section">
              <div class="detail-item-full">
                <span class="detail-item-label">Alamat Lengkap:</span>
                <span class="detail-item-value">{{ $registration->address }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Kota:</span>
                <span class="detail-item-value">{{ $registration->city }}</span>
              </div>
            </div>

            <h3 style="margin-bottom: 16px; color: #2b2621; font-size: 18px; font-weight: 700;">🏃 Informasi Event</h3>
            <div class="detail-section">
              <div class="detail-item">
                <span class="detail-item-label">Ukuran Jersey:</span>
                <span class="detail-item-value">{{ $registration->jersey_size }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Golongan Darah:</span>
                <span class="detail-item-value">{{ $registration->blood_type }}</span>
              </div>
            </div>

            <h3 style="margin-bottom: 16px; color: #2b2621; font-size: 18px; font-weight: 700;">📞 Kontak Darurat</h3>
            <div class="detail-section">
              <div class="detail-item">
                <span class="detail-item-label">Nama:</span>
                <span class="detail-item-value">{{ $registration->emergency_name }}</span>
              </div>
              <div class="detail-item">
                <span class="detail-item-label">Nomor Telepon:</span>
                <span class="detail-item-value">{{ $registration->emergency_phone }}</span>
              </div>
            </div>

            @if($registration->community)
              <h3 style="margin-bottom: 16px; color: #2b2621; font-size: 18px; font-weight: 700;">👥 Komunitas</h3>
              <div class="detail-section">
                <div class="detail-item-full">
                  <span class="detail-item-value">{{ $registration->community }}</span>
                </div>
              </div>
            @endif

          </div>

          <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
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
          <a href="/#tentang">Tentang</a>
          <a href="/#rute">Rute</a>
          <a href="/#jadwal">Jadwal</a>
          <a href="/#faq">FAQ</a>
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
    </script>
  </body>
</html>

