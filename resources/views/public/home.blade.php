@extends('layouts.public')

@section('content')
<!-- Hero Section -->
<section class="relative overflow-hidden bg-white pt-16 pb-32">
    <div class="absolute inset-0 z-0 opacity-10">
        <div class="absolute -top-24 -left-24 h-96 w-96 rounded-full bg-blue-400 blur-3xl"></div>
        <div class="absolute top-1/2 -right-24 h-96 w-96 rounded-full bg-blue-300 blur-3xl"></div>
    </div>
    
    <div class="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="lg:flex lg:items-center lg:gap-12">
            <div class="lg:w-1/2">
                <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3 py-1 text-sm font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 mb-6">
                    <span class="flex h-2 w-2 rounded-full bg-blue-600"></span>
                    Layanan Laundry No. 1 di Kota Anda
                </div>
                <h1 class="text-5xl font-extrabold tracking-tight text-slate-900 sm:text-6xl lg:leading-[1.1]">
                    Pakaian Bersih, <br>
                    <span class="text-blue-600">Hidup Lebih Berarti.</span>
                </h1>
                <p class="mt-6 text-lg leading-relaxed text-slate-600">
                    Nikmati kemudahan layanan laundry profesional yang menjamin kebersihan, kesegaran, dan kehalusan pakaian Anda. Serahkan pada ahlinya, nikmati waktu luang Anda.
                </p>
                <div class="mt-10 flex flex-wrap gap-4">
                    <a href="{{ route('public.layanan') }}" class="inline-flex items-center justify-center rounded-xl bg-blue-600 px-8 py-4 text-base font-bold text-white shadow-xl shadow-blue-200 transition-all hover:bg-blue-700 hover:scale-105 active:scale-95">
                        Lihat Layanan
                        <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                    <a href="{{ route('public.pelanggan') }}" class="inline-flex items-center justify-center rounded-xl bg-white px-8 py-4 text-base font-bold text-slate-900 border border-slate-200 transition-all hover:bg-slate-50 hover:border-slate-300">
                        Cek Status Cucian
                    </a>
                </div>
                
                <div class="mt-12 flex items-center gap-6">
                    <div class="flex -space-x-3">
                        <div class="h-10 w-10 rounded-full border-2 border-white bg-slate-200"></div>
                        <div class="h-10 w-10 rounded-full border-2 border-white bg-slate-300"></div>
                        <div class="h-10 w-10 rounded-full border-2 border-white bg-slate-400"></div>
                    </div>
                    <div class="text-sm">
                        <span class="font-bold text-slate-900">500+</span> Pelanggan Puas
                    </div>
                </div>
            </div>
            
            <div class="hidden lg:block lg:w-1/2">
                <div class="relative">
                    <div class="absolute -inset-4 rounded-3xl bg-blue-100/50 blur-2xl"></div>
                    <div class="relative overflow-hidden rounded-3xl bg-blue-600 aspect-[4/3] flex items-center justify-center text-white shadow-2xl">
                         <!-- Placeholder for Image or Iconography -->
                         <div class="text-center p-12">
                            <i class="fas fa-soap text-9xl mb-8 opacity-20"></i>
                            <div class="space-y-4">
                                <div class="h-4 w-48 mx-auto bg-white/20 rounded-full"></div>
                                <div class="h-4 w-64 mx-auto bg-white/10 rounded-full"></div>
                                <div class="h-4 w-40 mx-auto bg-white/5 rounded-full"></div>
                            </div>
                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="bg-slate-50 py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
            <h2 class="text-base font-bold uppercase tracking-[0.2em] text-blue-600">Keunggulan</h2>
            <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Mengapa Memilih SiLaundry?</p>
        </div>
        
        <div class="mt-16 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <!-- Feature 1 -->
            <div class="group relative rounded-3xl border border-slate-200 bg-white p-8 transition-all hover:border-blue-200 hover:shadow-xl hover:shadow-blue-50">
                <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                    <i class="fas fa-bolt text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Proses Cepat</h3>
                <p class="mt-4 leading-relaxed text-slate-500">
                    Kami menghargai waktu Anda. Layanan kilat kami memastikan pakaian kembali bersih dalam waktu singkat.
                </p>
            </div>
            
            <!-- Feature 2 -->
            <div class="group relative rounded-3xl border border-slate-200 bg-white p-8 transition-all hover:border-blue-200 hover:shadow-xl hover:shadow-blue-50">
                <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                    <i class="fas fa-hand-sparkles text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Higienis & Bersih</h3>
                <p class="mt-4 leading-relaxed text-slate-500">
                    Setiap pakaian dicuci secara individual dan menggunakan deterjen berkualitas tinggi yang ramah lingkungan.
                </p>
            </div>
            
            <!-- Feature 3 -->
            <div class="group relative rounded-3xl border border-slate-200 bg-white p-8 transition-all hover:border-blue-200 hover:shadow-xl hover:shadow-blue-50">
                <div class="mb-6 inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600 transition-colors group-hover:bg-blue-600 group-hover:text-white">
                    <i class="fas fa-wallet text-xl"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-900">Harga Terjangkau</h3>
                <p class="mt-4 leading-relaxed text-slate-500">
                    Kualitas premium tidak harus mahal. Kami menawarkan harga yang transparan dan kompetitif.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview Section -->
