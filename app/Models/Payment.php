<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'field_id',
        'start_time',
        'end_time',
        'total_price',
        'payment_method',
        'payment_proof_path', // Kolom untuk bukti pembayaran
        'status', // Contoh: 'pending_verification', 'confirmed'
        'admin_notes',
    ];
    
    // Pastikan kolom waktu diproses sebagai objek Carbon
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    /**
     * Relasi many-to-one ke User (Customer).
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi many-to-one ke Field.
     */
    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}