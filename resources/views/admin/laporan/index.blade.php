@extends('layouts.app')
@section('title', 'Laporan Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Laporan</li>
@endsection

@section('content')
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-white">
        <h6 class="mb-0 fw-bold"><i class="fas fa-filter me-2 text-primary"></i>Filter Laporan</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.laporan.index') }}" method="GET" class="row g-3 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted">Dari Tanggal</label>
                <input type="date" name="dari_tanggal" class="form-control" value="{{ request('dari_tanggal') }}">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-bold text-muted">Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" class="form-control" value="{{ request('sampai_tanggal') }}">
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold text-muted">Status</label>
                <select name="status" class="form-select">
                    <option value="">Semua</option>
                    <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="siap" {{ request('status') == 'siap' ? 'selected' : '' }}>Siap</option>
                    <option value="diambil" {{ request('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
                    <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label small fw-bold text-muted">Metode Bayar</label>
                <select name="metode_bayar" class="form-select">
                    <option value="">Semua</option>
                    <option value="tunai" {{ request('metode_bayar') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                    <option value="transfer" {{ request('metode_bayar') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                </select>
            </div>
            <div class="col-md-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Laporan Transaksi</h5>
        <div>
            <!--
            <a href="{{ route('admin.laporan.cetak', request()->all()) }}" target="_blank" class="btn btn-outline-secondary btn-sm me-2">
                <i class="fas fa-print me-1"></i> Print
            </a>
            -->
            <a href="{{ route('admin.laporan.export-pdf', request()->all()) }}" target="_blank" class="btn btn-danger btn-sm">
                <i class="fas fa-file-pdf me-1"></i> Export PDF
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3">No</th>
                        <th>Tgl Masuk</th>
                        <th>No Order</th>
                        <th>Pelanggan</th>
                        <th>Metode Bayar</th>
                        <th class="text-center">Status</th>
                        <th class="text-end pe-3">Total (Rp)</th>
                    </tr>
                </thead>
                <tbody>
                    @php $totalSemua = 0; @endphp
                    @forelse($data as $i => $item)
                    @php 
                        if($item->status !== 'batal') $totalSemua += $item->total; 
                    @endphp
                    <tr>
                        <td class="px-3">{{ $i + 1 }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td class="fw-bold">{{ $item->no_order }}</td>
                        <td>{{ $item->pelanggan->nama_pelanggan }}</td>
                        <td>{{ strtoupper($item->metode_bayar) }}</td>
                        <td class="text-center"><span class="badge badge-{{ $item->status }}">{{ strtoupper($item->status) }}</span></td>
                        <td class="text-end pe-3">{{ number_format($item->total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">Data tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot class="table-light">
                    <tr>
                        <th colspan="6" class="text-end py-3">Total Pendapatan (Diluar Batal):</th>
                        <th class="text-end pe-3 py-3 fs-5 text-primary fw-bold">Rp {{ number_format($totalSemua, 0, ',', '.') }}</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
