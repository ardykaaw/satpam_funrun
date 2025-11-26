@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Manajemen
                    </div>
                    <h2 class="page-title">
                        Detail Pendaftaran
                    </h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                            <path d="M5 12l14 0" />
                            <path d="M5 12l6 6" />
                            <path d="M5 12l6 -6" />
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-cards">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Pendaftar</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <div class="form-control-plaintext">{{ $registration->full_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="form-control-plaintext">{{ $registration->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon</label>
                                        <div class="form-control-plaintext">{{ $registration->phone }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama di BIB</label>
                                        <div class="form-control-plaintext">{{ $registration->bib_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="form-control-plaintext">{{ $registration->birth_date->format('d F Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="form-control-plaintext">{{ $registration->gender }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pekerjaan</label>
                                        <div class="form-control-plaintext">{{ $registration->occupation }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <div class="form-control-plaintext">
                                            <span class="badge bg-primary text-white">{{ $registration->category }}</span>
                                            @if($registration->category_type)
                                                <span class="badge bg-info text-white ms-2">
                                                    {{ $registration->category_type === 'satpam' ? 'Korps Satpam' : 'Umum' }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @if($registration->unique_price_code)
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Harga Unik</label>
                                        <div class="form-control-plaintext">
                                            <strong class="text-primary">Rp {{ number_format($registration->unique_price_code, 0, ',', '.') }}</strong>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <hr>

                            <h4 class="mb-3">Identitas</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kartu Identitas</label>
                                        <div class="form-control-plaintext">{{ $registration->id_type }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Kartu Identitas</label>
                                        <div class="form-control-plaintext">{{ $registration->id_number }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4 class="mb-3">Alamat</h4>
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <div class="form-control-plaintext">{{ $registration->address }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <div class="form-control-plaintext">{{ $registration->city }}</div>
                            </div>

                            <hr>

                            <h4 class="mb-3">Informasi Event</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Ukuran Jersey</label>
                                        <div class="form-control-plaintext">
                                            <span class="badge bg-info text-white">{{ $registration->jersey_size }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Golongan Darah</label>
                                        <div class="form-control-plaintext">{{ $registration->blood_type }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4 class="mb-3">Kontak Darurat</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kontak Darurat</label>
                                        <div class="form-control-plaintext">{{ $registration->emergency_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon Kontak Darurat</label>
                                        <div class="form-control-plaintext">{{ $registration->emergency_phone }}</div>
                                    </div>
                                </div>
                            </div>

                            @if($registration->community)
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Komunitas</label>
                                    <div class="form-control-plaintext">{{ $registration->community }}</div>
                                </div>
                            @endif

                            @if($registration->medical_notes)
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Catatan Medis</label>
                                    <div class="form-control-plaintext">{{ $registration->medical_notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($registration->payment_proof_path)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    @if($registration->category_type === 'satpam')
                                        Kartu Tanda Satpam
                                    @else
                                        Bukti Pembayaran
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body">
                                @php
                                    // Handle path - store() returns path without 'storage/' prefix
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
                                     alt="{{ $registration->category_type === 'satpam' ? 'Kartu Tanda Satpam' : 'Bukti Pembayaran' }}" 
                                     class="img-fluid rounded" 
                                     style="max-height: 500px; width: auto; display: block; margin: 0 auto; cursor: pointer;"
                                     onclick="window.open('{{ asset($imagePath) }}', '_blank')"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                <p style="display: none; color: #dc3545; margin-top: 12px; text-align: center;">
                                    <strong>Gambar tidak dapat ditampilkan.</strong><br>
                                    <small>Path: {{ $imagePath }}</small>
                                </p>
                                @else
                                <p class="text-muted">File tidak ditemukan.</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Status & Aksi</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Status Pendaftaran</label>
                                <div>
                                    @if($registration->status === 'approved')
                                        <span class="badge bg-success text-white">Disetujui</span>
                                    @elseif($registration->status === 'rejected')
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-white">Menunggu</span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Pembayaran</label>
                                <div>
                                    @if($registration->payment_status === 'verified')
                                        <span class="badge bg-success text-white">Terkonfirmasi</span>
                                    @elseif($registration->payment_status === 'rejected')
                                        <span class="badge bg-danger text-white">Ditolak</span>
                                    @else
                                        <span class="badge bg-warning text-white">Pending</span>
                                    @endif
                                </div>
                            </div>

                            @if($registration->registration_number)
                                <div class="mb-3">
                                    <label class="form-label">Nomor Pendaftaran</label>
                                    <div class="form-control-plaintext">
                                        <strong class="text-primary">{{ $registration->registration_number }}</strong>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pendaftaran</label>
                                <div class="form-control-plaintext">{{ $registration->created_at->format('d F Y H:i') }}</div>
                            </div>

                            @if($registration->admin_notes)
                                <div class="mb-3">
                                    <label class="form-label">Catatan Admin</label>
                                    <div class="form-control-plaintext">{{ $registration->admin_notes }}</div>
                                </div>
                            @endif

                            <hr>

                            @if($registration->status === 'pending')
                                <form action="{{ route('admin.registrations.approve', $registration->id) }}" method="POST" class="mb-3">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Catatan (Opsional)</label>
                                        <textarea name="admin_notes" class="form-control" rows="3" placeholder="Catatan untuk pendaftar..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                        Setujui Pendaftaran
                                    </button>
                                </form>

                                <form action="{{ route('admin.registrations.reject', $registration->id) }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Alasan Penolakan <span class="text-danger">*</span></label>
                                        <textarea name="admin_notes" class="form-control" rows="3" required placeholder="Alasan penolakan..."></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-danger w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path d="M18 6l-12 12" />
                                            <path d="M6 6l12 12" />
                                        </svg>
                                        Tolak Pendaftaran
                                    </button>
                                </form>
                            @else
                                <div class="alert alert-info">
                                    Pendaftaran ini sudah diproses.
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

