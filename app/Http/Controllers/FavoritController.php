<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resep;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // <<== Untuk memastikan model User tersedia

class FavoritController extends Controller
{
    // Menampilkan daftar resep favorit pengguna yang sedang login
    public function index()
    {
        $user = Auth::user();
        $favoritResep = $user->favorites;  
        return view('tudungsaji.favorit', compact('favoritResep'));
    }

    // Menambahkan atau menghapus resep dari daftar favorit
    public function toggle(Resep $resep)
    {
        $user = Auth::user();
        
        // Cek apakah resep sudah ada di daftar favorit pengguna
        if ($user->favorites()->where('resep_id', $resep->id)->exists()) {
            $user->favorites()->detach($resep->id);
        } else {
            // Jika belum, tambahkan ke favorit
            $user->favorites()->attach($resep->id);
        }

        return back(); // Kembali ke halaman sebelumnya
    }
}
