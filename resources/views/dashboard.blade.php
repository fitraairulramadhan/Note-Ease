<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col md:flex-row items-center justify-between gap-4">
            <h2 class="font-black text-2xl text-slate-800 dark:text-white leading-tight">
                {{ __('My Notes') }} <span class="text-indigo-600">NoteEase</span>
            </h2>

            <form action="{{ route('dashboard') }}" method="GET" class="w-full md:w-1/3">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" 
                        placeholder="Cari judul atau isi..." 
                        class="w-full pl-10 pr-4 py-2 rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-slate-900 dark:text-white">
                    <div class="absolute left-3 top-2.5 text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </form>

            <button onclick="toggleModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl font-bold shadow-lg shadow-indigo-100 dark:shadow-none transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Catatan
            </button>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 transition-transform hover:scale-105">
                    <p class="text-slate-500 text-sm font-medium">Total Catatan</p>
                    <h3 class="text-3xl font-black text-indigo-600 mt-1">{{ $stats['total'] }}</h3>
                </div>
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 transition-transform hover:scale-105">
                    <p class="text-slate-500 text-sm font-medium">Kategori Unik</p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white mt-1">{{ $stats['categories'] }}</h3>
                </div>
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 transition-transform hover:scale-105">
                    <p class="text-slate-500 text-sm font-medium">Status Akun</p>
                    <h3 class="text-3xl font-black text-green-500 mt-1 uppercase text-sm tracking-widest">Premium User</h3>
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500 text-white rounded-xl font-bold shadow-lg animate-bounce text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($notes as $note)
                    <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col justify-between">
                        <div>
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">{{ $note->category ?? 'Umum' }}</span>
                                <form action="{{ route('notes.destroy', $note) }}" method="POST" onsubmit="return confirm('Hapus catatan ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-slate-300 hover:text-red-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                            <h4 class="font-bold text-lg text-slate-800 dark:text-white mb-2">{{ $note->title }}</h4>
                            <p class="text-slate-500 text-sm leading-relaxed mb-4">{{ Str::limit($note->content, 120) }}</p>
                        </div>
                        <p class="text-[10px] text-slate-400 font-medium italic border-t pt-4">Dibuat {{ $note->created_at->diffForHumans() }}</p>
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center">
                        <div class="bg-slate-100 dark:bg-slate-900 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 dark:text-white">Tidak ada catatan ditemukan</h3>
                        <p class="text-slate-500">Coba kata kunci lain atau buat catatan baru.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div id="noteModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
        <div class="bg-white dark:bg-slate-800 w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden transform transition-all">
            <div class="p-8">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-2xl font-black text-slate-800 dark:text-white">Tulis <span class="text-indigo-600">Ide</span></h3>
                    <button onclick="toggleModal()" class="text-slate-400 hover:text-slate-600 text-2xl font-bold">&times;</button>
                </div>
                <form action="{{ route('notes.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <input type="text" name="title" required placeholder="Judul Inspirasi" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-slate-900 dark:text-white">
                        <input type="text" name="category" placeholder="Kategori (Kuliah, Ide, Proyek)" class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-slate-900 dark:text-white">
                        <textarea name="content" rows="5" required placeholder="Tulis detail ide Anda di sini..." class="w-full rounded-xl border-slate-200 focus:border-indigo-500 focus:ring-indigo-500 dark:bg-slate-900 dark:text-white"></textarea>
                    </div>
                    <div class="mt-8 flex gap-3">
                        <button type="button" onclick="toggleModal()" class="flex-1 py-3 font-bold text-slate-500 hover:bg-slate-50 rounded-xl transition">Batal</button>
                        <button type="submit" class="flex-1 py-3 bg-indigo-600 text-white rounded-xl font-bold shadow-lg shadow-indigo-200 hover:bg-indigo-700 transition-all">Simpan ke NoteEase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function toggleModal() {
            const modal = document.getElementById('noteModal');
            modal.classList.toggle('hidden');
            modal.classList.toggle('flex');
        }
    </script>
</x-app-layout>