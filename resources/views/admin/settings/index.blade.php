@extends('layouts.app')

@section('content')
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Pengaturan
                    </div>
                    <h2 class="page-title">
                        Pengaturan Pendaftaran
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon">
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="alert-title">Berhasil!</h4>
                            <div class="text-secondary">{{ session('success') }}</div>
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <div class="row row-cards">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Status Pendaftaran</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.settings.update-registration-status') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Status Pendaftaran</label>
                                    <div class="form-selectgroup form-selectgroup-boxes d-flex flex-column">
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="registration_open" value="1" class="form-selectgroup-input" {{ $registrationOpen ? 'checked' : '' }}>
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                <span class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </span>
                                                <span>
                                                    <strong class="form-selectgroup-label-strong">Pendaftaran Dibuka</strong>
                                                    <span class="d-block text-muted">User dapat mengakses halaman pendaftaran dan melakukan registrasi</span>
                                                </span>
                                            </span>
                                        </label>
                                        <label class="form-selectgroup-item">
                                            <input type="radio" name="registration_open" value="0" class="form-selectgroup-input" {{ !$registrationOpen ? 'checked' : '' }}>
                                            <span class="form-selectgroup-label d-flex align-items-center p-3">
                                                <span class="me-3">
                                                    <span class="form-selectgroup-check"></span>
                                                </span>
                                                <span>
                                                    <strong class="form-selectgroup-label-strong">Pendaftaran Ditutup</strong>
                                                    <span class="d-block text-muted">User akan melihat halaman "Pendaftaran Ditutup" saat mengakses formulir</span>
                                                </span>
                                            </span>
                                        </label>
                                    </div>
                                </div>

                                <div class="form-footer">
                                    <button type="submit" class="btn btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                            <path d="M5 12l5 5l10 -10" />
                                        </svg>
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi</h3>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-info">
                                <div class="alert-title">Catatan Penting</div>
                                <div class="text-secondary">
                                    <ul class="mb-0">
                                        <li>Ketika pendaftaran ditutup, user yang mencoba mengakses halaman pendaftaran akan langsung diarahkan ke halaman "Pendaftaran Ditutup"</li>
                                        <li>User yang sudah mendaftar sebelumnya tetap dapat mengecek status pendaftaran mereka</li>
                                        <li>Perubahan status akan langsung berlaku setelah Anda menyimpan</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Status Saat Ini</h3>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Status Pendaftaran</label>
                                <div>
                                    @if($registrationOpen)
                                        <span class="badge bg-success text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <polyline points="12 6 12 12 16 14"></polyline>
                                            </svg>
                                            Dibuka
                                        </span>
                                    @else
                                        <span class="badge bg-danger text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                                <circle cx="12" cy="12" r="10"></circle>
                                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                                            </svg>
                                            Ditutup
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Link Pendaftaran</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" value="{{ url('/event/register') }}" readonly>
                                    <button class="btn btn-outline-primary" type="button" onclick="copyToClipboard('{{ url('/event/register') }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                            <rect width="14" height="14" x="8" y="8" rx="2" ry="2"></rect>
                                            <path d="M4 16c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h8c1.1 0 2 .9 2 2"></path>
                                        </svg>
                                        Copy
                                    </button>
                                </div>
                            </div>

                            <div class="d-grid">
                                <a href="{{ url('/event/register') }}" target="_blank" class="btn btn-outline-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-2">
                                        <path d="M18 13v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6" />
                                        <path d="M15 3h6v6" />
                                        <path d="M10 14l11 -11" />
                                        <path d="M15 3l6 6l-6 -6" />
                                    </svg>
                                    Preview Halaman Pendaftaran
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('Link berhasil di-copy!');
            }, function() {
                alert('Gagal copy link');
            });
        }
    </script>
@endsection

