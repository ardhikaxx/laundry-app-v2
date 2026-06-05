@extends('layouts.app')
@section('title', 'Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Layanan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Layanan</h5>
        <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Layanan
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3">Kode</th>
                        <th>Nama Layanan</th>
                        <th>Kategori</th>
                        <th class="text-center">Satuan</th>
                        <th class="text-end">Harga</th>
                        <th class="text-center">Est. Hari</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($layanans as $layanan)
                    <tr>
                        <td class="px-3 fw-bold text-primary">{{ $layanan->kode_layanan }}</td>
                        <td class="fw-semibold">{{ $layanan->nama_layanan }}</td>
                        <td>{{ $layanan->kategori->nama_kategori ?? '-' }}</td>
                        <td class="text-center"><span class="badge bg-secondary">{{ strtoupper($layanan->satuan) }}</span></td>
                        <td class="text-end">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $layanan->estimasi_hari }}</td>
                        <td class="text-center">
                            @if($layanan->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.layanan.show', $layanan) }}" class="btn btn-info btn-sm text-white" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.layanan.edit', $layanan) }}" class="btn btn-warning btn-sm" title="Ubah">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="form-delete-{{ $layanan->id }}" action="{{ route('admin.layanan.destroy', $layanan) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                    onclick="confirmDelete('form-delete-{{ $layanan->id }}', '{{ $layanan->nama_layanan }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Data layanan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($layanans->hasPages())
    <div class="card-footer bg-white pt-3 pb-1">
        {{ $layanans->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
