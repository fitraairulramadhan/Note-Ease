<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * 1. Menampilkan Dashboard dengan fitur PENCARIAN & STATISTIK
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Query mengambil catatan milik user yang sedang login saja
        $notes = Note::where('user_id', Auth::id())
            ->when($search, function ($query, $search) {
                return $query->where(function($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                      ->orWhere('content', 'like', "%{$search}%")
                      ->orWhere('category', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->get();

        // Data statistik agar kotak di Dashboard tidak nol (0)
        $stats = [
            'total' => $notes->count(),
            'categories' => $notes->whereNotNull('category')->unique('category')->count(),
        ];

        return view('dashboard', compact('notes', 'stats'));
    }

    /**
     * 2. Proses SIMPAN Catatan Baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'nullable|string|max:50',
        ]);

        Note::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
        ]);

        return redirect()->route('dashboard')->with('success', 'Catatan berhasil disimpan ke NoteEase!');
    }

    /**
     * 3. Proses HAPUS Catatan
     */
    public function destroy(Note $note)
    {
        // Keamanan: Cek apakah catatan ini benar milik user yang sedang login
        if ($note->user_id !== Auth::id()) {
            abort(403, 'Aksi tidak diizinkan.');
        }

        $note->delete();

        return redirect()->route('dashboard')->with('success', 'Catatan telah dihapus.');
    }
}