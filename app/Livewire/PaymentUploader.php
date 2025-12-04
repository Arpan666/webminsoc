<?php

namespace App\Livewire;

use App\Models\Booking;
use Livewire\Component;
use Livewire\WithFileUploads;

class PaymentUploader extends Component
{
    use WithFileUploads;

    public $booking;
    public $paymentProof; // Ganti nama agar sesuai dengan View (sebelumnya proof_image)
    public $uploadSuccess = false; // ✅ Tambahkan ini agar error hilang

    // Validasi
    protected $rules = [
        'paymentProof' => 'required|image|max:2048', // Maksimal 2MB
    ];

    public function mount($bookingId)
    {
        // Kita terima ID saja agar lebih aman
        $this->booking = Booking::findOrFail($bookingId);
    }

    public function save()
    {
        $this->validate();

        // 1. Simpan file
        $path = $this->paymentProof->store('payment_proofs', 'public');

        // 2. Update database
        // PERHATIAN: Pastikan nama kolom di database sesuai (biasanya payment_proof_path)
        $this->booking->update([
            'payment_proof_path' => $path, // ✅ Sesuaikan dengan nama kolom di database kamu
            'status' => 'pending_verification', 
        ]);

        // 3. Ubah status sukses agar muncul notifikasi di layar
        $this->uploadSuccess = true;
        
        // Reset input file
        $this->paymentProof = null;

        // Opsional: Redirect setelah 2 detik atau biarkan user melihat pesan sukses dulu
        session()->flash('message', 'Bukti berhasil diunggah!');
    }

    public function render()
    {
        return view('livewire.payment-uploader');
    }
}