@extends('layouts.public')

@section('content')
<style>
    .hero-section {
        padding: 100px 0;
        position: relative;
        overflow: hidden;
        background-color: white;
    }
    .hero-title {
        font-weight: 800;
        font-size: 4rem;
        line-height: 1.1;
        letter-spacing: -2px;
        color: #0f172a;
    }
    .hero-subtitle {
        font-size: 1.25rem;
        color: #64748b;
        margin: 2rem 0;
        max-width: 550px;
    }
    .feature-card {
        border: 1px solid #e2e8f0;
        border-radius: 25px;
        padding: 40px;
        background: white;
        transition: all 0.3s;
        height: 100%;
    }
    .feature-card:hover {
        border-color: #c7d2fe;
        box-shadow: 0 20px 40px -15px rgba(79, 70, 229, 0.1);
        transform: translateY(-5px);
    }
    .feature-icon {
        width: 60px;
        height: 60px;
        background-color: #f5f3ff;
        color: #4f46e5;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 25px;
    }
    .btn-hero-primary {
        background-color: #4f46e5;
        color: white;
        padding: 15px 35px;
        border-radius: 15px;
        font-weight: 800;
        border: none;
        box-shadow: 0 10px 20px rgba(79, 70, 229, 0.3);
    }
    .btn-hero-outline {
        background-color: white;
        color: #0f172a;
        padding: 15px 35px;
        border-radius: 15px;
        font-weight: 800;
        border: 1px solid #e2e8f0;
    }
    .section-title { font-weight: 800; font-size: 2.5rem; letter-spacing: -1px; }
    .badge-premium {
        background-color: #f5f3ff;
        color: #4f46e5;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 2px;
        font-size: 0.7rem;
        padding: 8px 15px;
        border-radius: 50px;
    }
</style>

<!-- Hero -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6">
                <span class="badge-premium mb-4 d-inline-block">The Premium Choice</span>
                <h1 class="hero-title">Layanan Laundry <br><span style="color: #4f46e5">Kelas Dunia.</span></h1>
                <p class="hero-subtitle">Kombinasi sempurna antara teknologi mutakhir dan perhatian terhadap detail untuk memastikan pakaian Anda selalu bersih sempurna.</p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('public.layanan') }}" class="btn btn-hero-primary">Mulai Sekarang <i class="fas fa-arrow-right ms-2 small"></i></a>
                    <a href="{{ route('public.pelanggan') }}" class="btn btn-hero-outline">Cek Status</a>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="rounded-5 overflow-hidden shadow-lg" style="background-color: #111827; aspect-ratio: 4/5; display: flex; align-items: center; justify-content: center;">
                    <div class="text-center text-white opacity-25">
                        <i class="fas fa-soap" style="font-size: 150px;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="py-5" style="background-color: #f8fafc;">
    <div class="container py-5">
        <div class="row mb-5">
            <div class="col-lg-6">
                <h6 class="text-uppercase fw-bold text-primary small spacing-widest">Superiority</h6>
                <h2 class="section-title">Mengapa Memilih Cuciin?</h2>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-bolt"></i></div>
                    <h4 class="fw-bold mb-3">Express Service</h4>
                    <p class="text-muted small mb-0">Sistem antrean cerdas kami memastikan pakaian Anda selesai tepat waktu tanpa kompromi pada kualitas.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-hand-sparkles"></i></div>
                    <h4 class="fw-bold mb-3">Eco-Friendly</h4>
                    <p class="text-muted small mb-0">Menggunakan deterjen biodegradable premium yang aman untuk serat kain dan sangat ramah lingkungan.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon"><i class="fas fa-gem"></i></div>
                    <h4 class="fw-bold mb-3">Premium Care</h4>
                    <p class="text-muted small mb-0">Perawatan khusus untuk setiap jenis bahan, mulai dari katun halus hingga sutra yang berharga.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="container mb-5">
    <div class="rounded-5 p-5 text-center text-white shadow-lg" style="background: linear-gradient(135deg, #1e293b, #0f172a); padding: 80px !important;">
        <h2 class="fw-bold display-5 mb-4">Siap Memberikan yang Terbaik <br> untuk Pakaian Anda?</h2>
        <p class="lead opacity-75 mb-5 mx-auto" style="max-width: 600px;">Nikmati layanan antar-jemput eksklusif dan kemudahan pelacakan cucian secara digital.</p>
        <div class="d-flex justify-content-center gap-3">
            <a href="#" class="btn btn-light rounded-4 px-5 py-3 fw-bold">Hubungi WhatsApp</a>
            <a href="{{ route('public.layanan') }}" class="btn btn-outline-light rounded-4 px-5 py-3 fw-bold">Daftar Harga</a>
        </div>
    </div>
</section>
@endsection
