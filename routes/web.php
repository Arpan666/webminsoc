<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FieldController;
use App\Models\Booking;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\BookingReportController; // Tambahkan ini

// ------------------
// ROUTE APLIKASI UTAMA
// ------------------

// Halaman utama (daftar lapangan)
Route::get('/', [FieldController::class, 'index'])->name('welcome');

// routes/web.php
Route::get('/contact', [App\Http\Controllers\ContactController::class, 'index'])->name('contact-us');

// Detail lapangan
Route::get('/lapangan/{field}', [FieldController::class, 'show'])->name('field.detail');

Route::get('/location', [App\Http\Controllers\LocationController::class, 'index'])->name('location');

Route::get('/about', [App\Http\Controllers\AboutController::class, 'index'])->name('about-us');

// ------------------
// ROUTE USER LOGIN
// ------------------

Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/booking/process', [BookingController::class, 'process'])->name('booking.process');

    Route::get('/booking/{booking}/payment', [PaymentController::class, 'show'])
        ->middleware('verified')
        ->name('payment.show');

    Route::post('/booking/{booking}/payment', [PaymentController::class, 'store'])
        ->middleware('verified')
        ->name('payment.store');

    // ROUTE RIWAYAT BOOKING
    Route::get('/my-bookings', [CustomerBookingController::class, 'index'])->name('my-bookings.index');

    // --- ROUTE CETAK LAPORAN (BARU) ---
    Route::get('/admin/bookings/report/print', [BookingReportController::class, 'print'])
        ->name('bookings.report.print');

        // --- ROUTE CETAK TICKET ---
    Route::get('/booking/{booking}/print', [App\Http\Controllers\PaymentController::class, 'printTicket'])->name('booking.print');
});

// Route untuk halaman sukses
Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success')->middleware('auth');

// ------------------
// ROUTE AUTH DEFAULT
// ------------------

require __DIR__.'/auth.php';