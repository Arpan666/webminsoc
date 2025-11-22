<?php

namespace App\Http\Controllers;

use App\Models\Field; // Import Model Field
use Illuminate\Http\Request;

class FieldController extends Controller
{
    // Method 'index' yang digunakan untuk halaman utama (route: '/')
    public function index(Request $request)
    {
        // Logika Pencarian dari Tahap 4
        $fields = Field::when($request->search, function ($query, $search) {
            $query->where('name', 'like', "%{$search}%");
        })->get();

        return view('welcome', compact('fields'));
    }
    
    // Method 'show' untuk detail Lapangan (route: /lapangan/{field})
    public function show(Field $field) // Gunakan Route Model Binding
    {
        // Mengirim objek Field ke view detail
        return view('field.show', compact('field'));
    }
}