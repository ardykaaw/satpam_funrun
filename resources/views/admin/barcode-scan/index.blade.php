@extends('layouts.app')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row g-2 align-items-center">
            <div class="col">
                <h2 class="page-title">Scan Barcode</h2>
                <div class="text-muted mt-1">Scan QR code atau masukkan nomor pendaftaran untuk konfirmasi pengambilan race pack</div>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <!-- Toast Container -->
        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1060;">
            <div id="toastSuccess" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-success text-white">
                    <strong class="me-auto">Berhasil</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body" id="toastSuccessBody"></div>
            </div>
            <div id="toastError" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header bg-danger text-white">
                    <strong class="me-auto">Error</strong>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
                </div>
                <div class="toast-body" id="toastErrorBody"></div>
            </div>
        </div>

        <div class="row">
            <!-- Scanner Section -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Scanner QR Code</h3>
                    </div>
                    <div class="card-body">
                        <!-- Manual Input -->
                        <div class="mb-4">
                            <label class="form-label">Atau masukkan nomor pendaftaran secara manual</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="manualInput" placeholder="Contoh: SFR5001" maxlength="20">
                                <button class="btn btn-primary" type="button" id="btnLookup">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px;">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="m21 21-4.3-4.3"></path>
                                    </svg>
                                    Cari
                                </button>
                            </div>
                        </div>

                        <!-- Camera Scanner -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <label class="form-label mb-0">Scan QR Code dengan Kamera</label>
                                <div class="btn-group">
                                    <button class="btn btn-sm btn-outline-primary" id="btnStartScanner" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px; height: 16px;">
                                            <path d="M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z"></path>
                                            <circle cx="12" cy="13" r="3"></circle>
                                        </svg>
                                        Mulai Scan
                                    </button>
                                    <button class="btn btn-sm btn-outline-danger d-none" id="btnStopScanner" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px; height: 16px;">
                                            <rect x="6" y="6" width="12" height="12"></rect>
                                        </svg>
                                        Stop
                                    </button>
                                    <button class="btn btn-sm btn-outline-secondary d-none" id="btnFlipCamera" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 16px; height: 16px;">
                                            <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                            <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                            <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                        </svg>
                                        Flip
                                    </button>
                                </div>
                            </div>
                            <div id="reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
                            <div id="scannerError" class="alert alert-danger d-none mt-3"></div>
                        </div>

                        <!-- Registration Details -->
                        <div id="registrationDetails" class="d-none">
                            <div class="card bg-light">
                                <div class="card-body">
                                    <h4 class="card-title mb-3">Detail Pendaftaran</h4>
                                    <div class="row mb-2">
                                        <div class="col-4"><strong>Nomor:</strong></div>
                                        <div class="col-8" id="detailRegistrationNumber">-</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4"><strong>Nama:</strong></div>
                                        <div class="col-8" id="detailFullName">-</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4"><strong>Kategori:</strong></div>
                                        <div class="col-8" id="detailCategory">-</div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-4"><strong>Email:</strong></div>
                                        <div class="col-8" id="detailEmail">-</div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-4"><strong>Status:</strong></div>
                                        <div class="col-8">
                                            <span id="detailPickupStatus" class="badge">-</span>
                                        </div>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-success btn-lg" id="btnConfirmPickup" type="button" disabled>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; margin-right: 8px;">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg>
                                            Konfirmasi Race Pack Diambil
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Pickups -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Pengambilan Terakhir</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-vcenter">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor</th>
                                        <th>Nama</th>
                                        <th>Waktu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pickedUpRegistrations as $index => $reg)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td><code>{{ $reg->registration_number }}</code></td>
                                        <td>{{ $reg->full_name }}</td>
                                        <td>
                                            <small>{{ $reg->race_pack_picked_up_at ? $reg->race_pack_picked_up_at->format('d/m H:i') : '-' }}</small>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-light">Belum ada pengambilan</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Confirmation Modal -->
<div class="modal modal-blur fade" id="confirmPickupModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 24px; height: 24px; color: #28a745; margin-right: 8px;">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Konfirmasi Pengambilan Race Pack
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin mengonfirmasi bahwa race pack telah diambil oleh peserta berikut?</p>
                <div class="alert alert-info">
                    <strong>Penting:</strong> Setelah dikonfirmasi, status ini tidak dapat diubah.
                </div>
                <div class="card bg-light">
                    <div class="card-body">
                        <p class="mb-1"><strong>Nomor Pendaftaran:</strong> <span id="modalRegistrationNumber">-</span></p>
                        <p class="mb-0"><strong>Nama:</strong> <span id="modalFullName">-</span></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="btnConfirmModal">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px; margin-right: 6px;">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                    Konfirmasi
                </button>
            </div>
        </div>
    </div>
</div>

<!-- HTML5 QR Code Scanner Library -->
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

<script>
let html5QrCode = null;
let currentFacingMode = 'environment'; // 'environment' = back camera, 'user' = front camera
let currentRegistrationId = null;

// Toast functions
function showToast(type, message) {
    const toastElement = type === 'success' ? document.getElementById('toastSuccess') : document.getElementById('toastError');
    const toastBody = type === 'success' ? document.getElementById('toastSuccessBody') : document.getElementById('toastErrorBody');
    
    toastBody.textContent = message;
    const toast = new bootstrap.Toast(toastElement);
    toast.show();
}

// Manual input lookup
document.getElementById('btnLookup').addEventListener('click', function() {
    const code = document.getElementById('manualInput').value.trim();
    if (!code) {
        showToast('error', 'Masukkan nomor pendaftaran');
        return;
    }
    lookupRegistration(code);
});

