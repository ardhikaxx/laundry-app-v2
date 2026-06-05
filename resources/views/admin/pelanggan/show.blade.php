@extends('layouts.app')
@section('title', 'Detail Pelanggan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pelanggan.index') }}">Pelanggan</a></li>
    <li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')
<style>
    .profile-header { background: #4f46e5; border-radius: 30px; padding: 40px; color: white; position: relative; overflow: hidden; margin-bottom: 30px; }
    .profile-header::after { content: ''; position: absolute; width: 300px; height: 300px; background: white; opacity: 0.05; border-radius: 50%; top: -150px; right: -100px; }
    .avatar-lg { width: 100px; height: 100px; border-radius: 30px; background: white; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 3rem; font-weight: 900; shadow: 0 10px 20px rgba(0,0,0,0.1); }
    .info-card { background: white; border-radius: 30px; border: 1px solid #e2e8f0; padding: 30px; height: 100%; }
</style>

<div class="profile-header d-flex flex-column flex-md-row align-items-center gap-4">
    <div class="avatar-lg">{{ substr($pelanggan->nama_pelanggan, 0, 1) }}</div>
    <div class="text-center text-md-start">
        <h2 class="fw-black mb-1">{{ $pelanggan->nama_pelanggan }}</h2>
        <p class="mb-3 fw-bold text-white text-opacity-75 uppercase spacing-widest small">{{ $pelanggan->kode_pelanggan }}</p>
        <div class="d-flex gap-2 justify-content-center justify-content-md-start">
            <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-2 fw-black small uppercase">{{ $pelanggan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
            <span class="badge bg-white bg-opacity-25 rounded-pill px-3 py-2 fw-black small uppercase">{{ $pelanggan->total_transaksi }}x Transaksi</span>
        </div>
    </div>
    <div class="ms-md-auto d-flex gap-2">
        <a href="{{ route('admin.pelanggan.cetak', $pelanggan) }}" target="_blank" class="btn btn-white bg-white rounded-3 fw-black px-4 py-2 shadow-sm border-0">Cetak Kartu</a>
        <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-outline-light rounded-3 fw-black px-4 py-2 border-opacity-25">Ubah Profil</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-4">
        <div class="info-card">
            <h5 class="fw-black mb-4">Informasi Kontak</h5>
            <div class="mb-4">
                <label class="small fw-black text-muted text-uppercase spacing-widest mb-1 d-block" style="font-size: 10px;">Nomor Telepon</label>
                <p class="fw-bold text-dark fs-5">{{ $pelanggan->no_telepon }}</p>
            </div>
            <div class="mb-4">
                <label class="small fw-black text-muted text-uppercase spacing-widest mb-1 d-block" style="font-size: 10px;">Alamat Email</label>
                <p class="fw-bold text-dark">{{ $pelanggan->email ?: 'Tidak tersedia' }}</p>
            </div>
            <div class="mb-4">
                <label class="small fw-black text-muted text-uppercase spacing-widest mb-1 d-block" style="font-size: 10px;">Alamat Lengkap</label>
                <p class="fw-medium text-muted small leading-relaxed">{{ $pelanggan->alamat }}</p>
            </div>
            <div class="mb-0 pt-3 border-top">
                <label class="small fw-black text-muted text-uppercase spacing-widest mb-1 d-block" style="font-size: 10px;">Member Sejak</label>
                <p class="fw-bold text-dark mb-0">{{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d M Y') }}</p>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="info-card">
            <h5 class="fw-black mb-4">Riwayat Transaksi</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3">No Order</th>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3">Tanggal</th>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3 text-end">Total</th>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3 text-center">Status</th>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksis as $t)
                        <tr>
                            <td class="p-3 fw-black text-primary">{{ $t->no_order }}</td>
                            <td class="p-3 text-muted small fw-bold">{{ \Carbon\Carbon::parse($t->tanggal_masuk)->format('d M Y') }}</td>
                            <td class="p-3 text-end fw-black">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
                            <td class="p-3 text-center">
                                <span class="badge bg-light text-dark rounded-pill fw-black uppercase border" style="font-size: 8px;">{{ $t->status }}</span>
                            </td>
                            <td class="p-3 text-center">
                                <a href="{{ route('admin.transaksi.show', $t) }}" class="btn btn-light btn-sm rounded-circle"><i class="fas fa-chevron-right small text-muted"></i></a>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center py-5 text-muted fw-bold small uppercase spacing-widest">Belum ada riwayat transaksi</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($transaksis->hasPages())
            <div class="mt-4">
                {{ $transaksis->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
