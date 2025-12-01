<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil - Satpam Fun Run 5K</title>
    <meta name="description" content="Pendaftaran Anda berhasil! Email konfirmasi telah dikirim ke alamat email Anda.">
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
        /* Menu must be highest - use maximum z-index */
        .nav {
          z-index: 2147483647 !important; /* Maximum z-index value */
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
        .section .form-panel,
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
        <div class="container">
          <div class="form-panel" style="text-align: center; max-width: 760px; margin: 0 auto;">
            <div style="margin-bottom: 32px;">
              <div style="width: 100px; height: 100px; margin: 0 auto 24px; background: linear-gradient(135deg, #7ec69a, #5be588); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 56px; color: #232324; font-weight: 900; box-shadow: 0 8px 24px rgba(126, 198, 154, 0.3);">
                ✓
              </div>
              <h1 style="margin-bottom: 16px; color: #2b2621; font-size: 32px;">Pendaftaran Berhasil! 🎉</h1>
              <p style="font-size: 18px; margin-bottom: 8px; color: #5d5141;">
                Terima kasih <strong style="color: #2b2621; word-break: break-word;">{{ $registration->first_name }}</strong>!
              </p>
              <p style="font-size: 16px; margin-bottom: 32px; color: #5d5141; word-break: break-word; overflow-wrap: break-word;">
                Email konfirmasi dengan informasi pembayaran telah dikirim ke <strong style="color: #282061; word-break: break-all; overflow-wrap: break-word;">{{ $registration->email }}</strong>
              </p>
            </div>

            <!-- Informasi Pendaftaran -->
            <div style="background: rgba(255,255,255,.95); border: 1px solid rgba(200,177,120,.4); border-radius: 12px; padding: 24px; margin-bottom: 24px; text-align: left;">
              <h3 style="margin-bottom: 20px; color: #2b2621; font-size: 20px; text-align: center;">📋 Informasi Pendaftaran</h3>
              <div style="display: grid; gap: 16px;">
                <div style="padding-bottom: 12px; border-bottom: 1px solid rgba(165,154,130,.2);">
                  <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: flex-start;">
                    <span style="color: #5d5141; font-weight: 500; flex-shrink: 0; min-width: 100px;">Nama:</span>
                    <strong style="color: #2b2621; word-break: break-word; overflow-wrap: break-word; flex: 1; min-width: 0;">{{ $registration->full_name }}</strong>
                  </div>
                </div>
                <div style="padding-bottom: 12px; border-bottom: 1px solid rgba(165,154,130,.2);">
                  <div style="display: flex; flex-wrap: wrap; gap: 8px; align-items: flex-start;">
                    <span style="color: #5d5141; font-weight: 500; flex-shrink: 0; min-width: 100px;">Email:</span>
                    <strong style="color: #2b2621; word-break: break-all; overflow-wrap: break-word; flex: 1; min-width: 0; font-size: 14px;">{{ $registration->email }}</strong>
                  </div>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; padding-bottom: 12px; border-bottom: 1px solid rgba(165,154,130,.2);">
                  <span style="color: #5d5141; font-weight: 500; flex-shrink: 0;">Kategori:</span>
                  <strong style="color: #282061; word-break: break-word; text-align: right;">{{ $registration->category }}</strong>
                </div>
                @if($registration->unique_price_code)
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px; padding-bottom: 12px; border-bottom: 1px solid rgba(165,154,130,.2);">
                  <span style="color: #5d5141; font-weight: 500; flex-shrink: 0;">Total Pembayaran:</span>
                  <strong style="color: #282061; font-size: 18px; word-break: break-word; text-align: right;">Rp {{ number_format($registration->unique_price_code, 0, ',', '.') }}</strong>
                </div>
                @endif
                <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 8px;">
                  <span style="color: #5d5141; font-weight: 500; flex-shrink: 0;">Status:</span>
                  <span style="background: rgba(243,200,124,.2); color: #8b6f2e; padding: 6px 16px; border-radius: 8px; font-size: 14px; font-weight: 600; white-space: nowrap;">
                    Menunggu Pembayaran
                  </span>
                </div>
              </div>
            </div>

            <!-- Kartu Satpam (jika kategori satpam) -->
            @if($registration->category_type === 'satpam' && $registration->payment_proof_path)
            <div style="background: rgba(255,255,255,.95); border: 1px solid rgba(200,177,120,.4); border-radius: 12px; padding: 20px; margin-bottom: 24px;">
              <h3 style="margin-bottom: 12px; color: #2b2621; font-size: 16px; text-align: center;">🪪 Kartu Tanda Satpam</h3>
              <div style="text-align: center;">
                @php
                    $imagePath = $registration->payment_proof_path;
                    if ($imagePath) {
                        // Remove 'storage/' if already present
                        $imagePath = ltrim($imagePath, '/');
                        if (strpos($imagePath, 'storage/') !== 0) {
                            $imagePath = 'storage/' . $imagePath;
                        }
                    }
                @endphp
                @if($imagePath)
                <img src="{{ asset($imagePath) }}" 
                     alt="Kartu Tanda Satpam" 
                     style="max-width: 100%; max-height: 400px; border-radius: 8px; border: 2px solid rgba(165,154,130,.4); box-shadow: 0 4px 12px rgba(0,0,0,.1); cursor: pointer;"
                     onclick="window.open('{{ asset($imagePath) }}', '_blank')"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <p style="display: none; color: #5d5141; margin-top: 12px;">Gambar tidak dapat ditampilkan.</p>
                @else
                <p style="color: #5d5141;">File tidak ditemukan.</p>
                @endif
              </div>
            </div>
            @endif

            <!-- Informasi Pembayaran -->
            {{-- <div style="background: linear-gradient(135deg, rgba(238,223,157,.3), rgba(212,196,138,.2)); border: 2px solid rgba(238,223,157,.5); border-radius: 12px; padding: 24px; margin-bottom: 24px;">
              <p style="margin: 0 0 16px; color: #2b2621; font-size: 18px; font-weight: 700; text-align: center;">
                💳 Langkah Pembayaran
              </p>
              <div style="text-align: left; color: #5d5141; line-height: 1.8;">
                <p style="margin: 0 0 12px;">
                  <strong style="color: #282061;">1.</strong> Cek email Anda untuk melihat detail pembayaran dan nomor rekening
                </p>
                <p style="margin: 0 0 12px;">
                  <strong style="color: #282061;">2.</strong> Transfer sesuai nominal yang tertera di email (Rp {{ $registration->unique_price_code ? number_format($registration->unique_price_code, 0, ',', '.') : '-' }})
                </p>
                <p style="margin: 0 0 12px;">
                  <strong style="color: #282061;">3.</strong> Klik tombol "Hubungi Admin via WhatsApp" di bawah untuk mengirim bukti transfer
                </p>
                <p style="margin: 0;">
                  <strong style="color: #282061;">4.</strong> Admin akan memverifikasi dan mengirimkan konfirmasi pendaftaran
                </p>
              </div>
            </div>

            <!-- Tombol WhatsApp -->
            <div style="text-align: center; margin-bottom: 32px;">
              <a href="https://wa.me/6282342919490?text=Halo%20Admin%2C%20saya%20{{ urlencode($registration->full_name) }}%20telah%20melakukan%20pendaftaran%20Satpam%20Fun%20Run%205K%20dengan%20kategori%20{{ urlencode($registration->category) }}.%20Total%20pembayaran%20Rp%20{{ $registration->unique_price_code ? number_format($registration->unique_price_code, 0, ',', '.') : '-' }}.%20Saya%20ingin%20mengirimkan%20bukti%20transfer." 
                 target="_blank"
                 style="display: inline-block; background: #25D366; color: #ffffff; text-decoration: none; padding: 16px 32px; border-radius: 12px; font-weight: 700; font-size: 16px; box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3); transition: transform 0.2s;">
                📱 Hubungi Admin via WhatsApp
              </a>
            </div> --}}

            <!-- Info Email -->
            <div style="background: rgba(238,223,157,.15); border: 1px solid rgba(238,223,157,.3); border-radius: 12px; padding: 20px; margin-bottom: 32px;">
              <p style="margin: 0; color: #2b2621; font-size: 15px; line-height: 1.6; text-align: center; word-break: break-word; overflow-wrap: break-word;">
                <strong style="color: #282061;">📧 Email Konfirmasi</strong><br>
                <span style="color: #5d5141;">Email dengan informasi pembayaran lengkap telah dikirim ke <strong style="word-break: break-all; overflow-wrap: break-word;">{{ $registration->email }}</strong>. 
                Silakan cek inbox atau folder spam Anda.</span>
              </p>
            </div>

            <!-- Action Buttons -->
            <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
              <a href="/" class="btn btn-primary" style="background: linear-gradient(135deg, #eedf9d, #d4c48a) !important; color: #232324 !important; border: none !important; font-weight: 700 !important;">Kembali ke Beranda</a>
              <a href="{{ route('registration.check') }}" class="btn btn-ghost" style="background: transparent !important; color: #2b2621 !important; border: 1px solid rgba(165,154,130,.5) !important;">Cek Status Pendaftaran</a>
            </div>
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