<section class="py-24">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6">
            <div>
                <h2 class="text-base font-bold uppercase tracking-[0.2em] text-blue-600">Layanan</h2>
                <p class="mt-3 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">Layanan Unggulan Kami</p>
            </div>
            <a href="{{ route('public.layanan') }}" class="group inline-flex items-center font-bold text-blue-600">
                Lihat Semua Layanan
                <i class="fas fa-arrow-right ml-2 transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
        
        <div class="mt-16 grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($layanans as $layanan)
            <div class="relative flex flex-col rounded-3xl border border-slate-100 bg-white p-6 shadow-sm transition-all hover:shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center rounded-full bg-blue-50 px-2.5 py-0.5 text-xs font-semibold text-blue-700">
                        {{ $layanan->kategori->nama_kategori ?? '-' }}
                    </span>
                    <div class="flex items-center text-xs text-slate-400">
                        <i class="fas fa-clock mr-1"></i>
                        {{ $layanan->estimasi_hari }} Hari
                    </div>
                </div>
                <h3 class="text-lg font-bold text-slate-900">{{ $layanan->nama_layanan }}</h3>
                <div class="mt-4 flex items-baseline gap-1">
                    <span class="text-2xl font-extrabold text-blue-600">Rp{{ number_format($layanan->harga, 0, ',', '.') }}</span>
                    <span class="text-sm font-medium text-slate-400">/ {{ $layanan->satuan }}</span>
                </div>
                <p class="mt-4 text-sm leading-relaxed text-slate-500 line-clamp-2">
                    {{ $layanan->deskripsi ?: 'Layanan berkualitas tinggi untuk merawat pakaian kesayangan Anda.' }}
                </p>
            </div>
            @empty
            <div class="col-span-full py-12 text-center">
                <div class="inline-flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 mb-4">
                    <i class="fas fa-box-open text-3xl"></i>
                </div>
                <p class="text-slate-500 font-medium">Belum ada layanan yang tersedia saat ini.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 pb-24">
    <div class="relative overflow-hidden rounded-[2.5rem] bg-slate-900 px-8 py-16 text-center shadow-2xl sm:px-16">
        <div class="absolute inset-0 z-0 opacity-20">
            <div class="absolute -top-24 -right-24 h-96 w-96 rounded-full bg-blue-500 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 h-96 w-96 rounded-full bg-blue-600 blur-3xl"></div>
        </div>
        
        <div class="relative z-10">
            <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">Siap Membuat Pakaian Anda Kembali Cemerlang?</h2>
            <p class="mx-auto mt-6 max-w-xl text-lg text-slate-400">
                Kunjungi outlet kami hari ini atau hubungi kami untuk informasi lebih lanjut mengenai layanan jemput antar.
            </p>
            <div class="mt-10 flex flex-wrap justify-center gap-4">
                <a href="#" class="rounded-xl bg-white px-8 py-4 text-base font-bold text-slate-900 shadow-lg transition-all hover:bg-slate-50 hover:scale-105 active:scale-95">
                    Hubungi WhatsApp
                </a>
                <a href="{{ route('public.layanan') }}" class="rounded-xl bg-slate-800 px-8 py-4 text-base font-bold text-white transition-all hover:bg-slate-700">
                    Lihat Harga
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