document.getElementById('manualInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('btnLookup').click();
    }
});

// Start scanner
document.getElementById('btnStartScanner').addEventListener('click', function() {
    startScanner();
});

// Stop scanner
document.getElementById('btnStopScanner').addEventListener('click', function() {
    stopScanner();
});

// Flip camera
document.getElementById('btnFlipCamera').addEventListener('click', function() {
    currentFacingMode = currentFacingMode === 'environment' ? 'user' : 'environment';
    stopScanner();
    setTimeout(() => startScanner(), 500);
});

// Confirm pickup button
document.getElementById('btnConfirmPickup').addEventListener('click', function() {
    if (currentRegistrationId) {
        const modal = new bootstrap.Modal(document.getElementById('confirmPickupModal'));
        modal.show();
    }
});

// Modal confirm button
document.getElementById('btnConfirmModal').addEventListener('click', function() {
    if (currentRegistrationId) {
        confirmPickup(currentRegistrationId);
    }
});

// Lookup registration
function lookupRegistration(code) {
    fetch('{{ route("admin.barcode-scan.lookup") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ code: code })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displayRegistrationDetails(data.registration);
        } else {
            showToast('error', data.message || 'Pendaftaran tidak ditemukan');
            hideRegistrationDetails();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Terjadi kesalahan saat mencari pendaftaran');
        hideRegistrationDetails();
    });
}

// Display registration details
function displayRegistrationDetails(registration) {
    document.getElementById('detailRegistrationNumber').textContent = registration.registration_number;
    document.getElementById('detailFullName').textContent = registration.full_name;
    document.getElementById('detailCategory').textContent = registration.category;
    document.getElementById('detailEmail').textContent = registration.email;
    
    const statusBadge = document.getElementById('detailPickupStatus');
    if (registration.race_pack_picked_up) {
        statusBadge.textContent = 'Sudah Diambil';
        statusBadge.className = 'badge bg-success text-light';
        document.getElementById('btnConfirmPickup').disabled = true;
        document.getElementById('btnConfirmPickup').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; margin-right: 8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>Sudah Diambil';
    } else {
        statusBadge.textContent = 'Belum Diambil';
        statusBadge.className = 'badge bg-warning text-light';
        document.getElementById('btnConfirmPickup').disabled = false;
        document.getElementById('btnConfirmPickup').innerHTML = '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="width: 20px; height: 20px; margin-right: 8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>Konfirmasi Race Pack Diambil';
    }
    
    // Update modal
    document.getElementById('modalRegistrationNumber').textContent = registration.registration_number;
    document.getElementById('modalFullName').textContent = registration.full_name;
    
    currentRegistrationId = registration.id;
    document.getElementById('registrationDetails').classList.remove('d-none');
}

// Hide registration details
function hideRegistrationDetails() {
    document.getElementById('registrationDetails').classList.add('d-none');
    currentRegistrationId = null;
}

// Confirm pickup
function confirmPickup(id) {
    fetch(`{{ url('/admin/barcode-scan') }}/${id}/confirm-pickup`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast('success', data.message || 'Race pack berhasil dikonfirmasi diambil');
            const modal = bootstrap.Modal.getInstance(document.getElementById('confirmPickupModal'));
            modal.hide();
            hideRegistrationDetails();
            document.getElementById('manualInput').value = '';
            // Reload page after 1 second to update the list
            setTimeout(() => location.reload(), 1000);
        } else {
            showToast('error', data.message || 'Gagal mengonfirmasi pengambilan');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('error', 'Terjadi kesalahan saat mengonfirmasi');
    });
}

// Start scanner
function startScanner() {
    const readerElement = document.getElementById('reader');
    readerElement.innerHTML = '';
    
    html5QrCode = new Html5Qrcode("reader");
    
    html5QrCode.start(
        { facingMode: currentFacingMode },
        {
            fps: 10,
            qrbox: { width: 250, height: 250 }
        },
        (decodedText, decodedResult) => {
            // Successfully scanned
            stopScanner();
            lookupRegistration(decodedText);
        },
        (errorMessage) => {
            // Ignore errors, scanner will keep trying
        }
    )
    .then(() => {
        document.getElementById('btnStartScanner').classList.add('d-none');
        document.getElementById('btnStopScanner').classList.remove('d-none');
        document.getElementById('btnFlipCamera').classList.remove('d-none');
        document.getElementById('scannerError').classList.add('d-none');
    })
    .catch((err) => {
        console.error('Error starting scanner:', err);
        document.getElementById('scannerError').textContent = 'Tidak dapat mengakses kamera: ' + err;
        document.getElementById('scannerError').classList.remove('d-none');
        showToast('error', 'Tidak dapat mengakses kamera. Pastikan izin kamera telah diberikan.');
    });
}

// Stop scanner
function stopScanner() {
    if (html5QrCode) {
        html5QrCode.stop().then(() => {
            html5QrCode.clear();
            html5QrCode = null;
            document.getElementById('btnStartScanner').classList.remove('d-none');
            document.getElementById('btnStopScanner').classList.add('d-none');
            document.getElementById('btnFlipCamera').classList.add('d-none');
        }).catch((err) => {
            console.error('Error stopping scanner:', err);
        });
    }
}

// Cleanup on page unload
window.addEventListener('beforeunload', function() {
    stopScanner();
});
</script>

<style>
#reader {
    border: 2px solid #282061;
    border-radius: 8px;
    overflow: hidden;
}

#reader video {
    width: 100%;
    height: auto;
}

.navbar-toggler {
    z-index: 1060;
    pointer-events: auto;
}

@media (max-width: 768px) {
    #reader {
        max-width: 100%;
    }
}
</style>
@endsection

