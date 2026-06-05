@extends('layouts.app')
@section('title', 'Tambah Layanan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.layanan.index') }}">Layanan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="mb-4">
            <h2 class="fw-black mb-1">Tambah Layanan Baru</h2>
            <p class="text-muted small fw-bold">Definisikan tarif dan spesifikasi layanan baru.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-5 p-4">
            <form action="{{ route('admin.layanan.store') }}" method="POST">
                @csrf
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Nama Layanan</label>
                        <input type="text" name="nama_layanan" class="form-control border-0 bg-light rounded-3 p-3 fw-bold @error('nama_layanan') is-invalid @enderror" placeholder="Contoh: Cuci Lipat" value="{{ old('nama_layanan') }}" required>
                        @error('nama_layanan') <div class="invalid-feedback fw-bold">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Kategori</label>
                        <select name="kategori_layanan_id" class="form-select border-0 bg-light rounded-3 p-3 fw-bold" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id }}" {{ old('kategori_layanan_id') == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row g-4 mb-4">
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Satuan</label>
                        <select name="satuan" class="form-select border-0 bg-light rounded-3 p-3 fw-bold" required>
                            <option value="kg">Kilogram (Kg)</option>
                            <option value="pcs">Pieces (Pcs)</option>
                            <option value="item">Item</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Harga (Rp)</label>
                        <input type="number" name="harga" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" value="{{ old('harga', 0) }}" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Est. Hari</label>
                        <input type="number" name="estimasi_hari" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" value="{{ old('estimasi_hari', 1) }}" required>
                    </div>
                </div>
                <div class="mb-4">
                    <label class="form-label small fw-black text-muted text-uppercase spacing-widest">Deskripsi</label>
                    <textarea name="deskripsi" rows="3" class="form-control border-0 bg-light rounded-3 p-3 fw-bold" placeholder="Detail layanan...">{{ old('deskripsi') }}</textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.layanan.index') }}" class="btn btn-light rounded-3 px-4 fw-bold small text-uppercase">Batal</a>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 fw-black small text-uppercase shadow-sm">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
