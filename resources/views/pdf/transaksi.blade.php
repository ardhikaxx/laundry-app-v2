@extends('layouts.pdf')
@section('pdf-content')
<div class="pdf-title-container">
    <div class="pdf-title">NOTA TRANSAKSI: {{ $transaksi->no_order }}</div>
</div>

<table style="width:100%; border:none; margin-bottom:20px; font-size: 11px;">
    <tr>
        <td style="width:50%; vertical-align:top; border:none; padding: 0;">
            <div style="background-color: #f8f9fa; padding: 10px; border-radius: 4px; border: 1px solid #dee2e6;">
                <h4 style="margin-bottom: 5px; color: #0d6efd; border-bottom: 1px solid #dee2e6; padding-bottom: 5px;">Data Pelanggan</h4>
                <strong>{{ $transaksi->pelanggan->nama_pelanggan }}</strong><br>
                <span style="color: #666;">{{ $transaksi->pelanggan->no_telepon }}</span><br>
                {{ Str::limit($transaksi->pelanggan->alamat, 80) }}
            </div>
        </td>
        <td style="width:5%; border:none;"></td>
        <td style="width:45%; vertical-align:top; border:none; padding: 0;">
             <div style="background-color: #f8f9fa; padding: 10px; border-radius: 4px; border: 1px solid #dee2e6;">
                <h4 style="margin-bottom: 5px; color: #0d6efd; border-bottom: 1px solid #dee2e6; padding-bottom: 5px;">Detail Order</h4>
                <table style="width: 100%; border: none;">
                    <tr>
                        <td style="border: none; padding: 2px 0;"><strong>Tgl Masuk</strong></td>
                        <td style="border: none; padding: 2px 0; text-align: right;">{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 2px 0;"><strong>Est. Selesai</strong></td>
                        <td style="border: none; padding: 2px 0; text-align: right;">{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d/m/Y') }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 2px 0;"><strong>Kasir</strong></td>
                        <td style="border: none; padding: 2px 0; text-align: right;">{{ $transaksi->pegawai->nama_pegawai ?? 'Admin' }}</td>
                    </tr>
                </table>
            </div>
        </td>
    </tr>
</table>

<table class="table">
    <thead>
        <tr>
            <th style="width: 5%;" class="text-center">No</th>
            <th style="width: 40%;">Layanan</th>
            <th style="width: 25%;" class="text-right">Harga Satuan</th>
            <th style="width: 10%;" class="text-center">Qty</th>
            <th style="width: 20%;" class="text-right">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi->detail as $i => $item)
        <tr>
            <td class="text-center">{{ $i + 1 }}</td>
            <td>
                <strong>{{ $item->nama_layanan }}</strong>
                @if($item->keterangan)
                    <br><span style="font-size: 9px; color: #666;">Catatan: {{ $item->keterangan }}</span>
                @endif
            </td>
            <td class="text-right">Rp {{ number_format($item->harga_satuan, 0, ',', '.') }}<span class="text-muted" style="font-size: 9px;"> / {{ strtoupper($item->satuan) }}</span></td>
            <td class="text-center">{{ $item->qty }}</td>
            <td class="text-right fw-bold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="4" class="text-right"><strong>Total Transaksi:</strong></td>
            <td class="text-right text-primary fw-bold" style="font-size: 14px;">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan="4" class="text-right">Telah Dibayar ({{ strtoupper($transaksi->metode_bayar) }}):</td>
            <td class="text-right">Rp {{ number_format($transaksi->bayar ?? 0, 0, ',', '.') }}</td>
        </tr>
        @if($transaksi->kembalian > 0)
        <tr>
            <td colspan="4" class="text-right">Kembalian:</td>
            <td class="text-right">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</td>
        </tr>
        @endif
        <tr>
            <td colspan="4" class="text-right"><strong>Status Pembayaran:</strong></td>
            <td class="text-right">
                @if($transaksi->bayar >= $transaksi->total)
                    <span class="badge badge-success">LUNAS</span>
                @else
                    <span class="badge badge-danger">BELUM LUNAS</span>
                @endif
            </td>
        </tr>
    </tfoot>
</table>

<div style="margin-top:30px; font-size:10px; background-color: #f1f5f9; padding: 10px; border-left: 3px solid #0dcaf0; border-radius: 4px;">
    <strong>Catatan Transaksi:</strong><br>
    {{ $transaksi->catatan ?: 'Tidak ada catatan tambahan.' }}
</div>

<div style="margin-top:40px; font-size:11px; text-align: center;">
    <p><em>Harap membawa nota ini saat pengambilan cucian.</em></p>
    <p>Terima kasih atas kepercayaan Anda menggunakan layanan <strong>Cuciin</strong>.</p>
</div>
@endsection
