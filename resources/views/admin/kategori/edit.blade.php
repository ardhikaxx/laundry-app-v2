@extends('layouts.app')
@section('title', 'Ubah Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
    <li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-6">
        <div class="mb-4">
            <h2 class="fw-black mb-1">Ubah Kategori</h2>
            <p class="text-muted small fw-bold">Edit informasi kelompok layanan.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-5 p-4">
            <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
                @csrf @method('PATCH')
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                    @error('nama_kategori') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control border-0 bg-light rounded-3 p-3 fw-bold">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Status</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active1" value="1" {{ $kategori->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active1">Aktif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active0" value="0" {{ !$kategori->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active0">Nonaktif</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-light rounded-3 px-4 fw-bold small text-uppercase">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-black small text-uppercase shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
