# Changelog: Fitur Export Excel untuk Participants

## Ringkasan
Menambahkan fitur export Excel untuk daftar peserta terkonfirmasi dengan styling yang sesuai tema project.

---

## 1. DEPENDENCIES (Composer)

### Package Baru yang Ditambahkan:
```json
"maatwebsite/excel": "^3.1"
```

### Perintah Install:
```bash
composer require maatwebsite/excel
```

**File yang berubah:**
- `composer.json` - Menambahkan dependency
- `composer.lock` - Auto-generated setelah install

---

## 2. FILE BARU YANG DIBUAT

### `app/Exports/ParticipantsExport.php`
**Lokasi:** `app/Exports/ParticipantsExport.php` (folder baru)

**Fungsi:** Class untuk menangani export data participants ke Excel

**Fitur:**
- Export data peserta dengan status 'approved'
- Support filter berdasarkan keyword pencarian
- Styling Excel dengan tema project (warna primary #7C6BFF)
- Header dengan judul "SATPAM FUN RUN 5K"
- Alternating row colors untuk readability
- Auto-width columns
- Footer dengan info tanggal cetak dan filter

**Kolom yang di-export:**
1. No. Pendaftaran
2. Nama Lengkap
3. Nama di Bib
4. Email
5. Telepon
6. Tanggal Lahir
7. Jenis Kelamin
8. Kategori
9. Ukuran Jersey
10. Golongan Darah
11. Alamat
12. Kota
13. Tanggal Disetujui

---

## 3. FILE YANG DIMODIFIKASI

### A. `app/Http/Controllers/Admin/ParticipantController.php`

**Perubahan:**

1. **Import baru:**
```php
use App\Exports\ParticipantsExport;
use Maatwebsite\Excel\Facades\Excel;
```

2. **Method baru `export()`:**
```php
public function export(Request $request)
{
    $searchKeyword = $request->input('search', '');
    $filename = 'peserta-terkonfirmasi-' . date('Y-m-d-His') . '.xlsx';
    
    return Excel::download(new ParticipantsExport($searchKeyword), $filename);
}
```

**Lokasi:** Tambahkan method ini setelah method `show()`

---

### B. `routes/web.php`

**Perubahan:**

Menambahkan route export sebelum route `show` (penting untuk menghindari konflik):

```php
// Admin Participant routes (only approved registrations)
Route::prefix('admin/participants')->name('admin.participants.')->group(function () {
    Route::get('/', [ParticipantController::class, 'index'])->name('index');
    Route::get('/export', [ParticipantController::class, 'export'])->name('export'); // BARU
    Route::get('/{id}', [ParticipantController::class, 'show'])->name('show');
});
```

**Catatan:** Route `/export` harus ditempatkan SEBELUM route `/{id}` untuk menghindari konflik routing.

---

### C. `resources/views/admin/participants/index.blade.php`

**Perubahan:**

Menambahkan tombol "Export Excel" di header halaman (baris 21-32):

```blade
<div class="col-auto ms-auto d-print-none">
    <div class="btn-list">
        <a href="{{ route('admin.participants.export', request()->query()) }}" class="btn btn-success">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon me-2">
                <path d="M21 15v4a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-4" />
                <polyline points="7 10 12 15 17 10" />
                <line x1="12" y1="15" x2="12" y2="3" />
            </svg>
            Export Excel
        </a>
        <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-primary">
            <!-- ... existing code ... -->
        </a>
    </div>
</div>
```

**Lokasi:** Di dalam `<div class="col-auto ms-auto d-print-none">`, sebelum tombol "Lihat Pendaftaran"

**Fitur:**
- Tombol hijau (btn-success) dengan icon download
- Meneruskan query parameters (termasuk search) ke route export
- Menggunakan `request()->query()` untuk mempertahankan filter pencarian

---

## 4. STRUKTUR FOLDER BARU

```
app/
└── Exports/              # Folder baru
    └── ParticipantsExport.php
```

---

## 5. FITUR YANG DITAMBAHKAN

### A. Export Excel dengan Filter
- Export mengikuti filter pencarian yang aktif di halaman
- Jika ada keyword pencarian, hanya data yang sesuai yang di-export

### B. Styling Excel
- **Header:** Background ungu (#7C6BFF), teks putih, bold
- **Judul:** "SATPAM FUN RUN 5K" (size 18, warna ungu navy)
- **Subjudul:** "DAFTAR PESERTA TERKONFIRMASI" (size 14, warna abu-abu)
- **Data rows:** Alternating colors (baris genap abu-abu terang)
- **Borders:** Border tipis di semua sel
- **Column widths:** Auto-adjusted untuk readability

### C. Footer Info
- Tanggal dan waktu cetak
- Info filter pencarian (jika ada)

### D. Nama File
- Format: `peserta-terkonfirmasi-YYYY-MM-DD-HHMMSS.xlsx`
- Contoh: `peserta-terkonfirmasi-2025-01-15-143022.xlsx`

---

## 6. LANGKAH DEPLOY KE PRODUKSI

### Step 1: Install Dependencies
```bash
composer require maatwebsite/excel
```

### Step 2: Buat Folder Exports
```bash
mkdir -p app/Exports
```

### Step 3: Copy File Baru
- Copy `app/Exports/ParticipantsExport.php` ke server

### Step 4: Update File yang Dimodifikasi
- Update `app/Http/Controllers/Admin/ParticipantController.php`
- Update `routes/web.php`
- Update `resources/views/admin/participants/index.blade.php`

### Step 5: Clear Cache (jika perlu)
```bash
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
```

### Step 6: Test
1. Buka halaman `/admin/participants`
2. Klik tombol "Export Excel"
3. Verifikasi file Excel terdownload dengan format yang benar

---

## 7. TESTING CHECKLIST

- [ ] Tombol "Export Excel" muncul di halaman participants
- [ ] Klik tombol export berhasil download file Excel
- [ ] File Excel memiliki header dengan judul yang benar
- [ ] Data peserta ter-export dengan lengkap
- [ ] Filter pencarian bekerja saat export (jika ada keyword)
- [ ] Styling Excel sesuai tema (warna ungu #7C6BFF)
- [ ] Alternating row colors bekerja
- [ ] Footer menampilkan tanggal cetak
- [ ] Nama file sesuai format yang ditentukan

---

## 8. CATATAN PENTING

1. **Route Order:** Route `/export` HARUS ditempatkan sebelum route `/{id}` untuk menghindari konflik
2. **Dependencies:** Pastikan `maatwebsite/excel` terinstall dengan benar
3. **Permissions:** Pastikan folder `app/Exports` memiliki permission yang benar
4. **Memory:** Export banyak data mungkin memerlukan peningkatan memory limit PHP
5. **Filter:** Export mengikuti filter pencarian yang aktif, termasuk parameter `search`

---

## 9. TROUBLESHOOTING

### Error: Class 'App\Exports\ParticipantsExport' not found
**Solusi:** Pastikan folder `app/Exports` ada dan file `ParticipantsExport.php` sudah di-copy

### Error: Route conflict dengan /{id}
**Solusi:** Pastikan route `/export` ditempatkan sebelum route `/{id}`

### Error: Memory limit exceeded
**Solusi:** Tambahkan di `php.ini` atau `.htaccess`:
```ini
memory_limit = 256M
```

### Excel tidak terdownload
**Solusi:** 
- Cek permission folder
- Cek error log Laravel
- Pastikan extension PHP yang diperlukan terinstall (zip, xml, gd)

---

## 10. VERSI & TANGGAL

- **Versi:** 1.0.0
- **Tanggal:** 2025-01-15
- **Fitur:** Export Excel untuk Participants dengan styling tema project

---

## 11. FILES SUMMARY

### Files Created (1):
- `app/Exports/ParticipantsExport.php`

### Files Modified (3):
- `app/Http/Controllers/Admin/ParticipantController.php`
- `routes/web.php`
- `resources/views/admin/participants/index.blade.php`

### Dependencies Added (1):
- `maatwebsite/excel: ^3.1`

---

**Selesai!** Semua perubahan telah didokumentasikan.

