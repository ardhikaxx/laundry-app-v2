@extends('layouts.public')
@section('title', 'Cek Status Cucian')

@section('content')
<!-- Search Header -->
<div class="relative overflow-hidden bg-slate-900 py-24 lg:py-32">
    <div class="absolute inset-0 z-0 opacity-20">
        <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-blue-600 blur-3xl"></div>
        <div class="absolute bottom-0 right-0 h-64 w-64 bg-blue-500 blur-3xl opacity-30"></div>
    </div>
    
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl">Cek Status Cucian</h1>
        <p class="mt-6 text-lg text-slate-400 max-w-2xl mx-auto">
            Masukkan Nama, Kode Pelanggan, atau Nomor Telepon Anda untuk melacak progress cucian secara real-time.
        </p>
        
        <div class="mt-12 mx-auto max-w-2xl">
            <form action="{{ route('public.pelanggan') }}" method="GET" class="relative group">
                <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <input type="text" name="cari" 
                       class="block w-full rounded-2xl border-0 bg-white/10 py-5 pl-14 pr-32 text-white placeholder-slate-500 ring-1 ring-inset ring-white/20 focus:bg-white focus:text-slate-900 focus:placeholder-slate-400 focus:ring-2 focus:ring-blue-500 transition-all text-lg shadow-2xl" 
                       placeholder="Contoh: PLG-2026... atau 0812..." 
                       value="{{ request('cari') }}" 
                       required>
                <div class="absolute inset-y-2 right-2 flex items-center">
                    <button type="submit" class="h-full rounded-xl bg-blue-600 px-8 text-sm font-bold text-white transition-all hover:bg-blue-700 active:scale-95 shadow-lg shadow-blue-500/20">
                        Cari Data
                    </button>
                </div>
            </form>
            
            <div class="mt-6 flex flex-wrap justify-center gap-4 text-xs font-medium text-slate-500">
                <div class="flex items-center gap-1.5">
                    <i class="fas fa-shield-alt text-blue-500"></i>
                    Pencarian Aman
                </div>
                <div class="flex items-center gap-1.5">
                    <i class="fas fa-bolt text-yellow-500"></i>
                    Update Real-time
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16 min-h-[400px]">
    @if(request('cari'))
        @if($pelanggans->count() > 0)
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach($pelanggans as $pelanggan)
                <div class="group relative flex flex-col rounded-[2rem] border border-slate-200 bg-white p-8 transition-all hover:border-blue-200 hover:shadow-2xl hover:shadow-blue-50">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-2xl font-black text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition-all">
                            {{ substr($pelanggan->nama_pelanggan, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">{{ $pelanggan->nama_pelanggan }}</h3>
                            <p class="text-sm font-medium text-slate-400">{{ $pelanggan->kode_pelanggan }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-4 rounded-2xl bg-slate-50 p-6 mb-8">
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 font-medium">No. Telepon</span>
                            <span class="text-slate-900 font-bold tracking-tight">
                                {{ substr($pelanggan->no_telepon, 0, 4) . '****' . substr($pelanggan->no_telepon, -3) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 font-medium">Bergabung Pada</span>
                            <span class="text-slate-900 font-bold">
                                {{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d M Y') }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <span class="text-slate-500 font-medium">Total Transaksi</span>
                            <span class="inline-flex items-center rounded-full bg-blue-100 px-2.5 py-0.5 text-xs font-bold text-blue-700">
                                {{ $pelanggan->total_transaksi }}x
                            </span>
                        </div>
                    </div>
                    
                    <a href="{{ route('public.pelanggan.show', $pelanggan->kode_pelanggan) }}" class="mt-auto inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-4 text-sm font-bold text-white shadow-xl shadow-slate-200 transition-all hover:bg-blue-600 hover:shadow-blue-200 active:scale-95 group/btn">
                        Lihat Detail Cucian
                        <i class="fas fa-chevron-right ml-2 text-[10px] transition-transform group-hover/btn:translate-x-1"></i>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-20">
                <div class="mx-auto flex h-24 w-24 items-center justify-center rounded-full bg-red-50 text-red-400 mb-8 animate-bounce">
                    <i class="fas fa-user-slash text-4xl"></i>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900">Data Tidak Ditemukan</h3>
                <p class="mt-4 text-slate-500 max-w-sm mx-auto">
                    Maaf, kami tidak dapat menemukan pelanggan dengan data tersebut. Pastikan ejaan dan kode sudah benar.
                </p>
                <a href="{{ route('public.pelanggan') }}" class="mt-8 inline-flex items-center font-bold text-blue-600 hover:text-blue-700 transition-colors">
                    <i class="fas fa-undo mr-2 text-xs"></i>
                    Reset Pencarian
                </a>
            </div>
        @endif
    @else
        <div class="text-center py-20">
            <div class="mx-auto flex h-32 w-32 items-center justify-center rounded-full bg-blue-50 text-blue-100 mb-8">
                <i class="fas fa-tshirt text-6xl"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-400">Silakan gunakan fitur pencarian di atas</h3>
            <p class="mt-4 text-slate-400 max-w-xs mx-auto text-sm">
                Informasi status cucian Anda akan ditampilkan di sini setelah Anda melakukan pencarian.
            </p>
        </div>
    @endif
</div>
@endsection
