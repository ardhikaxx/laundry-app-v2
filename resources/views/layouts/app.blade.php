<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Cuciin Admin</title>

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
            --dark-sidebar: #111827;
        }
        body {
            font-family: 'Instrument Sans', sans-serif;
            background-color: #f8fafc;
            color: #1e293b;
        }
        
        /* Sidebar */
        #sidebar {
            width: 280px;
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background-color: var(--dark-sidebar);
            color: #94a3b8;
            transition: all 0.3s;
            z-index: 1000;
            overflow-y: auto;
        }
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid #1f2937;
        }
        .sidebar-brand {
            font-weight: 800;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .brand-icon {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #6366f1, #a855f7);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }
        .nav-section-title {
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.1rem;
            font-weight: 800;
            color: #4b5563;
            padding: 1.5rem 1.5rem 0.5rem;
        }
        .sidebar-nav .nav-link {
            padding: 0.75rem 1.5rem;
            color: #94a3b8;
            font-weight: 600;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 12px;
            transition: all 0.2s;
        }
        .sidebar-nav .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,0.05);
        }
        .sidebar-nav .nav-link.active {
            color: white;
            background-color: var(--primary-indigo);
            border-radius: 0 50px 50px 0;
            margin-right: 1.5rem;
            box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.4);
        }
        .sidebar-nav .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        #main-content {
            margin-left: 280px;
            min-height: 100vh;
            transition: all 0.3s;
        }
        
        /* Topbar */
        .topbar {
            height: 64px;
            background-color: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 999;
        }
        .breadcrumb { margin-bottom: 0; font-weight: 700; font-size: 0.875rem; }
        .breadcrumb-item a { color: #64748b; text-decoration: none; }
        .breadcrumb-item.active { color: var(--primary-indigo); }
        
        /* Profile Dropdown */
        .user-dropdown .btn {
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            padding: 6px 15px;
            font-weight: 700;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
            gap: 10px;
            background: white;
        }
        .avatar {
            width: 28px;
            height: 28px;
            background-color: #e0e7ff;
            color: var(--primary-indigo);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.7rem;
            font-weight: 800;
        }

        /* Content Padding */
        .content-body {
            padding: 2rem;
        }

        /* Responsive */
        @media (max-width: 991.98px) {
            #sidebar { left: -280px; }
            #sidebar.active { left: 0; }
            #main-content { margin-left: 0; }
            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(0,0,0,0.5);
                z-index: 999;
            }
            .sidebar-overlay.active { display: block; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="sidebar-overlay" id="sidebar-overlay"></div>

    <!-- Sidebar -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <div class="brand-icon"><i class="fas fa-soap"></i></div>
                <span>Cuciin Admin</span>
            </a>
        </div>
        
        <div class="sidebar-nav">
            <div class="nav-section-title">Utama</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>

            <div class="nav-section-title">Master Data</div>
            <a href="{{ route('admin.kategori.index') }}" class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i> Kategori Layanan
            </a>
            <a href="{{ route('admin.layanan.index') }}" class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
                <i class="fas fa-tshirt"></i> Layanan
            </a>
            <a href="{{ route('admin.pelanggan.index') }}" class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Pelanggan
            </a>

            <div class="nav-section-title">Operasional</div>
            <a href="{{ route('admin.transaksi.index') }}" class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
                <i class="fas fa-receipt"></i> Transaksi
            </a>
            <a href="{{ route('admin.pegawai.index') }}" class="nav-link {{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
                <i class="fas fa-user-tie"></i> Pegawai
            </a>

            <div class="nav-section-title">Sistem</div>
            <a href="{{ route('admin.laporan.index') }}" class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
                <i class="fas fa-chart-bar"></i> Laporan
            </a>
            
            <div class="mt-4 pt-4 border-top border-secondary opacity-25"></div>
            <a href="{{ route('home') }}" class="nav-link">
                <i class="fas fa-external-link-alt"></i> Halaman Publik
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div id="main-content">
        <!-- Topbar -->
        <header class="topbar">
            <div class="d-flex align-items-center">
                <button class="btn border-0 d-lg-none me-3" id="sidebar-toggle">
                    <i class="fas fa-bars fs-4"></i>
                </button>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>

            <div class="user-dropdown dropdown">
                <button class="btn dropdown-toggle shadow-none" type="button" data-bs-toggle="dropdown">
                    <div class="avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <span class="d-none d-md-block">{{ auth()->user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg p-2 mt-2 rounded-4" style="width: 220px;">
                    <li class="p-3 border-bottom mb-2">
                        <div class="fw-bold small text-muted text-uppercase mb-1" style="font-size: 10px;">Signed in as</div>
                        <div class="fw-bold text-dark truncate small">{{ auth()->user()->email }}</div>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger fw-bold py-2 rounded-3 d-flex align-items-center gap-2">
                                <i class="fas fa-sign-out-alt w-20px text-center"></i> Keluar Aplikasi
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Page Content -->
        <main class="content-body">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Sidebar Toggle for Mobile
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const toggle = document.getElementById('sidebar-toggle');

        if(toggle) {
            toggle.addEventListener('click', () => {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            });
        }
        if(overlay) {
            overlay.addEventListener('click', () => {
                sidebar.classList.remove('active');
                overlay.classList.remove('active');
            });
        }

        // Global SweetAlert Helpers
        window.confirmDelete = (formId, nama = 'data ini') => {
            Swal.fire({
                title: 'Hapus Data?',
                html: `Anda akan menghapus <strong>${nama}</strong>. Tindakan ini tidak dapat dibatalkan.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#4f46e5',
                cancelButtonColor: '#94a3b8',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'rounded-4' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(formId).submit();
                }
            });
        };

        // Flash Messages
        @if(session('success'))
            Swal.fire({ icon: 'success', title: 'Berhasil!', text: "{{ session('success') }}", timer: 3000, showConfirmButton: false, customClass: { popup: 'rounded-4' } });
        @endif
        @if(session('error'))
            Swal.fire({ icon: 'error', title: 'Gagal!', text: "{{ session('error') }}", confirmButtonColor: '#4f46e5', customClass: { popup: 'rounded-4' } });
        @endif
    </script>
    @stack('scripts')
</body>
</html>
