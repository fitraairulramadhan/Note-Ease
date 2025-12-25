<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NoteEase - Digital Notes Made Easy</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] antialiased selection:bg-indigo-100 selection:text-indigo-700">
    
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] rounded-full bg-indigo-50/50 blur-[120px] dark:bg-indigo-950/20"></div>
        <div class="absolute -bottom-[10%] -right-[10%] w-[40%] h-[40%] rounded-full bg-blue-50/50 blur-[120px] dark:bg-blue-950/20"></div>
    </div>

    <div class="flex flex-col min-h-screen p-6 lg:p-8">
        <header class="w-full max-w-6xl mx-auto flex justify-between items-center mb-16">
            <div class="flex items-center gap-2.5 group cursor-default">
                <div class="bg-indigo-600 p-2.5 rounded-xl text-white shadow-lg shadow-indigo-200 dark:shadow-none group-hover:scale-110 transition-transform">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <span class="text-2xl font-black tracking-tight dark:text-white">Note<span class="text-indigo-600">Ease</span></span>
            </div>
            
            @if (Route::has('login'))
                <nav class="flex items-center gap-2 sm:gap-6">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-indigo-600 text-white rounded-full text-sm font-bold hover:bg-indigo-700 hover:shadow-md transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-semibold text-[#706f6c] dark:text-[#A1A09A] hover:text-indigo-600 transition">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hidden sm:block px-6 py-2.5 border-2 border-indigo-600 text-indigo-600 dark:text-indigo-400 rounded-full text-sm font-bold hover:bg-indigo-600 hover:text-white transition-all">Daftar Sekarang</a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="flex-1 flex flex-col items-center justify-center text-center max-w-5xl mx-auto">
            <div class="inline-flex items-center gap-2 px-4 py-2 mb-8 text-xs font-bold tracking-widest uppercase text-indigo-600 bg-indigo-50 dark:bg-indigo-900/30 dark:text-indigo-300 rounded-full shadow-sm">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                </span>
                Tersedia untuk UAS 2025
            </div>
            
            <h1 class="text-6xl lg:text-8xl font-black mb-8 tracking-tighter dark:text-white leading-[0.9]">
                Ide Besar Dimulai dari <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-blue-500">Catatan Kecil.</span>
            </h1>
            
            <p class="text-xl lg:text-2xl text-[#706f6c] dark:text-[#A1A09A] mb-12 leading-relaxed max-w-3xl font-medium">
                NoteEase adalah ruang kreatif digital Anda. Simpan inspirasi, kelola tugas, dan atur hidup Anda dalam satu antarmuka yang elegan.
            </p>

            <div class="flex flex-col sm:flex-row gap-5 mb-20">
                @auth
                    <a href="{{ url('/dashboard') }}" class="px-10 py-5 bg-indigo-600 text-white rounded-2xl font-bold text-xl shadow-xl shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 hover:-translate-y-1 transition-all">
                        Lanjutkan Menulis
                    </a>
                @else
                    <a href="{{ route('register') }}" class="px-10 py-5 bg-indigo-600 text-white rounded-2xl font-bold text-xl shadow-xl shadow-indigo-200 dark:shadow-none hover:bg-indigo-700 hover:-translate-y-1 transition-all">
                        Mulai Gratis Sekarang
                    </a>
                    <div class="px-10 py-5 bg-white dark:bg-[#161615] border border-gray-200 dark:border-gray-800 rounded-2xl font-bold text-xl dark:text-white cursor-default">
                        100% Secure
                    </div>
                @endauth
            </div>

            <div class="w-full max-w-4xl bg-white dark:bg-[#161615] rounded-t-3xl border-t border-x border-gray-200 dark:border-gray-800 p-4 shadow-2xl shadow-indigo-100 dark:shadow-none">
                <div class="flex gap-2 mb-4">
                    <div class="w-3 h-3 rounded-full bg-red-400"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-400"></div>
                    <div class="w-3 h-3 rounded-full bg-green-400"></div>
                </div>
                <div class="grid grid-cols-3 gap-4">
                    <div class="h-32 rounded-xl bg-slate-50 dark:bg-zinc-900 border border-dashed border-gray-200 dark:border-gray-800"></div>
                    <div class="h-32 rounded-xl bg-slate-50 dark:bg-zinc-900 border border-dashed border-gray-200 dark:border-gray-800"></div>
                    <div class="h-32 rounded-xl bg-indigo-50/50 dark:bg-indigo-900/10 border border-indigo-100 dark:border-indigo-900/50"></div>
                </div>
            </div>
        </main>

        <footer class="w-full text-center py-10 border-t border-gray-100 dark:border-gray-900 text-sm font-medium text-[#706f6c] dark:text-[#A1A09A]">
            <p>&copy; 2025 NoteEase Dashboard. Dibuat untuk memenuhi tugas UAS Web Programming.</p>
        </footer>
    </div>
</body>
</html>