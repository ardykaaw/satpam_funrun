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
              <h3 style="margin-bottom: 16px; color: var(--text);">📋 Informasi Event</h3>
              <div style="display: grid; gap: 8px;">
                <div style="display: flex; justify-content: space-between;">
                  <span class="muted">Event:</span>
                  <strong>Satpam Fun Run 5K</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                  <span class="muted">Tanggal:</span>
                  <strong>4 Januari 2026</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                  <span class="muted">Kategori:</span>
                  <strong>{{ $registration->category }}</strong>
                </div>
                <div style="display: flex; justify-content: space-between;">
                  <span class="muted">Nomor BIB:</span>
                  <strong>{{ $registration->bib_name }}</strong>
                </div>
              </div>
            </div>

            @if($registration->registration_number)
            <div class="glass-card" style="text-align: center; margin-bottom: 24px; padding: 32px;">
              <h3 style="margin-bottom: 16px; color: #2b2621;">📱 QR Code Pendaftaran</h3>
              <p style="margin-bottom: 20px; color: #5d5141; font-size: 14px;">Tunjukkan QR code ini saat pengambilan race pack</p>
              @php
                $qrCode = \App\Services\BarcodeService::generateBarcodeBase64Static($registration->registration_number);
              @endphp
              @if($qrCode)
                <div style="display: inline-block; padding: 16px; background: rgba(255,255,255,.95); border: 2px solid rgba(238,223,157,.5); border-radius: 16px; box-shadow: 0 8px 24px rgba(0,0,0,.15);">
                  <img src="{{ $qrCode }}" alt="QR Code {{ $registration->registration_number }}" style="max-width: 280px; width: 100%; height: auto; display: block;">
                </div>
              @else
                <p style="color: #f18b8b; margin-top: 12px;">QR code tidak dapat ditampilkan. Silakan gunakan nomor pendaftaran: <strong>{{ $registration->registration_number }}</strong></p>
              @endif
              <div style="margin-top: 20px; padding: 16px; background: rgba(40,32,97,.1); border-radius: 12px; border: 1px solid rgba(40,32,97,.2);">
                <p style="margin: 0 0 8px; color: #2b2621; font-weight: 600;">📦 Pengambilan Race Pack</p>
                <p style="margin: 4px 0; color: #5d5141; font-size: 14px;"><strong>Tanggal:</strong> Coming Soon</p>
                <p style="margin: 4px 0; color: #5d5141; font-size: 14px;"><strong>Waktu:</strong> 10.00 - 17.00 WITA</p>
                <p style="margin: 4px 0; color: #5d5141; font-size: 14px;"><strong>Lokasi:</strong> Aula Lanal Kendari</p>
              </div>
            </div>
            @endif

            <h3 style="margin-bottom: 16px; color: var(--text);">👤 Data Pribadi</h3>
            <div style="display: grid; gap: 12px; margin-bottom: 24px;">
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Nama Lengkap:</span>
                <strong>{{ $registration->full_name }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Email:</span>
                <strong>{{ $registration->email }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Nomor Telepon:</span>
                <strong>{{ $registration->phone }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Tanggal Lahir:</span>
                <strong>{{ $registration->birth_date->format('d F Y') }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Jenis Kelamin:</span>
                <strong>{{ $registration->gender }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Pekerjaan:</span>
                <strong>{{ $registration->occupation }}</strong>
              </div>
            </div>

            <h3 style="margin-bottom: 16px; color: var(--text);">🏠 Alamat</h3>
            <div style="display: grid; gap: 12px; margin-bottom: 24px;">
              <div style="padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Alamat Lengkap:</span>
                <div style="margin-top: 4px;"><strong>{{ $registration->address }}</strong></div>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Kota:</span>
                <strong>{{ $registration->city }}</strong>
              </div>
            </div>

            <h3 style="margin-bottom: 16px; color: var(--text);">🏃 Informasi Event</h3>
            <div style="display: grid; gap: 12px; margin-bottom: 24px;">
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Ukuran Jersey:</span>
                <strong>{{ $registration->jersey_size }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Golongan Darah:</span>
                <strong>{{ $registration->blood_type }}</strong>
              </div>
            </div>

            <h3 style="margin-bottom: 16px; color: var(--text);">📞 Kontak Darurat</h3>
            <div style="display: grid; gap: 12px; margin-bottom: 24px;">
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Nama:</span>
                <strong>{{ $registration->emergency_name }}</strong>
              </div>
              <div style="display: flex; justify-content: space-between; padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px;">
                <span class="muted">Nomor Telepon:</span>
                <strong>{{ $registration->emergency_phone }}</strong>
              </div>
            </div>

            @if($registration->community)
              <h3 style="margin-bottom: 16px; color: var(--text);">👥 Komunitas</h3>
              <div style="padding: 12px; background: rgba(255,255,255,.02); border-radius: 8px; margin-bottom: 24px;">
                <strong>{{ $registration->community }}</strong>
              </div>
            @endif

            <div style="background: rgba(238,223,157,.1); border: 1px solid var(--primary); border-radius: 12px; padding: 20px; margin-top: 24px;">
              <p style="margin: 0; color: var(--text); font-size: 15px; line-height: 1.6;">
                <strong>📌 Catatan Penting:</strong><br>
                Simpan nomor pendaftaran ini untuk keperluan pengambilan race pack dan saat event berlangsung.
              </p>
            </div>
          </div>

          <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
            <a href="/" class="btn btn-primary">Kembali ke Beranda</a>
            <a href="{{ route('registration.check') }}" class="btn btn-ghost">Cek Status Lainnya</a>
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

