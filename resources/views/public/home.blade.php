@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-white pt-20 pb-32 lg:pt-32 lg:pb-48">
    <!-- Decorative background elements -->
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[10%] -left-[10%] h-[40%] w-[40%] rounded-full bg-indigo-50/50 blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[5%] h-[30%] w-[30%] rounded-full bg-purple-50/50 blur-[100px]"></div>
    </div>
    
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:gap-16">
            <div class="lg:w-1/2">
                <div class="inline-flex items-center gap-2 rounded-full bg-indigo-50 px-4 py-1.5 text-xs font-black uppercase tracking-widest text-indigo-600 ring-1 ring-inset ring-indigo-200 mb-8">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                    </span>
                    The Premium Choice
                </div>
                <h1 class="text-6xl font-black tracking-tighter text-slate-900 sm:text-7xl lg:leading-[0.95]">
                    Layanan Laundry <br>
                    <span class="bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Kelas Dunia.</span>
                </h1>
                <p class="mt-8 text-xl leading-relaxed text-slate-500 max-w-xl">
                    Kombinasi sempurna antara teknologi mutakhir dan perhatian terhadap detail untuk memastikan pakaian Anda selalu dalam kondisi terbaik.
                </p>
                <div class="mt-12 flex flex-wrap gap-5">
                    <a href="{{ route('public.layanan') }}" class="inline-flex items-center justify-center rounded-2xl bg-indigo-600 px-10 py-5 text-base font-black text-white shadow-2xl shadow-indigo-200 transition-all hover:bg-indigo-700 hover:scale-105 active:scale-95 group">
                        Mulai Sekarang
                        <i class="fas fa-arrow-right ml-3 text-sm transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <a href="{{ route('public.pelanggan') }}" class="inline-flex items-center justify-center rounded-2xl bg-white px-10 py-5 text-base font-black text-slate-900 border border-slate-200 transition-all hover:bg-slate-50 hover:border-slate-300">
                        Cek Status
                    </a>
                </div>
                
                <div class="mt-16 flex items-center gap-10">
                    <div class="flex -space-x-4">
                        @for ($i = 1; $i <= 3; $i++)
                        <div class="h-12 w-12 rounded-full border-4 border-white bg-slate-200 shadow-sm"></div>
                        @endfor
                        <div class="h-12 w-12 rounded-full border-4 border-white bg-indigo-600 flex items-center justify-center text-white text-[10px] font-bold">
                            99+
                        </div>
                    </div>
                    <div class="text-sm">
                        <div class="flex items-center gap-1 text-yellow-400 mb-1">
                            @for ($i = 1; $i <= 5; $i++) <i class="fas fa-star text-[10px]"></i> @endfor
                        </div>
                        <span class="font-black text-slate-900 uppercase tracking-tighter">Dipercaya 1000+ Pelanggan</span>
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block lg:w-1/2">
                <div class="relative">
                    <!-- Premium visual placeholder -->
                    <div class="absolute -inset-10 rounded-[3rem] bg-gradient-to-tr from-indigo-100 to-purple-100 opacity-40 blur-3xl"></div>
                    <div class="relative overflow-hidden rounded-[3rem] bg-slate-900 aspect-[4/5] flex items-center justify-center shadow-[0_50px_100px_-20px_rgba(79,70,229,0.3)]">
                         <div class="text-center p-12">
                            <div class="relative mb-12 inline-block">
                                <div class="absolute -inset-4 rounded-full bg-indigo-500/20 animate-pulse"></div>
                                <i class="fas fa-soap text-[120px] text-white opacity-90"></i>
                            </div>
                            <div class="space-y-6 max-w-xs mx-auto">
                                <div class="h-2 w-full bg-gradient-to-r from-indigo-500/40 to-transparent rounded-full"></div>
                                <div class="h-2 w-3/4 bg-gradient-to-r from-purple-500/30 to-transparent rounded-full mx-auto"></div>
                                <div class="h-2 w-1/2 bg-gradient-to-r from-indigo-500/20 to-transparent rounded-full mx-auto"></div>
                            </div>
                            <div class="mt-12 grid grid-cols-2 gap-4">
                                <div class="rounded-2xl bg-white/5 p-4 border border-white/10 backdrop-blur-sm">
                                    <span class="block text-2xl font-black text-white">100%</span>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em]">Higienis</span>
                                </div>
                                <div class="rounded-2xl bg-white/5 p-4 border border-white/10 backdrop-blur-sm">
                                    <span class="block text-2xl font-black text-white">24h</span>
                                    <span class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em]">Selesai</span>
                                </div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="bg-slate-50 py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl">
            <h2 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-600 mb-4">Superiority</h2>
            <p class="mt-3 text-4xl font-black tracking-tighter text-slate-900 sm:text-5xl">Mengapa Memilih Cuciin?</p>
            <p class="mt-6 text-lg text-slate-500">Standar kualitas kami yang tak tertandingi memastikan kepuasan Anda dalam setiap helai pakaian.</p>
        </div>
        
        <div class="mt-20 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Feature 1 -->
            <div class="group relative rounded-[2.5rem] border border-slate-200 bg-white p-10 transition-all duration-500 hover:border-indigo-200 hover:shadow-[0_30px_60px_-15px_rgba(79,70,229,0.1)] hover:-translate-y-2">
                <div class="mb-8 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition-all duration-500 group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-[10deg]">
                    <i class="fas fa-bolt text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Express Service</h3>
                <p class="mt-5 leading-relaxed text-slate-500 text-base font-medium">
                    Sistem manajemen antrean cerdas kami memastikan pakaian Anda selesai sesuai jadwal, tanpa kompromi.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="group relative rounded-[2.5rem] border border-slate-200 bg-white p-10 transition-all duration-500 hover:border-indigo-200 hover:shadow-[0_30px_60px_-15px_rgba(79,70,229,0.1)] hover:-translate-y-2">
                <div class="mb-8 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition-all duration-500 group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-[10deg]">
                    <i class="fas fa-hand-sparkles text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Eco-Friendly Tech</h3>
                <p class="mt-5 leading-relaxed text-slate-500 text-base font-medium">
                    Menggunakan deterjen biodegradable premium yang aman untuk serat kain dan sangat ramah lingkungan.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="group relative rounded-[2.5rem] border border-slate-200 bg-white p-10 transition-all duration-500 hover:border-indigo-200 hover:shadow-[0_30px_60px_-15px_rgba(79,70,229,0.1)] hover:-translate-y-2">
                <div class="mb-8 inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-indigo-50 text-indigo-600 transition-all duration-500 group-hover:bg-indigo-600 group-hover:text-white group-hover:rotate-[10deg]">
                    <i class="fas fa-gem text-2xl"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Premium Care</h3>
                <p class="mt-5 leading-relaxed text-slate-500 text-base font-medium">
                    Perawatan khusus untuk setiap jenis bahan, mulai dari katun halus hingga setera sutra yang berharga.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview Section -->
