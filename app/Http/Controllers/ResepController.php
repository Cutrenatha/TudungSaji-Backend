<?php

namespace App\Http\Controllers;

use App\Models\Resep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ResepController extends Controller
{
    // Tampilkan semua resep publik
    public function showAllPublic()
    {
        $reseps = Resep::with('user')->latest()->get();
        return view('tudungsaji.resepmasakan', compact('reseps'));
    }

    // Tampilkan resep milik user login
    public function index()
    {
        $reseps = Resep::where('user_id', Auth::id())->latest()->get();
        return view('tudungsaji.myresep', compact('reseps'));
    }

    // Tampilkan detail resep
    public function show($id)
    {
        $resep = Resep::with('user')->findOrFail($id);
        return view('tudungsaji.tampilkanResep', compact('resep'));
    }

    // Tampilkan form tambah resep
    public function create()
    {
        return view('tudungsaji.tambahResep');
    }

    // Simpan resep baru ke database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'porsi' => 'required|string|max:50',
            'lamaMemasak' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bahan_bahan' => 'required|array',
            'bahan_bahan.*' => 'required|string',
            'langkah_memasak' => 'required|array',
            'langkah_memasak.*' => 'required|string',
        ]);

        $dataToStore = [
            'user_id' => Auth::id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'porsi' => $validated['porsi'],
            'lama_memasak' => $validated['lamaMemasak'],
            'bahan_bahan' => $validated['bahan_bahan'],
            'langkah_memasak' => $validated['langkah_memasak'],
        ];

        // Simpan gambar jika diunggah
        if ($request->hasFile('gambar')) {
            $dataToStore['gambar'] = $request->file('gambar')->store('resep-images', 'public');
        }

        Resep::create($dataToStore);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil ditambahkan!');
    }

    // Tampilkan form edit resep
    public function edit($id)
    {
        $resep = Resep::findOrFail($id);

        // Cek kepemilikan resep
        if ($resep->user_id !== Auth::id()) {
            abort(403, 'TINDAKAN TIDAK DIIZINKAN.');
        }

        return view('tudungsaji.tambahResep', compact('resep'));
    }

    // Update data resep
    public function update(Request $request, $id)
    {
        $resep = Resep::findOrFail($id);

        // Cek kepemilikan resep
        if ($resep->user_id !== Auth::id()) {
            abort(403, 'TINDAKAN TIDAK DIIZINKAN.');
        }

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'porsi' => 'required|string|max:50',
            'lamaMemasak' => 'required|string|max:50',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'bahan_bahan' => 'required|array',
            'bahan_bahan.*' => 'required|string',
            'langkah_memasak' => 'required|array',
            'langkah_memasak.*' => 'required|string',
        ]);

        $dataToUpdate = [
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'],
            'porsi' => $validated['porsi'],
            'lama_memasak' => $validated['lamaMemasak'],
            'bahan_bahan' => $validated['bahan_bahan'],
            'langkah_memasak' => $validated['langkah_memasak'],
        ];

        // Ganti gambar jika ada upload baru
        if ($request->hasFile('gambar')) {
            if ($resep->gambar && Storage::disk('public')->exists($resep->gambar)) {
                Storage::disk('public')->delete($resep->gambar);
            }
            $dataToUpdate['gambar'] = $request->file('gambar')->store('resep-images', 'public');
        }

        $resep->update($dataToUpdate);

        return redirect()->route('resep.index')->with('success', 'Resep berhasil diperbarui!');
    }

    // Hapus resep
    public function destroy($id)
    {
        $resep = Resep::findOrFail($id);

        // Cek kepemilikan resep
        if ($resep->user_id !== Auth::id()) {
            abort(403, 'TINDAKAN TIDAK DIIZINKAN.');
        }

        // Hapus dari favorit
        $resep->favoritedByUsers()->detach();

        // Hapus gambar jika ada
        if ($resep->gambar && Storage::disk('public')->exists($resep->gambar)) {
            Storage::disk('public')->delete($resep->gambar);
        }

        $resep->delete();

        return redirect()->route('resep.index')->with('success', 'Resep berhasil dihapus!');
    }
}