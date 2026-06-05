<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Cuciin</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full font-sans text-slate-900 antialiased selection:bg-indigo-100 selection:text-indigo-700 overflow-hidden">
    <div class="relative flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Background Decor -->
        <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-[10%] -left-[10%] h-[50%] w-[50%] rounded-full bg-indigo-100/50 blur-[120px]"></div>
            <div class="absolute -bottom-[10%] -right-[10%] h-[50%] w-[50%] rounded-full bg-purple-100/50 blur-[120px]"></div>
        </div>

        <div class="relative z-10 w-full max-w-md">
            <!-- Brand / Logo -->
            <div class="text-center mb-10">
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 group">
                    <div class="flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 text-white shadow-2xl shadow-indigo-200 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-soap text-2xl"></i>
                    </div>
                </a>
                <h2 class="mt-6 text-3xl font-black tracking-tighter text-slate-900">Selamat Datang</h2>
                <p class="mt-2 text-sm font-medium text-slate-500 uppercase tracking-widest">Akses Portal Cuciin</p>
            </div>

            <!-- Login Card -->
            <div class="overflow-hidden rounded-[2.5rem] border border-slate-100 bg-white/80 p-1 backdrop-blur-xl shadow-[0_40px_80px_-20px_rgba(79,70,229,0.15)]">
                <div class="rounded-[2.2rem] bg-white p-8 sm:p-10 shadow-inner">
                    @if ($errors->any())
                        <div class="mb-8 rounded-2xl bg-red-50 p-4 border border-red-100">
                            <div class="flex gap-3">
                                <i class="fas fa-circle-exclamation text-red-500 mt-1"></i>
                                <ul class="text-xs font-bold text-red-600 space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('login') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="space-y-2">
                            <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 ml-1">Alamat Email</label>
                            <div class="relative group">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-envelope text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                                </div>
                                <input type="email" name="email" 
                                       class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-4 text-sm font-bold text-slate-900 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" 
                                       placeholder="admin@cuciin.com" 
                                       value="{{ old('email') }}" required autofocus>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex justify-between items-center ml-1">
                                <label class="text-[10px] font-black uppercase tracking-widest text-slate-400">Kata Sandi</label>
                                <!-- Optional: Forgot password link if exists -->
                            </div>
                            <div class="relative group" x-data="{ show: false }">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <i class="fas fa-lock text-slate-400 group-focus-within:text-indigo-500 transition-colors"></i>
                                </div>
                                <input :type="show ? 'text' : 'password'" name="password" id="password"
                                       class="block w-full rounded-xl border-slate-200 bg-slate-50/50 py-3.5 pl-11 pr-12 text-sm font-bold text-slate-900 shadow-sm transition-all focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10" 
                                       placeholder="••••••••" required>
                                <button type="button" @click="show = !show" 
                                        class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-indigo-600 transition-colors">
                                    <i class="fas" :class="show ? 'fa-eye-slash' : 'fa-eye'"></i>
                                </button>
                            </div>
                        </div>

                        <div class="pt-2">
                            <button type="submit" 
                                    class="flex w-full items-center justify-center rounded-2xl bg-slate-900 py-4 text-sm font-black uppercase tracking-widest text-white shadow-xl transition-all hover:bg-indigo-600 active:scale-95">
                                Masuk Aplikasi
                                <i class="fas fa-arrow-right ml-3 text-xs"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Footer Link -->
            <div class="mt-8 text-center">
                <a href="{{ route('home') }}" class="group inline-flex items-center text-sm font-black uppercase tracking-widest text-slate-400 hover:text-indigo-600 transition-colors">
                    <i class="fas fa-arrow-left mr-3 text-xs transition-transform group-hover:-translate-x-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <!-- Alpine.js for interaktivity -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
