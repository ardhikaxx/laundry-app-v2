@extends('layouts.app')
@section('title', 'Kategori Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Kategori Layanan</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Kategori Layanan</h5>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Kategori
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3" width="5%">No</th>
                        <th>Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center">Jumlah Layanan</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $i => $kategori)
                    <tr>
                        <td class="px-3">{{ $kategoris->firstItem() + $i }}</td>
                        <td class="fw-semibold">{{ $kategori->nama_kategori }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($kategori->deskripsi, 50) ?: '-' }}</td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark">{{ $kategori->layanan_count }}</span>
                        </td>
                        <td class="text-center">
                            @if($kategori->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning btn-sm" title="Ubah">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="form-delete-{{ $kategori->id }}" action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                    onclick="confirmDelete('form-delete-{{ $kategori->id }}', '{{ $kategori->nama_kategori }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Data kategori layanan tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($kategoris->hasPages())
    <div class="card-footer bg-white pt-3 pb-1">
        {{ $kategoris->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
