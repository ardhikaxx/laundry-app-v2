@extends('layouts.app')
@section('title', 'Laporan Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Laporan</li>
@endsection

@section('content')
<style>
    .filter-card { background: white; border-radius: 30px; border: 1px solid #e2e8f0; padding: 30px; margin-bottom: 30px; }
    .report-table { background: white; border-radius: 30px; border: 1px solid #e2e8f0; overflow: hidden; }
    .total-banner { background: #4f46e5; border-radius: 20px; padding: 30px; color: white; margin-bottom: 30px; }
</style>

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-black mb-1">Laporan Keuangan</h2>
        <p class="text-muted small fw-bold mb-0">Analisa performa bisnis dan cetak laporan berkala.</p>
    </div>
    <a href="{{ route('admin.laporan.export-pdf', request()->all()) }}" target="_blank" class="btn btn-danger rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest shadow-sm">
        <i class="fas fa-file-pdf me-2"></i> Export ke PDF
    </a>
</div>

<div class="filter-card shadow-sm">
    <form action="{{ route('admin.laporan.index') }}" method="GET" class="row g-3 align-items-end">
        <div class="col-md-3">
            <label class="form-label small fw-black text-muted text-uppercase spacing-widest" style="font-size: 9px;">Dari Tanggal</label>
            <input type="date" name="dari_tanggal" class="form-control border-0 bg-light rounded-3 p-3 fw-bold small" value="{{ request('dari_tanggal') }}">
        </div>
        <div class="col-md-3">
            <label class="form-label small fw-black text-muted text-uppercase spacing-widest" style="font-size: 9px;">Sampai Tanggal</label>
            <input type="date" name="sampai_tanggal" class="form-control border-0 bg-light rounded-3 p-3 fw-bold small" value="{{ request('sampai_tanggal') }}">
        </div>
        <div class="col-md-2">
            <label class="form-label small fw-black text-muted text-uppercase spacing-widest" style="font-size: 9px;">Status</label>
            <select name="status" class="form-select border-0 bg-light rounded-3 p-3 fw-bold small">
                <option value="">Semua</option>
                <option value="diterima" {{ request('status') == 'diterima' ? 'selected' : '' }}>Diterima</option>
                <option value="siap" {{ request('status') == 'siap' ? 'selected' : '' }}>Siap</option>
                <option value="diambil" {{ request('status') == 'diambil' ? 'selected' : '' }}>Diambil</option>
                <option value="batal" {{ request('status') == 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label small fw-black text-muted text-uppercase spacing-widest" style="font-size: 9px;">Metode</label>
            <select name="metode_bayar" class="form-select border-0 bg-light rounded-3 p-3 fw-bold small">
                <option value="">Semua</option>
                <option value="tunai" {{ request('metode_bayar') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                <option value="transfer" {{ request('metode_bayar') == 'transfer' ? 'selected' : '' }}>Transfer</option>
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-dark w-100 rounded-3 py-3 fw-black text-uppercase small">Filter</button>
        </div>
    </form>
</div>

<div class="report-table shadow-sm">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">No Order</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Tanggal</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Pelanggan</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Status</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-end" style="font-size: 9px;">Total (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @php $totalSemua = 0; @endphp
                @forelse($data as $item)
                @php if($item->status !== 'batal') $totalSemua += $item->total; @endphp
                <tr>
                    <td class="px-4 py-3 fw-black text-primary">{{ $item->no_order }}</td>
                    <td class="px-4 py-3 text-muted small fw-bold">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
                    <td class="px-4 py-3 fw-black text-dark">{{ $item->pelanggan->nama_pelanggan }}</td>
                    <td class="px-4 py-3 text-center">
                        <span class="badge rounded-pill fw-black text-uppercase bg-light text-dark border" style="font-size: 8px;">{{ $item->status }}</span>
                    </td>
                    <td class="px-4 py-3 text-end fw-black">Rp {{ number_format($item->total, 0, ',', '.') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted fw-bold">Data tidak ditemukan</td></tr>
                @endforelse
            </tbody>
            <tfoot class="bg-indigo-subtle">
                <tr>
                    <th colspan="4" class="px-4 py-4 text-end text-uppercase fw-black text-primary">Total Pendapatan Bersih (Non-Batal):</th>
                    <th class="px-4 py-4 text-end fs-4 fw-black text-primary">Rp {{ number_format($totalSemua, 0, ',', '.') }}</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
@endsection
