@extends('layouts.public')
@section('title', 'Daftar Layanan')

@section('content')
<!-- Header -->
<div class="bg-white border-b border-slate-200 py-12 lg:py-16">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl">Daftar Layanan</h1>
        <p class="mt-4 text-lg text-slate-500 max-w-2xl mx-auto">
            Kami menyediakan berbagai pilihan layanan laundry yang dapat disesuaikan dengan jenis pakaian dan kebutuhan waktu Anda.
        </p>
    </div>
</div>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-12">
    <!-- Category Filter -->
    <div class="mb-12">
        <div class="flex flex-wrap items-center justify-center gap-2">
            <a href="{{ route('public.layanan') }}" 
               class="inline-flex items-center rounded-full px-6 py-2 text-sm font-semibold transition-all {{ !$kategoriId ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-slate-600 border border-slate-200 hover:border-blue-300 hover:bg-blue-50' }}">
                Semua Layanan
            </a>
            @foreach($kategoris as $kat)
            <a href="{{ route('public.layanan', ['kategori' => $kat->id]) }}" 
               class="inline-flex items-center rounded-full px-6 py-2 text-sm font-semibold transition-all {{ $kategoriId == $kat->id ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-slate-600 border border-slate-200 hover:border-blue-300 hover:bg-blue-50' }}">
                {{ $kat->nama_kategori }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($layanans as $layanan)
        <div class="group relative flex flex-col rounded-3xl border border-slate-200 bg-white p-6 transition-all hover:border-blue-200 hover:shadow-xl hover:shadow-blue-50/50">
            <div class="flex items-center justify-between mb-6">
                <div class="inline-flex items-center rounded-lg bg-blue-50 px-2.5 py-1 text-xs font-bold text-blue-700 uppercase tracking-wide">
                    {{ $layanan->kategori->nama_kategori ?? 'Umum' }}
                </div>
                <div class="flex items-center text-xs font-medium text-slate-400">
                    <i class="fas fa-history mr-1.5 text-blue-400"></i>
                    {{ $layanan->estimasi_hari }} Hari
                </div>
            </div>
            
            <h3 class="text-xl font-extrabold text-slate-900 group-hover:text-blue-600 transition-colors">{{ $layanan->nama_layanan }}</h3>
            
            <div class="mt-4 flex items-baseline gap-1.5">
                <span class="text-3xl font-black text-slate-900">Rp{{ number_format($layanan->harga, 0, ',', '.') }}</span>
                <span class="text-sm font-medium text-slate-400">/ {{ $layanan->satuan }}</span>
            </div>
            
            <p class="mt-4 text-sm leading-relaxed text-slate-500">
                {{ $layanan->deskripsi ?: 'Layanan perawatan pakaian profesional dengan hasil maksimal.' }}
            </p>
            
            <div class="mt-8 pt-6 border-t border-slate-100 flex items-center justify-between mt-auto">
                <div class="flex items-center gap-1.5">
                    <div class="flex -space-x-1">
                        <div class="h-5 w-5 rounded-full bg-blue-100 flex items-center justify-center border border-white">
                            <i class="fas fa-check text-[8px] text-blue-600"></i>
                        </div>
                    </div>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tersedia</span>
                </div>
                <button class="h-8 w-8 rounded-full bg-slate-100 text-slate-400 flex items-center justify-center transition-all group-hover:bg-blue-600 group-hover:text-white">
                    <i class="fas fa-plus text-xs"></i>
                </button>
            </div>
        </div>
        @empty
        <div class="col-span-full py-24 text-center">
            <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-full bg-slate-50 text-slate-300 mb-6">
                <i class="fas fa-search text-3xl"></i>
            </div>
            <h3 class="text-lg font-bold text-slate-900">Tidak ada layanan ditemukan</h3>
            <p class="mt-2 text-slate-500">Coba pilih kategori lain atau kembali ke semua layanan.</p>
            <a href="{{ route('public.layanan') }}" class="mt-8 inline-flex items-center font-bold text-blue-600 hover:underline">
                Reset Filter
                <i class="fas fa-undo ml-2 text-xs"></i>
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
