@extends('layouts.app')
@section('title', 'Ubah Pelanggan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pelanggan.index') }}">Pelanggan</a></li>
    <li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="mb-4">
            <h2 class="fw-black mb-1">Ubah Data Pelanggan</h2>
            <p class="text-muted small fw-bold">Edit informasi profil pelanggan.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-5 p-4">
            <form action="{{ route('admin.pelanggan.update', $pelanggan) }}" method="POST">
                @csrf @method('PATCH')
                <div class="row g-4 mb-4">
                    <div class="col-md-8">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Nama Lengkap</label>
                        <input type="text" name="nama_pelanggan" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan', $pelanggan->nama_pelanggan) }}" required>
                        @error('nama_pelanggan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select border-0 bg-light rounded-3 p-3 fw-bold" required>
                            <option value="L" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin', $pelanggan->jenis_kelamin) == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon', $pelanggan->no_telepon) }}" required>
                        @error('no_telepon') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Email (Opsional)</label>
                        <input type="email" name="email" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" value="{{ old('email', $pelanggan->email) }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" required>{{ old('alamat', $pelanggan->alamat) }}</textarea>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Tanggal Daftar</label>
                    <input type="date" name="tanggal_daftar" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('tanggal_daftar') is-invalid @enderror" value="{{ old('tanggal_daftar', $pelanggan->tanggal_daftar) }}" required>
                    @error('tanggal_daftar') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Status Akun</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active1" value="1" {{ $pelanggan->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active1">Aktif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active0" value="0" {{ !$pelanggan->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active0">Nonaktif</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-light rounded-3 px-4 fw-bold small text-uppercase">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-black small text-uppercase shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
