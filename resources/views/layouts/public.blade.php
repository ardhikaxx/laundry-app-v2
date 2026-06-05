<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — Cuciin</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    <style>
        :root {
            --primary-indigo: #4f46e5;
            --hover-indigo: #4338ca;
        }
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        .navbar {
            background-color: rgba(255, 255, 255, 0.9) !important;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 0;
        }
        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
        .brand-icon {
            background: linear-gradient(135deg, #6366f1, #a855f7);
            color: white;
            padding: 8px;
            border-radius: 10px;
            margin-right: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }
        .nav-link {
            font-weight: 600;
            color: #64748b !important;
            margin: 0 10px;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--primary-indigo) !important;
        }
        .btn-login {
            background-color: #0f172a;
            color: white;
            border-radius: 50px;
            padding: 8px 25px;
            font-weight: 700;
            font-size: 0.85rem;
            border: none;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #1e293b;
            color: white;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .footer {
            background-color: white;
            border-top: 1px solid #e2e8f0;
            padding: 60px 0;
            margin-top: 80px;
        }
        .footer-brand { font-weight: 800; font-size: 1.25rem; }
        .footer h6 { font-weight: 800; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1.5px; color: #0f172a; margin-bottom: 1.5rem; }
        .footer-links { list-style: none; padding: 0; }
        .footer-links li { margin-bottom: 10px; }
        .footer-links a { color: #64748b; text-decoration: none; font-size: 0.9rem; transition: color 0.3s; }
        .footer-links a:hover { color: var(--primary-indigo); }
        .social-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #f1f5f9;
            color: #64748b;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: all 0.3s;
            text-decoration: none;
        }
        .social-btn:hover { background-color: var(--primary-indigo); color: white; }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <div class="brand-icon">
                    <i class="fas fa-soap"></i>
                </div>
                <span>Cuci<span style="color: var(--primary-indigo)">in</span></span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.layanan') ? 'active' : '' }}" href="{{ route('public.layanan') }}">Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('public.pelanggan') ? 'active' : '' }}" href="{{ route('public.pelanggan') }}">Cek Status</a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-login shadow-sm">
                            <i class="fas fa-sign-in-alt me-2 small"></i>Login
                        </a>
                    @endguest
                    @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : '#' }}" class="btn btn-outline-secondary rounded-pill px-4 fw-bold small">
                            <i class="fas fa-user-circle me-2"></i>{{ auth()->user()->name }}
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <a class="footer-brand d-flex align-items-center mb-3 text-decoration-none text-dark" href="{{ route('home') }}">
                        <div class="brand-icon" style="width: 32px; height: 32px; font-size: 14px;">
                            <i class="fas fa-soap"></i>
                        </div>
                        <span>Cuci<span style="color: var(--primary-indigo)">in</span></span>
                    </a>
                    <p class="text-muted small pe-lg-5 mb-4">
                        Layanan laundry premium dengan standar kualitas terbaik, menggunakan teknologi ramah lingkungan untuk hasil yang sempurna setiap saat.
                    </p>
                    <div class="d-flex">
                        <a href="#" class="social-btn"><i class="fab fa-facebook-f small"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-twitter small"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-instagram small"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-3">
                    <h6>Navigasi</h6>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Beranda Utama</a></li>
                        <li><a href="{{ route('public.layanan') }}">Daftar Layanan</a></li>
                        <li><a href="{{ route('public.pelanggan') }}">Cek Status</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-4">
                    <h6>Bantuan & Kontak</h6>
                    <ul class="footer-links">
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-5 opacity-10">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="text-muted mb-0 small" style="font-size: 0.75rem;">
                    &copy; {{ date('Y') }} Cuciin. Dibuat dengan <i class="fas fa-heart text-danger mx-1"></i> untuk kebersihan pakaian Anda.
                </p>
                <span class="text-muted fw-bold text-uppercase" style="font-size: 0.6rem; letter-spacing: 2px;">Premium Quality Verified</span>
            </div>
        </div>
    </footer>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')
</body>
</html>
