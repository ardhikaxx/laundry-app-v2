@extends('layouts.app')
@section('title', 'Dashboard')
@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
@endsection

@section('content')
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card bg-primary text-white h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="kpi-icon bg-white bg-opacity-25 text-white me-3"><i class="fas fa-tshirt"></i></div>
                <div>
                    <h6 class="text-white-50 mb-1 fw-bold">Layanan Aktif</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalLayanan }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card bg-success text-white h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="kpi-icon bg-white bg-opacity-25 text-white me-3"><i class="fas fa-users"></i></div>
                <div>
                    <h6 class="text-white-50 mb-1 fw-bold">Total Pelanggan</h6>
                    <h3 class="mb-0 fw-bold">{{ $totalPelanggan }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card bg-warning text-dark h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="kpi-icon bg-white bg-opacity-50 text-dark me-3"><i class="fas fa-receipt"></i></div>
                <div>
                    <h6 class="text-black-50 mb-1 fw-bold">Transaksi Hari Ini</h6>
                    <h3 class="mb-0 fw-bold">{{ $transaksiHariIni }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card kpi-card bg-info text-white h-100 shadow-sm">
            <div class="card-body d-flex align-items-center">
                <div class="kpi-icon bg-white bg-opacity-25 text-white me-3"><i class="fas fa-wallet"></i></div>
                <div>
                    <h6 class="text-white-50 mb-1 fw-bold">Pendapatan Bulan Ini</h6>
                    <h4 class="mb-0 fw-bold">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-xl-8">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>5 Transaksi Terbaru</span>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-outline-primary">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">No Order</th>
                                <th>Pelanggan</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksiTerbaru as $t)
                            <tr>
                                <td class="px-3 fw-bold text-primary">{{ $t->no_order }}</td>
                                <td>{{ $t->pelanggan->nama_pelanggan }}</td>
                                <td>Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                                <td><span class="badge badge-{{ $t->status }} px-2 py-1">{{ strtoupper($t->status) }}</span></td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center text-muted py-3">Tidak ada transaksi</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-header">Layanan Terpopuler Bulan Ini</div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @forelse($layananPopuler as $lp)
                    <li class="list-group-item d-flex justify-content-between align-items-center px-3 py-3">
                        <div class="d-flex align-items-center">
                            <div class="bg-light rounded p-2 me-3 text-primary"><i class="fas fa-tshirt"></i></div>
                            <span class="fw-semibold">{{ $lp->nama_layanan }}</span>
                        </div>
                        <span class="badge bg-primary rounded-pill">{{ $lp->total_qty }}x</span>
                    </li>
                    @empty
                    <li class="list-group-item text-center text-muted py-4">Belum ada data</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