<section class="py-32">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-8 mb-20">
            <div class="max-w-xl">
                <h2 class="text-xs font-black uppercase tracking-[0.4em] text-indigo-600 mb-4">Curated List</h2>
                <p class="text-4xl font-black tracking-tighter text-slate-900 sm:text-5xl">Pilihan Layanan Terbaik</p>
            </div>
            <a href="{{ route('public.layanan') }}" class="group inline-flex items-center text-sm font-black uppercase tracking-widest text-indigo-600 hover:text-indigo-700 transition-colors">
                Selengkapnya
                <div class="ml-4 flex h-10 w-10 items-center justify-center rounded-full border border-indigo-100 group-hover:bg-indigo-600 group-hover:text-white transition-all">
                    <i class="fas fa-arrow-right text-xs"></i>
                </div>
            </a>
        </div>
        
        <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($layanans->take(3) as $layanan)
            <div class="group relative flex flex-col rounded-[2.5rem] border border-slate-100 bg-white p-8 transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200/50 overflow-hidden">
                <div class="flex items-center justify-between mb-8">
                    <span class="inline-flex items-center rounded-full bg-indigo-50 px-3 py-1 text-[10px] font-black uppercase tracking-widest text-indigo-700 ring-1 ring-inset ring-indigo-200">
                        {{ $layanan->kategori->nama_kategori ?? 'Standard' }}
                    </span>
                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        <i class="fas fa-clock mr-2 text-indigo-400"></i>
                        {{ $layanan->estimasi_hari }} Hari
                    </div>
                </div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight mb-4 group-hover:text-indigo-600 transition-colors">{{ $layanan->nama_layanan }}</h3>
                <div class="mt-auto pt-8 border-t border-slate-50 flex items-baseline gap-2">
                    <span class="text-3xl font-black text-indigo-600">Rp{{ number_format($layanan->harga, 0, ',', '.') }}</span>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">/ {{ $layanan->satuan }}</span>
                </div>
                <div class="absolute top-0 right-0 -mr-8 -mt-8 h-32 w-32 rounded-full bg-indigo-50 opacity-0 transition-all duration-500 group-hover:opacity-100 group-hover:scale-150 -z-10"></div>
            </div>
            @empty
            <div class="col-span-full py-16 text-center rounded-[3rem] border-2 border-dashed border-slate-200">
                <i class="fas fa-box-open text-4xl text-slate-200 mb-4"></i>
                <p class="text-slate-400 font-bold uppercase tracking-widest">Belum ada layanan unggulan</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-32">
    <div class="relative overflow-hidden rounded-[3.5rem] bg-slate-900 px-8 py-24 text-center shadow-2xl shadow-indigo-200 sm:px-16 lg:py-32">
        <!-- Background Decor -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[50%] -right-[10%] h-[150%] w-[50%] rounded-full bg-indigo-600 opacity-20 blur-[120px]"></div>
            <div class="absolute -bottom-[50%] -left-[10%] h-[150%] w-[50%] rounded-full bg-purple-600 opacity-20 blur-[120px]"></div>
        </div>
        
        <div class="relative z-10 max-w-4xl mx-auto">
            <h2 class="text-4xl font-black tracking-tighter text-white sm:text-6xl lg:leading-[1.1]">Siap Memberikan yang Terbaik <br> untuk Pakaian Anda?</h2>
            <p class="mx-auto mt-8 max-w-2xl text-xl text-slate-400 leading-relaxed font-medium">
                Nikmati layanan antar-jemput eksklusif dan kemudahan pembayaran digital. Hubungi kami sekarang dan biarkan kami bekerja untuk Anda.
            </p>
            <div class="mt-12 flex flex-wrap justify-center gap-6">
                <a href="#" class="rounded-2xl bg-white px-12 py-5 text-base font-black text-slate-900 shadow-xl transition-all hover:bg-slate-50 hover:scale-105 active:scale-95">
                    Hubungi WhatsApp
                </a>
                <a href="{{ route('public.layanan') }}" class="rounded-2xl bg-slate-800 px-12 py-5 text-base font-black text-white border border-white/10 transition-all hover:bg-slate-700">
                    Daftar Harga
                </a>
            </div>
            <div class="mt-16 flex justify-center gap-12 opacity-30 grayscale invert">
                <span class="text-xs font-black tracking-[0.5em] text-white uppercase">Trust</span>
                <span class="text-xs font-black tracking-[0.5em] text-white uppercase">Quality</span>
                <span class="text-xs font-black tracking-[0.5em] text-white uppercase">Premium</span>
            </div>
        </div>
    </div>
</section>
@endsection
