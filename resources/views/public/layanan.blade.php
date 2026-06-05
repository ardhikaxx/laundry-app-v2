@extends('layouts.public')
@section('title', 'Katalog Layanan')

@section('content')
<!-- Header -->
<div class="bg-white border-b border-slate-200 py-20 lg:py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-600 mb-6">Our Collection</h2>
        <h1 class="text-5xl font-black tracking-tighter text-slate-900 sm:text-6xl">Katalog Layanan</h1>
        <p class="mt-8 text-xl text-slate-500 max-w-2xl mx-auto font-medium">
            Pilihan perawatan pakaian yang dipersonalisasi untuk setiap kebutuhan Anda, dengan standar kualitas tertinggi.
        </p>
    </div>
</div>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-20">
    <!-- Category Filter -->
    <div class="mb-20">
        <div class="flex flex-wrap items-center justify-center gap-3">
            <a href="{{ route('public.layanan') }}" 
               class="inline-flex items-center rounded-2xl px-8 py-3.5 text-sm font-black uppercase tracking-widest transition-all {{ !$kategoriId ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-100' : 'bg-white text-slate-500 border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50' }}">
                All Services
            </a>
            @foreach($kategoris as $kat)
            <a href="{{ route('public.layanan', ['kategori' => $kat->id]) }}" 
               class="inline-flex items-center rounded-2xl px-8 py-3.5 text-sm font-black uppercase tracking-widest transition-all {{ $kategoriId == $kat->id ? 'bg-indigo-600 text-white shadow-xl shadow-indigo-100' : 'bg-white text-slate-500 border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50' }}">
                {{ $kat->nama_kategori }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Services Grid -->
    <div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse($layanans as $layanan)
        <div class="group relative flex flex-col rounded-[2.5rem] border border-slate-200 bg-white p-8 transition-all duration-500 hover:border-indigo-100 hover:shadow-2xl hover:shadow-slate-200/50">
            <div class="flex items-center justify-between mb-8">
                <div class="inline-flex items-center rounded-xl bg-indigo-50 px-3 py-1.5 text-[10px] font-black text-indigo-700 uppercase tracking-widest ring-1 ring-inset ring-indigo-100">
                    {{ $layanan->kategori->nama_kategori ?? 'Premium' }}
                </div>
                <div class="flex items-center text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em]">
                    <i class="fas fa-history mr-2 text-indigo-500"></i>
                    {{ $layanan->estimasi_hari }} Days
                </div>
            </div>
            
            <h3 class="text-2xl font-black text-slate-900 tracking-tight group-hover:text-indigo-600 transition-colors">{{ $layanan->nama_layanan }}</h3>
            
            <div class="mt-6 flex items-baseline gap-2">
                <span class="text-3xl font-black text-slate-900">Rp{{ number_format($layanan->harga, 0, ',', '.') }}</span>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">/ {{ $layanan->satuan }}</span>
            </div>
            
            <p class="mt-6 text-sm leading-relaxed text-slate-500 font-medium">
                {{ $layanan->deskripsi ?: 'Perawatan mendalam untuk serat pakaian Anda dengan hasil yang memuaskan.' }}
            </p>
            
            <div class="mt-10 pt-8 border-t border-slate-50 flex items-center justify-between mt-auto">
                <div class="flex items-center gap-2">
                    <div class="flex h-6 w-6 items-center justify-center rounded-full bg-indigo-50 border border-indigo-100">
                        <i class="fas fa-check text-[8px] text-indigo-600"></i>
                    </div>
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Active</span>
                </div>
                <div class="h-10 w-10 rounded-2xl bg-slate-50 text-slate-300 flex items-center justify-center transition-all duration-300 group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-[10deg]">
                    <i class="fas fa-plus text-sm"></i>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full py-32 text-center bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
            <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-white text-slate-200 mb-8 shadow-sm">
                <i class="fas fa-search text-3xl"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-900 tracking-tight">Tidak ada layanan ditemukan</h3>
            <p class="mt-4 text-slate-500 font-medium">Maaf, kami belum memiliki layanan di kategori ini.</p>
            <a href="{{ route('public.layanan') }}" class="mt-10 inline-flex items-center text-sm font-black uppercase tracking-widest text-indigo-600 hover:underline">
                <i class="fas fa-undo mr-3"></i>
                Reset Filter
            </a>
        </div>
        @endforelse
    </div>
</div>
@endsection
