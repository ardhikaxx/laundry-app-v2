<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — SiLaundry</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        body { background: #f4f6f9; height: 100vh; display: flex; align-items: center; justify-content: center; }
        .login-card { border: none; border-radius: 12px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); width: 100%; max-width: 400px; padding: 2rem; background: #fff; }
        .login-card .brand { text-align: center; margin-bottom: 2rem; }
        .login-card .brand i { font-size: 3rem; color: #0d6efd; margin-bottom: 1rem; }
        .login-card .brand h3 { font-weight: 700; color: #333; margin: 0; }
        .btn-primary { padding: 0.6rem; font-weight: 600; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="brand">
            <i class="fas fa-soap"></i>
            <h3>SiLaundry</h3>
            <p class="text-muted small">Silakan login untuk melanjutkan</p>
        </div>
        
        @if ($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0 ps-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label text-muted small fw-bold">Alamat Email</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="Masukkan alamat email Anda" value="{{ old('email') }}" required autofocus>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label text-muted small fw-bold">Kata Sandi</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                    <input type="password" name="password" id="password" class="form-control border-start-0 border-end-0 ps-0" placeholder="Masukkan kata sandi Anda" required>
                    <button class="btn btn-light border border-start-0 text-muted" type="button" id="togglePassword">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100 mb-3">Login</button>
            <div class="text-center">
                <a href="{{ route('home') }}" class="text-decoration-none small text-muted"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
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