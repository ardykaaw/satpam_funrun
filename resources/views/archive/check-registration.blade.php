<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cek Status Pendaftaran - Satpam Fun Run 5K</title>
    <meta name="description" content="Cek status dan detail pendaftaran Satpam Fun Run 5K menggunakan nomor pendaftaran.">
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
      /* Fix mobile menu z-index - ensure menu is always on top */
      @media (max-width: 768px) {
        /* Menu must be highest */
        .nav {
          z-index: 2147483647 !important;
          position: fixed !important;
        }
        .nav-overlay {
          z-index: 2147483646 !important;
          position: fixed !important;
        }
        .burger-menu {
          z-index: 2147483647 !important;
          position: relative !important;
        }
        .site-header {
          z-index: 2147483645 !important;
          position: relative !important;
        }
        /* Force ALL content below menu - no exceptions */
        body > main,
        body > .section,
        body > .section.alt,
        main .section,
        main .section.alt,
        main .container,
        .section .container,
        .section .form-shell,
        .section .form-panel,
        .form-shell,
        .form-panel,
        .glass-card,
        .card,
        .info-pill,
        .hero,
        .hero-inner,
        .hero-copy,
        .hero-visual {
          position: relative !important;
          z-index: 1 !important;
        }
        /* Prevent any stacking context from interfering */
        body {
          position: relative;
        }
        main {
          isolation: isolate;
          z-index: 1 !important;
        }
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
            <a href="{{ url('/event/register') }}" onclick="closeMobileMenu()">Daftar</a>
          </div>
          <div class="nav-cta">
            <span class="nav-badge">Edisi 2025</span>
            <a href="{{ route('registration.check') }}" class="btn btn-cta btn-sm" onclick="closeMobileMenu()">Cek Status</a>
          </div>
        </nav>
      </div>
    </header>

    <main>
      <section class="section">
        <div class="container" style="max-width: 880px;">
          <h1 style="text-align: center; margin-bottom: 8px;">Cek Status Pendaftaran</h1>
          <p class="muted" style="text-align: center; margin-bottom: 32px;">Masukkan nomor pendaftaran Anda untuk melihat detail lengkap</p>

          <div class="form-panel">
            <form action="{{ route('registration.check') }}" method="GET" class="form">
              <div class="field">
                <label for="registration_number">Nomor Pendaftaran</label>
                <input 
                  type="text" 
                  id="registration_number" 
                  name="registration_number" 
                  placeholder="Contoh: FR202512345" 
                  required
                  value="{{ request('registration_number') }}"
                  style="text-transform: uppercase;"
                >
                <small class="muted">Masukkan nomor pendaftaran yang Anda terima via email</small>
              </div>
              <div class="form-actions">
                <button type="submit" class="btn btn-primary">Cek Status</button>
                <a href="/" class="btn btn-ghost">Kembali</a>
              </div>
            </form>
          </div>

          @if($registration)
            <div class="form-panel" style="margin-top: 24px;">
              <div style="text-align: center; margin-bottom: 24px;">
                @if($registration->status === 'approved')
                  <div style="width: 80px; height: 80px; margin: 0 auto 16px; background: linear-gradient(135deg, var(--ok), #5be588); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 48px; color: #0b0f1a; font-weight: 900;">
                    ✓
                  </div>
                  <h2 style="color: var(--ok); margin-bottom: 8px;">Pendaftaran Disetujui!</h2>
                @elseif($registration->status === 'rejected')
                  <div style="width: 80px; height: 80px; margin: 0 auto 16px; background: linear-gradient(135deg, var(--danger), #ff5252); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 48px; color: white; font-weight: 900;">
                    ✗
                  </div>
                  <h2 style="color: var(--danger); margin-bottom: 8px;">Pendaftaran Ditolak</h2>
                @else
                  <div style="width: 80px; height: 80px; margin: 0 auto 16px; background: rgba(255,165,0,.2); border: 3px solid var(--warning); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 48px; color: var(--warning); font-weight: 900;">
                    ⏳
                  </div>
                  <h2 style="color: var(--warning); margin-bottom: 8px;">Menunggu Konfirmasi</h2>
                @endif
              </div>

              <div style="background: rgba(35,35,36,.85); border: 1px solid var(--border); border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                <h3 style="margin-bottom: 16px; color: var(--text);">Informasi Pendaftaran</h3>
                <div style="display: grid; gap: 12px;">
                  <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border);">
                    <span class="muted">Nomor Pendaftaran:</span>
                    <strong>{{ $registration->registration_number ?? 'Belum Tersedia' }}</strong>
                  </div>
                  <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border);">
                    <span class="muted">Nama:</span>
                    <strong>{{ $registration->full_name }}</strong>
                  </div>
                  <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border);">
                    <span class="muted">Email:</span>
                    <strong>{{ $registration->email }}</strong>
                  </div>
                  <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border);">
                    <span class="muted">Kategori:</span>
                    <strong>{{ $registration->category }}</strong>
                  </div>
                  <div style="display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px solid var(--border);">
                    <span class="muted">Status:</span>
                    @if($registration->status === 'approved')
                      <span style="background: rgba(122,242,155,.2); color: var(--ok); padding: 4px 12px; border-radius: 6px; font-size: 14px; font-weight: 600;">Disetujui</span>
                    @elseif($registration->status === 'rejected')
                      <span style="background: rgba(255,107,107,.2); color: var(--danger); padding: 4px 12px; border-radius: 6px; font-size: 14px; font-weight: 600;">Ditolak</span>
                    @else
                      <span style="background: rgba(255,165,0,.2); color: var(--warning); padding: 4px 12px; border-radius: 6px; font-size: 14px; font-weight: 600;">Menunggu</span>
                    @endif
                  </div>
                  <div style="display: flex; justify-content: space-between; padding: 8px 0;">
                    <span class="muted">Tanggal Pendaftaran:</span>
                    <strong>{{ $registration->created_at->format('d F Y') }}</strong>
                  </div>
                </div>
              </div>

              @if($registration->status === 'approved')
                <div style="background: rgba(238,223,157,.12); border: 1px solid var(--primary); border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                  <p style="margin: 0; color: var(--text); font-size: 15px; line-height: 1.6;">
                    <strong>🎉 Selamat!</strong><br>
                    Pendaftaran Anda telah dikonfirmasi. Silahkan cek detail lengkap di bawah ini untuk informasi lebih lanjut.
                  </p>
                </div>
                <div style="text-align: center;">
                  <a href="{{ route('registration.show', $registration->registration_number) }}" class="btn btn-primary">
                    Lihat Detail Lengkap
                  </a>
                </div>
              @elseif($registration->status === 'rejected' && $registration->admin_notes)
                <div style="background: rgba(255,107,107,.12); border: 1px solid var(--danger); border-radius: 12px; padding: 20px; margin-bottom: 24px;">
                  <p style="margin: 0; color: var(--text); font-size: 15px; line-height: 1.6;">
                    <strong>Alasan Penolakan:</strong><br>
                    {{ $registration->admin_notes }}
                  </p>
                </div>
              @elseif($registration->status === 'pending')
                <div style="background: rgba(255,165,0,.1); border: 1px solid var(--warning); border-radius: 12px; padding: 20px;">
                  <p style="margin: 0; color: var(--text); font-size: 15px; line-height: 1.6;">
                    <strong>⏳ Mohon Tunggu</strong><br>
                    Pendaftaran Anda sedang dalam proses peninjauan oleh admin. Anda akan menerima notifikasi via email setelah pendaftaran dikonfirmasi.
                  </p>
                </div>
              @endif
            </div>
          @elseif(request('registration_number'))
            <div class="card" style="margin-top: 24px; background: rgba(255,107,107,.1); border: 1px solid var(--danger);">
              <div style="text-align: center; padding: 24px;">
                <div style="font-size: 48px; margin-bottom: 16px;">❌</div>
                <h3 style="color: var(--danger); margin-bottom: 8px;">Nomor Pendaftaran Tidak Ditemukan</h3>
                <p class="muted">Pastikan nomor pendaftaran yang Anda masukkan sudah benar.</p>
              </div>
            </div>
          @endif
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

