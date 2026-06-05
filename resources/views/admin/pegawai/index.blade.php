@extends('layouts.app')
@section('title', 'Pegawai')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">Pegawai</li>
@endsection

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Daftar Pegawai</h5>
        <a href="{{ route('admin.pegawai.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus me-1"></i> Tambah Pegawai
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover table-striped mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="px-3" width="5%">No</th>
                        <th>Kode</th>
                        <th>Nama Pegawai</th>
                        <th>Jabatan</th>
                        <th>No. Telepon</th>
                        <th>Tgl Masuk</th>
                        <th class="text-center">Status</th>
                        <th class="text-center" width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pegawais as $i => $pegawai)
                    <tr>
                        <td class="px-3">{{ $pegawais->firstItem() + $i }}</td>
                        <td class="fw-bold text-primary">{{ $pegawai->kode_pegawai }}</td>
                        <td class="fw-semibold">{{ $pegawai->nama_pegawai }}</td>
                        <td>{{ $pegawai->jabatan }}</td>
                        <td>{{ $pegawai->no_telepon ?: '-' }}</td>
                        <td>{{ \Carbon\Carbon::parse($pegawai->tanggal_masuk)->format('d/m/Y') }}</td>
                        <td class="text-center">
                            @if($pegawai->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('admin.pegawai.edit', $pegawai) }}" class="btn btn-warning btn-sm" title="Ubah">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form id="form-delete-{{ $pegawai->id }}" action="{{ route('admin.pegawai.destroy', $pegawai) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-danger btn-sm" title="Hapus" 
                                    onclick="confirmDelete('form-delete-{{ $pegawai->id }}', '{{ $pegawai->nama_pegawai }}')">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Data pegawai tidak ditemukan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pegawais->hasPages())
    <div class="card-footer bg-white pt-3 pb-1">
        {{ $pegawais->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>
@endsection
