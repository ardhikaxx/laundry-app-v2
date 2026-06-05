@extends('layouts.app')
@section('title', 'Pelanggan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pelanggan</li>
@endsection

@section('content')
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-body p-3">
        <form action="{{ route('admin.pelanggan.index') }}" method="GET" class="row g-2 align-items-center">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-white"><i class="fas fa-search text-muted"></i></span>
                    <input type="text" name="cari" class="form-control border-start-0 ps-0" placeholder="Cari nama, kode, atau telepon..." value="{{ request('cari') }}">
                </div>
            </div>
            <div class="col-md-3">
                <select name="jenis_kelamin" class="form-select">
                    <option value="">-- Semua Jenis Kelamin --</option>
                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-md-3">
                <select name="is_active" class="form-select">
                    <option value="">-- Semua Status --</option>
                    <option value="1" {{ request('is_active') == '1' ? 'selected' : '' }}>Aktif</option>
                    <option value="0" {{ request('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pelanggan</h5>
        <div>
            <a href="{{ route('admin.pelanggan.cetak-semua', request()->all()) }}" target="_blank" class="btn btn-secondary btn-sm me-2">
                <i class="fas fa-print me-1"></i> Cetak PDF
            </a>
            <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary btn-sm">
                <i class="fas fa-plus me-1"></i> Tambah Pelanggan
            </a>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3" width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Pelanggan</th>
                        <th>L/P</th>
                        <th>No. Telepon</th>
                        <th>Tgl Daftar</th>
                        <th class="text-center">Trx</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pelanggans as $i => $pelanggan)
                    <tr>
                        <td class="px-3">{{ $pelanggans->firstItem() + $i }}</td>
                        <td class="fw-bold text-primary">{{ $pelanggan->kode_pelanggan }}</td>
                        <td class="fw-semibold">{{ $pelanggan->nama_pelanggan }}</td>
                        <td>{{ $pelanggan->jenis_kelamin }}</td>
                        <td>{{ $pelanggan->no_telepon }}</td>
                        <td>{{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d/m/Y') }}</td>
                        <td class="text-center"><span class="badge bg-info text-dark">{{ $pelanggan->total_transaksi }}</span></td>
                        <td class="text-center">
                            @if($pelanggan->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.pelanggan.show', $pelanggan) }}" class="btn btn-info btn-sm text-white" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-warning btn-sm" title="Ubah">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="form-delete-{{ $pelanggan->id }}" action="{{ route('admin.pelanggan.destroy', $pelanggan) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                    onclick="confirmDelete('form-delete-{{ $pelanggan->id }}', '{{ $pelanggan->nama_pelanggan }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">Data pelanggan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pelanggans->hasPages())
    <div class="card-footer bg-white pt-3 pb-1">
        {{ $pelanggans->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
