@extends('layouts.public')
@section('title', 'Daftar Layanan')

@section('content')
<style>
    .page-header {
        background-color: white;
        border-bottom: 1px solid #e2e8f0;
        padding: 60px 0;
        text-align: center;
    }
    .filter-btn {
        border-radius: 50px;
        padding: 10px 25px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin: 5px;
        transition: all 0.3s;
        border: 1px solid #e2e8f0;
        background: white;
        color: #64748b;
    }
    .filter-btn.active {
        background-color: #4f46e5;
        color: white;
        border-color: #4f46e5;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.2);
    }
    .service-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 25px;
        padding: 30px;
        height: 100%;
        transition: all 0.3s;
    }
    .service-card:hover {
        border-color: #c7d2fe;
        box-shadow: 0 20px 40px -15px rgba(79, 70, 229, 0.1);
        transform: translateY(-5px);
    }
    .category-badge {
        background-color: #f5f3ff;
        color: #4f46e5;
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 5px 12px;
        border-radius: 10px;
    }
    .price-tag {
        font-size: 1.75rem;
        font-weight: 900;
        color: #0f172a;
        letter-spacing: -1px;
    }
    .unit-text {
        font-size: 0.85rem;
        color: #94a3b8;
        font-weight: 600;
    }
</style>

<div class="page-header">
    <div class="container">
        <h6 class="text-uppercase fw-bold text-primary small spacing-widest mb-3">Our Collection</h6>
        <h1 class="fw-black display-4 mb-3" style="letter-spacing: -2px;">Katalog Layanan</h1>
        <p class="text-muted mx-auto" style="max-width: 600px;">Pilihan perawatan pakaian yang dipersonalisasi untuk setiap kebutuhan Anda, dengan standar kualitas tertinggi.</p>
    </div>
</div>

<div class="container py-5">
    <!-- Filter -->
    <div class="d-flex flex-wrap justify-content-center mb-5">
        <a href="{{ route('public.layanan') }}" class="btn filter-btn {{ !$kategoriId ? 'active' : '' }}">Semua Layanan</a>
        @foreach($kategoris as $kat)
            <a href="{{ route('public.layanan', ['kategori' => $kat->id]) }}" class="btn filter-btn {{ $kategoriId == $kat->id ? 'active' : '' }}">{{ $kat->nama_kategori }}</a>
        @endforeach
    </div>

    <!-- Grid -->
    <div class="row g-4">
        @forelse($layanans as $layanan)
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="service-card d-flex flex-column">
                <div class="d-flex justify-content-between align-items-start mb-4">
                    <span class="category-badge">{{ $layanan->kategori->nama_kategori ?? 'Umum' }}</span>
                    <small class="text-muted fw-bold small"><i class="fas fa-history me-1 text-primary"></i> {{ $layanan->estimasi_hari }} Days</small>
                </div>
                <h4 class="fw-bold mb-3">{{ $layanan->nama_layanan }}</h4>
                <div class="mb-3">
                    <span class="price-tag">Rp{{ number_format($layanan->harga, 0, ',', '.') }}</span>
                    <span class="unit-text">/ {{ $layanan->satuan }}</span>
                </div>
                <p class="text-muted small mb-4 flex-grow-1">{{ $layanan->deskripsi ?: 'Perawatan mendalam untuk serat pakaian Anda dengan hasil yang memuaskan.' }}</p>
                <div class="pt-4 border-top d-flex justify-content-between align-items-center">
                    <span class="text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 1px; color: #94a3b8;"><i class="fas fa-check-circle me-1 text-success"></i> Active</span>
                    <div class="btn btn-light rounded-circle p-0 d-flex align-items-center justify-content-center" style="width: 35px; height: 35px;">
                        <i class="fas fa-plus text-primary small"></i>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light rounded-pill d-inline-flex p-4 mb-4">
                <i class="fas fa-search fs-1 text-muted opacity-25"></i>
            </div>
            <h3 class="fw-bold">Tidak ada layanan ditemukan</h3>
            <p class="text-muted">Maaf, kami belum memiliki layanan di kategori ini.</p>
            <a href="{{ route('public.layanan') }}" class="btn btn-link text-primary fw-bold text-decoration-none mt-3">
                <i class="fas fa-undo me-2"></i> Reset Filter
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
