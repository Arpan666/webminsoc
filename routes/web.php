<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FieldController; // <-- HANYA PERLU SEKALI IMPORT

// --- ROUTE APLIKASI UTAMA ---

// 1. Route untuk halaman utama (menggunakan FieldController@index)
// INI AKAN MENAMPILKAN DAFTAR LAPANGAN DAN SEARCH BAR
Route::get('/', [FieldController::class, 'index'])->name('home');

// 2. Route untuk detail lapangan (menggunakan FieldController@show)
Route::get('/lapangan/{field}', [FieldController::class, 'show'])->name('field.detail');


// --- ROUTE AUTENTIKASI BREEZE (BIARKAN) ---

// Route::get('/dashboard', function () {
// 	return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// HAPUS route ini dari file Anda:
// Route::get('/', function () {
//     return view('welcome');
// });