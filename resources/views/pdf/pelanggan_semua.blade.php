@extends('layouts.pdf')
@section('pdf-content')
<div class="title-container">
    <div class="document-type">Laporan Data Master</div>
    <h2 class="document-id">Seluruh Database Pelanggan</h2>
</div>

<div class="rounded-card" style="margin-bottom: 30px; display: table; width: 100%;">
    <div style="display: table-cell; width: 50%;">
        <p style="font-size: 8px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Total Data</p>
        <p style="font-size: 16px; font-weight: 900; color: #0f172a; margin: 0;">{{ $pelanggans->count() }} Pelanggan Terdaftar</p>
    </div>
    <div style="display: table-cell; width: 50%; text-align: right; vertical-align: bottom;">
        <p style="font-size: 8px; color: #94a3b8; font-style: italic;">Urutan berdasarkan pendaftaran terbaru</p>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th style="width: 30px;" class="text-center">No</th>
            <th style="width: 100px;">Kode</th>
            <th>Nama Pelanggan</th>
            <th class="text-center" style="width: 40px;">L/P</th>
            <th>No. Telepon</th>
            <th class="text-center">Tgl Daftar</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($pelanggans as $i => $p)
        <tr>
            <td class="text-center" style="color: #94a3b8;">{{ $i + 1 }}</td>
            <td style="font-weight: 900; color: #4f46e5;">{{ $p->kode_pelanggan }}</td>
            <td style="font-weight: bold; color: #1e293b;">{{ $p->nama_pelanggan }}</td>
            <td class="text-center" style="color: #64748b; font-weight: bold;">{{ $p->jenis_kelamin }}</td>
            <td style="font-weight: bold;">{{ $p->no_telepon }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($p->tanggal_daftar)->format('d/m/Y') }}</td>
            <td class="text-center">
                @if($p->is_active)
                    <span class="badge badge-emerald">Aktif</span>
                @else
                    <span class="badge badge-slate">Nonaktif</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center" style="padding: 40px; color: #94a3b8; font-style: italic;">
                Belum ada data pelanggan dalam database.
            </td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
