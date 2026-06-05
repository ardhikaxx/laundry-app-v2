@extends('layouts.public')
@section('title', 'Cek Status Cucian')

@section('content')
<!-- Search Header -->
<div class="relative overflow-hidden bg-slate-900 py-24 lg:py-32">
    <!-- Premium Decor -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[50%] -left-[10%] h-[150%] w-[50%] rounded-full bg-indigo-600 opacity-20 blur-[120px]"></div>
        <div class="absolute -bottom-[50%] -right-[10%] h-[150%] w-[50%] rounded-full bg-purple-600 opacity-20 blur-[120px]"></div>
    </div>
    
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-400 mb-6">Real-time Tracking</h2>
        <h1 class="text-5xl font-black tracking-tighter text-white sm:text-6xl">Lacak Pesanan Anda</h1>
        <p class="mt-8 text-xl text-slate-400 max-w-2xl mx-auto font-medium">
            Pantau progress cucian Anda secara langsung hanya dengan Nama, Kode Pelanggan, atau Nomor Telepon.
        </p>
        
        <div class="mt-16 mx-auto max-w-2xl">
            <form action="{{ route('public.pelanggan') }}" method="GET" class="relative group">
                <div class="absolute inset-y-0 left-0 pl-7 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-500 group-focus-within:text-indigo-400 transition-colors"></i>
                </div>
                <input type="text" name="cari" 
                       class="block w-full rounded-[2rem] border-0 bg-white/5 py-7 pl-16 pr-40 text-white placeholder-slate-500 ring-1 ring-inset ring-white/10 focus:bg-white focus:text-slate-900 focus:placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 transition-all text-lg shadow-2xl backdrop-blur-md" 
                       placeholder="Contoh: PLG-2026... atau 0812..." 
                       value="{{ request('cari') }}" 
                       required>
                <div class="absolute inset-y-2.5 right-2.5 flex items-center">
                    <button type="submit" class="h-full rounded-[1.5rem] bg-indigo-600 px-10 text-sm font-black uppercase tracking-widest text-white transition-all hover:bg-indigo-700 active:scale-95 shadow-xl shadow-indigo-600/20">
                        Search
                    </button>
                </div>
            </form>
            
            <div class="mt-8 flex flex-wrap justify-center gap-8 text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
                <div class="flex items-center gap-3">
                    <div class="h-1.5 w-1.5 rounded-full bg-indigo-500"></div>
                    Secure Data access
                </div>
                <div class="flex items-center gap-3">
                    <div class="h-1.5 w-1.5 rounded-full bg-purple-500"></div>
                    Instant Updates
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-24 min-h-[400px]">
    @if(request('cari'))
        @if($pelanggans->count() > 0)
            <div class="grid grid-cols-1 gap-10 md:grid-cols-2 lg:grid-cols-3">
                @foreach($pelanggans as $pelanggan)
                <div class="group relative flex flex-col rounded-[3rem] border border-slate-200 bg-white p-10 transition-all duration-500 hover:border-indigo-100 hover:shadow-2xl hover:shadow-slate-200/50">
                    <div class="flex items-center gap-6 mb-10">
                        <div class="flex h-20 w-20 items-center justify-center rounded-[1.5rem] bg-indigo-50 text-3xl font-black text-indigo-600 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 group-hover:rotate-[5deg]">
                            {{ substr($pelanggan->nama_pelanggan, 0, 1) }}
                        </div>
                        <div>
                            <h3 class="text-2xl font-black text-slate-900 tracking-tight">{{ $pelanggan->nama_pelanggan }}</h3>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mt-1">{{ $pelanggan->kode_pelanggan }}</p>
                        </div>
                    </div>
                    
                    <div class="space-y-5 rounded-[2rem] bg-slate-50 p-8 mb-10">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-black uppercase tracking-widest">Phone Number</span>
                            <span class="text-slate-900 font-black tracking-tighter">
                                {{ substr($pelanggan->no_telepon, 0, 4) . '****' . substr($pelanggan->no_telepon, -3) }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-400 font-black uppercase tracking-widest">Member Since</span>
                            <span class="text-slate-900 font-black tracking-tighter">
                                {{ \Carbon\Carbon::parse($pelanggan->tanggal_daftar)->format('d M Y') }}
                            </span>
                        </div>
                        <div class="flex items-center justify-between text-xs pt-4 border-t border-slate-200">
                            <span class="text-slate-400 font-black uppercase tracking-widest">Orders</span>
                            <span class="inline-flex items-center rounded-lg bg-indigo-100 px-3 py-1 text-[10px] font-black text-indigo-700">
                                {{ $pelanggan->total_transaksi }} Transactions
                            </span>
                        </div>
                    </div>
                    
                    <a href="{{ route('public.pelanggan.show', $pelanggan->kode_pelanggan) }}" class="mt-auto inline-flex items-center justify-center rounded-2xl bg-slate-900 px-8 py-5 text-sm font-black uppercase tracking-widest text-white shadow-xl shadow-slate-200 transition-all duration-300 hover:bg-indigo-600 hover:shadow-indigo-200 active:scale-95 group/btn">
                        Open History
                        <i class="fas fa-chevron-right ml-4 text-[10px] transition-transform group-hover/btn:translate-x-2"></i>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-32">
                <div class="mx-auto flex h-32 w-32 items-center justify-center rounded-full bg-red-50 text-red-500 mb-10 animate-bounce">
                    <i class="fas fa-user-slash text-5xl"></i>
                </div>
                <h3 class="text-3xl font-black text-slate-900 tracking-tight">Data Tidak Ditemukan</h3>
                <p class="mt-6 text-slate-500 max-w-md mx-auto font-medium text-lg leading-relaxed">
                    Maaf, sistem kami tidak dapat menemukan data pelanggan dengan input tersebut. Mohon pastikan kembali data Anda.
                </p>
                <a href="{{ route('public.pelanggan') }}" class="mt-12 inline-flex items-center text-sm font-black uppercase tracking-widest text-indigo-600 hover:text-indigo-700 transition-colors">
                    <i class="fas fa-undo mr-3"></i>
                    Reset Pencarian
                </a>
            </div>
        @endif
    @else
        <div class="text-center py-32">
            <div class="mx-auto flex h-40 w-40 items-center justify-center rounded-full bg-slate-50 text-slate-100 mb-10">
                <i class="fas fa-tshirt text-8xl"></i>
            </div>
            <h3 class="text-2xl font-black text-slate-300 tracking-widest uppercase">Input Search Criteria</h3>
            <p class="mt-6 text-slate-400 max-w-sm mx-auto font-medium leading-relaxed">
                Silakan masukkan data pencarian Anda di kolom atas untuk melacak status pesanan secara real-time.
            </p>
        </div>
    @endif
</div>
@endsection
