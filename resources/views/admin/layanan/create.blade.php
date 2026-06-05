@extends('layouts.app')
@section('title', 'Tambah Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Layanan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tambah Layanan Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.layanan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Nama Layanan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_layanan" class="form-control @error('nama_layanan') is-invalid @enderror" value="{{ old('nama_layanan') }}" required>
                            @error('nama_layanan') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Kategori Layanan <span class="text-danger">*</span></label>
                            <select name="kategori_layanan_id" class="form-select @error('kategori_layanan_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($kategoris as $kategori)
                                    <option value="{{ $kategori->id }}" {{ old('kategori_layanan_id') == $kategori->id ? 'selected' : '' }}>{{ $kategori->nama_kategori }}</option>
                                @endforeach
                            </select>
                            @error('kategori_layanan_id') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Satuan <span class="text-danger">*</span></label>
                            <select name="satuan" class="form-select @error('satuan') is-invalid @enderror" required>
                                <option value="kg" {{ old('satuan') == 'kg' ? 'selected' : '' }}>Kilogram (Kg)</option>
                                <option value="pcs" {{ old('satuan') == 'pcs' ? 'selected' : '' }}>Pieces (Pcs)</option>
                                <option value="item" {{ old('satuan') == 'item' ? 'selected' : '' }}>Item</option>
                            </select>
                            @error('satuan') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Harga <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">Rp</span>
                                <input type="number" name="harga" class="form-control @error('harga') is-invalid @enderror" value="{{ old('harga', 0) }}" min="0" required>
                            </div>
                            @error('harga') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Estimasi Selesai <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" name="estimasi_hari" class="form-control @error('estimasi_hari') is-invalid @enderror" value="{{ old('estimasi_hari', 1) }}" min="1" max="30" required>
                                <span class="input-group-text">Hari</span>
                            </div>
                            @error('estimasi_hari') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                        <select name="is_active" class="form-select w-50 @error('is_active') is-invalid @enderror" required>
                            <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('is_active') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <hr>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.layanan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
