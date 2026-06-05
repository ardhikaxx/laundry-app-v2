@extends('layouts.app')
@section('title', 'Ubah Pegawai')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pegawai.index') }}">Pegawai</a></li>
    <li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="mb-4">
            <h2 class="fw-black mb-1">Ubah Data Pegawai</h2>
            <p class="text-muted small fw-bold">Edit profil dan hak akses petugas.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-5 p-4">
            <form action="{{ route('admin.pegawai.update', $pegawai) }}" method="POST">
                @csrf @method('PATCH')
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Nama Lengkap</label>
                        <input type="text" name="nama_pegawai" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('nama_pegawai') is-invalid @enderror" value="{{ old('nama_pegawai', $pegawai->nama_pegawai) }}" required>
                        @error('nama_pegawai') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Jabatan</label>
                        <input type="text" name="jabatan" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $pegawai->jabatan) }}" required>
                        @error('jabatan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon', $pegawai->no_telepon) }}" required>
                        @error('no_telepon') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Tanggal Masuk</label>
                        <input type="date" name="tanggal_masuk" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', $pegawai->tanggal_masuk) }}" required>
                        @error('tanggal_masuk') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Alamat Domisili</label>
                    <textarea name="alamat" rows="3" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" required>{{ old('alamat', $pegawai->alamat) }}</textarea>
                </div>
                
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Status</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active1" value="1" {{ $pegawai->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active1">Aktif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active0" value="0" {{ !$pegawai->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active0">Nonaktif</label>
                        </div>
                    </div>
                </div>

                <hr class="my-5 opacity-10">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h6 class="fw-black text-uppercase spacing-widest text-primary mb-0" style="font-size: 10px;">Informasi Akun</h6>
                    <small class="text-muted italic" style="font-size: 10px;">*Sandi hanya diisi jika ingin diubah</small>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Email Petugas</label>
                        <input type="email" name="email" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('email') is-invalid @enderror" value="{{ old('email', $pegawai->user->email ?? '') }}" required>
                        @error('email') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Ganti Sandi</label>
                        <input type="password" name="password" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('password') is-invalid @enderror" placeholder="Kosongkan jika tidak diubah">
                        @error('password') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pegawai.index') }}" class="btn btn-light rounded-3 px-4 fw-bold small text-uppercase">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-black small text-uppercase shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
