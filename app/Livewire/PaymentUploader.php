<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentUploader extends Component
{
    use WithFileUploads;

    public $booking;
    public $paymentProof; 
    public $uploadSuccess = false;

    protected $rules = [
        'paymentProof' => 'required|image|max:2048', // Maksimal 2MB
    ];

    public function mount($bookingId)
    {
        $this->booking = Booking::findOrFail($bookingId);
    }

    public function updatedPaymentProof()
    {
        $this->validateOnly('paymentProof');
    }

    public function save()
    {
        $this->validate();

        // Simpan file ke storage public
        $path = $this->paymentProof->store('payment_proofs', 'public');

        // Update database
        $this->booking->update([
            'payment_proof_path' => $path,
            'status' => 'pending_verification', 
        ]);

        $this->uploadSuccess = true;
        $this->paymentProof = null;

        session()->flash('message', 'Bukti berhasil diunggah!');
    }

    public function render()
    {
        return view('livewire.payment-uploader');
    }
}