<ul class="navbar-nav px-1 dropdown-menu my-1 z-1">
    <a class="nav-link mb-1 {{ Request::is('dashboard') || Request::is('/') ? 'aktif' : '' }}" href="/dashboard">
        <!-- Download SVG icon from http://tabler.io/icons/icon/home -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
            <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
        </svg>
        <span class="ms-2 nav-link-title">
            Dashboard
        </span>
    </a>
    <a class="nav-link mb-1 {{ Request::is('admin/registrations*') ? 'aktif' : '' }}" href="{{ route('admin.registrations.index') }}">
        <!-- Download SVG icon from http://tabler.io/icons/icon/users -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-users">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
            <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
            <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
        </svg>
        <span class="ms-2 nav-link-title">
            Pendaftaran
        </span>
    </a>
    <a class="nav-link mb-1 {{ Request::is('admin/participants*') ? 'aktif' : '' }}" href="{{ route('admin.participants.index') }}">
        <!-- Download SVG icon from http://tabler.io/icons/icon/user-check -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path d="M16 21v-2a4 4 0 0 0 -4 -4h-4a4 4 0 0 0 -4 4v2" />
            <path d="M13 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M5 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            <path d="M9 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
        </svg>
        <span class="ms-2 nav-link-title">
            Peserta
        </span>
    </a>
    <a class="nav-link mb-1 {{ Request::is('admin/barcode-scan*') ? 'aktif' : '' }}" href="{{ route('admin.barcode-scan.index') }}">
        <!-- Download SVG icon from http://tabler.io/icons/icon/qrcode -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path d="M4 4h6v6H4z" />
            <path d="M14 4h6v6h-6z" />
            <path d="M4 14h6v6H4z" />
            <path d="M14 14h2" />
            <path d="M18 14h2" />
            <path d="M14 18h2" />
            <path d="M18 18h2" />
        </svg>
        <span class="ms-2 nav-link-title">
            Scan Barcode
        </span>
    </a>
    <a class="nav-link mb-1 {{ Request::is('admin/settings*') ? 'aktif' : '' }}" href="{{ route('admin.settings.index') }}">
        <!-- Download SVG icon from http://tabler.io/icons/icon/settings -->
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon">
            <path d="M12.22 2h-.44a2 2 0 0 0 -2 2v.18a2 2 0 0 1 -1 1.73l-.43.25a2 2 0 0 1 -2 0l-.15 -.08a2 2 0 0 0 -2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1 -1 1.74l-.15.09a2 2 0 0 0 -.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15 -.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73v.18a2 2 0 0 0 2 2h.44a2 2 0 0 0 2 -2v-.18a2 2 0 0 1 1 -1.73l.43 -.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73 -.73l.22 -.39a2 2 0 0 0 -.73 -2.73l-.15 -.08a2 2 0 0 1 -1 -1.74v-.5a2 2 0 0 1 1 -1.74l.15 -.09a2 2 0 0 0 .73 -2.73l-.22 -.38a2 2 0 0 0 -2.73 -.73l-.15.08a2 2 0 0 1 -2 0l-.43 -.25a2 2 0 0 1 -1 -1.73v-.18a2 2 0 0 0 -2 -2z" />
            <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
        </svg>
        <span class="ms-2 nav-link-title">
            Pengaturan
        </span>
    </a>
</ul>