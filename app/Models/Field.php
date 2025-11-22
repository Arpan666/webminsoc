<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'image_path', // Asumsi ada kolom image untuk lapangan
        // Tambahkan kolom lain jika ada (misalnya: type, capacity)
    ];

    /**
     * Relasi one-to-many ke PriceSetting (Satu Lapangan memiliki banyak pengaturan harga).
     */
    public function priceSettings(): HasMany
    {
        return $this->hasMany(PriceSetting::class);
    }
    
    /**
     * Relasi one-to-many ke Booking (Satu Lapangan memiliki banyak pemesanan).
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}