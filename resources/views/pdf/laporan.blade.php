@extends('layouts.pdf')
@section('pdf-content')
<div class="title-container">
    <div class="document-type">Laporan Keuangan & Operasional</div>
    <h2 class="document-id">Periode Transaksi</h2>
</div>

<div style="display: table; width: 100%; margin-bottom: 30px;">
    <div style="display: table-cell; width: 60%; vertical-align: top;">
        <div class="rounded-card" style="margin-right: 10px;">
            <p style="font-size: 8px; font-weight: 900; color: #64748b; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px;">Filter Laporan</p>
            <table style="width: 100%; border: none; font-size: 10px;">
                <tr>
                    <td style="color: #64748b; padding-bottom: 5px;">Rentang Tanggal</td>
                    <td style="font-weight: bold; text-align: right;">
                        {{ request('dari_tanggal') ? \Carbon\Carbon::parse(request('dari_tanggal'))->format('d/m/Y') : 'Awal' }} 
                        s/d 
                        {{ request('sampai_tanggal') ? \Carbon\Carbon::parse(request('sampai_tanggal'))->format('d/m/Y') : 'Sekarang' }}
                    </td>
                </tr>
                <tr>
                    <td style="color: #64748b; padding-bottom: 5px;">Status Pesanan</td>
                    <td style="font-weight: bold; text-align: right; text-transform: uppercase;">{{ request('status') ?: 'Semua Status' }}</td>
                </tr>
                <tr>
                    <td style="color: #64748b;">Metode Bayar</td>
                    <td style="font-weight: bold; text-align: right; text-transform: uppercase;">{{ request('metode_bayar') ?: 'Semua Metode' }}</td>
                </tr>
            </table>
        </div>
    </div>
    <div style="display: table-cell; width: 40%; vertical-align: top;">
        <div class="rounded-card" style="margin-left: 10px; background-color: #4f46e5; border-color: #4338ca;">
            <p style="font-size: 8px; font-weight: 900; color: #c7d2fe; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 5px;">Total Pendapatan Bersih</p>
            @php 
                $totalLaporan = 0;
                foreach($data as $item) {
                    if($item->status !== 'batal') $totalLaporan += $item->total;
                }
            @endphp
            <p style="font-size: 20px; font-weight: 900; color: #ffffff; margin: 0; tracking-tighter: -1px;">Rp {{ number_format($totalLaporan, 0, ',', '.') }}</p>
            <p style="font-size: 8px; color: #a5b4fc; margin-top: 5px;">*Terhitung dari transaksi non-batal</p>
        </div>
    </div>
</div>

<table class="table">
    <thead>
        <tr>
            <th style="width: 30px;" class="text-center">No</th>
            <th style="width: 80px;">Tgl Masuk</th>
            <th style="width: 100px;">No Order</th>
            <th>Nama Pelanggan</th>
            <th class="text-center">Metode</th>
            <th class="text-center">Status</th>
            <th class="text-right">Total</th>
        </tr>
    </thead>
    <tbody>
        @forelse($data as $i => $item)
        <tr>
            <td class="text-center" style="color: #94a3b8;">{{ $i + 1 }}</td>
            <td style="color: #475569; font-weight: bold;">{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
            <td style="color: #4f46e5; font-weight: 900;">{{ $item->no_order }}</td>
            <td style="font-weight: bold; color: #1e293b;">{{ $item->pelanggan->nama_pelanggan }}</td>
            <td class="text-center">
                <span style="font-size: 8px; color: #64748b; font-weight: bold; text-transform: uppercase;">{{ $item->metode_bayar }}</span>
            </td>
            <td class="text-center">
                @php
                    $badgeCls = [
                        'diterima' => 'badge-slate',
                        'dicuci' => 'badge-indigo',
                        'dijemur' => 'badge-amber',
                        'disetrika' => 'badge-amber',
                        'siap' => 'badge-emerald',
                        'diambil' => 'badge-indigo',
                        'batal' => 'badge-rose'
                    ][$item->status] ?? 'badge-slate';
                @endphp
                <span class="badge {{ $badgeCls }}">{{ $item->status }}</span>
            </td>
            <td class="text-right" style="font-weight: 900; color: #0f172a;">
                Rp {{ number_format($item->total, 0, ',', '.') }}
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center" style="padding: 40px; color: #94a3b8; font-style: italic;">
                Tidak ada data transaksi yang ditemukan untuk kriteria filter ini.
            </td>
        </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6" class="text-right" style="font-weight: bold; color: #64748b; text-transform: uppercase; font-size: 9px;">Total Akumulasi</td>
            <td class="text-right" style="font-size: 14px; font-weight: 900; color: #4f46e5; border-top: 2px solid #e2e8f0;">
                Rp {{ number_format($totalLaporan, 0, ',', '.') }}
            </td>
        </tr>
    </tfoot>
</table>

<div style="margin-top: 40px; display: table; width: 100%;">
    <div style="display: table-cell; width: 70%;"></div>
    <div style="display: table-cell; width: 30%; text-align: center;">
        <p style="margin-bottom: 60px; color: #64748b; font-weight: bold;">Manager Operasional,</p>
        <div style="border-bottom: 1px solid #1e293b; width: 150px; margin: 0 auto;"></div>
        <p style="margin-top: 5px; font-weight: 900;">{{ auth()->user()->name }}</p>
    </div>
</div>
@endsection
