<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FavoritController;
use App\Http\Controllers\ResepController;

// =======================
// Halaman Umum (Tidak Membutuhkan Autentikasi)
// =======================
Route::view('/beranda', 'tudungsaji.beranda')->name('beranda');
Route::view('/tipsmasak', 'tudungsaji.tipsmasak')->name('tipsmasak');
Route::view('/resepspaghetti', 'tudungsaji.spaghetti')->name('resepspaghetti'); // Halaman resep statis/detail contoh

Route::get('/resepmasakan', [ResepController::class, 'showAllPublic'])->name('resepmasakan');
// Untuk menampilkan detail resep secara publik, gunakan Route Model Binding jika method 'show' menerima Resep
Route::get('/resep/{resep}', [ResepController::class, 'show'])->name('resep.show.public');


// =======================
// Auth: Register & Login & Logout
// =======================
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register.process');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');

// Logout ditempatkan di sini karena membutuhkan middleware auth, tapi tidak perlu di dalam grup utama
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');


// =======================
// Halaman yang Membutuhkan Autentikasi
// =======================
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', fn() => view('pages.dashboard'))->name('dashboard'); // Pastikan view 'pages.dashboard' ada

    // --- Halaman Profil ---
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');

    // --- Halaman Favorit ---
    Route::get('/favorit', [FavoritController::class, 'index'])->name('favorit.index');
    Route::post('/favorit/toggle/{resep}', [FavoritController::class, 'toggle'])->name('favorit.toggle'); // {resep} untuk Route Model Binding

    // --- Halaman ResepKu (CRUD Milik User) ---
    Route::get('/resepku', [ResepController::class, 'index'])->name('resep.index'); 
    Route::get('/resepku/create', [ResepController::class, 'create'])->name('resep.create'); 
    Route::post('/resepku', [ResepController::class, 'store'])->name('resep.store'); 

    // Gunakan Route Model Binding untuk edit, update, destroy jika method controller menerima model Resep
    Route::get('/resepku/{resep}/edit', [ResepController::class, 'edit'])->name('resep.edit'); // Form edit resep
    Route::put('/resepku/{resep}', [ResepController::class, 'update'])->name('resep.update'); // Proses update resep
    Route::delete('/resepku/{resep}', [ResepController::class, 'destroy'])->name('resep.destroy'); // Proses hapus resep

});