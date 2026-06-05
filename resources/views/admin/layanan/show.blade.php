@extends('layouts.app')
@section('title', 'Detail Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Layanan</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<style>
    .detail-card { background: white; border-radius: 30px; border: 1px solid #e2e8f0; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .label-meta { font-size: 0.65rem; font-weight: 800; text-transform: uppercase; letter-spacing: 1.5px; color: #94a3b8; margin-bottom: 8px; display: block; }
    .value-meta { font-weight: 900; color: #0f172a; font-size: 1.25rem; }
    .icon-box { width: 60px; height: 60px; border-radius: 20px; background: #f5f3ff; color: #4f46e5; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; }
</style>

<div class="mb-4 d-flex justify-content-between align-items-center">
    <div>
        <h2 class="fw-black mb-1">Detail Layanan</h2>
        <p class="text-muted small fw-bold mb-0">Informasi spesifikasi dan tarif layanan laundry.</p>
    </div>
    <a href="{{ route('admin.layanan.index') }}" class="btn btn-outline-secondary rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest">
        <i class="fas fa-arrow-left me-2 small"></i> Kembali
    </a>
</div>

<div class="detail-card">
    <div class="row g-5">
        <div class="col-md-auto text-center text-md-start">
            <div class="icon-box mx-auto mx-md-0 shadow-sm"><i class="fas fa-tshirt"></i></div>
            <div class="mt-4">
                @if($layanan->is_active)
                    <span class="badge bg-success-subtle text-success rounded-pill fw-black text-uppercase px-3 py-2" style="font-size: 9px;">Aktif & Tersedia</span>
                @else
                    <span class="badge bg-light text-muted rounded-pill fw-black text-uppercase px-3 py-2 border" style="font-size: 9px;">Nonaktif</span>
                @endif
            </div>
        </div>
        <div class="col-md">
            <div class="row g-4 mb-5">
                <div class="col-sm-6 col-lg-3">
                    <span class="label-meta">Kode Layanan</span>
                    <span class="value-meta text-primary">{{ $layanan->kode_layanan }}</span>
                </div>
                <div class="col-sm-6 col-lg-5">
                    <span class="label-meta">Nama Layanan</span>
                    <span class="value-meta">{{ $layanan->nama_layanan }}</span>
                </div>
                <div class="col-sm-6 col-lg-4">
                    <span class="label-meta">Kategori</span>
                    <span class="badge bg-indigo-subtle text-primary rounded-3 fw-black text-uppercase" style="font-size: 11px; padding: 10px 15px;">{{ $layanan->kategori->nama_kategori ?? '-' }}</span>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-sm-6 col-lg-3">
                    <span class="label-meta">Harga Tarif</span>
                    <span class="value-meta">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</span>
                    <small class="text-muted fw-bold">/ {{ strtoupper($layanan->satuan) }}</small>
                </div>
                <div class="col-sm-6 col-lg-3">
                    <span class="label-meta">Estimasi Selesai</span>
                    <span class="value-meta">{{ $layanan->estimasi_hari }} <span class="small fw-bold text-muted">Hari Kerja</span></span>
                </div>
            </div>

            <div class="mb-5">
                <span class="label-meta">Deskripsi Layanan</span>
                <p class="text-muted leading-relaxed fw-medium mb-0">"{{ $layanan->deskripsi ?: 'Tidak ada deskripsi tambahan untuk layanan ini.' }}"</p>
            </div>

            <hr class="my-5 opacity-10">

            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.layanan.edit', $layanan) }}" class="btn btn-warning rounded-4 px-5 py-3 fw-black text-uppercase small spacing-widest text-white shadow-sm">
                    <i class="fas fa-edit me-2 small"></i> Ubah Data
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
