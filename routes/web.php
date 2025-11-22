<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FieldController;
use App\Models\Booking;
use App\Http\Controllers\PaymentController;

// ------------------
// ROUTE APLIKASI UTAMA
// ------------------

// Halaman utama (daftar lapangan)
Route::get('/', [FieldController::class, 'index'])->name('home');

// Detail lapangan
Route::get('/lapangan/{field}', [FieldController::class, 'show'])->name('field.detail');

// ------------------
// ROUTE USER LOGIN
// ------------------

Route::middleware('auth')->group(function () {

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------
// ROUTE PEMBAYARAN BOOKING
// ------------------

Route::get('/booking/{booking}/payment', function (Booking $booking) {

    // Hanya pemilik booking yang boleh akses
    if (Auth::id() !== $booking->user_id) {
        abort(403);
    }

    // Tampilkan view booking.payment
    return view('booking.payment', compact('booking'));

})->middleware(['auth'])->name('booking.payment');

Route::get('/booking/{booking}/payment', [PaymentController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('payment.show');

// Route untuk memproses bukti pembayaran (jika Anda menggunakan Controller terpisah)
Route::post('/booking/{booking}/payment', [PaymentController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('payment.store');

// ------------------
// ROUTE AUTH DEFAULT (Breeze / Jetstream / Fortify)
// ------------------

require __DIR__.'/auth.php';
