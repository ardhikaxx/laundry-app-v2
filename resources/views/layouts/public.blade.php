<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Beranda') — SiLaundry</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    @stack('styles')
</head>
<body class="bg-slate-50 font-sans text-slate-900 antialiased selection:bg-blue-100 selection:text-blue-700">
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 w-full border-b border-slate-200 bg-white/80 backdrop-blur-md">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                        <div class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-600 text-white shadow-lg shadow-blue-200 group-hover:bg-blue-700 transition-colors">
                            <i class="fas fa-soap text-lg"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Si<span class="text-blue-600">Laundry</span></span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:block">
                    <div class="flex items-center gap-8">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600' }} text-sm transition-colors">Beranda</a>
                        <a href="{{ route('public.layanan') }}" class="{{ request()->routeIs('public.layanan') ? 'text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600' }} text-sm transition-colors">Layanan</a>
                        <a href="{{ route('public.pelanggan') }}" class="{{ request()->routeIs('public.pelanggan') ? 'text-blue-600 font-semibold' : 'text-slate-600 hover:text-blue-600' }} text-sm transition-colors">Cek Status</a>
                        
                        <div class="h-4 w-px bg-slate-200"></div>

                        @guest
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-2 text-sm font-medium text-white transition-all hover:bg-slate-800 hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-900 focus:ring-offset-2">
                            <i class="fas fa-sign-in-alt mr-2 text-xs"></i>
                            Login
                        </a>
                        @endguest

                        @auth
                        <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : '#' }}" class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-4 py-1.5 text-sm font-medium text-slate-700 transition-all hover:bg-slate-50 hover:border-slate-300">
                            <div class="h-6 w-6 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 text-[10px]">
                                <i class="fas fa-user"></i>
                            </div>
                            {{ auth()->user()->name }}
                        </a>
                        @endauth
                    </div>
                </div>

                <!-- Mobile menu button -->
                <div class="flex md:hidden">
                    <button type="button" @click="mobileMenu = !mobileMenu" class="inline-flex items-center justify-center rounded-lg p-2 text-slate-400 hover:bg-slate-100 hover:text-slate-500 focus:outline-none">
                        <i class="fas fa-bars text-xl" x-show="!mobileMenu"></i>
                        <i class="fas fa-times text-xl" x-show="mobileMenu" x-cloak></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu (requires Alpine.js for full functionality, but using standard Blade for now or I can add Alpine) -->
        <div id="mobile-menu" class="hidden border-t border-slate-100 bg-white md:hidden">
            <div class="space-y-1 px-4 py-3">
                <a href="{{ route('home') }}" class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Beranda</a>
                <a href="{{ route('public.layanan') }}" class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('public.layanan') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Layanan</a>
                <a href="{{ route('public.pelanggan') }}" class="block rounded-lg px-3 py-2 text-base font-medium {{ request()->routeIs('public.pelanggan') ? 'bg-blue-50 text-blue-600' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">Cek Status</a>
                @guest
                <div class="mt-4 border-t border-slate-100 pt-4">
                    <a href="{{ route('login') }}" class="flex w-full items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-md shadow-blue-200 transition-all hover:bg-blue-700">
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
    <footer class="mt-20 border-t border-slate-200 bg-white py-12 lg:py-16">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 lg:grid-cols-3">
                <div class="lg:col-span-1">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600 text-white shadow-lg shadow-blue-200">
                            <i class="fas fa-soap text-sm"></i>
                        </div>
                        <span class="text-xl font-bold tracking-tight text-slate-900">Si<span class="text-blue-600">Laundry</span></span>
                    </a>
                    <p class="mt-4 text-sm leading-relaxed text-slate-500 max-w-xs">
                        Layanan laundry modern dengan teknologi terkini untuk memberikan hasil cucian yang bersih, wangi, dan rapi setiap saat.
                    </p>
                    <div class="mt-6 flex gap-4">
                        <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-blue-600 hover:text-white transition-all">
                            <i class="fab fa-facebook-f text-xs"></i>
                        </a>
                        <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-blue-400 hover:text-white transition-all">
                            <i class="fab fa-twitter text-xs"></i>
                        </a>
                        <a href="#" class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-slate-500 hover:bg-pink-600 hover:text-white transition-all">
                            <i class="fab fa-instagram text-xs"></i>
                        </a>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-8 sm:grid-cols-2 lg:col-span-2">
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-900">Halaman</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="{{ route('home') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Beranda</a></li>
                            <li><a href="{{ route('public.layanan') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Daftar Layanan</a></li>
                            <li><a href="{{ route('public.pelanggan') }}" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Cek Status</a></li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-900">Bantuan</h3>
                        <ul class="mt-4 space-y-2">
                            <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Cara Pemesanan</a></li>
                            <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Syarat & Ketentuan</a></li>
                            <li><a href="#" class="text-sm text-slate-500 hover:text-blue-600 transition-colors">Kontak Kami</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-12 border-t border-slate-100 pt-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-slate-400">
                    &copy; {{ date('Y') }} SiLaundry. Dibuat dengan <i class="fas fa-heart text-red-500"></i> untuk kebersihan pakaian Anda.
                </p>
                <div class="flex items-center gap-6">
                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-[0.2em]">Terdaftar & Terpercaya</span>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Simple mobile menu toggle without full Alpine.js dependency if not needed
        document.addEventListener('DOMContentLoaded', function() {
            const btn = document.querySelector('button[type="button"]');
            const menu = document.getElementById('mobile-menu');
            
            if (btn && menu) {
                btn.addEventListener('click', () => {
                    menu.classList.toggle('hidden');
                });
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
