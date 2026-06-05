@extends('layouts.app')
@section('title', 'Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Data Transaksi</h5>
        <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Buat Transaksi Baru
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3">No Order</th>
                        <th>Pelanggan</th>
                        <th>Tgl Masuk</th>
                        <th>Tgl Estimasi</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Pembayaran</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $transaksi)
                    <tr>
                        <td class="px-3 fw-bold text-primary">{{ $transaksi->no_order }}</td>
                        <td class="fw-semibold">{{ $transaksi->pelanggan->nama_pelanggan }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d/m/Y') }}</td>
                        <td class="text-end fw-bold">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                        <td class="text-center">
                            @if($transaksi->bayar >= $transaksi->total)
                                <span class="badge bg-success">Lunas</span>
                            @else
                                <span class="badge bg-danger">Belum Lunas</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <span class="badge badge-{{ $transaksi->status }} px-2 py-1">{{ strtoupper($transaksi->status) }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.transaksi.show', $transaksi) }}" class="btn btn-info btn-sm text-white" title="Detail / Kelola">
                                <i class="fas fa-cog"></i>
                            </a>
                            @if($transaksi->status !== 'batal')
                            <a href="{{ route('admin.transaksi.nota', $transaksi) }}" target="_blank" class="btn btn-secondary btn-sm" title="Cetak Nota">
                                <i class="fas fa-print"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Data transaksi tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($transaksis->hasPages())
    <div class="card-footer bg-white pt-3 pb-1">
        {{ $transaksis->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
