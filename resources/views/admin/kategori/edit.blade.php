@extends('layouts.app')
@section('title', 'Ubah Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori Layanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Kategori Layanan</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori', $kategori->nama_kategori) }}" required>
                        @error('nama_kategori') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-select @error('is_active') is-invalid @enderror" required>
                            <option value="1" {{ old('is_active', $kategori->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active', $kategori->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
