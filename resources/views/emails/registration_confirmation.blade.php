<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Konfirmasi Pendaftaran - Satpam Fun Run 5K</title>
  </head>
  <body style="font-family: system-ui, -apple-system, Segoe UI, Roboto, 'Helvetica Neue', Arial, sans-serif; background:#f7f7fb; margin:0; padding:24px;">
    <div style="max-width:640px; margin:0 auto; background:#ffffff; border-radius:12px; padding:32px; border:1px solid #eee; box-shadow: 0 2px 8px rgba(0,0,0,.1);">
      <div style="text-align:center; margin-bottom:24px;">
        @php
          // Try multiple paths to find Logo file
          $logoPath = null;
          $possiblePaths = [
            public_path('assets/SATPAM/Logo.png'),
            base_path('assets/SATPAM/Logo.png'),
            storage_path('app/public/assets/SATPAM/Logo.png'),
          ];
          
          foreach ($possiblePaths as $path) {
            if (file_exists($path)) {
              $logoPath = $path;
              break;
            }
          }
        @endphp
        @if($logoPath && file_exists($logoPath))
          <img src="{{ $message->embed($logoPath) }}" alt="Satpam Fun Run" style="height:64px; width:auto;">
        @else
          <div style="height:64px; display:flex; align-items:center; justify-content:center; color:#282061; font-weight:700; font-size:20px;">Satpam Fun Run</div>
        @endif
      </div>
      <h2 style="margin:0 0 8px; color:#232324; font-size:24px;">Terima Kasih Atas Pendaftaran Anda! 🎉</h2>
      <p style="margin:0 0 16px; color:#5d5141; line-height:1.6;">Halo <strong>{{ $registration->full_name }}</strong>,</p>
      <p style="margin:0 0 16px; color:#5d5141; line-height:1.6;">
        Pendaftaran Anda untuk <strong style="color:#282061;">Satpam Fun Run 5K</strong> telah berhasil kami terima. Berikut adalah informasi pembayaran Anda:
      </p>

      <div style="background:linear-gradient(135deg, #eedf9d, #d4c48a); border:2px solid #282061; border-radius:12px; padding:24px; margin:24px 0; text-align:center;">
        <p style="margin:0 0 8px; color:#232324; font-size:14px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Kategori</p>
        <p style="margin:0 0 16px; color:#232324; font-size:20px; font-weight:700;">{{ $registration->category }}</p>
        <div style="border-top:2px solid #282061; padding-top:16px; margin-top:16px;">
          <p style="margin:0 0 8px; color:#232324; font-size:14px; font-weight:600; text-transform:uppercase; letter-spacing:0.5px;">Total Pembayaran</p>
          <p style="margin:0; color:#282061; font-size:32px; font-weight:800;">Rp {{ number_format($registration->unique_price_code, 0, ',', '.') }}</p>
          <p style="margin:8px 0 0; color:#665d6c; font-size:12px;">* Harga unik untuk identifikasi pembayaran Anda</p>
        </div>
      </div>

      <div style="background:#fafbff; border:1px solid #e5e9ff; border-radius:10px; padding:20px; margin:24px 0;">
        <p style="margin:0 0 12px; color:#282061; font-weight:700; font-size:16px;">📋 Detail Pendaftaran</p>
        <p style="margin:4px 0; color:#5d5141;"><strong>Nama:</strong> {{ $registration->full_name }}</p>
        <p style="margin:4px 0; color:#5d5141;"><strong>Email:</strong> {{ $registration->email }}</p>
        <p style="margin:4px 0; color:#5d5141;"><strong>Telepon:</strong> {{ $registration->phone }}</p>
        <p style="margin:4px 0; color:#5d5141;"><strong>Tanggal Event:</strong> 4 Januari 2026</p>
      </div>

      <div style="background:#fff3cd; border:1px solid #ffc107; border-radius:10px; padding:20px; margin:24px 0;">
        <p style="margin:0 0 16px; color:#856404; font-weight:700; font-size:16px;">💳 Cara Pembayaran</p>
        
        <!-- QRIS Payment -->
        <div style="margin-bottom:20px; padding:16px; background:#ffffff; border-radius:8px; border:1px solid #ffc107;">
          <p style="margin:0 0 12px; color:#856404; font-weight:600; font-size:14px;">📱 Pembayaran via QRIS</p>
          <div style="text-align:center; margin-bottom:12px;">
            @php
              // Try multiple paths to find QRIS file
              $qrisPath = null;
              $possiblePaths = [
                public_path('assets/SATPAM/qris.jpeg'),
                base_path('assets/SATPAM/qris.jpeg'),
                storage_path('app/public/assets/SATPAM/qris.jpeg'),
              ];
              
              foreach ($possiblePaths as $path) {
                if (file_exists($path)) {
                  $qrisPath = $path;
                  break;
                }
              }
            @endphp
            @if($qrisPath && file_exists($qrisPath))
              <img src="{{ $message->embed($qrisPath) }}" alt="QRIS" style="max-width:250px; width:100%; height:auto; border:2px solid #ffc107; border-radius:8px; padding:8px; background:#ffffff;">
            @else
              <p style="margin:0; color:#856404; font-size:13px;">QRIS akan tersedia segera</p>
            @endif
          </div>
          <p style="margin:0; color:#856404; font-size:13px; line-height:1.6;">Scan QR Code di atas menggunakan aplikasi mobile banking atau e-wallet Anda untuk melakukan pembayaran.</p>
        </div>
        
        <!-- Manual Transfer -->
        <div style="margin-bottom:20px; padding:16px; background:#ffffff; border-radius:8px; border:1px solid #ffc107;">
          <p style="margin:0 0 12px; color:#856404; font-weight:600; font-size:14px;">🏦 Transfer Manual ke Bank BRI</p>
          <div style="background:#f8f9fa; padding:12px; border-radius:6px; margin-bottom:12px;">
            <p style="margin:0 0 8px; color:#856404; font-size:13px;"><strong>Nomor Rekening:</strong></p>
            <p style="margin:0 0 4px; color:#282061; font-size:18px; font-weight:700; letter-spacing:1px;">0192 0100 2100 562</p>
            <p style="margin:8px 0 0; color:#856404; font-size:13px;"><strong>Atas Nama:</strong> <span style="color:#282061; font-weight:600;">SUSI ROSANTI</span></p>
          </div>
          <p style="margin:0; color:#856404; font-size:13px; line-height:1.6;">Transfer sesuai nominal yang tertera di atas (Rp {{ number_format($registration->unique_price_code, 0, ',', '.') }})</p>
        </div>
        
        <!-- Payment Steps -->
        <p style="margin:0 0 12px; color:#856404; font-weight:600; font-size:14px;">📋 Langkah Pembayaran</p>
        <ol style="margin:0; padding-left:20px; color:#856404; line-height:1.8;">
          <li style="margin-bottom:8px;">Pilih metode pembayaran (QRIS atau Transfer Manual)</li>
          <li style="margin-bottom:8px;">Transfer sesuai nominal yang tertera di atas</li>
          <li style="margin-bottom:8px;">Setelah transfer, klik tombol "Hubungi Admin via WhatsApp" di bawah</li>
          <li style="margin-bottom:8px;">Kirim bukti transfer dan konfirmasi pembayaran Anda</li>
          <li>Admin akan memverifikasi dan mengirimkan konfirmasi pendaftaran</li>
        </ol>
      </div>

      <div style="text-align:center; margin:32px 0;">
        <a href="https://wa.me/6282342919490?text=Halo%20Admin%2C%20saya%20{{ urlencode($registration->full_name) }}%20telah%20melakukan%20pendaftaran%20Satpam%20Fun%20Run%205K%20dengan%20kategori%20{{ urlencode($registration->category) }}.%20Total%20pembayaran%20Rp%20{{ number_format($registration->unique_price_code, 0, ',', '.') }}.%20Saya%20ingin%20mengirimkan%20bukti%20transfer." 
           style="display:inline-block; background:#25D366; color:#ffffff; text-decoration:none; padding:16px 32px; border-radius:12px; font-weight:700; font-size:16px; box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);">
          📱 Hubungi Admin via WhatsApp
        </a>
      </div>

      <div style="background:#e8f4f8; border:1px solid #b3d9e6; border-radius:10px; padding:16px; margin:24px 0;">
        <p style="margin:0 0 8px; color:#2c3e50; font-weight:600; font-size:14px;">ℹ️ Informasi Penting</p>
        <p style="margin:4px 0; color:#34495e; font-size:13px; line-height:1.6;">
          • Pastikan Anda mentransfer sesuai dengan nominal yang tertera (Rp {{ number_format($registration->unique_price_code, 0, ',', '.') }})<br>
          • Nominal unik ini digunakan untuk identifikasi pembayaran Anda<br>
          • Setelah pembayaran dikonfirmasi, Anda akan menerima email konfirmasi pendaftaran<br>
          • Informasi pengambilan race pack akan diumumkan kemudian
        </p>
      </div>

      <p style="margin:24px 0 0; color:#5d5141; font-size:14px; line-height:1.6;">
        Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami melalui WhatsApp di atas.
      </p>
      <p style="margin:16px 0 0; color:#5d5141; font-size:14px; line-height:1.6;">
        Terima kasih dan sampai jumpa di <strong style="color:#282061;">Satpam Fun Run 5K</strong>! 🏃‍♂️🏃‍♀️
      </p>

      <div style="margin-top:32px; padding-top:24px; border-top:1px solid #eee; text-align:center;">
        <p style="margin:0; color:#999; font-size:12px;">Satpam Fun Run 5K - 4 Januari 2026</p>
        <p style="margin:8px 0 0; color:#999; font-size:12px;">
          <a href="{{ url('/registration/check') }}?registration_number={{ $registration->id }}" style="color:#282061; text-decoration:none;">Cek Status Pendaftaran</a>
        </p>
      </div>
    </div>
  </body>
</html>
