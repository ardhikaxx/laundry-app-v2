@extends('layouts.app')
@section('title', 'Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Layanan</li>
@endsection

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-black mb-1">Daftar Layanan</h2>
        <p class="text-muted small fw-bold mb-0">Kelola rincian harga dan estimasi pengerjaan laundry.</p>
    </div>
    <a href="{{ route('admin.layanan.create') }}" class="btn btn-primary rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Layanan
    </a>
</div>

<div class="card border-0 shadow-sm rounded-5 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Kode</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Layanan</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Kategori</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Satuan</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-end" style="font-size: 9px;">Harga</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Status</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($layanans as $layanan)
                <tr>
                    <td class="px-4 py-3 fw-bold text-muted">{{ $layanan->kode_layanan }}</td>
                    <td class="px-4 py-3 fw-black text-dark">{{ $layanan->nama_layanan }}</td>
                    <td class="px-4 py-3 text-muted small fw-bold">{{ $layanan->kategori->nama_kategori ?? '-' }}</td>
                    <td class="px-4 py-3 text-center"><span class="badge bg-light text-dark border rounded-pill">{{ strtoupper($layanan->satuan) }}</span></td>
                    <td class="px-4 py-3 text-end fw-black">Rp {{ number_format($layanan->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-3 text-center">
                        @if($layanan->is_active)
                            <span class="badge bg-success-subtle text-success rounded-pill fw-black text-uppercase" style="font-size: 9px;">Aktif</span>
                        @else
                            <span class="badge bg-light text-muted rounded-pill fw-black text-uppercase" style="font-size: 9px;">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.layanan.show', $layanan) }}" class="btn btn-info-subtle btn-sm rounded-3 text-info"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.layanan.edit', $layanan) }}" class="btn btn-warning-subtle btn-sm rounded-3 text-warning"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger-subtle btn-sm rounded-3 text-danger" onclick="confirmDelete('form-{{ $layanan->id }}', '{{ $layanan->nama_layanan }}')"><i class="fas fa-trash"></i></button>
                            <form id="form-{{ $layanan->id }}" action="{{ route('admin.layanan.destroy', $layanan) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-5 text-muted fw-bold">Data tidak ditemukan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($layanans->hasPages())
    <div class="card-footer bg-white border-top-0 p-4">
        {{ $layanans->links() }}
    </div>
    @endif
</div>
@endsection
