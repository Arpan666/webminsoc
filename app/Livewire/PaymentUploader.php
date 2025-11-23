<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Booking;
use Livewire\WithFileUploads; // Import trait untuk upload file
use Illuminate\Support\Facades\Storage;

class PaymentUploader extends Component
{
    use WithFileUploads;

    public Booking $booking; // Properti untuk menerima objek Booking
    public $paymentProof;    // Properti untuk menampung file upload
    public $uploadSuccess = false;

    // Aturan Validasi untuk file upload
    protected $rules = [
        'paymentProof' => 'required|image|max:1024', // max 1MB
    ];
    
    // Custom messages untuk validasi
    protected $messages = [
        'paymentProof.required' => 'Bukti pembayaran wajib diunggah.',
        'paymentProof.image' => 'File harus berupa gambar (jpeg, png, bmp, gif, svg, atau webp).',
        'paymentProof.max' => 'Ukuran file bukti pembayaran tidak boleh melebihi 1MB.',
    ];

    public function mount(Booking $booking)
    {
        $this->booking = $booking;
        // Jika booking sudah memiliki bukti bayar, asumsikan upload berhasil
        if ($booking->payment_proof_path) {
            $this->uploadSuccess = true;
        }
    }

    public function submitPayment()
    {
        // 1. Validasi file upload
        $this->validate();

        // 2. Simpan file
        try {
            // Simpan file ke storage 'public' di folder 'payment-proofs'
            $path = $this->paymentProof->store('payment-proofs', 'public');
            
            // 3. Update Model Booking
            $this->booking->update([
                'payment_proof_path' => $path,
                'status' => 'waiting_confirmation', // Update status ke menunggu konfirmasi admin
            ]);
            
            $this->uploadSuccess = true;
            session()->flash('message', 'Bukti pembayaran berhasil diunggah! Mohon tunggu konfirmasi dari Admin.');

        } catch (\Exception $e) {
            // Tangani kegagalan saat menyimpan file
            session()->flash('error', 'Gagal mengunggah bukti pembayaran. Silahkan coba lagi.');
            // Opsional: Log $e->getMessage() untuk debugging
        }
    }

    public function render()
    {
        return view('livewire.payment-uploader');
    }
}