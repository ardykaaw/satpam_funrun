@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Peserta
                    </div>
                    <h2 class="page-title">
                        Detail Peserta
                    </h2>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.participants.index') }}" class="btn btn-outline-primary">
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
                            <h3 class="card-title">Informasi Peserta</h3>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <div class="form-control-plaintext">{{ $participant->full_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <div class="form-control-plaintext">{{ $participant->email }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon</label>
                                        <div class="form-control-plaintext">{{ $participant->phone }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama di BIB</label>
                                        <div class="form-control-plaintext">{{ $participant->bib_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Lahir</label>
                                        <div class="form-control-plaintext">{{ $participant->birth_date->format('d F Y') }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kelamin</label>
                                        <div class="form-control-plaintext">{{ $participant->gender }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Pekerjaan</label>
                                        <div class="form-control-plaintext">{{ $participant->occupation }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Kategori</label>
                                        <div class="form-control-plaintext">
                                            <span class="badge bg-primary text-white">{{ $participant->category }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4 class="mb-3">Identitas</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Kartu Identitas</label>
                                        <div class="form-control-plaintext">{{ $participant->id_type }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Kartu Identitas</label>
                                        <div class="form-control-plaintext">{{ $participant->id_number }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4 class="mb-3">Alamat</h4>
                            <div class="mb-3">
                                <label class="form-label">Alamat Lengkap</label>
                                <div class="form-control-plaintext">{{ $participant->address }}</div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kota</label>
                                <div class="form-control-plaintext">{{ $participant->city }}</div>
                            </div>

                            <hr>

                            <h4 class="mb-3">Informasi Event</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Ukuran Jersey</label>
                                        <div class="form-control-plaintext">
                                            <span class="badge bg-info text-white">{{ $participant->jersey_size }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Golongan Darah</label>
                                        <div class="form-control-plaintext">{{ $participant->blood_type }}</div>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h4 class="mb-3">Kontak Darurat</h4>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Kontak Darurat</label>
                                        <div class="form-control-plaintext">{{ $participant->emergency_name }}</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nomor Telepon Kontak Darurat</label>
                                        <div class="form-control-plaintext">{{ $participant->emergency_phone }}</div>
                                    </div>
                                </div>
                            </div>

                            @if($participant->community)
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Komunitas</label>
                                    <div class="form-control-plaintext">{{ $participant->community }}</div>
                                </div>
                            @endif

                            @if($participant->medical_notes)
                                <hr>
                                <div class="mb-3">
                                    <label class="form-label">Catatan Medis</label>
                                    <div class="form-control-plaintext">{{ $participant->medical_notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>

                    @if($participant->payment_proof_path)
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bukti Pembayaran</h3>
                            </div>
                            <div class="card-body">
                                <img src="{{ Storage::url($participant->payment_proof_path) }}" alt="Bukti Pembayaran" class="img-fluid rounded" style="max-height: 500px;">
                            </div>
                        </div>
                    @endif
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Status & Informasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Status Pendaftaran</label>
                                <div>
                                    <span class="badge bg-success text-white">Disetujui</span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Status Pembayaran</label>
                                <div>
                                    <span class="badge bg-success text-white">Terkonfirmasi</span>
                                </div>
                            </div>

                            @if($participant->registration_number)
                                <div class="mb-3">
                                    <label class="form-label">Nomor Pendaftaran</label>
                                    <div class="form-control-plaintext">
                                        <strong class="text-primary">{{ $participant->registration_number }}</strong>
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label class="form-label">Tanggal Pendaftaran</label>
                                <div class="form-control-plaintext">{{ $participant->created_at->format('d F Y H:i') }}</div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Tanggal Disetujui</label>
                                <div class="form-control-plaintext">{{ $participant->approved_at ? $participant->approved_at->format('d F Y H:i') : '-' }}</div>
                            </div>

                            @if($participant->admin_notes)
                                <div class="mb-3">
                                    <label class="form-label">Catatan Admin</label>
                                    <div class="form-control-plaintext">{{ $participant->admin_notes }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

