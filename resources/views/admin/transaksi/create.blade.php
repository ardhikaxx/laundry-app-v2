@extends('layouts.app')
@section('title', 'Buat Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.transaksi.index') }}">Transaksi</a></li>
    <li class="breadcrumb-item active" aria-current="page">Buat Baru</li>
@endsection

@section('content')
<form action="{{ route('admin.transaksi.store') }}" method="POST" id="formTransaksi">
    @csrf
    <div class="row">
        <div class="col-lg-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Umum</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Pelanggan <span class="text-danger">*</span></label>
                        <select name="pelanggan_id" class="form-select @error('pelanggan_id') is-invalid @enderror" required>
                            <option value="">-- Pilih Pelanggan --</option>
                            @foreach($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}" {{ old('pelanggan_id') == $pelanggan->id ? 'selected' : '' }}>
                                    {{ $pelanggan->kode_pelanggan }} - {{ $pelanggan->nama_pelanggan }}
                                </option>
                            @endforeach
                        </select>
                        @error('pelanggan_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Tanggal Masuk <span class="text-danger">*</span></label>
                        <input type="date" name="tanggal_masuk" class="form-control @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                        @error('tanggal_masuk') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Pegawai Penerima (Opsional)</label>
                        <select name="pegawai_id" class="form-select @error('pegawai_id') is-invalid @enderror">
                            <option value="">-- Pilih Pegawai --</option>
                            @foreach($pegawais as $pegawai)
                                <option value="{{ $pegawai->id }}" {{ old('pegawai_id') == $pegawai->id ? 'selected' : '' }}>
                                    {{ $pegawai->nama_pegawai }}
                                </option>
                            @endforeach
                        </select>
                        @error('pegawai_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Catatan Transaksi</label>
                        <textarea name="catatan" rows="3" class="form-control @error('catatan') is-invalid @enderror" placeholder="Catatan tambahan...">{{ old('catatan') }}</textarea>
                        @error('catatan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <h6 class="mb-0 fw-bold"><i class="fas fa-list me-2 text-primary"></i>Detail Layanan</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="tambahItem()">
                        <i class="fas fa-plus me-1"></i>Tambah Item
                    </button>
                </div>
                <div class="card-body">
                    @error('items')
                        <div class="alert alert-danger py-2 small">{{ $message }}</div>
                    @enderror
                    
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0" id="tabelItem">
                            <thead class="table-light">
                                <tr>
                                    <th width="45%">Layanan</th>
                                    <th width="20%" class="text-end">Harga Satuan</th>
                                    <th width="15%">Qty</th>
                                    <th width="20%" class="text-end">Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Baris item akan dimuat via JS -->
                            </tbody>
                            <tfoot class="table-light">
                                <tr>
                                    <th colspan="3" class="text-end py-3">Total Transaksi:</th>
                                    <th class="text-end fw-bold py-3 fs-5 text-primary" id="totalSemua">Rp 0</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="mt-4 pt-3 border-top">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-muted">Metode Pembayaran <span class="text-danger">*</span></label>
                                <select name="metode_bayar" class="form-select @error('metode_bayar') is-invalid @enderror" required>
                                    <option value="tunai" {{ old('metode_bayar') == 'tunai' ? 'selected' : '' }}>Tunai</option>
                                    <option value="transfer" {{ old('metode_bayar') == 'transfer' ? 'selected' : '' }}>Transfer Bank</option>
                                    <option value="qris" {{ old('metode_bayar') == 'qris' ? 'selected' : '' }}>QRIS</option>
                                    <option value="dompet_digital" {{ old('metode_bayar') == 'dompet_digital' ? 'selected' : '' }}>Dompet Digital (Gopay/OVO/Dana)</option>
                                </select>
                                @error('metode_bayar') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                            <div class="col-md-6 text-end mt-4 mt-md-0">
                                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-secondary me-2">Batal</a>
                                <button type="submit" class="btn btn-primary px-4 fw-bold"><i class="fas fa-save me-2"></i>Simpan Transaksi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Data referensi layanan untuk JS -->
<script>
    const referensiLayanan = {
        @foreach($layanans as $layanan)
        "{{ $layanan->id }}": {
            harga: {{ $layanan->harga }},
            satuan: "{{ strtoupper($layanan->satuan) }}"
        },
        @endforeach
    };
</script>
@endsection

@push('scripts')
<script>
    let itemIndex = 0;

    function tambahItem() {
        const tbody = document.querySelector('#tabelItem tbody');
        const tr = document.createElement('tr');
        
        let options = '<option value="">-- Pilih --</option>';
        @foreach($layanans as $layanan)
            options += `<option value="{{ $layanan->id }}">{{ $layanan->nama_layanan }}</option>`;
        @endforeach

        tr.innerHTML = `
            <td>
                <select name="items[${itemIndex}][layanan_id]" class="form-select select-layanan" onchange="updateHarga(this, ${itemIndex})" required>
                    ${options}
                </select>
            </td>
            <td class="text-end align-middle">
                <span id="label-harga-${itemIndex}">Rp 0</span>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <input type="number" step="0.1" name="items[${itemIndex}][qty]" class="form-control input-qty" value="1" min="0.1" onchange="hitungSubtotal(${itemIndex})" required>
                    <span class="input-group-text" id="label-satuan-${itemIndex}">-</span>
                </div>
            </td>
            <td class="text-end align-middle fw-bold text-success">
                <span id="label-subtotal-${itemIndex}">Rp 0</span>
            </td>
            <td class="text-center align-middle">
                <button type="button" class="btn btn-sm btn-danger" onclick="hapusItem(this)"><i class="fas fa-times"></i></button>
            </td>
        `;
        tbody.appendChild(tr);
        itemIndex++;
    }

    function updateHarga(select, index) {
        const id = select.value;
        const info = referensiLayanan[id];
        
        if (info) {
            document.getElementById(`label-harga-${index}`).innerText = formatRupiah(info.harga);
            document.getElementById(`label-satuan-${index}`).innerText = info.satuan;
        } else {
            document.getElementById(`label-harga-${index}`).innerText = 'Rp 0';
            document.getElementById(`label-satuan-${index}`).innerText = '-';
        }
        hitungSubtotal(index);
    }

    function hitungSubtotal(index) {
        const select = document.querySelector(`select[name="items[${index}][layanan_id]"]`);
        const inputQty = document.querySelector(`input[name="items[${index}][qty]"]`);
        
        if (!select || !inputQty) return;

        const id = select.value;
        const qty = parseFloat(inputQty.value) || 0;
        
        let subtotal = 0;
        if (id && referensiLayanan[id]) {
            subtotal = referensiLayanan[id].harga * qty;
        }
        
        document.getElementById(`label-subtotal-${index}`).innerText = formatRupiah(subtotal);
        hitungTotalSemua();
    }

    function hapusItem(btn) {
        btn.closest('tr').remove();
        hitungTotalSemua();
    }

    function hitungTotalSemua() {
        let total = 0;
        const selects = document.querySelectorAll('.select-layanan');
        const qtys = document.querySelectorAll('.input-qty');
        
        for (let i = 0; i < selects.length; i++) {
            const id = selects[i].value;
            const qty = parseFloat(qtys[i].value) || 0;
            if (id && referensiLayanan[id]) {
                total += referensiLayanan[id].harga * qty;
            }
        }
        
        document.getElementById('totalSemua').innerText = formatRupiah(total);
    }

    function formatRupiah(angka) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
    }

    // Tambahkan 1 item default saat pertama kali dimuat
    document.addEventListener('DOMContentLoaded', () => {
        tambahItem();
    });
</script>
@endpush
