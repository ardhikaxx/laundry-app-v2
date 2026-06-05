@extends('layouts.app')
@section('title', 'Buat Transaksi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.transaksi.index') }}">Transaksi</a></li>
    <li class="breadcrumb-item active">Buat Baru</li>
@endsection

@section('content')
<style>
    .form-card { background: white; border-radius: 30px; border: 1px solid #e2e8f0; padding: 40px; box-shadow: 0 10px 30px rgba(0,0,0,0.02); }
    .item-row { background: #f8fafc; border-radius: 20px; padding: 20px; margin-bottom: 15px; border: 1px solid #f1f5f9; transition: all 0.2s; }
    .item-row:hover { border-color: #c7d2fe; background: white; }
    .btn-add { background: #f5f3ff; color: #4f46e5; font-weight: 800; border: none; border-radius: 12px; padding: 10px 20px; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; }
    .btn-add:hover { background: #4f46e5; color: white; }
    .total-display { background: #4f46e5; color: white; border-radius: 20px; padding: 25px; text-align: right; }
</style>

<div class="mb-4">
    <h2 class="fw-black mb-1">Buat Transaksi Baru</h2>
    <p class="text-muted small fw-bold">Input pesanan laundry pelanggan dengan rincian layanan.</p>
</div>

<form action="{{ route('admin.transaksi.store') }}" method="POST" id="formTransaksi">
    @csrf
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="form-card h-100">
                <h5 class="fw-black mb-4">Informasi Umum</h5>
                
                <div class="mb-4">
                    <label class="form-label fw-black text-muted small text-uppercase spacing-widest" style="font-size: 10px;">Pelanggan</label>
                    <select name="pelanggan_id" class="form-select border-0 bg-light rounded-3 p-3 fw-bold small" required>
                        <option value="">-- Pilih Pelanggan --</option>
                        @foreach($pelanggans as $p)
                            <option value="{{ $p->id }}" {{ old('pelanggan_id') == $p->id ? 'selected' : '' }}>{{ $p->kode_pelanggan }} - {{ $p->nama_pelanggan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-black text-muted small text-uppercase spacing-widest" style="font-size: 10px;">Tanggal Masuk</label>
                    <input type="date" name="tanggal_masuk" class="form-control border-0 bg-light rounded-3 p-3 fw-bold small" value="{{ old('tanggal_masuk', date('Y-m-d')) }}" required>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-black text-muted small text-uppercase spacing-widest" style="font-size: 10px;">Pegawai Penerima</label>
                    <select name="pegawai_id" class="form-select border-0 bg-light rounded-3 p-3 fw-bold small">
                        <option value="">-- Pilih Pegawai --</option>
                        @foreach($pegawais as $pg)
                            <option value="{{ $pg->id }}" {{ old('pegawai_id') == $pg->id ? 'selected' : '' }}>{{ $pg->nama_pegawai }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-0">
                    <label class="form-label fw-black text-muted small text-uppercase spacing-widest" style="font-size: 10px;">Catatan</label>
                    <textarea name="catatan" rows="3" class="form-control border-0 bg-light rounded-3 p-3 fw-bold small" placeholder="Opsional...">{{ old('catatan') }}</textarea>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="form-card">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-black mb-0">Rincian Layanan</h5>
                    <button type="button" class="btn btn-add shadow-sm" onclick="tambahItem()">
                        <i class="fas fa-plus me-2"></i> Tambah Item
                    </button>
                </div>

                <div id="containerItem" class="mb-4">
                    <!-- Items JS -->
                </div>

                <div class="total-display mb-4 shadow-lg">
                    <span class="d-block text-uppercase fw-black text-white text-opacity-75 mb-1" style="font-size: 10px; letter-spacing: 2px;">Total Tagihan</span>
                    <h2 class="fw-black mb-0" id="labelTotal">Rp 0</h2>
                </div>

                <div class="row g-3 align-items-end">
                    <div class="col-md-6">
                        <label class="form-label fw-black text-muted small text-uppercase spacing-widest" style="font-size: 10px;">Metode Bayar</label>
                        <select name="metode_bayar" class="form-select border-0 bg-light rounded-3 p-3 fw-bold small" required>
                            <option value="tunai">Tunai / Cash</option>
                            <option value="transfer">Transfer Bank</option>
                            <option value="qris">QRIS</option>
                        </select>
                    </div>
                    <div class="col-md-6 text-end">
                        <button type="submit" class="btn btn-dark rounded-4 py-3 px-5 fw-black text-uppercase small spacing-widest w-100">Simpan Transaksi</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    const dataLayanan = {
        @foreach($layanans as $l)
        "{{ $l->id }}": { harga: {{ $l->harga }}, satuan: "{{ strtoupper($l->satuan) }}" },
        @endforeach
    };
    let index = 0;

    function tambahItem() {
        const container = document.getElementById('containerItem');
        const div = document.createElement('div');
        div.className = 'item-row d-flex align-items-center gap-3 flex-wrap flex-md-nowrap';
        div.id = `row-${index}`;
        
        let opt = '<option value="">-- Pilih Layanan --</option>';
        @foreach($layanans as $l)
            opt += `<option value="{{ $l->id }}">{{ $l->nama_layanan }}</option>`;
        @endforeach

        div.innerHTML = `
            <div class="flex-grow-1">
                <select name="items[${index}][layanan_id]" class="form-select border-0 fw-bold small" onchange="updateRow(${index})" required>${opt}</select>
            </div>
            <div style="width: 100px;">
                <input type="number" step="0.1" name="items[${index}][qty]" class="form-control border-0 fw-black text-center" value="1" min="0.1" onchange="hitungSemua()" required>
            </div>
            <div class="text-muted small fw-bold text-uppercase" style="width: 50px;" id="satuan-${index}">-</div>
            <div class="text-end fw-black text-primary" style="min-width: 120px;" id="subtotal-${index}">Rp 0</div>
            <button type="button" class="btn btn-link text-danger p-0" onclick="hapusRow(${index})"><i class="fas fa-trash"></i></button>
        `;
        container.appendChild(div);
        index++;
    }

    function updateRow(idx) {
        const sel = document.querySelector(`select[name="items[${idx}][layanan_id]"]`);
        const id = sel.value;
        const sat = document.getElementById(`satuan-${idx}`);
        if(id && dataLayanan[id]) sat.innerText = dataLayanan[id].satuan;
        else sat.innerText = '-';
        hitungSemua();
    }

    function hapusRow(idx) {
        document.getElementById(`row-${idx}`).remove();
        hitungSemua();
    }

    function hitungSemua() {
        let total = 0;
        for(let i=0; i<index; i++) {
            const row = document.getElementById(`row-${i}`);
            if(!row) continue;
            const lid = document.querySelector(`select[name="items[${i}][layanan_id]"]`).value;
            const qty = parseFloat(document.querySelector(`input[name="items[${i}][qty]"]`).value) || 0;
            if(lid && dataLayanan[lid]) {
                const sub = dataLayanan[lid].harga * qty;
                total += sub;
                document.getElementById(`subtotal-${i}`).innerText = `Rp ${new Intl.NumberFormat('id-ID').format(sub)}`;
            }
        }
        document.getElementById('labelTotal').innerText = `Rp ${new Intl.NumberFormat('id-ID').format(total)}`;
    }

    document.addEventListener('DOMContentLoaded', () => tambahItem());
</script>
@endsection
