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
        // 1. Cek apakah statusnya memang bisa dibatalkan
        if (in_array($this->booking->status, ['pending_verification', 'waiting_confirmation'])) {
            
            $this->booking->update([
                'status' => 'cancelled', 
                'admin_notes' => 'Dibatalkan oleh customer.',
            ]);

            // 2. Kirim sinyal (Dispatch) ke Browser untuk memicu SweetAlert2
            $this->dispatch('swal:success', [
                'message' => 'Pesanan Anda berhasil dibatalkan, Bos!'
            ]);

        } else {
            // Jika gagal (status sudah berubah duluan), kirim sinyal error
            $this->dispatch('swal:error', [
                'message' => 'Gagal! Status pesanan sudah ' . ucfirst(str_replace('_', ' ', $this->booking->status))
            ]);
        }
    }

    public function render()
    {
        return view('livewire.cancel-booking-button');
    }
}