# Testing Email dengan QR Code di Local

## Masalah
Gmail memblokir:
1. Base64 images yang panjang
2. URL localhost/127.0.0.1 (tidak bisa diakses dari email client)

## Solusi untuk Testing di Local

### Opsi 1: Menggunakan ngrok (Recommended)

1. Install ngrok:
   ```bash
   # macOS
   brew install ngrok
   
   # atau download dari https://ngrok.com/download
   ```

2. Jalankan ngrok:
   ```bash
   ngrok http 8000
   # atau port yang digunakan Laravel (biasanya 8000)
   ```

3. Update `.env`:
   ```env
   APP_URL=https://xxxx-xxxx-xxxx.ngrok-free.app
   # Ganti dengan URL dari ngrok
   ```

4. Clear cache:
   ```bash
   php artisan config:clear
   php artisan cache:clear
   ```

5. Test email - QR code akan menggunakan URL dari ngrok yang bisa diakses dari email client

### Opsi 2: Cek QR Code di Halaman Web

Jika QR code tidak tampil di email, user bisa:
1. Klik link di email: "Atau cek QR Code di halaman status pendaftaran"
2. Atau akses langsung: `http://localhost/registration/check?registration_number=SFR-0221`

### Opsi 3: Testing di Production

Untuk testing yang lebih akurat, deploy ke production/staging server dengan domain yang benar.

## Catatan

- Base64 images mungkin tidak tampil di Gmail (diblokir)
- CID embedding lebih reliable tapi perlu testing
- URL dari ngrok akan bekerja untuk testing email

