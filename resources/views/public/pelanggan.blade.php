@extends('layouts.public')
@section('title', 'Cek Status Cucian')

@section('content')
<style>
    .search-header {
        background-color: #0f172a;
        padding: 100px 0;
        position: relative;
        overflow: hidden;
    }
    .search-header::before {
        content: '';
        position: absolute;
        width: 400px; height: 400px;
        background: #4f46e5;
        border-radius: 50%;
        filter: blur(100px);
        opacity: 0.1;
        top: -200px; left: -100px;
    }
    .search-input-group {
        max-width: 650px;
        margin: 40px auto 0;
    }
    .search-input {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        border-radius: 20px;
        padding: 20px 30px;
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
    }
    .search-input:focus {
        background: white;
        color: #0f172a;
        border-color: #4f46e5;
        box-shadow: 0 0 0 5px rgba(79, 70, 229, 0.2);
    }
    .search-btn {
        background-color: #4f46e5;
        color: white;
        border: none;
        border-radius: 15px;
        padding: 0 30px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .customer-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 30px;
        padding: 40px;
        transition: all 0.3s;
        height: 100%;
    }
    .customer-card:hover {
        border-color: #c7d2fe;
        box-shadow: 0 25px 50px -12px rgba(79, 70, 229, 0.15);
        transform: translateY(-5px);
    }
    .initial-circle {
        width: 80px; height: 80px;
        background-color: #f5f3ff;
        color: #4f46e5;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 25px;
    }
    .info-box {
        background-color: #f8fafc;
        border-radius: 15px;
        padding: 20px;
        margin-bottom: 25px;
    }
</style>

<div class="search-header">
    <div class="container text-center text-white position-relative">
        <h6 class="text-uppercase fw-bold text-primary small spacing-widest mb-3" style="color: #818cf8 !important;">Real-time Tracking</h6>
        <h1 class="fw-black display-4 mb-3" style="letter-spacing: -2px;">Lacak Pesanan Anda</h1>
        <p class="text-white-50 mx-auto" style="max-width: 600px;">Pantau progress cucian Anda secara langsung hanya dengan Nama, Kode Pelanggan, atau Nomor Telepon.</p>
        
        <form action="{{ route('public.pelanggan') }}" method="GET" class="search-input-group">
            <div class="input-group">
                <input type="text" name="cari" class="form-control search-input" placeholder="Contoh: PLG-2026... atau 0812..." value="{{ request('cari') }}" required>
                <button class="btn search-btn ms-2" type="submit">Cari</button>
            </div>
        </form>
    </div>
</div>

<div class="container py-5" style="min-height: 400px;">
    @if(request('cari'))
        @if($pelanggans->count() > 0)
            <div class="row g-4 pt-4">
                @foreach($pelanggans as $pelanggan)
                <div class="col-md-6 col-lg-4">
                    <div class="customer-card d-flex flex-column">
                        <div class="initial-circle">{{ substr($pelanggan->nama_pelanggan, 0, 1) }}</div>
                        <h3 class="fw-black text-dark mb-1">{{ $pelanggan->nama_pelanggan }}</h3>
                        <p class="text-muted small fw-bold text-uppercase spacing-widest mb-4">{{ $pelanggan->kode_pelanggan }}</p>
                        
                        <div class="info-box">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted small fw-bold text-uppercase">Phone</span>
                                <span class="fw-black small">{{ substr($pelanggan->no_telepon, 0, 4) . '****' . substr($pelanggan->no_telepon, -3) }}</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted small fw-bold text-uppercase">Member Since</span>
                                <span class="fw-black small">{{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d M Y') }}</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('public.pelanggan.show', $pelanggan->kode_pelanggan) }}" class="btn btn-dark w-100 rounded-4 py-3 fw-black text-uppercase small spacing-widest shadow-sm mt-auto">
                            Lihat Detail <i class="fas fa-chevron-right ms-2 small"></i>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <div class="bg-light rounded-circle d-inline-flex p-5 mb-4 shadow-sm">
                    <i class="fas fa-user-slash fs-1 text-danger opacity-50"></i>
                </div>
                <h2 class="fw-black">Data Tidak Ditemukan</h2>
                <p class="text-muted mx-auto" style="max-width: 400px;">Maaf, kami tidak dapat menemukan data pelanggan dengan input tersebut. Mohon pastikan kembali data Anda.</p>
                <a href="{{ route('public.pelanggan') }}" class="btn btn-link text-primary fw-bold text-decoration-none mt-3">
                    <i class="fas fa-undo me-2"></i> Reset Pencarian
                </a>
            </div>
        @endif
    @else
        <div class="text-center py-5 opacity-25 mt-5">
            <i class="fas fa-tshirt" style="font-size: 100px; color: #94a3b8;"></i>
            <h4 class="fw-black mt-4 text-uppercase spacing-widest">Input Search Criteria</h4>
        </div>
    @endif
</div>
@endsection
