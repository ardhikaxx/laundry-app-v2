@extends('layouts.pdf')
@section('pdf-content')
<div class="pdf-title-container">
    <div class="pdf-title">PROFIL PELANGGAN</div>
</div>

<table style="width: 100%; border: none; margin-bottom: 20px;">
    <tr>
        <td style="width: 60%; vertical-align: top; border: none; padding: 0;">
            <div style="background-color: #f8f9fa; border: 1px solid #dee2e6; padding: 15px; border-radius: 4px;">
                <h4 style="margin-top: 0; color: #0d6efd; border-bottom: 1px solid #dee2e6; padding-bottom: 8px; margin-bottom: 12px;">Data Pribadi</h4>
                <table style="width: 100%; border: none; font-size: 11px;">
                    <tr>
                        <td style="width: 35%; border: none; padding: 4px 0; color: #6c757d;"><strong>Kode Pelanggan</strong></td>
                        <td style="width: 65%; border: none; padding: 4px 0; font-weight: bold; color: #0d6efd;">: {{ $pelanggan->kode_pelanggan }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 4px 0; color: #6c757d;"><strong>Nama Lengkap</strong></td>
                        <td style="border: none; padding: 4px 0; font-weight: bold;">: {{ $pelanggan->nama_pelanggan }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 4px 0; color: #6c757d;"><strong>Jenis Kelamin</strong></td>
                        <td style="border: none; padding: 4px 0;">: {{ $pelanggan->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 4px 0; color: #6c757d;"><strong>No. Telepon</strong></td>
                        <td style="border: none; padding: 4px 0;">: {{ $pelanggan->no_telepon }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 4px 0; color: #6c757d;"><strong>Email</strong></td>
                        <td style="border: none; padding: 4px 0;">: {{ $pelanggan->email ?: '-' }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 4px 0; color: #6c757d; vertical-align: top;"><strong>Alamat</strong></td>
                        <td style="border: none; padding: 4px 0;">: {{ $pelanggan->alamat }}</td>
                    </tr>
                    <tr>
                        <td style="border: none; padding: 4px 0; color: #6c757d;"><strong>Terdaftar Sejak</strong></td>
                        <td style="border: none; padding: 4px 0;">: {{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d F Y') }}</td>
                    </tr>
                </table>
            </div>
        </td>
        <td style="width: 5%; border: none;"></td>
        <td style="width: 35%; vertical-align: top; border: none; padding: 0;">
            <div style="background-color: #f1f5f9; border: 1px solid #0d6efd; padding: 20px; border-radius: 4px; text-align: center;">
                <h5 style="margin: 0; color: #333;">Total Transaksi</h5>
                <div style="font-size: 48px; font-weight: bold; color: #0d6efd; margin: 15px 0;">
                    {{ $pelanggan->total_transaksi }}x
                </div>
                <p style="font-size: 10px; color: #6c757d; margin: 0;">Total transaksi sukses yang pernah dilakukan.</p>
            </div>
        </td>
    </tr>
</table>

@if($pelanggan->catatan)
<div style="background-color: #fff3cd; border: 1px solid #ffecb5; padding: 12px; border-radius: 4px; font-size: 11px;">
    <strong style="color: #664d03;">Catatan Pelanggan:</strong><br>
    <span style="color: #664d03;">{{ $pelanggan->catatan }}</span>
</div>
@endif

@endsection
