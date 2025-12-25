<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class NoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Mencari user yang sudah Anda buat saat Register tadi
        $user = User::first();

        // Jika user ditemukan, masukkan data catatan contoh
        if ($user) {
            DB::table('notes')->insert([
                [
                    'user_id' => $user->id,
                    'title'   => 'Rencana UAS NoteEase',
                    'content' => 'Menyelesaikan fitur CRUD dan integrasi database sebelum tanggal 30 Desember.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $user->id,
                    'title'   => 'Daftar Fitur Utama',
                    'content' => '1. Manajemen Catatan, 2. Kategorisasi, 3. Fitur Pencarian.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'user_id' => $user->id,
                    'title'   => 'Ide Pengembangan Masa Depan',
                    'content' => 'Menambahkan fitur Dark Mode dan pengingat waktu (Reminders).',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }
    }
}