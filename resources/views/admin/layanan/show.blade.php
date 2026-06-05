@extends('layouts.app')
@section('title', 'Detail Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Layanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Detail</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Detail Layanan: {{ $layanan->kode_layanan }}</h5>
                <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary btn-sm"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tbody>
                        <tr>
                            <th width="30%" class="bg-light">Kode Layanan</th>
                            <td>{{ $layanan->kode_layanan }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Nama Layanan</th>
                            <td class="fw-bold">{{ $layanan->nama_layanan }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Kategori</th>
                            <td>{{ $layanan->kategori->nama_kategori ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Harga / Satuan</th>
                            <td class="text-success fw-bold">Rp {{ number_format($layanan->harga, 0, ',', '.') }} / {{ strtoupper($layanan->satuan) }}</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Estimasi Selesai</th>
                            <td>{{ $layanan->estimasi_hari }} Hari</td>
                        </tr>
                        <tr>
                            <th class="bg-light">Status</th>
                            <td>
                                @if($layanan->is_active)
                                    <span class="badge bg-success">Aktif</span>
                                @else
                                    <span class="badge bg-secondary">Nonaktif</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="bg-light">Deskripsi</th>
                            <td>{{ $layanan->deskripsi ?: '-' }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="mt-3 text-end">
                    <a href="{{ route('admin.layanan.edit', $layanan) }}" class="btn btn-warning"><i class="fas fa-edit me-1"></i> Ubah Data</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
