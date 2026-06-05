@extends('layouts.app')
@section('title', 'Kelola Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.transaksi.index') }}">Transaksi</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ $transaksi->no_order }}</li>
@endsection

@section('content')
<div class="row">
    <!-- Kolom Kiri: Info Transaksi -->
    <div class="col-xl-8 mb-4">
        <!-- Status Banner -->
        <div class="card mb-4 border-0 shadow-sm bg-{{ $transaksi->warna_badge }} text-white">
            <div class="card-body d-flex justify-content-between align-items-center py-3">
                <div>
                    <h5 class="mb-0 fw-bold">Status Saat Ini: {{ strtoupper($transaksi->status) }}</h5>
                    <small>Dibuat pada: {{ \Carbon\Carbon::parse($transaksi->created_at)->format('d M Y, H:i') }}</small>
                </div>
                <div>
                    @if($transaksi->status !== 'batal')
                    <a href="{{ route('admin.transaksi.nota', $transaksi) }}" target="_blank" class="btn btn-light btn-sm text-dark fw-bold shadow-sm">
                        <i class="fas fa-print me-1"></i> Cetak Nota
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Tabel Detail -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-list-alt me-2 text-primary"></i>Rincian Layanan</h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="px-3">Layanan</th>
                                <th class="text-end">Harga Satuan</th>
                                <th class="text-center">Qty</th>
                                <th class="text-end pe-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaksi->detail as $item)
                            <tr>
                                <td class="px-3">
                                    <div class="fw-semibold">{{ $item->nama_layanan }}</div>
                                    <small class="text-muted">{{ $item->keterangan }}</small>
                                </td>
                                <td class="text-end align-middle">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }} / {{ strtoupper($item->satuan) }}</td>
                                <td class="text-center align-middle">{{ $item->qty }}</td>
                                <td class="text-end pe-3 align-middle fw-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <th colspan="3" class="text-end py-3">Total Transaksi:</th>
                                <th class="text-end pe-3 py-3 fs-5 fw-bold text-primary">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Info Pelanggan & Pegawai -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-user me-2 text-primary"></i>Info Pelanggan</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <th width="40%" class="text-muted">Kode</th>
                                <td class="fw-semibold">{{ $transaksi->pelanggan->kode_pelanggan }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Nama</th>
                                <td>{{ $transaksi->pelanggan->nama_pelanggan }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Telepon</th>
                                <td>{{ $transaksi->pelanggan->no_telepon }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Alamat</th>
                                <td>{{ $transaksi->pelanggan->alamat }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-header bg-white">
                        <h6 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2 text-primary"></i>Info Order</h6>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <th width="40%" class="text-muted">No. Order</th>
                                <td class="fw-bold text-primary">{{ $transaksi->no_order }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Tgl Masuk</th>
                                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Est. Selesai</th>
                                <td>{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d M Y') }}</td>
                            </tr>
                            <tr>
                                <th class="text-muted">Pegawai</th>
                                <td>{{ $transaksi->pegawai->nama_pegawai ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Kolom Kanan: Aksi & Pembayaran -->
    <div class="col-xl-4 mb-4">
        <!-- Update Status -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-tasks me-2 text-primary"></i>Kelola Status</h6>
            </div>
            <div class="card-body">
                @if(in_array($transaksi->status, ['diambil', 'batal']))
                    <div class="alert alert-secondary mb-0 text-center">
                        Transaksi telah <strong>{{ strtoupper($transaksi->status) }}</strong>. Status tidak dapat diubah lagi.
                    </div>
                @else
                    <form action="{{ route('admin.transaksi.status', $transaksi) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Ubah Status Menjadi:</label>
                            <select name="status" class="form-select mb-3" required>
                                <option value="diterima" {{ $transaksi->status == 'diterima' ? 'selected' : '' }}>DITERIMA - Cucian baru masuk</option>
                                <option value="dicuci" {{ $transaksi->status == 'dicuci' ? 'selected' : '' }}>DICUCI - Sedang dalam proses cuci</option>
                                <option value="dijemur" {{ $transaksi->status == 'dijemur' ? 'selected' : '' }}>DIJEMUR - Sedang dijemur / dikeringkan</option>
                                <option value="disetrika" {{ $transaksi->status == 'disetrika' ? 'selected' : '' }}>DISETRIKA - Sedang disetrika</option>
                                <option value="siap" {{ $transaksi->status == 'siap' ? 'selected' : '' }}>SIAP - Selesai, menunggu diambil</option>
                                <option value="diambil" {{ $transaksi->status == 'diambil' ? 'selected' : '' }}>DIAMBIL - Diserahkan ke pelanggan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 fw-bold"><i class="fas fa-save me-2"></i>Update Status</button>
                    </form>

                    @if(!in_array($transaksi->status, ['siap', 'diambil', 'batal']))
                    <hr>
                    <form id="form-batal-{{ $transaksi->id }}" action="{{ route('admin.transaksi.batal', $transaksi) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="button" class="btn btn-outline-danger w-100 fw-bold"
                            onclick="confirmAction('form-batal-{{ $transaksi->id }}', 'Batalkan Transaksi?', 'Transaksi {{ $transaksi->no_order }} akan dibatalkan.', '<i class=\'fas fa-ban me-1\'></i> Ya, Batalkan', 'warning')">
                            <i class="fas fa-ban me-1"></i> Batalkan Transaksi
                        </button>
                    </form>
                    @endif
                @endif
            </div>
        </div>

        <!-- Pembayaran -->
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-money-bill-wave me-2 text-success"></i>Pembayaran</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Total Tagihan</span>
                    <span class="fw-bold">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Telah Dibayar</span>
                    <span class="fw-bold text-success">Rp {{ number_format($transaksi->bayar, 0, ',', '.') }}</span>
                </div>
                
                @if($transaksi->bayar >= $transaksi->total)
                    <div class="alert alert-success text-center mb-0 fw-bold">
                        <i class="fas fa-check-circle me-1"></i> LUNAS
                    </div>
                    @if($transaksi->kembalian > 0)
                    <div class="mt-3 text-center small text-muted">
                        Kembalian: Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}
                    </div>
                    @endif
                @else
                    <div class="alert alert-danger text-center mb-3 fw-bold">
                        <i class="fas fa-times-circle me-1"></i> BELUM LUNAS
                    </div>
                    
                    @if(!in_array($transaksi->status, ['batal']))
                    <form action="{{ route('admin.transaksi.bayar', $transaksi) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="mb-3">
                            <label class="form-label small fw-bold text-muted">Input Pembayaran</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="bayar" id="inputBayar" class="form-control" value="{{ $transaksi->total }}" min="{{ $transaksi->total }}" required>
                            </div>
                            <small class="text-muted mt-1 d-block">Minimal Rp {{ number_format($transaksi->total, 0, ',', '.') }}</small>
                            <div class="mt-2 fw-bold text-success d-none" id="kembalianInfo">
                                Kembalian: Rp <span id="kembalianNominal">0</span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success w-100 fw-bold"><i class="fas fa-check me-2"></i>Proses Pembayaran</button>
                    </form>
                    
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const inputBayar = document.getElementById('inputBayar');
                            const kembalianInfo = document.getElementById('kembalianInfo');
                            const kembalianNominal = document.getElementById('kembalianNominal');
                            const totalTagihan = {{ $transaksi->total }};

                            inputBayar.addEventListener('input', function() {
                                const bayar = parseFloat(this.value) || 0;
                                if (bayar > totalTagihan) {
                                    const kembalian = bayar - totalTagihan;
                                    kembalianNominal.innerText = new Intl.NumberFormat('id-ID').format(kembalian);
                                    kembalianInfo.classList.remove('d-none');
                                } else {
                                    kembalianInfo.classList.add('d-none');
                                }
                            });
                        });
                    </script>
                    @endif
                @endif
            </div>
        </div>

        <!-- Log Riwayat Status -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-bold"><i class="fas fa-history me-2 text-primary"></i>Riwayat Status</h6>
            </div>
            <div class="card-body p-0">
                <ul class="list-group list-group-flush">
                    @foreach($transaksi->riwayatStatus as $log)
                    <li class="list-group-item px-3 py-2">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-{{ $log->status }} py-1">{{ strtoupper($log->status) }}</span>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($log->created_at)->format('d M, H:i') }}</small>
                        </div>
                        <div class="mt-2 small text-muted">
                            <i class="fas fa-user-circle me-1"></i> {{ $log->user->name ?? 'Sistem' }}
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
