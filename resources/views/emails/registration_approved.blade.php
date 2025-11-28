<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pendaftaran - Satpam Fun Run 5K</title>
  </head>
  <body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, sans-serif; background:#f5f5f5; margin:0; padding:0;">
    <div style="max-width:600px; margin:0 auto; background:#ffffff; padding:0;">
      
      <!-- Header Message -->
      <div style="padding:24px 20px; text-align:center; border-bottom:1px solid #e0e0e0;">
        <p style="margin:0; color:#333; font-size:15px; line-height:1.6;">
          Email ini merupakan konfirmasi bahwa Anda telah terdaftar untuk <strong>Satpam Fun Run 5K</strong>
        </p>
      </div>

      <!-- QR Code - Paling Atas -->
      @php
        $hasQrCode = false;
        $qrCodeSrc = null;
        
        // Prioritize base64 (works best in email clients)
        if (!empty($qrCodeBase64) && str_starts_with($qrCodeBase64, 'data:image/png;base64,')) {
          $hasQrCode = true;
          $qrCodeSrc = $qrCodeBase64;
        } elseif (!empty($qrCodePath)) {
          // Fallback to file path
          $hasQrCode = true;
          $qrCodeSrc = asset($qrCodePath);
        }
      @endphp
      
      @if($hasQrCode && $qrCodeSrc)
      <div style="text-align:center; padding:32px 20px; background:#ffffff;">
        <p style="margin:0 0 16px; color:#333; font-size:14px; font-weight:600;">QR Code Pendaftaran Anda:</p>
        <img src="{{ $qrCodeSrc }}" alt="QR Code {{ $registration->registration_number ?? 'N/A' }}" style="max-width:280px; width:100%; height:auto; display:block; margin:0 auto; border:2px solid #282061; border-radius:8px; padding:8px; background:#f9f9f9;">
        <p style="margin:16px 0 0; color:#666; font-size:12px; line-height:1.5;">Tunjukkan QR Code ini saat pengambilan race pack. Informasi detail akan diumumkan kemudian.</p>
      </div>
      @else
      <div style="text-align:center; padding:32px 20px; background:#fff3cd; border:1px solid #ffc107;">
        <p style="margin:0; color:#856404; font-size:14px;">QR Code sedang diproses. Silakan cek status pendaftaran Anda di bawah.</p>
      </div>
      @endif

      <!-- Detail Peserta -->
      <div style="padding:0 20px 20px; border-bottom:1px solid #e0e0e0;">
        <ul style="margin:0; padding:0; list-style:none;">
          <li style="margin-bottom:12px; color:#333; font-size:14px; line-height:1.5;">
            <strong>ID Pendaftaran:</strong> {{ $registration->registration_number }}
          </li>
          <li style="margin-bottom:12px; color:#333; font-size:14px; line-height:1.5;">
            <strong>Nama:</strong> {{ $registration->full_name }}
          </li>
          <li style="margin-bottom:12px; color:#333; font-size:14px; line-height:1.5;">
            <strong>Kategori Lomba:</strong> {{ $registration->category }}
          </li>
          @if($registration->jersey_size)
          <li style="margin-bottom:12px; color:#333; font-size:14px; line-height:1.5;">
            <strong>Jersey:</strong> {{ $registration->jersey_size }}
          </li>
          @endif
        </ul>
      </div>

      <!-- Informasi Lomba -->
      <div style="padding:20px; border-bottom:1px solid #e0e0e0;">
        <p style="margin:0 0 12px; color:#333; font-size:14px; font-weight:600;">Informasi Lomba:</p>
        <ul style="margin:0; padding:0; list-style:none;">
          <li style="margin-bottom:8px; color:#333; font-size:14px; line-height:1.5;">
            <strong>Tanggal Lomba:</strong><br>
            <span style="color:#666;">Minggu, 4 Januari 2026</span>
          </li>
          <li style="margin-bottom:8px; color:#333; font-size:14px; line-height:1.5;">
            <strong>Pengambilan Race Pack:</strong><br>
            <span style="color:#666;">Informasi detail akan diumumkan kemudian</span>
          </li>
          @if($registration->category_type === 'satpam' && $registration->kta_number)
          <li style="margin-bottom:8px; color:#333; font-size:14px; line-height:1.5;">
            <strong>No. KTA:</strong><br>
            <span style="color:#666;">{{ $registration->kta_number }}</span>
          </li>
          @endif
        </ul>
      </div>

      <!-- Button Cek Status -->
      <div style="padding:24px 20px; text-align:center; background:#ffffff; border-top:1px solid #e0e0e0;">
        <a href="{{ route('registration.check', ['registration_number' => $registration->registration_number]) }}" style="display:inline-block; padding:14px 32px; background:linear-gradient(135deg, #282061, #3d2f7a); color:#ffffff; text-decoration:none; border-radius:8px; font-weight:600; font-size:15px; box-shadow:0 4px 12px rgba(40,32,97,.3);">Cek Status Pendaftaran</a>
        <p style="margin:16px 0 0; color:#666; font-size:12px; line-height:1.5;">Klik tombol di atas untuk melihat detail lengkap pendaftaran Anda</p>
      </div>

      <!-- Informasi Penting -->
      <div style="padding:20px; background:#fafafa;">
        <p style="margin:0 0 12px; color:#333; font-size:14px; font-weight:600;">Informasi Penting:</p>
        <ul style="margin:0; padding:0; list-style:none;">
          <li style="margin-bottom:12px; color:#333; font-size:13px; line-height:1.6;">
            <strong>Peraturan & Ketentuan:</strong> Dengan mendaftar, Anda telah memahami dan setuju dengan Peraturan & Ketentuan Lomba Satpam Fun Run 5K.
          </li>
          <li style="margin-bottom:0; color:#333; font-size:13px; line-height:1.6;">
            <strong>Tidak Dapat Dikembalikan & Dipindah Tangan:</strong> Pendaftaran bersifat final dan tidak dapat dikembalikan atau dipindah tangan dalam kondisi apa pun.
          </li>
        </ul>
      </div>

      <!-- Footer -->
      <div style="padding:16px 20px; text-align:center; background:#f5f5f5; border-top:1px solid #e0e0e0;">
        <p style="margin:0; color:#999; font-size:12px;">
          © {{ date('Y') }} Satpam Fun Run 5K. Email ini dikirim otomatis.
        </p>
      </div>

    </div>
  </body>
  </html>


