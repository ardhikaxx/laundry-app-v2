<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Cuciin</title>
    
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
            --gradient-indigo: linear-gradient(135deg, #6366f1, #a855f7);
        }
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            overflow: hidden;
            position: relative;
        }
        .bg-decor {
            position: absolute;
            inset: 0;
            z-index: -1;
            overflow: hidden;
        }
        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.2;
        }
        .blob-1 { width: 500px; height: 500px; background: #6366f1; top: -100px; left: -100px; }
        .blob-2 { width: 400px; height: 400px; background: #a855f7; bottom: -100px; right: -100px; }

        .login-container {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }
        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 30px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }
        .brand-icon {
            width: 60px;
            height: 60px;
            background: var(--gradient-indigo);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin: 0 auto 20px;
            box-shadow: 0 10px 20px rgba(99, 102, 241, 0.3);
        }
        .login-title {
            font-weight: 800;
            font-size: 1.75rem;
            color: #0f172a;
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }
        .login-subtitle {
            font-size: 0.85rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
            margin-bottom: 30px;
        }
        .form-label {
            font-size: 0.65rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-left: 5px;
        }
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            font-weight: 600;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
            transition: all 0.3s;
        }
        .form-control:focus {
            background-color: white;
            border-color: var(--primary-indigo);
            box-shadow: 0 0 0 4px rgba(79, 70, 229, 0.1);
        }
        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: #94a3b8;
        }
        .btn-login {
            background-color: #0f172a;
            color: white;
            border: none;
            border-radius: 15px;
            padding: 14px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.85rem;
            width: 100%;
            margin-top: 10px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: var(--primary-indigo);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
            transform: translateY(-2px);
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 700;
            margin-top: 25px;
            transition: color 0.3s;
        }
        .back-link:hover { color: var(--primary-indigo); }
    </style>
</head>
<body>
    <div class="bg-decor">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
    </div>

    <div class="login-container">
        <div class="text-center">
            <div class="brand-icon">
                <i class="fas fa-soap"></i>
            </div>
            <h1 class="login-title">Selamat Datang</h1>
            <p class="login-subtitle">Akses Portal Cuciin</p>
        </div>

        <div class="login-card">
            @if ($errors->any())
                <div class="alert alert-danger border-0 rounded-4 small p-3 mb-4">
                    <div class="d-flex gap-2">
                        <i class="fas fa-circle-exclamation mt-1"></i>
                        <ul class="mb-0 ps-0 list-unstyled fw-bold">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Alamat Email</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="fas fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0" placeholder="admin@cuciin.com" value="{{ old('email') }}" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text border-end-0"><i class="fas fa-lock"></i></span>
                        <input type="password" name="password" id="password" class="form-control border-start-0 border-end-0" placeholder="••••••••" required>
                        <button class="btn btn-outline-light border border-start-0 text-muted" type="button" id="togglePassword" style="background: #f8fafc; border-radius: 0 12px 12px 0;">
                            <i class="fas fa-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <button type="submit" class="btn btn-login">
                    Masuk Aplikasi <i class="fas fa-arrow-right ms-2 small"></i>
                </button>
            </form>
        </div>

        <div class="text-center">
            <a href="{{ route('home') }}" class="back-link">
                <i class="fas fa-arrow-left small"></i> Kembali ke Beranda
            </a>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        });
    </script>
</body>
</html>
