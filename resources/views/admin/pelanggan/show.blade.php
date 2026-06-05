@extends('layouts.app')
@section('title', 'Detail Pelanggan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pelanggan.index') }}">Pelanggan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white text-center pt-4 pb-0 border-0">
                <div class="bg-primary text-white d-inline-flex justify-content-center align-items-center rounded-circle mb-3" style="width: 80px; height: 80px; font-size: 2.5rem;">
                    {{ substr($pelanggan->nama_pelanggan, 0, 1) }}
                </div>
                <h5 class="fw-bold mb-0">{{ $pelanggan->nama_pelanggan }}</h5>
                <p class="text-muted">{{ $pelanggan->kode_pelanggan }}</p>
            </div>
            <div class="card-body pt-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-venus-mars me-2"></i>Jenis Kelamin</span>
                        <span class="fw-semibold">{{ $pelanggan->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-phone me-2"></i>Telepon</span>
                        <span class="fw-semibold">{{ $pelanggan->no_telepon }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-envelope me-2"></i>Email</span>
                        <span class="fw-semibold">{{ $pelanggan->email ?: '-' }}</span>
                    </li>
                    <li class="list-group-item px-0 d-flex justify-content-between align-items-center">
                        <span class="text-muted"><i class="fas fa-calendar-alt me-2"></i>Tgl Daftar</span>
                        <span class="fw-semibold">{{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d/m/Y') }}</span>
                    </li>
                </ul>
                <div class="mt-4 text-center">
                    <a href="{{ route('admin.pelanggan.cetak', $pelanggan) }}" target="_blank" class="btn btn-outline-primary w-100 mb-2">
                        <i class="fas fa-print me-1"></i> Cetak Kartu
                    </a>
                    <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-primary w-100">
                        <i class="fas fa-edit me-1"></i> Ubah Profil
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-8 mb-4">
        <div class="card h-100 border-0 shadow-sm">
            <div class="card-header bg-white border-bottom">
                <h6 class="mb-0 fw-bold"><i class="fas fa-history me-2 text-primary"></i>Riwayat Transaksi</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">No Order</th>
                                <th>Tgl Masuk</th>
                                <th class="text-end">Total</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $t)
                            <tr>
                                <td class="px-3 fw-semibold text-primary">{{ $t->no_order }}</td>
                                <td>{{ \Carbon\Carbon::parse($t->tanggal_masuk)->format('d/m/Y') }}</td>
                                <td class="text-end fw-bold">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="badge badge-{{ $t->status }} px-2 py-1">{{ strtoupper($t->status) }}</span>
                                </td>
                                <td class="text-end pe-3">
                                    <a href="{{ route('admin.transaksi.show', $t) }}" class="btn btn-sm btn-light" title="Detail">
                                        <i class="fas fa-chevron-right"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">Belum ada riwayat transaksi.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            @if($transaksis->hasPages())
            <div class="card-footer bg-white">
                {{ $transaksis->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
