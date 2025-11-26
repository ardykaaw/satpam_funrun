@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Dashboard
                    </div>
                    <h2 class="page-title">
                        Satpam Fun Run 5K
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="/" class="btn btn-outline-primary d-none d-sm-inline-block" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="icon">
                                <path d="M18 13v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6" />
                                <path d="M15 3h6v6" />
                                <path d="M10 14l11 -11" />
                                <path d="M15 3l6 6l-6 -6" />
                            </svg>
                            Lihat Website
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <!-- Welcoming Card -->
            <div class="row row-cards mb-3">
                <div class="col-12">
                    <div class="card" style="background: linear-gradient(135deg, #282061 0%, #665d6c 100%); border: none;">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <div style="background: rgba(238,223,157,0.15); padding: 12px; border-radius: 12px; display: inline-block;">
                                                <img src="{{ url('/assets/SATPAM/Logo.png') }}" 
                                                 alt="Logo" 
                                                     style="max-height: 80px; width: auto; display: block;">
                                            </div>
                                        </div>
                                        <div class="text-white">
                                            <h2 class="mb-1 text-white">Selamat Datang, {{ Auth::check() ? Auth::user()->name : 'Admin' }}!</h2>
                                            <p class="text-white-50 mb-0">Kelola seluruh data Satpam Fun Run 5K langsung dari dashboard ini.</p>
                                            <div class="mt-2">
                                                <span class="badge bg-white text-primary text-uppercase" style="color:#282061 !important;">14 Desember 2025</span>
                                                <span class="badge bg-white text-primary ms-2 text-uppercase" style="color:#282061 !important;">Kategori: Satpam & Umum</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row row-cards mb-3">
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Pendaftaran</div>
                            </div>
                            <div class="h1 mb-3">{{ number_format($totalRegistrations ?? 0) }}</div>
                            <div class="d-flex mb-2">
                                <div>Status: <strong>{{ ($totalRegistrations ?? 0) > 0 ? 'Aktif' : 'Belum Ada' }}</strong></div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar" style="width: {{ ($totalRegistrations ?? 0) > 0 ? '100' : '0' }}%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pembayaran Terkonfirmasi</div>
                            </div>
                            <div class="h1 mb-3">{{ number_format($verifiedPayments ?? 0) }}</div>
                            <div class="d-flex mb-2">
                                <div>Status: <strong class="text-success">Konfirmasi</strong></div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-success" style="width: {{ ($totalRegistrations ?? 0) > 0 ? (($verifiedPayments ?? 0) / ($totalRegistrations ?? 1)) * 100 : 0 }}%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pembayaran Pending</div>
                            </div>
                            <div class="h1 mb-3">{{ number_format($pendingPayments ?? 0) }}</div>
                            <div class="d-flex mb-2">
                                <div>Status: <strong class="text-warning">Menunggu</strong></div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-warning" style="width: {{ ($totalRegistrations ?? 0) > 0 ? (($pendingPayments ?? 0) / ($totalRegistrations ?? 1)) * 100 : 0 }}%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Total Pendapatan</div>
                            </div>
                            <div class="h1 mb-3">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                            <div class="d-flex mb-2">
                                <div>Dari <strong>{{ $verifiedPayments ?? 0 }}</strong> pembayaran</div>
                            </div>
                            <div class="progress progress-sm">
                                <div class="progress-bar bg-primary" style="width: {{ ($totalRegistrations ?? 0) > 0 ? (($verifiedPayments ?? 0) / ($totalRegistrations ?? 1)) * 100 : 0 }}%" role="progressbar"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Statistics -->
            <div class="row row-cards mb-3">
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Peserta Terverifikasi</div>
                            </div>
                            <div class="h1 mb-3">{{ number_format($approvedRegistrations ?? 0) }}</div>
                            <div class="d-flex align-items-baseline">
                                <div class="text-muted">Peserta yang sudah diverifikasi</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pendaftaran Pending</div>
                            </div>
                            <div class="h1 mb-3">{{ number_format($pendingRegistrations ?? 0) }}</div>
                            <div class="d-flex align-items-baseline">
                                <div class="text-muted">Pendaftaran yang menunggu persetujuan</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="subheader">Pendaftaran Hari Ini</div>
                            </div>
                            <div class="h1 mb-3">{{ number_format($todayRegistrations ?? 0) }}</div>
                            <div class="d-flex align-items-baseline">
                                <div class="text-muted">Pendaftaran baru hari ini</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="row row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Aksi Cepat</h3>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-outline-primary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon me-2">
                                            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                        </svg>
                                        Lihat Pendaftaran
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('admin.participants.index') }}" class="btn btn-outline-success w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon me-2">
                                            <path d="M16 21v-2a4 4 0 0 0 -4 -4h-4a4 4 0 0 0 -4 4v2" />
                                            <path d="M13 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                            <path d="M5 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                            <path d="M9 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        </svg>
                                        Lihat Peserta
                                    </a>
                                </div>
                                <div class="col-md-4">
                                    <a href="/" target="_blank" class="btn btn-outline-secondary w-100">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                            class="icon me-2">
                                            <path d="M18 13v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6" />
                                            <path d="M15 3h6v6" />
                                            <path d="M10 14l11 -11" />
                                            <path d="M15 3l6 6l-6 -6" />
                                        </svg>
                                        Lihat Website
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection