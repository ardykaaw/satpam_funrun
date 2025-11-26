@extends('layouts.app')

@section('content')
    @php
        $searchKeyword = $searchKeyword ?? request('search', '');
        $currentPerPage = $currentPerPage ?? (int) request('per_page', 20);
        $perPageOptions = $perPageOptions ?? [10, 20, 50, 100];
    @endphp
    <!-- Page header -->
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Manajemen
                    </div>
                    <h2 class="page-title">
                        Data Pendaftaran
                    </h2>
                </div>
            </div>
        </div>
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            @if(session('success'))
                <div class="alert alert-{{ session('whatsapp_sent') ? 'success' : 'info' }} alert-dismissible" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="alert-title">Berhasil!</h4>
                            <div class="text-secondary">{{ session('success') }}</div>
                            @if(session('whatsapp_url') && !session('whatsapp_sent'))
                                <div class="mt-2">
                                    <p class="text-muted small mb-2">
                                        <strong>Nomor Pengirim:</strong> {{ env('WHATSAPP_SENDER_NUMBER', '085851295471') }}
                                    </p>
                                    <a href="{{ session('whatsapp_url') }}" target="_blank" class="btn btn-sm btn-primary">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon me-1">
                                            <path d="M3 10l18 0" />
                                            <path d="M5 6l14 0a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-8a2 2 0 0 1 2 -2z" />
                                        </svg>
                                        Kirim via WhatsApp (Manual)
                                    </a>
                                    <p class="text-muted small mt-2 mb-0">
                                        <em>Untuk mengirim otomatis, setup ChatAPI/Wabox dengan nomor di atas</em>
                                    </p>
                                </div>
                            @endif
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif

            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title mb-1">Daftar Pendaftaran</h3>
                        <p class="text-muted mb-0 small">
                            Total {{ number_format($registrations->total()) }} data
                            @if(!empty($searchKeyword))
                                · Pencarian: <strong>{{ $searchKeyword }}</strong>
                            @endif
                        </p>
                    </div>
                    <div class="card-actions">
                        <form action="{{ route('admin.registrations.index') }}" method="GET" class="row g-2 align-items-center">
                            <div class="col-auto">
                                <input type="search"
                                       name="search"
                                       value="{{ $searchKeyword }}"
                                       class="form-control"
                                       placeholder="Cari nama, email, nomor...">
                            </div>
                            <div class="col-auto">
                                <select name="per_page" class="form-select" onchange="this.form.submit()">
                                    @foreach($perPageOptions as $option)
                                        <option value="{{ $option }}" @selected($currentPerPage === $option)>{{ $option }} / halaman</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">
                                    Cari
                                </button>
                            </div>
                            @if(!empty($searchKeyword))
                                <div class="col-auto">
                                    <a href="{{ route('admin.registrations.index') }}" class="btn btn-link text-muted">
                                        Reset
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Tanggal</th>
                                <th class="w-1">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="registrationTable">
                            @forelse($registrations as $index => $registration)
                                <tr>
                                    <td>{{ $registrations->firstItem() + $index }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-sm me-2">{{ substr($registration->first_name, 0, 1) }}</div>
                                            <div>
                                                <div class="fw-bold">{{ $registration->full_name }}</div>
                                                @if($registration->registration_number)
                                                    <div class="text-muted text-xs">No: {{ $registration->registration_number }}</div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-muted">{{ $registration->email }}</td>
                                    <td class="text-muted">{{ $registration->phone }}</td>
                                    <td>
                                        <span class="badge bg-primary text-white">{{ $registration->category }}</span>
                                        @if($registration->category_type)
                                            <br><small class="text-muted">
                                                {{ $registration->category_type === 'satpam' ? 'Korps Satpam' : 'Umum' }}
                                                @if($registration->unique_price_code)
                                                    · Rp {{ number_format($registration->unique_price_code, 0, ',', '.') }}
                                                @endif
                                            </small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($registration->status === 'approved')
                                            <span class="badge bg-success text-white">Disetujui</span>
                                        @elseif($registration->status === 'rejected')
                                            <span class="badge bg-danger text-white">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-white">Menunggu</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($registration->payment_status === 'verified')
                                            <span class="badge bg-success text-white">Terkonfirmasi</span>
                                        @elseif($registration->payment_status === 'rejected')
                                            <span class="badge bg-danger text-white">Ditolak</span>
                                        @else
                                            <span class="badge bg-warning text-white">Pending</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $registration->created_at->format('d M Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.registrations.show', $registration->id) }}" class="btn btn-sm btn-primary">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center py-4">
                                        <div class="empty">
                                            <div class="empty-img">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="128" height="128" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
                                                    <path d="M16 21v-2a4 4 0 0 0 -4 -4h-4a4 4 0 0 0 -4 4v2" />
                                                    <path d="M13 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                                </svg>
                                            </div>
                                            <p class="empty-title">Tidak ada pendaftaran</p>
                                            <p class="empty-subtitle text-muted">
                                                Belum ada data pendaftaran yang masuk.
                                            </p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">
                        Menampilkan <span>{{ $registrations->firstItem() }}</span> sampai <span>{{ $registrations->lastItem() }}</span> dari <span>{{ $registrations->total() }}</span> pendaftaran
                    </p>
                    <div class="ms-auto">
                        {{ $registrations->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

