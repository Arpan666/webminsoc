<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CustomerBookingController;
use App\Http\Controllers\BookingReportController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AboutController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- HALAMAN PUBLIK (Bisa diakses tanpa login) ---
Route::get('/', [FieldController::class, 'index'])->name('welcome');
Route::get('/lapangan/{field}', [FieldController::class, 'show'])->name('field.detail');
Route::get('/location', [LocationController::class, 'index'])->name('location');
Route::get('/about', [AboutController::class, 'index'])->name('about-us');

// --- FITUR KONTAK (Logika Terpisah & AJAX) ---
Route::controller(ContactController::class)->group(function () {
    Route::get('/contact', 'index')->name('contact.index');
    Route::post('/contact/send', 'sendMessage')->name('contact.send');
});

// --- HALAMAN PROTECTED (Wajib Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Manajemen Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Proses Booking
    Route::post('/booking/process', [BookingController::class, 'process'])->name('booking.process');
    Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');

    // Pembayaran & Tiket (Wajib Verified Email jika ada)
    Route::middleware('verified')->group(function () {
        Route::get('/booking/{booking}/payment', [PaymentController::class, 'show'])->name('payment.show');
        Route::post('/booking/{booking}/payment', [PaymentController::class, 'store'])->name('payment.store');
        Route::get('/booking/{booking}/print', [PaymentController::class, 'printTicket'])->name('booking.print');
    });

    // Riwayat Booking Customer
    Route::get('/my-bookings', [CustomerBookingController::class, 'index'])->name('my-bookings.index');

    // Laporan Admin (Cetak Laporan)
    Route::get('/admin/bookings/report/print', [BookingReportController::class, 'print'])->name('bookings.report.print');

    // Inbox Admin (Pesan Kontak)
    Route::get('/admin/inbox', [ContactController::class, 'adminIndex'])->name('admin.inbox');
    Route::delete('/admin/inbox/{contact}', [ContactController::class, 'destroy'])->name('admin.inbox.delete');
});

// --- AUTHENTICATION ROUTES (Breeze/Jetstream) ---
require __DIR__.'/auth.php';