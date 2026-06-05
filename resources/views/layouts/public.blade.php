<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — Cuciin</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased selection:bg-indigo-100 selection:text-indigo-700">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/80 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-20 items-center justify-between">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-linear-to-br from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-200 group-hover:shadow-indigo-300 transition-all duration-300 group-hover:scale-105">
                            <i class="fas fa-soap text-lg"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tighter text-slate-900">Cuci<span class="text-indigo-600">in</span></span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-indigo-600' }} text-sm transition-colors relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-0 {{ request()->routeIs('home') ? 'after:w-full after:bg-indigo-600' : '' }} after:transition-all hover:after:w-full hover:after:bg-indigo-600">Beranda</a>
                        <a href="{{ route('public.layanan') }}" class="{{ request()->routeIs('public.layanan') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-indigo-600' }} text-sm transition-colors relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-0 {{ request()->routeIs('public.layanan') ? 'after:w-full after:bg-indigo-600' : '' }} after:transition-all hover:after:w-full hover:after:bg-indigo-600">Layanan</a>
                        <a href="{{ route('public.pelanggan') }}" class="{{ request()->routeIs('public.pelanggan') ? 'text-indigo-600 font-bold' : 'text-slate-500 hover:text-indigo-600' }} text-sm transition-colors relative after:content-[''] after:absolute after:-bottom-1 after:left-0 after:h-0.5 after:w-0 {{ request()->routeIs('public.pelanggan') ? 'after:w-full after:bg-indigo-600' : '' }} after:transition-all hover:after:w-full hover:after:bg-indigo-600">Cek Status</a>
                        
                        <div class="h-4 w-px bg-slate-200"></div>

                        @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-xl bg-slate-900 px-6 py-2.5 text-sm font-bold text-white transition-all hover:bg-indigo-600 hover:shadow-lg hover:shadow-indigo-200 focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2">
                            <i class="fas fa-sign-in-alt mr-2 text-xs"></i>
                            Login
                        </a>
                        @endguest

                        @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : '#' }}" class="inline-flex items-center gap-2 rounded-xl border border-slate-200 bg-white px-4 py-2 text-sm font-bold text-slate-700 transition-all hover:bg-slate-50 hover:border-indigo-200 group">
                            <div class="h-6 w-6 rounded-full bg-indigo-50 flex items-center justify-center text-indigo-600 text-[10px] group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                                <i class="fas fa-user"></i>
                            </div>
                            {{ auth()->user()->name }}
                        </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button type="button" id="mobile-menu-btn" class="inline-flex items-center justify-center rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-500 focus:outline-none">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden border-t border-slate-100 bg-white md:hidden">
            <div class="space-y-1 px-4 py-3">
                <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-base font-bold {{ request()->routeIs('home') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Beranda</a>
                <a href="{{ route('public.layanan') }}" class="block rounded-lg px-3 py-2 text-base font-bold {{ request()->routeIs('public.layanan') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Layanan</a>
                <a href="{{ route('public.pelanggan') }}" class="block rounded-lg px-3 py-2 text-base font-bold {{ request()->routeIs('public.pelanggan') ? 'bg-indigo-50 text-indigo-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Cek Status</a>
                @guest
                <div class="mt-4 border-t border-slate-100 pt-4">
                    <a href="{{ route('login') }}" class="flex w-full items-center justify-center rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-100 transition-all hover:bg-indigo-700">
                        Login ke Akun
                    </a>
                </div>
                @endguest
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="mt-20 border-t border-slate-200 bg-white py-16 lg:py-20">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-12 lg:grid-cols-3">
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-linear-to-br from-indigo-500 to-purple-600 text-white shadow-lg shadow-indigo-200">
                            <i class="fas fa-soap text-base"></i>
                        </div>
                        <span class="text-2xl font-black tracking-tighter text-slate-900">Cuci<span class="text-indigo-600">in</span></span>
                    </a>
                    <p class="mt-6 text-base leading-relaxed text-slate-500 max-w-xs">
                        Layanan laundry premium dengan standar hotel bintang lima, menggunakan teknologi mutakhir untuk hasil yang sempurna.
                    </p>
                    <div class="mt-8 flex gap-4">
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-indigo-600 hover:text-white transition-all duration-300">
                            <i class="fab fa-facebook-f text-sm"></i>
                        </a>
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-indigo-400 hover:text-white transition-all duration-300">
                            <i class="fab fa-twitter text-sm"></i>
                        </a>
                        <a href="#" class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-50 text-slate-400 hover:bg-linear-to-tr hover:from-yellow-400 hover:to-purple-600 hover:text-white transition-all duration-300">
                            <i class="fab fa-instagram text-sm"></i>
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-8 sm:grid-cols-2 lg:col-span-2">
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-900">Navigasi</h3>
                        <ul class="mt-6 space-y-4">
                            <li><a href="{{ route('home') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">Beranda Utama</a></li>
                            <li><a href="{{ route('public.layanan') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">Katalog Layanan</a></li>
                            <li><a href="{{ route('public.pelanggan') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">Cek Status Cucian</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xs font-black uppercase tracking-[0.2em] text-slate-900">Layanan Pelanggan</h3>
                        <ul class="mt-6 space-y-4">
                            <li><a href="#" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">Pusat Bantuan</a></li>
                            <li><a href="#" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">Hubungi Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-16 border-t border-slate-100 pt-10 flex flex-col md:flex-row items-center justify-between gap-6">
                <p class="text-sm text-slate-400">
                    &copy; {{ date('Y') }} Cuciin. Dipersembahkan dengan <i class="fas fa-heart text-indigo-500 mx-1"></i> untuk kenyamanan Anda.
                </p>
                <div class="flex items-center gap-8">
                    <span class="text-[10px] font-black text-slate-300 uppercase tracking-[0.3em]">Premium Quality Verified</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.getElementById('mobile-menu-btn');
            const menu = document.getElementById('mobile-menu');
            
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                    const icon = btn.querySelector('i');
                    if (menu.classList.contains('hidden')) {
                        icon.className = 'fas fa-bars text-xl';
                    } else {
                        icon.className = 'fas fa-times text-xl';
                    }
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
