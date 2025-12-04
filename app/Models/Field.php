<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Field extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'address',
        'city',
        'image_path',
        // Tambahkan kolom lain jika ada
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

    /**
     * Mendapatkan harga per jam saat ini berdasarkan PriceSetting dan day_type.
     * Jika tidak ada aturan yang cocok, kembalikan null.
     *
     * @param \Carbon\Carbon|null $forDateTime Waktu spesifik untuk mencari harga. Default ke waktu sekarang.
     * @return float|null
     */
    public function getCurrentPricePerHour(Carbon $forDateTime = null): ?float
    {
        $forDateTime = $forDateTime ?: Carbon::now();

        $dayOfWeek = (int) $forDateTime->format('w'); // 0 (Minggu) hingga 6 (Sabtu)
        $time = $forDateTime->format('H:i:s');

        // Tentukan day_type berdasarkan day_of_week
        // Sesuaikan logika ini dengan aturan Anda.
        // Contoh: 1-5 (Senin-Jumat) adalah weekday, 0 dan 6 (Minggu-Sabtu) adalah weekend
        $dayType = match($dayOfWeek) {
            0, 6 => 'weekend', // Minggu dan Sabtu
            1, 2, 3, 4, 5 => 'weekday', // Senin-Jumat
            // Tambahkan case untuk 'holiday' jika Anda menanganinya secara manual
            default => null,
        };

        if ($dayType === null) {
            return null; // Atau kembalikan harga default jika hari tidak valid
        }

        $priceSetting = $this->priceSettings()
            ->where('day_type', $dayType)
            ->where('start_time', '<=', $time)
            ->where('end_time', '>', $time)
            ->first(); // Asumsikan tidak ada kolom is_active, atau semua entri dianggap aktif

        if ($priceSetting) {
            return (float) $priceSetting->price_per_hour;
        }

        // Jika tidak ada aturan khusus ditemukan, kembalikan null
        return null; // Atau kembalikan harga default jika diinginkan
    }

    /**
     * Alias untuk getCurrentPricePerHour agar bisa diakses seperti $field->price_per_hour
     * (hanya jika Anda ingin tetap menggunakan $field->price_per_hour di controller).
     * Gunakan dengan hati-hati dan pastikan logika waktunya jelas.
     * Lebih disarankan menggunakan method getCurrentPricePerHour($bookingTime).
     *
     * @return float|null
     */
    public function getAttribute($key)
    {
        if ($key === 'price_per_hour') {
            return $this->getCurrentPricePerHour();
        }

        return parent::getAttribute($key);
    }
}