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
                        Peserta
                    </div>
                    <h2 class="page-title">
                        Daftar Peserta Terkonfirmasi
                    </h2>
                </div>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Page body -->
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title mb-1">Peserta Terkonfirmasi</h3>
                        <p class="text-muted mb-0 small">
                            Total {{ number_format($participants->total()) }} peserta
                            @if(!empty($searchKeyword))
                                · Pencarian: <strong>{{ $searchKeyword }}</strong>
                            @endif
                        </p>
                    </div>
                    <div class="card-actions w-100 w-md-auto">
                        <form action="{{ route('admin.participants.index') }}" method="GET" class="row g-2 align-items-center">
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
                                    <a href="{{ route('admin.participants.index') }}" class="btn btn-link text-muted">
                                        Reset
                                    </a>
                                </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    @if($participants->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table">
                                <thead>
                                    <tr>
                                        <th>No. Pendaftaran</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Telepon</th>
                                        <th>Kategori</th>
                                        <th>Tanggal Disetujui</th>
                                        <th class="w-1">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($participants as $participant)
                                        <tr>
                                            <td>
                                                <strong class="text-primary">{{ $participant->registration_number }}</strong>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-2">
                                                        <div class="avatar-title bg-primary text-white rounded">
                                                            {{ strtoupper(substr($participant->first_name, 0, 1)) }}
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="font-weight-medium">{{ $participant->full_name }}</div>
                                                        <div class="text-muted small">{{ $participant->bib_name }}</div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-muted">
                                                {{ $participant->email }}
                                            </td>
                                            <td class="text-muted">
                                                {{ $participant->phone }}
                                            </td>
                                            <td>
                                                <span class="badge bg-primary text-white">{{ $participant->category }}</span>
                                            </td>
                                            <td class="text-muted">
                                                {{ $participant->approved_at ? $participant->approved_at->format('d/m/Y H:i') : '-' }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.participants.show', $participant->id) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty">
                            <div class="empty-img">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="128" height="128"
                                    viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M16 21v-2a4 4 0 0 0 -4 -4h-4a4 4 0 0 0 -4 4v2" />
                                    <path d="M13 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M5 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                    <path d="M9 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                </svg>
                            </div>
                            <p class="empty-title">Belum ada peserta terkonfirmasi</p>
                            <p class="empty-subtitle text-muted">
                                Peserta yang sudah disetujui akan muncul di sini.
                            </p>
                            <div class="empty-action">
                                <a href="{{ route('admin.registrations.index') }}" class="btn btn-primary">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="icon me-2">
                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                    </svg>
                                    Lihat Pendaftaran
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="card-footer d-flex align-items-center">
                    <p class="m-0 text-muted">
                        Menampilkan <span>{{ $participants->firstItem() }}</span> sampai <span>{{ $participants->lastItem() }}</span> dari <span>{{ $participants->total() }}</span> peserta
                    </p>
                    <div class="ms-auto">
                        {{ $participants->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

