<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking; // Pastikan Anda mengimpor Model Booking

class CustomerBookingController extends Controller
{
    /**
     * Menampilkan daftar semua booking user yang sedang login.
     */
    public function index()
    {
        // Ambil semua booking yang dimiliki oleh user yang sedang login
        $bookings = Booking::where('user_id', Auth::id())
                            ->orderBy('start_time', 'desc') // Urutkan dari yang terbaru
                            ->with('field') // Muat data lapangan terkait
                            ->get();

        return view('my-booking.index', compact('bookings'));
    }
}