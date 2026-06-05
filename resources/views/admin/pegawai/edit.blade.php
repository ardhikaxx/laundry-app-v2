@extends('layouts.app')
@section('title', 'Ubah Pegawai')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pegawai.index') }}">Pegawai</a></li>
    <li class="breadcrumb-item active" aria-current="page">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-md-8 col-lg-6">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Ubah Data Pegawai: {{ $pegawai->kode_pegawai }}</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.pegawai.update', $pegawai) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Pegawai <span class="text-danger">*</span></label>
                        <input type="text" name="nama_pegawai" class="form-control @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
                        @error('nama_pegawai') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
                            @error('jabatan') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">No. Telepon</label>
                            <input type="text" name="no_telepon" class="form-control @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon', $pegawai->no_telepon) }}">
                            @error('no_telepon') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" rows="3">{{ old('alamat', $pegawai->alamat) }}</textarea>
                        @error('alamat') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tanggal Masuk <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', $pegawai->tanggal_masuk) }}" required>
                            @error('tanggal_masuk') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Status <span class="text-danger">*</span></label>
                            <select name="is_active" class="form-select @error('is_active') is-invalid @enderror" required>
                                <option value="1" {{ old('is_active', $pegawai->is_active) == '1' ? 'selected' : '' }}>Aktif</option>
                                <option value="0" {{ old('is_active', $pegawai->is_active) == '0' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('is_active') <div class="invalid-feedback d-block">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.pegawai.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
