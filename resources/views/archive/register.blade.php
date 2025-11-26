<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Satpam Fun Run 5K</title>
    <meta name="description" content="Formulir resmi Satpam Fun Run 5K. Isi data dan unggah bukti pembayaran untuk mengamankan slot lari.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="{{ url('/assets/SATPAM/Logo.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ url('/assets/style.css') }}">
    <style>
      /* Perapihan tampilan unggah bukti pembayaran */
      /* kembalikan input file ke default, fokus rapikan checkbox & T&C */
      .form .field.checkbox { text-align: left; }
      .field.checkbox {
        display: flex;
        flex-direction: row-reverse; /* teks di kiri, checkbox di kanan */
        align-items: center;
        justify-content: flex-start;
        gap: 8px;
        margin: 0; /* cegah center via auto margin */
        padding: 0;
        width: fit-content; /* hanya selebar konten */
        align-self: flex-start; /* paksa nempel kiri jika parent flex */
      }
      .field.checkbox input[type="checkbox"] { margin: 0; }
      .field.checkbox label {
        line-height: 1.5;
        cursor: pointer;
        margin: 0;
        color: #2b2621;
      }
      .field.checkbox a { 
        text-decoration: underline;
        color: #282061;
      }
      .field.checkbox a:hover {
        color: #665d6c;
      }
      /* Remove background and border effects from logo-wrapper */
      .logo-wrapper[style*="background: transparent"]::before {
        display: none !important;
      }
      /* Fix button colors */
      .btn-primary {
        background: linear-gradient(135deg, #eedf9d, #d4c48a) !important;
        color: #232324 !important;
        border: none !important;
        font-weight: 700 !important;
      }
      .btn-primary:hover {
        background: linear-gradient(135deg, #d4c48a, #eedf9d) !important;
        color: #232324 !important;
      }
      .btn-ghost {
        background: transparent !important;
        color: #2b2621 !important;
        border: 1px solid rgba(165,154,130,.5) !important;
      }
      .btn-ghost:hover {
        background: rgba(165,154,130,.1) !important;
        color: #232324 !important;
      }
      .btn-cta {
        background: linear-gradient(135deg, #eedf9d, #d4c48a) !important;
        color: #232324 !important;
        border: none !important;
        font-weight: 800 !important;
      }
      .btn-cta:hover {
        background: linear-gradient(135deg, #d4c48a, #eedf9d) !important;
        color: #232324 !important;
      }
      /* Payment proof preview */
      #paymentProofPreview {
        margin-top: 12px;
        display: none;
      }
      #paymentProofPreview img {
        max-width: 100%;
        max-height: 300px;
        border-radius: 8px;
        border: 2px solid rgba(165,154,130,.4);
        box-shadow: 0 4px 12px rgba(0,0,0,.1);
      }
      .err {
        color: #f18b8b !important;
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
        <div class="container">
          <div class="form-shell two-column">
            <div class="form-panel hero-form-panel">
              <span class="eyebrow" style="color: #8c7a60;">Satpam Fun Run</span>
          <h1 style="color: #2b2621;">Formulir Pendaftaran</h1>
              <p class="muted" style="color: #5d5141;">Lengkapi data peserta Satpam Fun Run 5K untuk memastikan race pack dapat diproses tanpa kendala. Form ini diperuntukkan bagi peserta kategori Korps Satpam & Umum.</p>
              <div class="info-pills" style="margin-top: 20px;">
                <div class="info-pill light">
                  <span>Event</span>
                  <strong>Satpam Fun Run 5K • 4 Jan 2026</strong>
                </div>
                <div class="info-pill light">
                  <span>Lokasi</span>
                  <strong>Coming Soon</strong>
                </div>
                <div class="info-pill light">
                  <span>Investasi</span>
                  <strong>Coming Soon</strong>
                </div>
              </div>
              <div class="hero-visual" style="margin-top: 28px;">
                <img src="{{ url('/assets/SATPAM/Logo.png') }}" alt="Satpam Crest" style="width: clamp(220px, 35vw, 320px); filter: drop-shadow(0 25px 40px rgba(0,0,0,.35));">
              </div>
            </div>
            <div class="form-panel">
              <h2 style="color: #2b2621;">Data Peserta</h2>
              <p class="muted" style="color: #5d5141;">Berikut informasi yang dibutuhkan panitia untuk memproses registrasi Anda.</p>
              <form id="registerForm" class="form" action="{{ route('registration.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-section-title" style="color: #2b2621;">Pilih Kategori</div>
                <div class="field">
                  <label for="categoryType">Kategori <span style="color: #f18b8b;">*</span></label>
                  <select id="categoryType" name="categoryType" required>
                    <option value="">Pilih Kategori</option>
                    <option value="satpam">Korps Satpam (Rp 170.000)</option>
                    <option value="umum">Umum (Rp 180.000)</option>
                  </select>
                  <small class="err" data-err-for="categoryType"></small>
                </div>
                <input type="hidden" name="category" id="category" value="Korps Satpam & Umum">

                <div class="form-section-title" style="color: #2b2621;">Informasi Peserta</div>
            <div class="field">
              <label for="fullName">Nama Lengkap <span style="color: #f18b8b;">*</span></label>
              <input id="fullName" name="fullName" type="text" autocomplete="name" required placeholder="Nama Lengkap">
              <small class="err" data-err-for="fullName"></small>
            </div>

            <div class="field">
              <label for="email">Email <span style="color: var(--danger);">*</span></label>
              <input id="email" name="email" type="email" autocomplete="email" required placeholder="Gunakan Email Yang Valid">
              <small class="err" data-err-for="email"></small>
            </div>

            <div class="field">
              <label for="bibName">Nama di BIB <span style="color: var(--danger);">*</span></label>
              <input id="bibName" name="bibName" type="text" required placeholder="Nama di BIB" maxlength="16">
              <small class="muted">Max 16 Karakter</small>
              <small class="err" data-err-for="bibName"></small>
            </div>

            <div class="field">
              <label for="phone">Nomor Telepon <span style="color: var(--danger);">*</span></label>
              <input id="phone" name="phone" type="tel" inputmode="tel" autocomplete="tel-national" required placeholder="Nomor Telepon">
              <small class="err" data-err-for="phone"></small>
            </div>

            <div class="grid-2">
              <div class="field">
                <label for="birthDate">Tanggal Lahir <span style="color: var(--danger);">*</span></label>
                <input id="birthDate" name="birthDate" type="date" required>
                <small class="err" data-err-for="birthDate"></small>
              </div>
              <div class="field">
                <label for="gender">Jenis Kelamin <span style="color: var(--danger);">*</span></label>
                <select id="gender" name="gender" required>
                  <option value="">Pilih Jenis Kelamin</option>
                  <option value="Laki-laki">Laki-laki</option>
                  <option value="Perempuan">Perempuan</option>
                </select>
                <small class="err" data-err-for="gender"></small>
              </div>
            </div>

            <div class="field">
              <label for="occupation">Pekerjaan <span style="color: var(--danger);">*</span></label>
              <input id="occupation" name="occupation" type="text" required placeholder="Pekerjaan">
              <small class="err" data-err-for="occupation"></small>
            </div>

                <div class="form-section-title" style="color: #2b2621;">Identitas & Alamat</div>
            <div class="grid-2">
              <div class="field">
                <label for="idType">Jenis Kartu Identitas <span style="color: var(--danger);">*</span></label>
                <select id="idType" name="idType" required>
                  <option value="">Pilih Kartu Identitas</option>
                  <option value="KTP">KTP</option>
                  <option value="SIM">SIM</option>
                  <option value="Passport">Passport</option>
                  <option value="Kartu Pelajar">Kartu Pelajar</option>
                </select>
                <small class="err" data-err-for="idType"></small>
              </div>
              <div class="field">
                <label for="idNumber">Nomor Kartu Identitas <span style="color: var(--danger);">*</span></label>
                <input id="idNumber" name="idNumber" type="text" required placeholder="Nomor Kartu Identitas">
                <small class="err" data-err-for="idNumber"></small>
              </div>
            </div>

            <div class="field">
              <label for="address">Alamat <span style="color: var(--danger);">*</span></label>
              <textarea id="address" name="address" rows="3" required placeholder="Alamat Lengkap"></textarea>
              <small class="err" data-err-for="address"></small>
            </div>

            <div class="field">
              <label for="city">Kota <span style="color: var(--danger);">*</span></label>
              <input id="city" name="city" type="text" required placeholder="Kota">
              <small class="err" data-err-for="city"></small>
            </div>

                <div class="form-section-title" style="color: #2b2621;">Race Pack</div>
            <div class="field">
              <label>Tabel Ukuran</label>
              <div style="margin-bottom: 12px; padding: 24px; background: rgba(255,255,255,.7); border: 1px solid rgba(165,154,130,.4); border-radius: 12px; text-align: center;">
                <p style="margin: 0; color: #5d5141; font-size: 16px; font-weight: 600;">Coming Soon</p>
                <p style="margin: 8px 0 0; color: #5d5141; font-size: 14px;">Tabel ukuran jersey akan diumumkan segera.</p>
              </div>
            </div>

            <div class="grid-2">
              <div class="field">
                    <label for="jerseySize">Ukuran Jersey Satpam Fun Run <span style="color: var(--danger);">*</span></label>
                <select id="jerseySize" name="jerseySize" required>
                  <option value="">Pilih Ukuran Jersey</option>
                  <option value="XS">XS</option>
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                  <option value="XXL">XXL</option>
                </select>
                <small class="err" data-err-for="jerseySize"></small>
              </div>
              <div class="field">
                <label for="bloodType">Golongan Darah <span style="color: var(--danger);">*</span></label>
                <select id="bloodType" name="bloodType" required>
                  <option value="">Pilih Golongan Darah</option>
                  <option value="A">A</option>
                  <option value="B">B</option>
                  <option value="AB">AB</option>
                  <option value="O">O</option>
                  <option value="Tidak Tahu">Tidak Tahu</option>
                </select>
                <small class="err" data-err-for="bloodType"></small>
              </div>
            </div>

                <div class="form-section-title" style="color: #2b2621;">Kontak Darurat</div>
            <div class="grid-2">
              <div class="field">
                <label for="emergencyName">Nama Kontak Darurat <span style="color: var(--danger);">*</span></label>
                <input id="emergencyName" name="emergencyName" type="text" required placeholder="Nama Kontak Darurat">
                <small class="err" data-err-for="emergencyName"></small>
              </div>
              <div class="field">
                <label for="emergencyPhone">Nomor Telepon Kontak Darurat <span style="color: var(--danger);">*</span></label>
                <input id="emergencyPhone" name="emergencyPhone" type="tel" required placeholder="Nomor Telepon Kontak Darurat">
                <small class="err" data-err-for="emergencyPhone"></small>
              </div>
            </div>

            <div class="field">
                  <label for="community">Nama Komunitas / Instansi (Jika Ada)</label>
                  <input id="community" name="community" type="text" placeholder="Nama Komunitas atau Instansi">
            </div>

            <div class="field">
              <label for="medicalNotes">Catatan Medis (Jika Ada)</label>
              <textarea id="medicalNotes" name="medicalNotes" rows="3" placeholder="Catatan Medis"></textarea>
            </div>

                <div class="form-section-title" style="color: #2b2621;">Verifikasi Identitas</div>
                <div id="satpamCardUpload" class="field" style="display: none;">
                  <label for="satpamCard">Upload Foto Kartu Tanda Satpam <span style="color: #f18b8b;">*</span></label>
                  <input type="file" id="satpamCard" name="satpamCard" accept="image/*,.pdf">
                  <small class="muted">Ukuran maksimum 10 MB. Format: JPG, PNG, atau PDF.</small>
                  <small class="err" data-err-for="satpamCard"></small>
                  <div id="satpamCardPreview" style="margin-top: 12px;">
                    <img id="satpamCardImage" src="" alt="Preview Kartu Satpam" style="display: none; max-width: 100%; max-height: 300px; border-radius: 8px; border: 2px solid rgba(165,154,130,.4); box-shadow: 0 4px 12px rgba(0,0,0,.1);">
                  </div>
                </div>
                <div id="umumInfo" style="display: none; background: rgba(238,223,157,.2); border: 1px solid rgba(238,223,157,.4); border-radius: 12px; padding: 24px; margin-bottom: 24px;">
                  <p style="margin: 0; font-weight: 600; color: #2b2621; font-size: 16px;">Informasi Pembayaran</p>
                  <p style="margin: 8px 0 0; color: #5d5141; font-size: 14px;">Setelah mendaftar, Anda akan menerima email dengan informasi harga dan nomor rekening. Silakan hubungi admin via WhatsApp untuk konfirmasi pembayaran.</p>
                </div>

            <div class="field checkbox">
              <input id="consent" name="consent" type="checkbox" required>
                  <label for="consent">Saya menyetujui <a href="#" onclick="alert('Syarat & Ketentuan ringkas: jaga keamanan, ikuti arahan panitia, dan pastikan kondisi kesehatan.');return false;">Syarat & Ketentuan Satpam Fun Run</a>.</label>
              <small class="err" data-err-for="consent"></small>
            </div>

            <div class="form-actions">
              <button type="submit" class="btn btn-primary">Daftar Sekarang</button>
              <a href="/" class="btn btn-ghost">Batal</a>
            </div>
          </form>
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
      
      // Category type change handler
      const categoryType = document.getElementById('categoryType');
      const category = document.getElementById('category');
      const satpamCardUpload = document.getElementById('satpamCardUpload');
      const satpamCard = document.getElementById('satpamCard');
      const umumInfo = document.getElementById('umumInfo');
      
      if (categoryType) {
        categoryType.addEventListener('change', function() {
          const selectedType = this.value;
          
          if (selectedType === 'satpam') {
            category.value = 'Korps Satpam';
            satpamCardUpload.style.display = 'block';
            satpamCard.setAttribute('required', 'required');
            umumInfo.style.display = 'none';
          } else if (selectedType === 'umum') {
            category.value = 'Umum';
            satpamCardUpload.style.display = 'none';
            satpamCard.removeAttribute('required');
            satpamCard.value = '';
            umumInfo.style.display = 'block';
          } else {
            satpamCardUpload.style.display = 'none';
            umumInfo.style.display = 'none';
            satpamCard.removeAttribute('required');
          }
        });
      }
      
      // Satpam card upload preview
      const satpamCardPreview = document.getElementById('satpamCardPreview');
      const satpamCardImage = document.getElementById('satpamCardImage');
      
      if (satpamCard) {
        satpamCard.addEventListener('change', function(e) {
          const file = e.target.files[0];
          if (file) {
            const maxSize = 10 * 1024 * 1024; // 10 MB
            if (file.size > maxSize) {
              alert('File terlalu besar. Maksimal 10 MB.');
              e.target.value = '';
              satpamCardPreview.style.display = 'none';
              satpamCardImage.style.display = 'none';
              return;
            }
            
            // Show preview for images
            if (file.type.startsWith('image/')) {
              const reader = new FileReader();
              reader.onload = function(e) {
                satpamCardImage.src = e.target.result;
                satpamCardImage.style.display = 'block';
                satpamCardPreview.style.display = 'block';
              };
              reader.readAsDataURL(file);
            } else {
              // For PDF, just show filename
              satpamCardPreview.style.display = 'none';
              satpamCardImage.style.display = 'none';
            }
          } else {
            satpamCardPreview.style.display = 'none';
            satpamCardImage.style.display = 'none';
          }
        });
      }
      
      // Form submission handler
      const form = document.getElementById('registerForm');
      if (form) {
        form.addEventListener('submit', function(e) {
          let hasError = false;
          
          // Validate BIB name length
          const bibName = document.getElementById('bibName');
          if (bibName && bibName.value.length > 16) {
            e.preventDefault();
            alert('Nama di BIB tidak boleh lebih dari 16 karakter.');
            bibName.focus();
            hasError = true;
            return false;
          }
          
          // Validate category type
          const categoryType = document.getElementById('categoryType');
          if (!categoryType || !categoryType.value) {
            e.preventDefault();
            alert('Pilih kategori terlebih dahulu.');
            if (categoryType) categoryType.focus();
            hasError = true;
            return false;
          }
          
          // Validate satpam card upload for satpam category
          if (categoryType.value === 'satpam') {
            const satpamCard = document.getElementById('satpamCard');
            if (!satpamCard || !satpamCard.files || satpamCard.files.length === 0) {
              e.preventDefault();
              alert('Foto Kartu Tanda Satpam wajib diupload.');
              if (satpamCard) satpamCard.focus();
              hasError = true;
              return false;
            }
          }
          
          // Validate consent checkbox
          const consent = document.getElementById('consent');
          if (!consent || !consent.checked) {
            e.preventDefault();
            alert('Anda harus menyetujui Syarat & Ketentuan.');
            if (consent) consent.focus();
            hasError = true;
            return false;
          }
          
          // If all validations pass, allow form submission to proceed
          if (!hasError) {
            // Form will submit normally to Laravel route
            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
              submitBtn.disabled = true;
              submitBtn.textContent = 'Mengirim...';
            }
          }
        });
      }
      
      // BIB Name character counter and validation
      const bibName = document.getElementById('bibName');
      if (bibName) {
        bibName.addEventListener('input', function() {
          // Limit to 16 characters
          if (this.value.length > 16) {
            this.value = this.value.substring(0, 16);
          }
          const length = this.value.length;
          const small = this.nextElementSibling;
          if (small && small.classList.contains('muted')) {
            small.textContent = `Max 16 Karakter (${length}/16)`;
            if (length >= 15) {
              small.style.color = 'var(--warning)';
            } else {
              small.style.color = 'var(--muted)';
            }
          }
        });
      }
    </script>
  </body>
  </html>



