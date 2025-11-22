<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads; // <-- PENTING: Untuk menangani upload file
use App\Models\Booking; // <-- Import Model Booking
use Illuminate\Support\Facades\Storage; // <-- Import Storage

class PaymentUploader extends Component
{
    use WithFileUploads;

    public Booking $booking; // Properti untuk menerima objek Booking
    public $paymentProof; // Properti untuk menampung file yang diupload

    public function rules()
    {
        return [
            'paymentProof' => 'required|image|max:1024', // Wajib, berupa gambar, maks 1MB
        ];
    }
    
    // Method untuk menyimpan file dan update status booking
    public function uploadProof()
    {
        $this->validate();

        // 1. Simpan Bukti Pembayaran ke Storage
        // File akan disimpan di storage/app/public/payment-proofs
        $filePath = $this->paymentProof->store('payment-proofs', 'public');
        
        // 2. Update Booking
        $this->booking->update([
            'payment_method' => 'Bank Transfer', // Bisa disesuaikan
            'payment_proof_path' => $filePath, // Simpan path file
            'status' => 'pending_verification', // Konfirmasi lagi statusnya
        ]);

        // 3. Notifikasi dan Redirect
        session()->flash('success', 'Bukti pembayaran berhasil diunggah! Pesanan Anda akan segera diverifikasi oleh Admin.');
        
        // Redirect ke halaman ringkasan atau riwayat pemesanan (jika ada, jika tidak, ke root)
        return redirect('/'); 
    }

    public function render()
    {
        return view('livewire.payment-uploader');
    }
}