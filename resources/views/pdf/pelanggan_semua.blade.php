@extends('layouts.pdf')
@section('pdf-content')
<div class="pdf-title-container">
    <div class="pdf-title">DATA PELANGGAN LAUNDRY</div>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="width: 5%;">No</th>
            <th style="width: 15%;">Kode</th>
            <th style="width: 30%;">Nama Pelanggan</th>
            <th class="text-center" style="width: 5%;">L/P</th>
            <th style="width: 20%;">No. Telepon</th>
            <th style="width: 15%;">Tgl. Daftar</th>
            <th class="text-center" style="width: 10%;">Trx</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pelanggan as $i => $p)
        <tr>
            <td class="text-center">{{ $i + 1 }}</td>
            <td class="fw-bold text-primary">{{ $p->kode_pelanggan }}</td>
            <td class="fw-bold">{{ $p->nama_pelanggan }}</td>
            <td class="text-center">{{ $p->jenis_kelamin }}</td>
            <td>{{ $p->no_telepon }}</td>
            <td>{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('d/m/Y') }}</td>
            <td class="text-center">{{ $p->total_transaksi }}</td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted" style="padding: 20px;">Tidak ada data pelanggan</td></tr>
        @endforelse
    </tbody>
</table>

<div style="text-align:right; font-size:11px; margin-top: 15px;">
    <strong>Total Pelanggan Terdaftar:</strong> <span class="badge badge-primary">{{ $pelanggan->count() }} Orang</span>
</div>
@endsection
