<?php

use App\Http\Controllers\NoteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman Depan NoteEase (Welcome Page)
Route::get('/', function () {
    return view('welcome');
});

// Grup Route yang membutuhkan Login
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Route Dashboard Utama (Memanggil NoteController untuk menampilkan catatan)
    Route::get('/dashboard', [NoteController::class, 'index'])->name('dashboard');
    
    // Route untuk menyimpan catatan baru
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');
    
    // Route untuk hapus catatan
    Route::delete('/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

    // Route Profile (Bawaan Laravel Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';