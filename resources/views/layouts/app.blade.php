<!doctype html>
<!--
* Tabler - Premium and Open Source dashboard template with responsive and high quality UI.
* @version 1.0.0
* @link https://tabler.io
* Copyright 2018-2025 The Tabler Authors
* Copyright 2018-2025 codecalm.net Paweł Kuna
* Licensed under MIT (https://github.com/tabler/tabler/blob/master/LICENSE)
-->
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Admin - Satpam Fun Run 5K</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ url('/assets/SATPAM/Logo.png') }}">
    <!-- CSS files -->
    <link href="{{ asset('dist/css/admin.css') }}" rel="stylesheet" />
    <style>
        @import url('https://rsms.me/inter/inter.css');
        
        /* Custom Color Palette untuk Tabler Admin */
        :root {
            --tblr-primary: #282061;
            --tblr-primary-rgb: 40, 32, 97;
            --tblr-primary-darken: #1f1a4f;
            --tblr-primary-lighten: #3a2d85;
        }
        
        .btn-primary {
            background-color: var(--tblr-primary);
            border-color: var(--tblr-primary);
        }
        
        .btn-primary:hover {
            background-color: var(--tblr-primary-darken);
            border-color: var(--tblr-primary-darken);
        }
        
        .border-primary {
            border-color: var(--tblr-primary) !important;
        }
        
        .text-primary {
            color: var(--tblr-primary) !important;
        }
        
        .bg-primary {
            background-color: var(--tblr-primary) !important;
        }
        
        .nav-link.aktif {
            background-color: rgba(var(--tblr-primary-rgb), 0.1);
            color: var(--tblr-primary) !important;
        }
        
        .nav-link.aktif .icon {
            color: var(--tblr-primary);
        }
        
        .navbar-brand h1 {
            color: var(--tblr-primary);
            font-weight: 700;
        }
        
        .avatar.bg-cyan-lt {
            background-color: rgba(var(--tblr-primary-rgb), 0.15) !important;
            color: var(--tblr-primary) !important;
        }
        
        .badge.bg-white.text-primary {
            color: var(--tblr-primary) !important;
        }
        
        .link-secondary {
            color: var(--tblr-primary) !important;
        }
        
        .link-secondary:hover {
            color: var(--tblr-primary-darken) !important;
        }
    </style>
</head>

<body>
    <div class="page">
        @include('components.alert.error')
        @include('components.alert.success')
        <!-- Sidebar -->
        @include('components.sidebar')

        <div class="page-wrapper">
            @yield('content')
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    <div class="row text-center align-items-center flex-row-reverse">
                        <div class="col-lg-auto ms-lg-auto">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    <a href="/" class="link-secondary" target="_blank">Website Event</a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="#" class="link-secondary">Dokumentasi</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                            <ul class="list-inline list-inline-dots mb-0">
                                <li class="list-inline-item">
                                    Copyright &copy; {{ date('Y') }}
                                    <a href="/" class="link-secondary">Satpam Fun Run 5K</a>.
                                    All rights reserved.
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="{{ asset('dist/js/tabler.min.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const toast = document.getElementById("toast-simple");

            if (toast) {
                setTimeout(() => {
                    toast.classList.remove("show");
                    toast.classList.add("hide");
                }, 3000); // 5 detik
            }
        });
    </script>
</body>

</html>