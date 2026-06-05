@extends('layouts.pdf')
@section('pdf-content')
<div class="pdf-title-container">
    <div class="pdf-title">LAPORAN TRANSAKSI LAUNDRY</div>
</div>

<div style="background-color: #f8f9fa; padding: 15px; border-radius: 4px; border: 1px solid #dee2e6; margin-bottom: 20px; font-size: 11px;">
    <h4 style="margin-top: 0; color: #0d6efd; margin-bottom: 8px;">Kriteria Filter Laporan</h4>
    <table style="width: 100%; border: none;">
        <tr>
            <td style="width: 15%; border: none; padding: 2px 0;"><strong>Periode</strong></td>
            <td style="width: 35%; border: none; padding: 2px 0;">: {{ request('dari_tanggal') ? \Carbon\Carbon::parse(request('dari_tanggal'))->format('d/m/Y') : 'Awal' }} s/d {{ request('sampai_tanggal') ? \Carbon\Carbon::parse(request('sampai_tanggal'))->format('d/m/Y') : 'Akhir' }}</td>
            <td style="width: 15%; border: none; padding: 2px 0;"><strong>Status Order</strong></td>
            <td style="width: 35%; border: none; padding: 2px 0;">: {{ request('status') ? strtoupper(request('status')) : 'SEMUA STATUS' }}</td>
        </tr>
        <tr>
            <td style="border: none; padding: 2px 0;"><strong>Metode Bayar</strong></td>
            <td style="border: none; padding: 2px 0;">: {{ request('metode_bayar') ? strtoupper(request('metode_bayar')) : 'SEMUA METODE' }}</td>
            <td style="border: none; padding: 2px 0;"><strong>Total Record</strong></td>
            <td style="border: none; padding: 2px 0;">: {{ $data->count() }} Transaksi</td>
        </tr>
    </table>
</div>

<table class="table">
    <thead>
        <tr>
            <th class="text-center" style="width: 5%;">No</th>
            <th style="width: 12%;">Tgl Masuk</th>
            <th style="width: 18%;">No Order</th>
            <th style="width: 25%;">Pelanggan</th>
            <th style="width: 10%;">Metode</th>
            <th class="text-center" style="width: 15%;">Status</th>
            <th class="text-right" style="width: 15%;">Total (Rp)</th>
        </tr>
    </thead>
    <tbody>
        @php $totalPendapatan = 0; @endphp
        @forelse($data as $i => $item)
        @php 
            if($item->status !== 'batal') $totalPendapatan += $item->total; 
            
            $statusClass = 'badge-secondary';
            if($item->status == 'diambil') $statusClass = 'badge-primary';
            if($item->status == 'siap') $statusClass = 'badge-success';
            if($item->status == 'batal') $statusClass = 'badge-danger';
            if(in_array($item->status, ['dicuci', 'dijemur', 'disetrika'])) $statusClass = 'badge-info';
        @endphp
        <tr>
            <td class="text-center">{{ $i + 1 }}</td>
            <td>{{ \Carbon\Carbon::parse($item->tanggal_masuk)->format('d/m/Y') }}</td>
            <td class="fw-bold">{{ $item->no_order }}</td>
            <td>{{ Str::limit($item->pelanggan->nama_pelanggan, 20) }}</td>
            <td>{{ strtoupper($item->metode_bayar) }}</td>
            <td class="text-center"><span class="{{ $item->status == 'batal' ? 'text-danger fw-bold' : '' }}">{{ strtoupper($item->status) }}</span></td>
            <td class="text-right {{ $item->status == 'batal' ? 'text-muted' : '' }}" style="{{ $item->status == 'batal' ? 'text-decoration: line-through;' : '' }}">
                {{ number_format($item->total, 0, ',', '.') }}
            </td>
        </tr>
        @empty
        <tr><td colspan="7" class="text-center text-muted" style="padding: 20px;">Tidak ada data transaksi pada periode ini</td></tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th colspan="6" class="text-right" style="font-size: 12px;">Total Pendapatan (Diluar Batal):</th>
            <th class="text-right text-primary" style="font-size: 14px;">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</th>
        </tr>
    </tfoot>
</table>

<div style="margin-top: 40px; width: 100%; display: table;">
    <div style="display: table-cell; width: 70%;"></div>
    <div style="display: table-cell; width: 30%; text-align: center;">
        <p>Admin / Manager</p>
        <br><br><br>
        <p style="text-decoration: underline; font-weight: bold;">{{ auth()->check() ? auth()->user()->name : '_______________________' }}</p>
    </div>
</div>
@endsection
