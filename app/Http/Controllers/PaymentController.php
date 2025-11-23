<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Menampilkan halaman upload bukti pembayaran.
     * Route: /booking/{booking}/payment (payment.show)
     */
    public function show(Booking $booking)
    {
        // Pastikan hanya user pemilik booking yang bisa mengakses halaman ini
        if ($booking->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Ini bukan pesanan Anda.');
        }

        // Tampilkan view yang berisi detail booking dan komponen Livewire uploader
        return view('payment.show', compact('booking'));
    }
}