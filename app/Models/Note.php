<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    // Menentukan kolom mana saja yang boleh diisi secara massal
    protected $fillable = [
        'user_id', 
        'title', 
        'content', 
        'category'
    ];

    // Relasi: Setiap catatan milik satu user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}