@extends('layouts.app')
@section('title', 'Pegawai')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pegawai</li>
@endsection

@section('content')
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
    <div>
        <h2 class="fw-black mb-1">Manajemen Pegawai</h2>
        <p class="text-muted small fw-bold mb-0">Kelola data petugas operasional dan akses sistem.</p>
    </div>
    <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary rounded-4 px-4 py-2 fw-black small text-uppercase spacing-widest shadow-sm">
        <i class="fas fa-plus me-2"></i> Tambah Pegawai
    </a>
</div>

<div class="card border-0 shadow-sm rounded-5 overflow-hidden">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px; width: 60px;">No</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Nama Pegawai</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Kontak</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted" style="font-size: 9px;">Alamat</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Status</th>
                    <th class="px-4 py-3 text-uppercase small fw-black text-muted text-center" style="font-size: 9px;">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-top-0">
                @forelse($pegawais as $i => $pg)
                <tr>
                    <td class="px-4 py-3 fw-bold text-muted">{{ $pegawais->firstItem() + $i }}</td>
                    <td class="px-4 py-3 fw-black text-dark">{{ $pg->nama_pegawai }}</td>
                    <td class="px-4 py-3 text-muted small fw-bold">{{ $pg->no_telepon }}</td>
                    <td class="px-4 py-3 text-muted small">{{ Str::limit($pg->alamat, 30) }}</td>
                    <td class="px-4 py-3 text-center">
                        @if($pg->is_active)
                            <span class="badge bg-success-subtle text-success rounded-pill fw-black text-uppercase" style="font-size: 8px;">Aktif</span>
                        @else
                            <span class="badge bg-light text-muted rounded-pill fw-black text-uppercase" style="font-size: 8px;">Nonaktif</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">
                        <div class="d-flex justify-content-center gap-2">
                            <a href="{{ route('admin.pegawai.edit', $pg) }}" class="btn btn-warning-subtle btn-sm rounded-3 text-warning"><i class="fas fa-edit"></i></a>
                            <button type="button" class="btn btn-danger-subtle btn-sm rounded-3 text-danger" onclick="confirmDelete('form-{{ $pg->id }}', '{{ $pg->nama_pegawai }}')"><i class="fas fa-trash"></i></button>
                            <form id="form-{{ $pg->id }}" action="{{ route('admin.pegawai.destroy', $pg) }}" method="POST" class="d-none">@csrf @method('DELETE')</form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-5 text-muted fw-bold">Data tidak ditemukan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
