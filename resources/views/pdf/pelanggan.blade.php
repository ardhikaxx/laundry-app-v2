@extends('layouts.pdf')
@section('pdf-content')
<div class="title-container">
    <div class="document-type">Kartu Profil Pelanggan</div>
    <h2 class="document-id">{{ $pelanggan->kode_pelanggan }}</h2>
</div>

<div style="display: table; width: 100%; margin-bottom: 30px;">
    <div style="display: table-cell; width: 40%; vertical-align: top;">
        <div class="rounded-card" style="margin-right: 10px; text-align: center; padding: 30px 20px;">
            <div style="background-color: #e0e7ff; color: #4f46e5; width: 60px; height: 60px; line-height: 60px; border-radius: 50%; font-size: 30px; font-weight: 900; margin: 0 auto 15px;">
                {{ substr($pelanggan->nama_pelanggan, 0, 1) }}
            </div>
            <h3 style="font-size: 16px; font-weight: 900; color: #0f172a; margin: 0;">{{ $pelanggan->nama_pelanggan }}</h3>
            <p style="font-size: 10px; color: #64748b; margin-top: 5px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px;">{{ $pelanggan->kode_pelanggan }}</p>
            <div style="margin-top: 15px;">
                <span class="badge badge-indigo">{{ $pelanggan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                <span class="badge badge-emerald">{{ $pelanggan->total_transaksi }}x Transaksi</span>
            </div>
        </div>
    </div>
    <div style="display: table-cell; width: 60%; vertical-align: top;">
        <div class="rounded-card" style="margin-left: 10px;">
            <p style="font-size: 8px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Detail Informasi</p>
            <table style="width: 100%; border: none; font-size: 10px;">
                <tr>
                    <td style="color: #64748b; padding-bottom: 10px; width: 35%;">No. Telepon</td>
                    <td style="font-weight: bold; padding-bottom: 10px;">{{ $pelanggan->no_telepon }}</td>
                </tr>
                <tr>
                    <td style="color: #64748b; padding-bottom: 10px;">Alamat Email</td>
                    <td style="font-weight: bold; padding-bottom: 10px;">{{ $pelanggan->email ?: 'Tidak tersedia' }}</td>
                </tr>
                <tr>
                    <td style="color: #64748b; padding-bottom: 10px;">Alamat Lengkap</td>
                    <td style="font-weight: bold; padding-bottom: 10px; line-height: 1.4;">{{ $pelanggan->alamat }}</td>
                </tr>
                <tr>
                    <td style="color: #64748b;">Member Sejak</td>
                    <td style="font-weight: bold;">{{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d M Y') }}</td>
                </tr>
            </table>
        </div>
    </div>
</div>

<h3 style="font-size: 12px; font-weight: 900; color: #0f172a; margin-bottom: 15px; text-transform: uppercase; letter-spacing: 1px;">Riwayat 10 Transaksi Terakhir</h3>
<table class="table">
    <thead>
        <tr>
            <th style="width: 30px;" class="text-center">No</th>
            <th>No Order</th>
            <th>Tanggal Masuk</th>
            <th>Total Bayar</th>
            <th class="text-center">Status</th>
            <th class="text-center">Pembayaran</th>
        </tr>
    </thead>
    <tbody>
        @forelse($transaksis as $i => $t)
        <tr>
            <td class="text-center" style="color: #94a3b8;">{{ $i + 1 }}</td>
            <td style="font-weight: 900; color: #4f46e5;">{{ $t->no_order }}</td>
            <td>{{ \Carbon\Carbon::parse($t->tanggal_masuk)->format('d M Y') }}</td>
            <td style="font-weight: bold;">Rp {{ number_format($t->total, 0, ',', '.') }}</td>
            <td class="text-center">
                <span class="badge badge-slate" style="font-size: 7px;">{{ $t->status }}</span>
            </td>
            <td class="text-center">
                @if($t->bayar >= $t->total)
                    <span style="color: #059669; font-weight: 900; font-size: 8px;">LUNAS</span>
                @else
                    <span style="color: #dc2626; font-weight: 900; font-size: 8px;">BELUM LUNAS</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center" style="padding: 20px; color: #94a3b8; font-style: italic;">
                Pelanggan ini belum memiliki riwayat transaksi.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
