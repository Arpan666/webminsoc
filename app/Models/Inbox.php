<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    // Pastikan is_read sudah masuk ke fillable
    protected $fillable = ['name', 'email', 'message', 'is_read'];
}