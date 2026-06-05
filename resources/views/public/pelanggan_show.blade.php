@extends('layouts.public')
@section('title', 'Detail Cucian - ' . $pelanggan->nama_pelanggan)

@section('content')
<style>
    .order-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 40px;
        overflow: hidden;
        margin-bottom: 40px;
        box-shadow: 0 40px 80px -20px rgba(0,0,0,0.05);
        transition: all 0.3s;
    }
    .order-card:hover {
        box-shadow: 0 40px 80px -20px rgba(79, 70, 229, 0.1);
    }
    .status-badge {
        font-size: 0.65rem;
        font-weight: 900;
        text-transform: uppercase;
        letter-spacing: 1px;
        padding: 8px 15px;
        border-radius: 50px;
    }
    .progress-bar-custom {
        height: 8px;
        border-radius: 10px;
        background-color: #f1f5f9;
        margin-top: 15px;
        overflow: hidden;
    }
    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #6366f1, #4f46e5);
        transition: width 1s ease-in-out;
    }
    .info-pill {
        background-color: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 15px;
        padding: 15px;
        text-align: center;
    }
</style>

<div class="container py-5">
    <!-- Header -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-5 gap-4">
        <div>
            <h6 class="text-uppercase fw-bold text-primary small spacing-widest mb-2">Transaction History</h6>
            <h1 class="fw-black display-5" style="letter-spacing: -2px;">Status Cucian: <span class="text-primary">{{ $pelanggan->nama_pelanggan }}</span></h1>
        </div>
        <a href="{{ route('public.pelanggan') }}" class="btn btn-outline-secondary rounded-4 px-4 py-2 fw-black text-uppercase small spacing-widest">
            <i class="fas fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div class="row g-4">
        @forelse($transaksis as $transaksi)
        <div class="col-lg-6 col-xl-4">
            <div class="order-card">
                <div class="p-4 border-bottom d-flex justify-content-between align-items-center bg-light">
                    <span class="fw-black text-dark fs-5">{{ $transaksi->no_order }}</span>
                    @php
                        $statusStyles = [
                            'diterima' => 'bg-secondary text-white',
                            'dicuci' => 'bg-info text-dark',
                            'dijemur' => 'bg-warning text-dark',
                            'disetrika' => 'bg-primary text-white',
                            'siap' => 'bg-success text-white',
                            'diambil' => 'bg-dark text-white',
                            'batal' => 'bg-danger text-white'
                        ];
                        $progress = ['diterima' => 15, 'dicuci' => 40, 'dijemur' => 60, 'disetrika' => 80, 'siap' => 100, 'diambil' => 100, 'batal' => 0];
                        $pVal = $progress[$transaksi->status] ?? 0;
                    @endphp
                    <span class="status-badge {{ $statusStyles[$transaksi->status] ?? 'bg-secondary' }}">
                        {{ strtoupper($transaksi->status) }}
                    </span>
                </div>
                
                <div class="p-4">
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="info-pill">
                                <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="font-size: 8px;">Order Date</span>
                                <span class="fw-black small text-dark">{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="info-pill">
                                <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="font-size: 8px;">Estimation</span>
                                <span class="fw-black small text-primary">{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mb-4">
                        <h6 class="fw-black text-uppercase small spacing-widest text-muted mb-3" style="font-size: 10px;">Service Details</h6>
                        <ul class="list-unstyled mb-0">
                            @foreach($transaksi->detail as $item)
                            <li class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-dark fw-bold small"><span class="badge bg-light text-primary me-2">{{ $item->qty }}x</span> {{ $item->nama_layanan }}</span>
                                <span class="text-muted fw-black small">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="pt-4 border-top d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="font-size: 8px;">Total Payment</span>
                            <span class="fw-black fs-4 text-primary tracking-tighter">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-end">
                            <span class="d-block text-muted small fw-bold text-uppercase mb-1" style="font-size: 8px;">Payment Status</span>
                            <span class="fw-black text-uppercase small {{ $transaksi->bayar >= $transaksi->total ? 'text-success' : 'text-danger' }}" style="font-size: 10px;">
                                {{ $transaksi->bayar >= $transaksi->total ? 'Paid' : 'Unpaid' }}
                            </span>
                        </div>
                    </div>

                    @if($transaksi->status != 'diambil' && $transaksi->status != 'batal')
                    <div class="mt-4 pt-3 border-top">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted small fw-bold text-uppercase" style="font-size: 8px;">Overall Progress</span>
                            <span class="fw-black text-primary" style="font-size: 10px;">{{ $pVal }}%</span>
                        </div>
                        <div class="progress-bar-custom">
                            <div class="progress-fill" style="width: {{ $pVal }}%"></div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="bg-light rounded-pill d-inline-flex p-5 mb-4 shadow-sm">
                <i class="fas fa-receipt fs-1 text-muted opacity-25"></i>
            </div>
            <h2 class="fw-black">Belum Ada Transaksi</h2>
            <p class="text-muted">Sistem kami belum mencatat riwayat transaksi untuk akun pelanggan ini.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
