@extends('layouts.pdf')
@section('pdf-content')
<div class="title-container">
    <div class="document-type">Invoice / Nota Transaksi</div>
    <h2 class="document-id">{{ $transaksi->no_order }}</h2>
</div>

<div style="display: table; width: 100%; margin-bottom: 40px;">
    <div style="display: table-cell; width: 50%; vertical-align: top;">
        <div class="rounded-card" style="margin-right: 10px;">
            <p style="font-size: 8px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Customer</p>
            <p style="font-size: 14px; font-weight: 900; color: #0f172a; margin: 0;">{{ $transaksi->pelanggan->nama_pelanggan }}</p>
            <p style="color: #4f46e5; font-weight: bold; margin: 2px 0;">{{ $transaksi->pelanggan->no_telepon }}</p>
            <p style="font-size: 9px; color: #64748b; margin: 5px 0 0 0; line-height: 1.4;">{{ $transaksi->pelanggan->alamat }}</p>
        </div>
    </div>
    <div style="display: table-cell; width: 50%; vertical-align: top;">
        <div class="rounded-card" style="margin-left: 10px;">
            <p style="font-size: 8px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Order Details</p>
            <div style="display: table; width: 100%; font-size: 10px;">
                <div style="display: table-row;">
                    <div style="display: table-cell; padding-bottom: 5px; color: #64748b;">Tanggal Masuk</div>
                    <div style="display: table-cell; padding-bottom: 5px; text-align: right; font-weight: bold;">{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</div>
                </div>
                <div style="display: table-row;">
                    <div style="display: table-cell; padding-bottom: 5px; color: #64748b;">Estimasi Selesai</div>
                    <div style="display: table-cell; padding-bottom: 5px; text-align: right; font-weight: bold; color: #4f46e5;">{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d M Y') }}</div>
                </div>
                <div style="display: table-row;">
                    <div style="display: table-cell; color: #64748b;">Kasir</div>
                    <div style="display: table-cell; text-align: right; font-weight: bold;">{{ $transaksi->pegawai->nama_pegawai ?? 'Admin' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th style="width: 50px;" class="text-center">No</th>
            <th>Item Layanan</th>
            <th class="text-right">Harga</th>
            <th class="text-center" style="width: 80px;">Jumlah</th>
            <th class="text-right" style="width: 120px;">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi->detail as $i => $item)
        <tr>
            <td class="text-center" style="color: #94a3b8; font-weight: bold;">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
            <td>
                <div style="font-weight: 900; color: #0f172a; font-size: 11px;">{{ $item->nama_layanan }}</div>
                @if($item->keterangan)
                    <div style="font-size: 8px; color: #94a3b8; font-style: italic; margin-top: 2px;">Note: {{ $item->keterangan }}</div>
                @endif
            </td>
            <td class="text-right">
                <span style="color: #64748b;">Rp</span> {{ number_format($item->harga_satuan, 0, ',', '.') }}
                <span style="font-size: 8px; color: #94a3b8; text-transform: uppercase;">/{{ $item->satuan }}</span>
            </td>
            <td class="text-center">
                <span class="badge badge-slate">{{ $item->qty }}</span>
            </td>
            <td class="text-right font-black">
                <span style="color: #64748b;">Rp</span> {{ number_format($item->subtotal, 0, ',', '.') }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="summary-table">
    <div class="summary-row">
        <div class="summary-label">Total Transaksi</div>
        <div class="summary-value">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</div>
    </div>
    <div class="summary-row">
        <div class="summary-label">Telah Dibayar ({{ strtoupper($transaksi->metode_bayar) }})</div>
        <div class="summary-value">Rp {{ number_format($transaksi->bayar ?? 0, 0, ',', '.') }}</div>
    </div>
    @if($transaksi->kembalian > 0)
    <div class="summary-row">
        <div class="summary-label">Kembalian</div>
        <div class="summary-value text-indigo">Rp {{ number_format($transaksi->kembalian, 0, ',', '.') }}</div>
    </div>
    @endif
    <div class="total-row">
        <div class="summary-row">
            <div class="summary-label total-label">Status Pembayaran</div>
            <div class="summary-value total-value">
                @if($transaksi->bayar >= $transaksi->total)
                    <span style="color: #059669;">LUNAS</span>
                @else
                    <span style="color: #dc2626;">BELUM LUNAS</span>
                @endif
            </div>
        </div>
    </div>
</div>

@if($transaksi->catatan)
<div style="margin-top: 30px; border-left: 4px solid #e2e8f0; padding-left: 15px;">
    <p style="font-size: 8px; font-weight: 900; color: #94a3b8; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Catatan Transaksi</p>
    <p style="font-size: 10px; color: #475569; font-style: italic; margin: 0;">"{{ $transaksi->catatan }}"</p>
</div>
@endif

<div style="margin-top: 60px; text-align: center;">
    <p style="font-size: 10px; font-weight: bold; color: #1e293b;">Syarat & Ketentuan:</p>
    <p style="font-size: 8px; color: #64748b; max-width: 400px; margin: 0 auto; line-height: 1.4;">
        Harap membawa nota ini saat pengambilan. Barang yang tidak diambil dalam 30 hari diluar tanggung jawab kami.
        Keluhan hanya dilayani maksimal 24 jam setelah barang diterima dengan melampirkan nota.
    </p>
</div>
@endsection
