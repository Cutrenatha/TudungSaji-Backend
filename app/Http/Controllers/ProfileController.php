<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Import model User

class ProfileController extends Controller
{
    // Tampilkan form edit profil
    public function edit()
    {
        $user = Auth::user(); // Ambil user yang sedang login

        if (!$user) {
            return redirect()->route('login.form'); // Redirect jika user tidak ditemukan
        }

        return view('tudungsaji.Profil', ['user' => $user]);
    }

    // Proses update profil user
    public function update(Request $request)
    {
        $user = Auth::user(); // Ambil user login

        if (!$user instanceof User) {
            return back()->with('error', 'Gagal memuat data pengguna.');
        }

        // Validasi input
        $validated = $request->validate([
            'first_name'      => 'required|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users,email,' . $user->id,
            'alamat'          => 'nullable|string|max:255',
            'telepon'         => 'nullable|string|max:20',
            'tanggal_lahir'   => 'nullable|date',
            'lokasi'          => 'nullable|string|max:255',
            'kode_pos'        => 'nullable|string|max:10',
        ]);

        $user->update($validated); // Update data user

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}