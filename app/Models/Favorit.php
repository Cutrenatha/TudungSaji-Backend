<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    use HasFactory;

    // Kolom yang boleh diisi secara massal
    protected $fillable = ['user_id', 'resep_id'];

    /**
     * Relasi ke model User
     * - Setiap favorit dimiliki oleh satu user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Resep
     * - Setiap favorit merujuk ke satu resep
     */
    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }
}