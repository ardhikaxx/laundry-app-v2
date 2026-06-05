@extends('layouts.app')
@section('title', 'Ubah Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Layanan</a></li>
    <li class="breadcrumb-item active">Ubah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="mb-4">
            <h2 class="fw-black mb-1">Ubah Data Layanan</h2>
            <p class="text-muted small fw-bold">Edit informasi tarif dan spesifikasi.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-5 p-4">
            <form action="{{ route('admin.layanan.update', $layanan) }}" method="POST">
                @csrf @method('PATCH')
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('nama_layanan') is-invalid @enderror" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required>
                        @error('nama_layanan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Kategori</label>
                        <select name="kategori_layanan_id" class="form-select border-0 bg-light rounded-3 p-3 fw-bold" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_layanan_id', $layanan->kategori_layanan_id) == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Satuan</label>
                        <select name="satuan" class="form-select border-0 bg-light rounded-3 p-3 fw-bold" required>
                            <option value="kg" {{ $layanan->satuan == 'kg' ? 'selected' : '' }}>Kilogram (Kg)</option>
                            <option value="pcs" {{ $layanan->satuan == 'pcs' ? 'selected' : '' }}>Pieces (Pcs)</option>
                            <option value="item" {{ $layanan->satuan == 'item' ? 'selected' : '' }}>Item</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" value="{{ old('harga', $layanan->harga) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Est. Hari</label>
                        <input type="number" name="estimasi_hari" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" value="{{ old('estimasi_hari', $layanan->estimasi_hari) }}" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Status</label>
                    <div class="d-flex gap-3">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active1" value="1" {{ $layanan->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active1">Aktif</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="is_active" id="active0" value="0" {{ !$layanan->is_active ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold small" for="active0">Nonaktif</label>
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-light rounded-3 px-4 fw-bold small text-uppercase">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-black small text-uppercase shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
