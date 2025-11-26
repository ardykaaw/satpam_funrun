<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pendaftaran - Satpam Fun Run 5K</title>
  </head>
  <body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, sans-serif; background:#f7f7fb; margin:0; padding:24px;">
    <div style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:12px; padding:24px; border:1px solid #eee;">
      <div style="text-align:center; margin-bottom:16px;">
        <img src="{{ url('/assets/SATPAM/Logo.png') }}" alt="Satpam Fun Run" style="height:56px; width:auto;">
      </div>
      <h2 style="margin:0 0 8px; color:#222;">Pendaftaran Dikonfirmasi ✅</h2>
      <p style="margin:0 0 16px; color:#555;">Halo {{ $registration->full_name }},</p>
      <p style="margin:0 0 16px; color:#555;">
        Pendaftaran Anda untuk <strong>Satpam Fun Run 5K</strong> telah <strong>dikonfirmasi</strong>.
      </p>

      <div style="background:#fafbff; border:1px solid #e5e9ff; border-radius:10px; padding:16px; margin:16px 0;">
        <p style="margin:0; color:#333;"><strong>Nomor Pendaftaran:</strong> {{ $registration->registration_number }}</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Kategori:</strong> {{ $registration->category }}</p>
        <p style="margin:8px 0 0; color:#333;"><strong>Tanggal Event:</strong> 4 Januari 2026</p>
      </div>

      @if($qrCodeBase64 || $qrCodePath)
      <div style="text-align:center; margin:24px 0; padding:20px; background:#fafbff; border:1px solid #e5e9ff; border-radius:10px;">
        <p style="margin:0 0 12px; color:#333; font-weight:600;">QR Code Pendaftaran</p>
        @if($qrCodeBase64)
          <img src="{{ $qrCodeBase64 }}" alt="QR Code {{ $registration->registration_number }}" style="max-width:300px; width:100%; height:auto; border:2px solid #282061; border-radius:8px; padding:8px; background:#fff;">
        @elseif($qrCodePath)
          <img src="{{ asset($qrCodePath) }}" alt="QR Code {{ $registration->registration_number }}" style="max-width:300px; width:100%; height:auto; border:2px solid #282061; border-radius:8px; padding:8px; background:#fff;">
        @endif
        <p style="margin:12px 0 0; color:#666; font-size:13px;">Tunjukkan QR code ini saat pengambilan race pack</p>
      </div>
      @endif

      <div style="background:#e8f4f8; border:1px solid #b3d9e6; border-radius:10px; padding:16px; margin:16px 0;">
        <p style="margin:0 0 8px; color:#2c3e50; font-weight:600;">📦 Informasi Pengambilan Race Pack</p>
        <p style="margin:4px 0; color:#34495e;"><strong>Tanggal:</strong> Coming Soon</p>
        <p style="margin:4px 0; color:#34495e;"><strong>Waktu:</strong> Coming Soon</p>
        <p style="margin:4px 0; color:#34495e;"><strong>Lokasi:</strong> Coming Soon</p>
      </div>

      <p style="margin:0 0 16px; color:#555;">
        Anda dapat mengecek status pendaftaran kapan saja melalui halaman berikut:
      </p>
      <p style="margin:0 0 16px;">
        <a href="{{ url('/registration/check') }}?registration_number={{ $registration->registration_number }}" 
           style="display:inline-block; background:#282061; color:#eedf9d; text-decoration:none; padding:10px 16px; border-radius:8px; font-weight:600;">
          Cek Status Pendaftaran
        </a>
      </p>

      <div style="background:#fdf1d3; border:1px solid #f1c96f; border-radius:10px; padding:16px; margin:16px 0;">
        <p style="margin:0; color:#5a4527; font-weight:600;">
          ⚠️ Penting: Tunjukkan email ini saat pengambilan racepack Satpam Fun Run.
        </p>
      </div>

      <p style="margin:16px 0 0; color:#777; font-size:12px;">
        Email ini dikirim otomatis. Jika Anda merasa tidak mendaftar, abaikan email ini.
      </p>
    </div>
    <p style="text-align:center; color:#999; font-size:12px; margin-top:12px;">
      © {{ date('Y') }} Satpam Fun Run 5K
    </p>
  </body>
  </html>


