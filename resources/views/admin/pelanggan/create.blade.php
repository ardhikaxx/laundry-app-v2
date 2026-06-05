@extends('layouts.app')
@section('title', 'Tambah Pelanggan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pelanggan.index') }}">Pelanggan</a></li>
    <li class="breadcrumb-item active" aria-current="page">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-lg-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Tambah Pelanggan Baru</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pelanggan.store') }}" method="POST">
                    @csrf
                    
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <label class="form-label fw-bold">Nama Pelanggan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan') }}" required>
                            @error('nama_pelanggan') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Jenis Kelamin <span class="text-danger">*</span></label>
                            <select name="jenis_kelamin" class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki (L)</option>
                                <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan (P)</option>
                            </select>
                            @error('jenis_kelamin') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">No. Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}" required>
                            @error('no_telepon') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat <span class="text-danger">*</span></label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Daftar <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_daftar" class="form-control @error('tanggal_daftar') is-invalid @enderror" value="{{ old('tanggal_daftar', date('Y-m-d')) }}" required>
                            @error('tanggal_daftar') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Catatan</label>
                            <input type="text" name="catatan" class="form-control @error('catatan') is-invalid @enderror" value="{{ old('catatan') }}">
                            @error('catatan') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
