<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login - Satpam Fun Run 5K</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/admin.css') }}" rel="stylesheet" />
    <style>
        @import url("https://rsms.me/inter/inter.css");
        
        /* Custom Color Palette untuk Tabler */
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
        
        .form-control:focus {
            border-color: var(--tblr-primary);
            box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.25);
        }
        
        a {
            color: var(--tblr-primary);
        }
        
        a:hover {
            color: var(--tblr-primary-darken);
        }
        
        .navbar-brand img {
            max-height: 80px;
            width: auto;
            margin-bottom: 1rem;
        }
        
        .btn-primary:focus,
        .btn-primary:active {
            background-color: var(--tblr-primary-darken);
            border-color: var(--tblr-primary-darken);
        }
        
        .btn-primary:focus-visible {
            box-shadow: 0 0 0 0.25rem rgba(var(--tblr-primary-rgb), 0.5);
        }
        
        .navbar-brand h1 {
            letter-spacing: 0.5px;
        }
        
        /* Responsive untuk mobile */
        @media (max-width: 576px) {
            .navbar-brand img {
                max-height: 60px;
            }
            
            .navbar-brand h1 {
                font-size: 1rem !important;
            }
        }
    </style>
</head>

<body class="d-flex flex-column">
    <script src="{{ asset('dist/js/demo-theme.min.js') }}"></script>
    <div class="row g-0 flex-fill">
        <div class="col-12 border-top-wide border-primary d-flex flex-column justify-content-center">
            <div class="container container-tight my-5 px5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center mb-0 mt-3">
                            <div class="navbar-brand">
                                <div style="background: linear-gradient(135deg, #282061 0%, #665d6c 100%); padding: 12px; border-radius: 12px; display: inline-block; margin-bottom: 16px;">
                                    <img src="{{ url('/assets/SATPAM/Logo.png') }}" 
                                     class="navbar-brand-image" 
                                     alt="Satpam Fun Run Logo"
                                         style="max-height: 80px; width: auto; display: block;">
                                </div>
                                <h1 class="m-0 mt-2" style="font-size: 1.25rem; font-weight: 700; color: #282061;">
                                    Satpam Fun Run 5K
                                </h1>
                            </div>
                        </div>
                        <div class="px-2">
                            <div class="card-body">
                                <h2 class="h3 text-center mb-3">
                                    Masuk Ke Akun Anda
                                </h2>
                                <form action="/login" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Masukan Email" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        @error('password')
                                            <small class="text-danger">Email atau Password salah</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password"
                                            placeholder="Masukan Password" required>
                                    </div>
                                    <div class="form-footer mb-3">
                                        <button type="submit" class="btn btn-primary w-100">Masuk</button>
                                    </div>
                                </form>
                                <div class="text-center text-secondary mt-3">
                                    Kembali Ke Beranda <a href="/" tabindex="-1">Klik Disini</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('dist/js/tabler.min.js') }}" defer></script>
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