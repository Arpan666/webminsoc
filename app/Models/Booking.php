<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'status',
        'admin_notes',     // <-- WAJIB
        'payment_proof_path',
    ];


    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Field
    public function field()
    {
        return $this->belongsTo(Field::class);
    }
}
