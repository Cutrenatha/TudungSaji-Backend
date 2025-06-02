<?php
// app/Models/Resep.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import model User

class Resep extends Model
{
    use HasFactory;

    // Kolom yang bisa diisi secara massal
    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'gambar',
        'porsi',
        'lama_memasak',
        'bahan_bahan',
        'langkah_memasak',
    ];

    // Konversi otomatis ke array untuk JSON
    protected $casts = [
        'bahan_bahan' => 'array',
        'langkah_memasak' => 'array',
    ];

    /**
     * Relasi ke user (pembuat resep)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi many-to-many ke user yang memfavoritkan resep
     */
    public function favoritedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'favorit_resep', 'resep_id', 'user_id')->withTimestamps();
    }

    /**
     * Cek apakah resep ini sudah difavoritkan oleh user yang sedang login
     */
    public function isFavoritedByCurrentUser(): bool
    {
        if (!Auth::check()) {
            return false;
        }
        return $this->favoritedByUsers()->where('user_id', Auth::id())->exists();
    }
}