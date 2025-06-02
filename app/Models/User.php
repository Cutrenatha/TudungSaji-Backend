<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Resep; // Import model Resep

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Atribut yang bisa diisi secara massal.
     * - Digunakan saat registrasi atau update profil.
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'profile_image',
        'alamat',
        'telepon',
        'tanggal_lahir',
        'lokasi',
        'kode_pos',
    ];

    /**
     * Atribut yang disembunyikan saat serialisasi (misalnya ke JSON).
     * - Menjaga keamanan data.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Konversi otomatis tipe data.
     * - Digunakan oleh Eloquent untuk parsing data dari database.
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'tanggal_lahir' => 'date',
        'password' => 'hashed', // Laravel 10+ mendukung hashing otomatis
    ];

    /**
     * Relasi One-to-Many: User memiliki banyak resep.
     */
    public function reseps(): HasMany
    {
        return $this->hasMany(Resep::class);
    }

    /**
     * Relasi Many-to-Many: User memfavoritkan banyak resep.
     * - Tabel pivot: favorit_resep
     */
    public function favorites(): BelongsToMany
    {
        return $this->belongsToMany(Resep::class, 'favorit_resep', 'user_id', 'resep_id')->withTimestamps();
    }

    /**
     * Mengecek apakah user sudah memfavoritkan resep tertentu.
     * - Berguna untuk tampilan tombol favorit (sudah/belum).
     */
    public function hasFavorited(Resep $resep): bool
    {
        return $this->favorites()->where('resep_id', $resep->id)->exists();
    }
}