@extends('layouts.app')
@section('title', 'Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Transaksi</li>
@endsection

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-black mb-1">Operasional Transaksi</h2>
        <p class="text-muted small fw-bold mb-0">Pantau dan kelola seluruh pesanan laundry yang sedang diproses.</p>
    </div>
    <a href="{{ route('admin.transaksi.create') }}" class="btn btn-primary rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest shadow-sm">
        <i class="fas fa-plus me-2"></i> Buat Transaksi
    </a>
</div>

<div class="card border-0 shadow-sm rounded-5 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">No Order</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Pelanggan</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Tgl Masuk</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-end" style="font-size: 9px;">Total</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Status</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Bayar</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($transaksis as $transaksi)
                <tr>
                    <td class="px-4 py-3 fw-black text-primary">{{ $transaksi->no_order }}</td>
                    <td class="px-4 py-3">
                        <div class="fw-black text-dark">{{ $transaksi->pelanggan->nama_pelanggan }}</div>
                        <div class="text-muted small fw-bold" style="font-size: 10px;">{{ $transaksi->pelanggan->kode_pelanggan }}</div>
                    </td>
                    <td class="px-4 py-3 text-muted small fw-bold">{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-end fw-black">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center">
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
                        <span class="badge rounded-pill fw-black text-uppercase {{ $statusClass[$transaksi->status] ?? 'bg-light' }}" style="font-size: 8px;">
                            {{ $transaksi->status }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if($transaksi->bayar >= $transaksi->total)
                            <span class="badge bg-emerald-subtle text-success rounded-pill fw-black" style="font-size: 8px;">LUNAS</span>
                        @else
                            <span class="badge bg-danger-subtle text-danger rounded-pill fw-black" style="font-size: 8px;">UNPAID</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.transaksi.show', $transaksi) }}" class="btn btn-indigo-subtle btn-sm rounded-3 text-primary"><i class="fas fa-cog"></i></a>
                            <a href="{{ route('admin.transaksi.nota', $transaksi) }}" target="_blank" class="btn btn-light btn-sm rounded-3 border"><i class="fas fa-print"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-5 text-muted fw-bold">Data tidak ditemukan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($transaksis->hasPages())
    <div class="card-footer bg-white border-top-0 p-4">
        {{ $transaksis->links() }}
    </div>
    @endif
</div>
@endsection
