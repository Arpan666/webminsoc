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

    public function printTicket(Booking $booking)
    {
        // Pastikan hanya pemilik atau admin
        if (auth()->id() !== $booking->user_id && auth()->user()->role !== 'admin') {
            abort(403);
        }

        // Load relasi agar data tidak null saat di-print
        $booking->load(['user', 'field']);

        return view('payment.print', compact('booking'));
    }
}