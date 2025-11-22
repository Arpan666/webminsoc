<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PriceSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'field_id',
        'day_type',
        'price_per_hour',
        'start_time',
        'end_time',
    ];

    public function field(): BelongsTo
    {
        return $this->belongsTo(Field::class);
    }
}
