@extends('layouts.public')
@section('title', 'Detail Cucian - ' . $pelanggan->nama_pelanggan)

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
    <!-- Header -->
    <div class="mb-12 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                Status Cucian: <span class="text-blue-600">{{ $pelanggan->nama_pelanggan }}</span>
            </h1>
            <p class="mt-2 text-slate-500 font-medium">Menampilkan riwayat dan status pesanan aktif Anda.</p>
        </div>
        <a href="{{ route('public.pelanggan') }}" class="inline-flex items-center rounded-xl border border-slate-200 bg-white px-5 py-2.5 text-sm font-bold text-slate-600 transition-all hover:bg-slate-50 hover:border-slate-300 active:scale-95">
            <i class="fas fa-arrow-left mr-2 text-xs text-slate-400"></i>
            Kembali
        </a>
    </div>

    <!-- Transactions Grid -->
    <div class="grid grid-cols-1 gap-8 lg:grid-cols-2 xl:grid-cols-3">
        @forelse($transaksis as $transaksi)
        <div class="relative flex flex-col rounded-[2.5rem] border border-slate-100 bg-white p-2 shadow-xl shadow-slate-200/50">
            <!-- Status Badge & Order No -->
            <div class="flex items-center justify-between p-6 pb-4">
                <span class="text-lg font-black tracking-tight text-slate-900">{{ $transaksi->no_order }}</span>
                @php
                    $statusConfig = [
                        'diterima' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'label' => 'Diterima', 'icon' => 'fa-box'],
                        'dicuci' => ['bg' => 'bg-blue-100', 'text' => 'text-blue-600', 'label' => 'Sedang Dicuci', 'icon' => 'fa-soap'],
                        'dijemur' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'label' => 'Dijemur', 'icon' => 'fa-sun'],
                        'disetrika' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-600', 'label' => 'Disetrika', 'icon' => 'fa-tshirt'],
                        'siap' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'label' => 'Siap Diambil', 'icon' => 'fa-check-circle'],
                        'diambil' => ['bg' => 'bg-blue-600', 'text' => 'text-white', 'label' => 'Sudah Diambil', 'icon' => 'fa-hand-holding-heart'],
                        'batal' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'Dibatalkan', 'icon' => 'fa-times-circle'],
                    ];
                    $cfg = $statusConfig[$transaksi->status] ?? $statusConfig['diterima'];
                @endphp
                <span class="inline-flex items-center gap-1.5 rounded-full {{ $cfg['bg'] }} px-3 py-1 text-[10px] font-black uppercase tracking-wider {{ $cfg['text'] }}">
                    <i class="fas {{ $cfg['icon'] }}"></i>
                    {{ $cfg['label'] }}
                </span>
            </div>

            <div class="rounded-[2rem] bg-slate-50 p-6 flex-grow">
                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="rounded-xl bg-white p-3 border border-slate-100">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Masuk</span>
                        <span class="block text-sm font-extrabold text-slate-900">{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</span>
                    </div>
                    <div class="rounded-xl bg-white p-3 border border-slate-100">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-1">Estimasi</span>
                        <span class="block text-sm font-extrabold text-slate-900">{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d M Y') }}</span>
                    </div>
                </div>

                <!-- Items -->
                <div class="mb-6">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Detail Layanan</h4>
                    <div class="space-y-3">
                        @foreach($transaksi->detail as $item)
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-3">
                                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600 font-bold text-xs">
                                    {{ $item->qty }}x
                                </div>
                                <span class="font-bold text-slate-700">{{ $item->nama_layanan }}</span>
                            </div>
                            <span class="font-medium text-slate-500 text-xs">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Status -->
                <div class="flex items-center justify-between border-t border-slate-200 pt-4 mt-auto">
                    <div>
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Bayar</span>
                        <span class="text-xl font-black text-blue-600">Rp {{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-right">
                        <span class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pembayaran</span>
                        <span class="inline-flex items-center font-black text-xs {{ $transaksi->bayar >= $transaksi->total ? 'text-green-600' : 'text-red-500' }}">
                            {{ $transaksi->bayar >= $transaksi->total ? 'LUNAS' : 'BELUM LUNAS' }}
                        </span>
                    </div>
                </div>
            </div>
            
            @if($transaksi->status != 'diambil' && $transaksi->status != 'batal')
            <div class="p-4">
                <div class="relative h-2 w-full overflow-hidden rounded-full bg-slate-100">
                    @php
                        $progress = ['diterima' => 10, 'dicuci' => 30, 'dijemur' => 50, 'disetrika' => 75, 'siap' => 100];
                        $pVal = $progress[$transaksi->status] ?? 0;
                    @endphp
                    <div class="absolute inset-y-0 left-0 bg-blue-600 transition-all duration-1000" style="width: {{ $pVal }}%"></div>
                </div>
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-full py-24 text-center">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-slate-50 text-slate-200 mb-8">
                <i class="fas fa-receipt text-5xl"></i>
            </div>
            <h3 class="text-2xl font-extrabold text-slate-900">Belum Ada Transaksi</h3>
            <p class="mt-4 text-slate-500 max-w-sm mx-auto">
                Pelanggan ini belum memiliki riwayat transaksi cucian di sistem kami.
            </p>
        </div>
        @endforelse
    </div>
</div>
@endsection
