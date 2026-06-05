@extends('layouts.public')
@section('title', 'Detail Cucian - ' . $pelanggan->nama_pelanggan)

@section('content')
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20 lg:py-24">
    <!-- Header -->
    <div class="mb-16 flex flex-col md:flex-row md:items-center md:justify-between gap-8">
        <div>
            <h2 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-600 mb-4">Transaction History</h2>
            <h1 class="text-4xl font-black tracking-tighter text-slate-900 sm:text-5xl">
                Status Cucian: <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">{{ $pelanggan->nama_pelanggan }}</span>
            </h1>
            <p class="mt-4 text-slate-500 font-medium text-lg">Menampilkan seluruh riwayat pesanan dan status aktif Anda.</p>
        </div>
        <a href="{{ route('public.pelanggan') }}" class="inline-flex items-center rounded-2xl border border-slate-200 bg-white px-8 py-4 text-sm font-black uppercase tracking-widest text-slate-600 transition-all hover:bg-slate-50 hover:border-slate-300 active:scale-95 group">
            <i class="fas fa-arrow-left mr-3 transition-transform group-hover:-translate-x-2"></i>
            Kembali
        </a>
    </div>

    <!-- Transactions Grid -->
    <div class="grid grid-cols-1 gap-10 lg:grid-cols-2 xl:grid-cols-3">
        @forelse($transaksis as $transaksi)
        <div class="relative flex flex-col rounded-[3rem] border border-slate-100 bg-white p-2 shadow-[0_40px_80px_-20px_rgba(0,0,0,0.05)] transition-all duration-500 hover:shadow-[0_40px_80px_-20px_rgba(79,70,229,0.15)]">
            <!-- Header Card -->
            <div class="flex items-center justify-between p-8 pb-6">
                <span class="text-xl font-black tracking-tighter text-slate-900">{{ $transaksi->no_order }}</span>
                @php
                    $statusConfig = [
                        'diterima' => ['bg' => 'bg-slate-100', 'text' => 'text-slate-600', 'label' => 'Received', 'icon' => 'fa-box'],
                        'dicuci' => ['bg' => 'bg-indigo-100', 'text' => 'text-indigo-600', 'label' => 'Washing', 'icon' => 'fa-soap'],
                        'dijemur' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-600', 'label' => 'Drying', 'icon' => 'fa-sun'],
                        'disetrika' => ['bg' => 'bg-orange-100', 'text' => 'text-orange-600', 'label' => 'Ironing', 'icon' => 'fa-tshirt'],
                        'siap' => ['bg' => 'bg-green-100', 'text' => 'text-green-600', 'label' => 'Ready', 'icon' => 'fa-check-circle'],
                        'diambil' => ['bg' => 'bg-indigo-600', 'text' => 'text-white', 'label' => 'Completed', 'icon' => 'fa-hand-holding-heart'],
                        'batal' => ['bg' => 'bg-red-100', 'text' => 'text-red-600', 'label' => 'Cancelled', 'icon' => 'fa-times-circle'],
                    ];
                    $cfg = $statusConfig[$transaksi->status] ?? $statusConfig['diterima'];
                @endphp
                <span class="inline-flex items-center gap-2 rounded-full {{ $cfg['bg'] }} px-4 py-1.5 text-[10px] font-black uppercase tracking-[0.1em] {{ $cfg['text'] }} ring-1 ring-inset ring-black/5">
                    <i class="fas {{ $cfg['icon'] }}"></i>
                    {{ $cfg['label'] }}
                </span>
            </div>

            <div class="rounded-[2.5rem] bg-slate-50 p-8 flex-grow">
                <!-- Info Grid -->
                <div class="grid grid-cols-2 gap-5 mb-8">
                    <div class="rounded-2xl bg-white p-4 border border-slate-100 shadow-sm">
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Order Date</span>
                        <span class="block text-sm font-black text-slate-900">{{ \Carbon\Carbon::parse($transaksi->tanggal_masuk)->format('d M Y') }}</span>
                    </div>
                    <div class="rounded-2xl bg-white p-4 border border-slate-100 shadow-sm">
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Estimation</span>
                        <span class="block text-sm font-black text-slate-900">{{ \Carbon\Carbon::parse($transaksi->tanggal_estimasi)->format('d M Y') }}</span>
                    </div>
                </div>

                <!-- Items -->
                <div class="mb-8">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 flex items-center gap-3">
                        Service Details
                        <div class="h-px bg-slate-200 flex-grow"></div>
                    </h4>
                    <div class="space-y-4">
                        @foreach($transaksi->detail as $item)
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-4">
                                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600 font-black text-xs border border-indigo-100">
                                    {{ $item->qty }}x
                                </div>
                                <span class="font-bold text-slate-700">{{ $item->nama_layanan }}</span>
                            </div>
                            <span class="font-black text-slate-900 tracking-tighter">Rp{{ number_format($item->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <!-- Payment Status -->
                <div class="flex items-center justify-between border-t border-slate-200 pt-8 mt-auto">
                    <div>
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Payment</span>
                        <span class="text-2xl font-black text-indigo-600 tracking-tighter">Rp{{ number_format($transaksi->total, 0, ',', '.') }}</span>
                    </div>
                    <div class="text-right">
                        <span class="block text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status</span>
                        <span class="inline-flex items-center font-black text-[10px] uppercase tracking-widest {{ $transaksi->bayar >= $transaksi->total ? 'text-green-600' : 'text-red-500' }}">
                            {{ $transaksi->bayar >= $transaksi->total ? 'Paid' : 'Unpaid' }}
                        </span>
                    </div>
                </div>
            </div>
            
            @if($transaksi->status != 'diambil' && $transaksi->status != 'batal')
            <div class="px-8 py-6">
                <div class="flex justify-between items-center mb-3 text-[10px] font-black uppercase tracking-widest text-slate-400">
                    <span>Progress</span>
                    @php
                        $progress = ['diterima' => 15, 'dicuci' => 40, 'dijemur' => 60, 'disetrika' => 80, 'siap' => 100];
                        $pVal = $progress[$transaksi->status] ?? 0;
                    @endphp
                    <span class="text-indigo-600">{{ $pVal }}%</span>
                </div>
                <div class="relative h-2.5 w-full overflow-hidden rounded-full bg-slate-100 border border-slate-200/50">
                    <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-indigo-500 to-indigo-700 transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(79,70,229,0.5)]" style="width: {{ $pVal }}%"></div>
                </div>
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-full py-32 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
            <div class="mx-auto flex h-32 w-32 items-center justify-center rounded-full bg-white text-slate-200 mb-10 shadow-sm">
                <i class="fas fa-receipt text-5xl"></i>
            </div>
            <h3 class="text-3xl font-black text-slate-900 tracking-tight">Belum Ada Transaksi</h3>
            <p class="mt-6 text-slate-500 font-medium text-lg leading-relaxed max-w-md mx-auto">
                Sistem kami belum mencatat riwayat transaksi untuk akun pelanggan ini.
            </p>
        </div>
        @endforelse
    </div>
</div>
@endsection
