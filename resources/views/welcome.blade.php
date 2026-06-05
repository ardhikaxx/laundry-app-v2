<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Cuciin — Selamat Datang</title>

        <!-- Bootstrap 5 CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- Google Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <style>
            body {
                font-family: 'Instrument Sans', sans-serif;
                background-color: #f8fafc;
                min-height: 100vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin: 0;
            }
            .welcome-card {
                background: white;
                border-radius: 40px;
                padding: 60px;
                box-shadow: 0 40px 80px -20px rgba(79, 70, 229, 0.1);
                text-align: center;
                max-width: 500px;
                width: 90%;
            }
            .brand-logo {
                width: 80px;
                height: 80px;
                background: linear-gradient(135deg, #6366f1, #a855f7);
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: white;
                font-size: 2.5rem;
                margin: 0 auto 30px;
                box-shadow: 0 15px 30px rgba(99, 102, 241, 0.3);
            }
            .btn-start {
                background-color: #4f46e5;
                color: white;
                border: none;
                border-radius: 15px;
                padding: 15px 40px;
                font-weight: 800;
                text-transform: uppercase;
                letter-spacing: 1px;
                transition: all 0.3s;
                margin-top: 20px;
                text-decoration: none;
                display: inline-block;
            }
            .btn-start:hover {
                background-color: #4338ca;
                box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
                transform: translateY(-2px);
                color: white;
            }
        </style>
    </head>
    <body>
        <div class="welcome-card">
            <div class="brand-logo">
                <i class="fas fa-soap"></i>
            </div>
            <h1 class="fw-black display-5 mb-3" style="letter-spacing: -2px;">Cuci<span class="text-primary">in</span></h1>
            <p class="text-muted fw-bold mb-5">Sistem Informasi Manajemen Laundry Modern & Terpercaya.</p>
            
            <div class="d-grid gap-3">
                <a href="{{ route('home') }}" class="btn btn-start">Masuk ke Website</a>
                
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/admin/dashboard') }}" class="btn btn-outline-secondary rounded-pill fw-bold small py-3">Buka Dashboard Admin</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-link text-decoration-none text-muted fw-bold small mt-3">Portal Internal (Karyawan/Admin)</a>
                    @endauth
                @endif
            </div>
        </div>

        <p class="mt-5 text-muted small fw-bold text-uppercase opacity-50" style="letter-spacing: 3px;">&copy; {{ date('Y') }} Cuciin Team</p>

        <!-- Bootstrap 5 JS Bundle CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
