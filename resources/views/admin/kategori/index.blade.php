@extends('layouts.app')
@section('title', 'Kategori Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-black mb-1">Kategori Layanan</h2>
        <p class="text-muted small fw-bold mb-0">Kelola kelompok jenis layanan laundry Anda.</p>
    </div>
    <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Kategori
    </a>
</div>

<div class="card border-0 shadow-sm rounded-5 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 10px; width: 80px;">No</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 10px;">Nama Kategori</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 10px;">Deskripsi</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 10px;">Status</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 10px; width: 150px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($kategoris as $i => $kategori)
                <tr>
                    <td class="px-4 py-3 fw-bold text-muted">{{ $kategoris->firstItem() + $i }}</td>
                    <td class="px-4 py-3 fw-black text-dark">{{ $kategori->nama_kategori }}</td>
                    <td class="px-4 py-3 text-muted small">{{ $kategori->deskripsi ?: '-' }}</td>
                    <td class="px-4 py-3 text-center">
                        @if($kategori->is_active)
                            <span class="badge bg-success-subtle text-success rounded-pill fw-black text-uppercase" style="font-size: 9px;">Aktif</span>
                        @else
                            <span class="badge bg-light text-muted rounded-pill fw-black text-uppercase" style="font-size: 9px;">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.kategori.edit', $kategori) }}" class="btn btn-warning-subtle btn-sm rounded-3 text-warning"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger-subtle btn-sm rounded-3 text-danger" onclick="confirmDelete('form-{{ $kategori->id }}', '{{ $kategori->nama_kategori }}')"><i class="fas fa-trash"></i></button>
                            <form id="form-{{ $kategori->id }}" action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center py-5 text-muted fw-bold">Data tidak ditemukan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($kategoris->hasPages())
    <div class="card-footer bg-white border-top-0 p-4">
        {{ $kategoris->links() }}
    </div>
    @endif
</div>
@endsection
