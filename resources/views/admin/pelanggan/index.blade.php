@extends('layouts.app')
@section('title', 'Pelanggan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pelanggan</li>
@endsection

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-black mb-1">Database Pelanggan</h2>
        <p class="text-muted small fw-bold mb-0">Kelola riwayat dan informasi seluruh pelanggan Cuciin.</p>
    </div>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.pelanggan.cetak-semua', request()->all()) }}" target="_blank" class="btn btn-outline-secondary rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest">
            <i class="fas fa-print me-2"></i> PDF
        </a>
        <a href="{{ route('admin.pelanggan.create') }}" class="btn btn-primary rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest shadow-sm">
            <i class="fas fa-plus me-2"></i> Tambah Pelanggan
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-5 overflow-hidden">
    <div class="card-header bg-white p-4 border-bottom-0">
        <form action="{{ route('admin.pelanggan.index') }}" method="GET" class="row g-3">
            <div class="col-md-5">
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-search text-muted small"></i></span>
                    <input type="text" name="cari" class="form-control bg-light border-0 small" placeholder="Nama, Kode, atau Telepon..." value="{{ request('cari') }}">
                </div>
            </div>
            <div class="col-6 col-md-3">
                <select name="jenis_kelamin" class="form-select bg-light border-0 small">
                    <option value="">Semua L/P</option>
                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div class="col-6 col-md-2">
                <button type="submit" class="btn btn-dark w-100 rounded-3 fw-bold small">Filter</button>
            </div>
            <div class="col-12 col-md-2">
                <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-link text-muted w-100 fw-bold small text-decoration-none">Reset</a>
            </div>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Kode</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Pelanggan</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">No. Telepon</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">L/P</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Trx</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Status</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($pelanggans as $pelanggan)
                <tr>
                    <td class="px-4 py-3 fw-black text-primary">{{ $pelanggan->kode_pelanggan }}</td>
                    <td class="px-4 py-3 fw-black text-dark">{{ $pelanggan->nama_pelanggan }}</td>
                    <td class="px-4 py-3 fw-bold text-muted small">{{ $pelanggan->no_telepon }}</td>
                    <td class="px-4 py-3 text-center fw-bold text-muted small">{{ $pelanggan->jenis_kelamin }}</td>
                    <td class="px-4 py-3 text-center"><span class="badge bg-indigo-subtle text-primary rounded-pill fw-black">{{ $pelanggan->total_transaksi }}x</span></td>
                    <td class="px-4 py-3 text-center">
                        @if($pelanggan->is_active)
                            <span class="badge bg-success-subtle text-success rounded-pill fw-black text-uppercase" style="font-size: 9px;">Aktif</span>
                        @else
                            <span class="badge bg-light text-muted rounded-pill fw-black text-uppercase" style="font-size: 9px;">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.pelanggan.show', $pelanggan) }}" class="btn btn-info-subtle btn-sm rounded-3 text-info"><i class="fas fa-user-circle"></i></a>
                            <a href="{{ route('admin.pelanggan.edit', $pelanggan) }}" class="btn btn-warning-subtle btn-sm rounded-3 text-warning"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger-subtle btn-sm rounded-3 text-danger" onclick="confirmDelete('form-{{ $pelanggan->id }}', '{{ $pelanggan->nama_pelanggan }}')"><i class="fas fa-trash"></i></button>
                            <form id="form-{{ $pelanggan->id }}" action="{{ route('admin.pelanggan.destroy', $pelanggan) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-5 text-muted fw-bold">Data tidak ditemukan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pelanggans->hasPages())
    <div class="card-footer bg-white border-top-0 p-4">
        {{ $pelanggans->links() }}
    </div>
    @endif
</div>
@endsection
