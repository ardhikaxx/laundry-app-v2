@extends('layouts.app')
@section('title', 'Tambah Pelanggan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pelanggan.index') }}">Pelanggan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="mb-4">
            <h2 class="fw-black mb-1">Registrasi Pelanggan</h2>
            <p class="text-muted small fw-bold">Daftarkan pelanggan baru ke sistem loyalitas.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-5 p-4">
            <form action="{{ route('admin.pelanggan.store') }}" method="POST">
                @csrf
                <div class="row g-4 mb-4">
                    <div class="col-md-8">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Nama Lengkap</label>
                        <input type="text" name="nama_pelanggan" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan') }}" required>
                        @error('nama_pelanggan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select border-0 bg-light rounded-3 p-3 fw-bold" required>
                            <option value="L" {{ old('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">No. Telepon</label>
                        <input type="text" name="no_telepon" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('no_telepon') is-invalid @enderror" value="{{ old('no_telepon') }}" required>
                        @error('no_telepon') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Email (Opsional)</label>
                        <input type="email" name="email" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Alamat Lengkap</label>
                    <textarea name="alamat" rows="3" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" required>{{ old('alamat') }}</textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-light rounded-3 px-4 fw-bold small text-uppercase">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-black small text-uppercase shadow-sm">Daftarkan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
