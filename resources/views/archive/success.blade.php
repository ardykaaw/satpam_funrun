<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pendaftaran Berhasil — Satpam Fun Run 5K</title>
    <meta name="description" content="Konfirmasi pendaftaran Satpam Fun Run 5K. Simpan informasi ini untuk pengambilan race pack.">
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
        <nav class="nav">
          <div class="nav-links">
          <a href="/">Beranda</a>
            <a href="{{ route('registration.check') }}">Cek Status</a>
          </div>
          <div class="nav-cta">
            <span class="nav-badge">Edisi 2025</span>
            <a href="{{ url('/event/register') }}" class="btn btn-cta btn-sm">Daftar</a>
          </div>
        </nav>
      </div>
    </header>

    <main>
      <section class="section">
        <div class="container">
          <div class="form-panel" style="max-width: 760px; margin: 0 auto;">
            <div class="checkmark" aria-hidden="true">✓</div>
            <h1>Terima kasih, pendaftaran berhasil!</h1>
            <p class="muted">Detail pendaftaran Anda ditampilkan di bawah. Simpan bukti ini sebagai referensi ketika mengambil race pack.</p>
            <div id="summary" class="summary" style="margin-top: 20px;"></div>
            <div class="form-actions center" style="margin-top: 24px;">
              <a class="btn btn-primary" href="/">Kembali ke Beranda</a>
              <button class="btn btn-ghost" id="downloadBtn">Unduh Bukti (PNG)</button>
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
          <a href="{{ url('/event/register') }}" class="btn btn-sm">Daftar</a>
        </div>
      </div>
    </footer>

    <script src="{{ url('/assets/success.js') }}" defer></script>
  </body>
  </html>


