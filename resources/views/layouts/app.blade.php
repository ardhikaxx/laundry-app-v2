<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — SiLaundry Admin</title>

    <!-- Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <style>
        :root {
            --sidebar-bg:     #1a2332;
            --sidebar-width:  260px;
            --accent-primary: #0d6efd;
            --topbar-height:  60px;
            --text-sidebar:   #adb5bd;
            --text-sidebar-active: #ffffff;
        }

        body { background:#f4f6f9; font-family:'Segoe UI',sans-serif; }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed; top:0; left:0;
            z-index: 1000;
            transition: width .3s;
            overflow-y: auto;
        }
        #sidebar .brand {
            height: var(--topbar-height);
            display:flex; align-items:center;
            padding:0 1.2rem;
            background: rgba(255,255,255,.05);
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        #sidebar .brand span { color:#fff; font-weight:700; font-size:1.1rem; letter-spacing:.5px; }
        #sidebar .nav-link {
            color: var(--text-sidebar);
            padding:.55rem 1.2rem;
            border-radius:6px;
            margin:2px .6rem;
            transition:all .2s;
            font-size:.875rem;
        }
        #sidebar .nav-link:hover,
        #sidebar .nav-link.active {
            background: var(--accent-primary);
            color: var(--text-sidebar-active);
        }
        #sidebar .nav-link i { width:20px; text-align:center; margin-right:.5rem; }
        #sidebar .nav-section {
            font-size:.7rem; font-weight:700; text-transform:uppercase;
            letter-spacing:1px; color:#6c757d; padding:1rem 1.8rem .3rem;
        }

        /* Topbar */
        #topbar {
            height: var(--topbar-height);
            background:#fff;
            border-bottom:1px solid #dee2e6;
            position:fixed; top:0;
            left: var(--sidebar-width); right:0;
            z-index:999;
            display:flex; align-items:center; padding:0 1.5rem;
            justify-content:space-between;
            box-shadow:0 1px 3px rgba(0,0,0,.06);
        }

        /* Main Content */
        #main-content {
            margin-left: var(--sidebar-width);
            padding-top: calc(var(--topbar-height) + 1.5rem);
            padding-left:1.5rem; padding-right:1.5rem; padding-bottom:2rem;
            min-height:100vh;
        }

        /* Cards */
        .card { border:none; border-radius:10px; box-shadow:0 1px 6px rgba(0,0,0,.07); }
        .card-header { background:#fff; border-bottom:1px solid #f0f0f0; font-weight:600; }

        /* KPI Card */
        .kpi-card { border-radius:12px; border:none; }
        .kpi-card .kpi-icon {
            width:52px; height:52px; border-radius:10px;
            display:flex; align-items:center; justify-content:center; font-size:1.4rem;
        }

        /* Status Badges */
        .badge-diterima  { background:#6c757d; }
        .badge-dicuci    { background:#0dcaf0; color:#000; }
        .badge-dijemur   { background:#ffc107; color:#000; }
        .badge-disetrika { background:#fd7e14; }
        .badge-siap      { background:#198754; }
        .badge-diambil   { background:#0d6efd; }
        .badge-batal     { background:#dc3545; }

        /* Table */
        .table th { font-weight:600; font-size:.82rem; text-transform:uppercase;
                    letter-spacing:.5px; color:#6c757d; white-space:nowrap; }
        .table td { vertical-align:middle; font-size:.88rem; }

        /* Responsive */
        @media (max-width:768px) {
            #sidebar { width:0; overflow:hidden; }
            #sidebar.show { width:var(--sidebar-width); }
            #topbar { left:0; }
            #main-content { margin-left:0; }
        }
    </style>

    @stack('styles')
</head>
<body>

<!-- Sidebar -->
<nav id="sidebar">
    <div class="brand">
        <i class="fas fa-soap text-primary me-2 fs-5"></i>
        <span>SiLaundry</span>
    </div>
    <div class="pt-2 pb-3">
        <p class="nav-section">Utama</p>
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>

        <p class="nav-section">Master Data</p>
        <a href="{{ route('admin.kategori.index') }}"
           class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
            <i class="fas fa-tags"></i> Kategori Layanan
        </a>
        <a href="{{ route('admin.layanan.index') }}"
           class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}">
            <i class="fas fa-tshirt"></i> Layanan
        </a>
        <a href="{{ route('admin.pelanggan.index') }}"
           class="nav-link {{ request()->routeIs('admin.pelanggan.*') ? 'active' : '' }}">
            <i class="fas fa-users"></i> Pelanggan
        </a>

        <p class="nav-section">Operasional</p>
        <a href="{{ route('admin.transaksi.index') }}"
           class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}">
            <i class="fas fa-receipt"></i> Transaksi
        </a>
        <a href="{{ route('admin.pegawai.index') }}"
           class="nav-link {{ request()->routeIs('admin.pegawai.*') ? 'active' : '' }}">
            <i class="fas fa-user-tie"></i> Pegawai
        </a>

        <p class="nav-section">Sistem</p>
        <a href="{{ route('admin.laporan.index') }}"
           class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}">
            <i class="fas fa-chart-bar"></i> Laporan
        </a>
    </div>
</nav>

<!-- Topbar -->
<header id="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-light d-md-none" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <nav aria-label="breadcrumb" class="d-none d-md-block">
            <ol class="breadcrumb mb-0 small">
                @yield('breadcrumb')
            </ol>
        </nav>
    </div>
    <div class="d-flex align-items-center gap-2">
        <div class="dropdown">
            <button class="btn btn-sm btn-light dropdown-toggle" data-bs-toggle="dropdown">
                <i class="fas fa-user-circle me-1"></i>
                {{ auth()->user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><span class="dropdown-item-text small text-muted">{{ auth()->user()->email }}</span></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fas fa-sign-out-alt me-2"></i>Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- Main Content -->
<main id="main-content">
    @yield('content')
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Sidebar toggle (mobile)
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('show');
    });

    // SweetAlert Flash Messages
    @if(session('success'))
    Swal.fire({ icon:'success', title:'Berhasil!', text:'{{ session('success') }}',
        timer:2500, showConfirmButton:false, timerProgressBar:true });
    @endif
    @if(session('error'))
    Swal.fire({ icon:'error', title:'Gagal!', text:'{{ session('error') }}',
        confirmButtonColor:'#d33' });
    @endif
    @if(session('warning'))
    Swal.fire({ icon:'warning', title:'Perhatian!', text:'{{ session('warning') }}' });
    @endif

    // Global Helper Functions
    function confirmDelete(formId, nama = 'data ini') {
        Swal.fire({
            title: 'Hapus Data?',
            html: `Anda akan menghapus <strong>${nama}</strong>. Tindakan ini tidak dapat dibatalkan.`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: '<i class="fas fa-trash-alt me-1"></i>Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then(r => { if(r.isConfirmed) document.getElementById(formId).submit(); });
    }

    function confirmAction(formId, title, text, confirmText = 'Ya, Lanjutkan', icon = 'question') {
        Swal.fire({
            title, text, icon,
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#6c757d',
            confirmButtonText: confirmText,
            cancelButtonText: 'Batal'
        }).then(r => { if(r.isConfirmed) document.getElementById(formId).submit(); });
    }

    function showToast(icon, title) {
        Swal.mixin({ toast:true, position:'top-end', showConfirmButton:false,
            timer:3000, timerProgressBar:true }).fire({ icon, title });
    }
</script>

@stack('scripts')
</body>
</html>