@extends('layouts.app')
@section('title', 'Kelola Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.transaksi.index') }}">Transaksi</a></li>
    <li class="breadcrumb-item active">{{ $transaksi->no_order }}</li>
@endsection

@section('content')
<style>
    .status-header { border-radius: 30px; padding: 40px; margin-bottom: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
    .info-card { background: white; border-radius: 30px; border: 1px solid #e2e8f0; padding: 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .status-step { position: relative; padding-left: 45px; margin-bottom: 35px; }
    .status-step::before { content: ''; position: absolute; left: 18px; top: 25px; bottom: -45px; width: 2px; background: #f1f5f9; }
    .status-step:last-child::before { display: none; }
    .step-icon { position: absolute; left: 0; top: 0; width: 38px; height: 38px; border-radius: 50%; background: #f8fafc; border: 2px solid #e2e8f0; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; color: #94a3b8; z-index: 2; transition: all 0.3s; }
    .status-step.active .step-icon { background: #4f46e5; border-color: #4f46e5; color: white; box-shadow: 0 5px 15px rgba(79, 70, 229, 0.4); }
    .status-step.active .step-title { color: #0f172a; font-weight: 800; }
</style>

@php
    $st = [
        'diterima' => ['bg' => 'bg-secondary-subtle', 'text' => 'text-secondary', 'icon' => 'fa-box', 'label' => 'Order Diterima'],
        'dicuci' => ['bg' => 'bg-info-subtle', 'text' => 'text-info', 'icon' => 'fa-soap', 'label' => 'Sedang Dicuci'],
        'dijemur' => ['bg' => 'bg-warning-subtle', 'text' => 'text-warning', 'icon' => 'fa-sun', 'label' => 'Proses Pengeringan'],
        'disetrika' => ['bg' => 'bg-primary-subtle', 'text' => 'text-primary', 'icon' => 'fa-tshirt', 'label' => 'Sedang Disetrika'],
        'siap' => ['bg' => 'bg-success-subtle', 'text' => 'text-success', 'icon' => 'fa-check-circle', 'label' => 'Siap Diambil'],
        'diambil' => ['bg' => 'bg-dark', 'text' => 'text-white', 'icon' => 'fa-hand-holding-heart', 'label' => 'Selesai & Diambil'],
        'batal' => ['bg' => 'bg-danger-subtle', 'text' => 'text-danger', 'icon' => 'fa-times-circle', 'label' => 'Order Dibatalkan'],
    ];
    $c = $st[$transaksi->status] ?? $st['diterima'];
@endphp

<div class="status-header {{ $c['bg'] }} {{ $c['text'] }} d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
    <div class="d-flex align-items-center gap-4">
        <div class="bg-white bg-opacity-50 rounded-4 p-3 shadow-inner {{ $c['text'] }} fs-3">
            <i class="fas {{ $c['icon'] }}"></i>
        </div>
        <div>
            <h2 class="fw-black mb-1">{{ $c['label'] }}</h2>
            <p class="mb-0 fw-bold small opacity-75">Nomor Order: {{ $transaksi->no_order }}</p>
        </div>
    </div>
    <div class="d-flex gap-2">
        @if($transaksi->status !== 'batal')
            <a href="{{ route('admin.transaksi.nota', $transaksi) }}" target="_blank" class="btn btn-white rounded-3 fw-black text-dark px-4 py-2 shadow-sm border-0 bg-white">Cetak Nota</a>
        @endif
        <a href="{{ route('admin.transaksi.index') }}" class="btn btn-outline-dark border-opacity-25 rounded-3 fw-black px-4 py-2">Kembali</a>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="info-card mb-4">
            <h5 class="fw-black mb-4 d-flex align-items-center gap-2"><i class="fas fa-list-ul text-primary small"></i> Rincian Layanan</h5>
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead class="bg-light">
                        <tr>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3">Layanan</th>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3 text-end">Harga</th>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3 text-center">Jumlah</th>
                            <th class="border-0 small fw-black text-muted text-uppercase p-3 text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi->detail as $item)
                        <tr>
                            <td class="p-3">
                                <div class="fw-black text-dark">{{ $item->nama_layanan }}</div>
                                @if($item->keterangan) <div class="text-muted small italic" style="font-size: 10px;">Note: {{ $item->keterangan }}</div> @endif
                            </td>
                            <td class="p-3 text-end fw-bold text-muted small">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}</td>
                            <td class="p-3 text-center"><span class="badge bg-light text-dark fw-black border">{{ $item->qty }}x</span></td>
                            <td class="p-3 text-end fw-black">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="border-top-2">
                        <tr class="bg-light bg-opacity-50">
                            <th colspan="3" class="text-end p-3 text-uppercase fw-black small text-muted">Total Tagihan</th>
                            <th class="text-end p-3 fs-4 fw-black text-primary">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="info-card">
                    <h6 class="fw-black text-uppercase spacing-widest text-muted mb-3" style="font-size: 10px;">Data Pelanggan</h6>
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="bg-indigo-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; font-weight: 900;">{{ substr($transaksi->pelanggan->nama_pelanggan, 0, 1) }}</div>
                        <div>
                            <div class="fw-black text-dark">{{ $transaksi->pelanggan->nama_pelanggan }}</div>
                            <div class="text-primary small fw-bold">{{ $transaksi->pelanggan->no_telepon }}</div>
                        </div>
                    </div>
                    <p class="text-muted small mb-0">{{ $transaksi->pelanggan->alamat }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="info-card">
                    <h6 class="fw-black text-uppercase spacing-widest text-muted mb-3" style="font-size: 10px;">Waktu & Petugas</h6>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="small text-muted fw-bold">Masuk:</span>
                        <span class="small fw-black text-dark">{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</span>
                    </div>
                    <div class="mb-2 d-flex justify-content-between">
                        <span class="small text-muted fw-bold">Estimasi:</span>
                        <span class="small fw-black text-primary">{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d M Y') }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="small text-muted fw-bold">Penerima:</span>
                        <span class="small fw-black text-dark">{{ $transaksi->pegawai->nama_pegawai ?? '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Update Status -->
        <div class="info-card mb-4">
            <h5 class="fw-black mb-4">Kelola Order</h5>
            @if(in_array($transaksi->status, ['diambil', 'batal']))
                <div class="text-center py-4 bg-light rounded-4 border border-dashed">
                    <i class="fas fa-lock text-muted mb-2"></i>
                    <p class="text-muted small fw-bold mb-0">Status telah final.</p>
                </div>
            @else
                <form action="{{ route('admin.transaksi.status', $transaksi) }}" method="POST" class="mb-4">
                    @csrf @method('PATCH')
                    <div class="mb-3">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest" style="font-size: 9px;">Update Status</label>
                        <select name="status" class="form-select border-0 bg-light rounded-3 p-3 fw-bold small" required>
                            <option value="diterima" {{ $transaksi->status == 'diterima' ? 'selected' : '' }}>DITERIMA</option>
                            <option value="dicuci" {{ $transaksi->status == 'dicuci' ? 'selected' : '' }}>DICUCI</option>
                            <option value="dijemur" {{ $transaksi->status == 'dijemur' ? 'selected' : '' }}>DIJEMUR</option>
                            <option value="disetrika" {{ $transaksi->status == 'disetrika' ? 'selected' : '' }}>DISETRIKA</option>
                            <option value="siap" {{ $transaksi->status == 'siap' ? 'selected' : '' }}>SIAP DIAMBIL</option>
                            <option value="diambil" {{ $transaksi->status == 'diambil' ? 'selected' : '' }}>DIAMBIL</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 rounded-3 py-3 fw-black text-uppercase small shadow-sm">Update Progress</button>
                </form>
                
                @if(!in_array($transaksi->status, ['siap', 'diambil', 'batal']))
                <form id="formBatal" action="{{ route('admin.transaksi.batal', $transaksi) }}" method="POST">
                    @csrf @method('PATCH')
                    <button type="button" class="btn btn-outline-danger w-100 rounded-3 py-2 fw-bold small border-opacity-25" onclick="confirmAction('formBatal', 'Batalkan Order?', 'Pesanan akan dibatalkan permanen.', 'Ya, Batalkan', 'warning')">Batalkan Order</button>
                </form>
                @endif
            @endif
        </div>

        <!-- Pembayaran -->
        <div class="info-card mb-4">
            <h5 class="fw-black mb-4">Pembayaran</h5>
            <div class="d-flex justify-content-between mb-4">
                <span class="text-muted fw-bold small">Total Bayar:</span>
                <span class="fw-black text-success fs-5">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</span>
            </div>

            @if($transaksi->bayar >= $transaksi->total)
                <div class="alert alert-success border-0 rounded-4 text-center p-3">
                    <i class="fas fa-check-circle me-2"></i> <span class="fw-black small text-uppercase">LUNAS</span>
                </div>
            @elseif($transaksi->status !== 'batal')
                <div class="alert alert-danger border-0 rounded-4 text-center p-3 mb-4">
                    <span class="fw-black small text-uppercase">Kekurangan: Rp {{ number_format($transaksi->total - $transaksi->bayar, 0, ',', '.') }}</span>
                </div>
                <form action="{{ route('admin.transaksi.bayar', $transaksi) }}" method="POST">
                    @csrf @method('PATCH')
                    <div class="input-group mb-3">
                        <span class="input-group-text border-0 bg-light fw-black text-muted small">Rp</span>
                        <input type="number" name="bayar" id="inputBayar" class="form-control border-0 bg-light p-3 fw-black" value="{{ $transaksi->total }}" min="{{ $transaksi->total }}" required>
                    </div>
                    <div id="kembalianInfo" class="alert alert-success border-0 rounded-4 text-center p-3 mb-4 d-none">
                        <span class="fw-black small text-uppercase">Kembalian: Rp <span id="labelKembalian">0</span></span>
                    </div>
                    <button type="submit" class="btn btn-success w-100 rounded-3 py-3 fw-black text-uppercase small shadow-sm">Pelunasan</button>
                </form>

                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const inputBayar = document.getElementById('inputBayar');
                        const kembalianInfo = document.getElementById('kembalianInfo');
                        const labelKembalian = document.getElementById('labelKembalian');
                        const total = {{ $transaksi->total }};

                        inputBayar.addEventListener('input', function() {
                            const bayar = parseFloat(this.value) || 0;
                            if (bayar > total) {
                                const kembalian = bayar - total;
                                labelKembalian.innerText = new Intl.NumberFormat('id-ID').format(kembalian);
                                kembalianInfo.classList.remove('d-none');
                            } else {
                                kembalianInfo.classList.add('d-none');
                            }
                        });
                    });
                </script>
            @endif
        </div>

        <!-- Log -->
        <div class="info-card">
            <h5 class="fw-black mb-4">Riwayat Aktivitas</h5>
            <div class="status-timeline">
                @foreach($transaksi->riwayatStatus->sortByDesc('created_at') as $log)
                <div class="status-step active">
                    <div class="step-icon"><i class="fas {{ $st[$log->status]['icon'] ?? 'fa-circle' }}"></i></div>
                    <div class="step-content">
                        <div class="step-title text-uppercase small spacing-widest">{{ $log->status }}</div>
                        <div class="text-muted small" style="font-size: 10px;">{{ \Carbon\Carbon::parse($log->created_at)->format('d M, H:i') }} • {{ $log->user->name ?? 'System' }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
