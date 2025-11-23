<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class CancelBookingButton extends Component
{
    public Booking $booking;

    public function mount(Booking $booking)
    {
        // Guard: pastikan booking ini milik user yang sedang login
        if ($booking->user_id !== Auth::id()) {
            abort(403);
        }
        $this->booking = $booking;
    }

    public function cancel()
    {
        // Hanya izinkan pembatalan jika statusnya masih menunggu verifikasi atau konfirmasi
        if ($this->booking->status === 'pending_verification' || $this->booking->status === 'waiting_confirmation') {
            
            $this->booking->update([
                'status' => 'cancelled', 
                'admin_notes' => 'Dibatalkan oleh customer.',
            ]);

            session()->flash('success', 'Pemesanan berhasil dibatalkan.');
        } else {
            session()->flash('error', 'Pemesanan tidak dapat dibatalkan karena statusnya sudah ' . ucfirst(str_replace('_', ' ', $this->booking->status)) . '.');
        }

        // Redirect kembali ke halaman riwayat booking
        return redirect()->route('my-bookings.index');
    }

    public function render()
    {
        return view('livewire.cancel-booking-button');
    }
}