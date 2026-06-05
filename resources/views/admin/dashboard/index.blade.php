@extends('layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<style>
    .kpi-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 25px;
        padding: 30px;
        transition: all 0.3s;
        box-shadow: 0 10px 20px rgba(0,0,0,0.02);
    }
    .kpi-card:hover {
        box-shadow: 0 20px 40px rgba(79, 70, 229, 0.08);
        transform: translateY(-2px);
    }
    .kpi-icon {
        width: 55px; height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }
    .kpi-label {
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #94a3b8;
        margin-bottom: 5px;
    }
    .kpi-value {
        font-weight: 900;
        font-size: 1.5rem;
        color: #0f172a;
        margin: 0;
    }
    .table-container {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.02);
    }
    .table thead th {
        background-color: #f8fafc;
        border-bottom: 2px solid #f1f5f9;
        text-transform: uppercase;
        font-size: 10px;
        font-weight: 800;
        letter-spacing: 1px;
        color: #64748b;
        padding: 20px 25px;
    }
    .table tbody td {
        padding: 18px 25px;
        vertical-align: middle;
        font-size: 0.875rem;
        color: #334155;
    }
</style>

<div class="mb-5">
    <h2 class="fw-black tracking-tight mb-1">Ringkasan Bisnis</h2>
    <p class="text-muted small fw-bold">Selamat datang kembali, {{ auth()->user()->name }}. Berikut adalah performa Cuciin hari ini.</p>
</div>

<!-- KPI -->
<div class="row g-4 mb-5">
    <div class="col-md-6 col-xl-3">
        <div class="kpi-card d-flex align-items-center gap-4">
            <div class="kpi-icon bg-indigo-subtle text-primary"><i class="fas fa-tshirt"></i></div>
            <div>
                <p class="kpi-label">Layanan Aktif</p>
                <h3 class="kpi-value">{{ $totalLayanan }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="kpi-card d-flex align-items-center gap-4">
            <div class="kpi-icon bg-success-subtle text-success"><i class="fas fa-users"></i></div>
            <div>
                <p class="kpi-label">Pelanggan</p>
                <h3 class="kpi-value">{{ $totalPelanggan }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="kpi-card d-flex align-items-center gap-4">
            <div class="kpi-icon bg-warning-subtle text-warning"><i class="fas fa-receipt"></i></div>
            <div>
                <p class="kpi-label">Order Hari Ini</p>
                <h3 class="kpi-value">{{ $transaksiHariIni }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="kpi-card d-flex align-items-center gap-4" style="background-color: var(--primary-indigo)">
            <div class="kpi-icon bg-white bg-opacity-25 text-white"><i class="fas fa-wallet"></i></div>
            <div>
                <p class="kpi-label text-white text-opacity-75">Omzet Bulan Ini</p>
                <h3 class="kpi-value text-white">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Transactions -->
    <div class="col-lg-8">
        <div class="table-container">
            <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-white">
                <h5 class="fw-black mb-0">5 Transaksi Terbaru</h5>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-link text-primary fw-bold text-decoration-none small text-uppercase spacing-widest" style="font-size: 10px;">Lihat Semua</a>
            </div>
            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th>No Order</th>
                            <th>Pelanggan</th>
                            <th>Total</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksiTerbaru as $t)
                        <tr>
                            <td class="fw-black text-primary">{{ $t->no_order }}</td>
                            <td>
                                <div class="fw-bold">{{ $t->pelanggan->nama_pelanggan }}</div>
                                <div class="text-muted small" style="font-size: 10px;">{{ $t->pelanggan->kode_pelanggan }}</div>
                            </td>
                            <td class="fw-black">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @php
                                    $statusClass = [
                                        'diterima' => 'bg-secondary-subtle text-secondary',
                                        'dicuci' => 'bg-info-subtle text-info',
                                        'dijemur' => 'bg-warning-subtle text-warning',
                                        'disetrika' => 'bg-primary-subtle text-primary',
                                        'siap' => 'bg-success-subtle text-success',
                                        'diambil' => 'bg-dark-subtle text-dark',
                                        'batal' => 'bg-danger-subtle text-danger'
                                    ];
                                @endphp
                                <span class="badge rounded-pill fw-black text-uppercase {{ $statusClass[$t->status] ?? 'bg-light' }}" style="font-size: 9px; padding: 6px 12px;">
                                    {{ $t->status }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted fw-bold">Belum ada transaksi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Popular Services -->
    <div class="col-lg-4">
        <div class="table-container h-100">
            <div class="p-4 border-bottom bg-white">
                <h5 class="fw-black mb-0">Layanan Populer</h5>
                <p class="text-muted small fw-bold text-uppercase spacing-widest mt-1" style="font-size: 9px;">Bulan Ini</p>
            </div>
            <div class="p-3">
                <div class="list-group list-group-flush gap-2">
                    @forelse($layananPopuler as $lp)
                    <div class="list-group-item border-0 rounded-4 p-3 bg-light-subtle d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-white rounded-3 shadow-sm p-2 text-primary" style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-tshirt small"></i>
                            </div>
                            <div>
                                <div class="fw-black small text-dark">{{ $lp->nama_layanan }}</div>
                                <div class="text-muted" style="font-size: 10px;">Terjual {{ $lp->total_qty }}x</div>
                            </div>
                        </div>
                        <div class="progress" style="width: 60px; height: 4px;">
                            <div class="progress-bar bg-primary" style="width: {{ min(100, $lp->total_qty * 10) }}%"></div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5 text-muted small fw-bold">Belum ada data statistik</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
