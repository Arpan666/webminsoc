<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Filament\Models\Contracts\FilamentUser; 
use Filament\Panel;
use Illuminate\Database\Eloquent\Relations\HasMany; // <-- Tambahkan ini

class User extends Authenticatable implements FilamentUser
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // user / admin
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Akses panel Filament.
     */
    public function canAccessPanel(Panel $panel): bool
    {
        // Panel admin hanya untuk role admin
        if ($panel->getId() === 'admin') {
            return $this->role === 'admin';
        }

        return true;
    }

    /**
     * Relasi one-to-many:
     * Satu User memiliki banyak Booking.
     */
    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
