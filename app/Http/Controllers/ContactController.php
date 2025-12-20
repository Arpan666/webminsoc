<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inbox; // Gunakan model Inbox

class ContactController extends Controller
{
    public function index() {
        return view('contact');
    }

    public function sendMessage(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        // SIMPAN KE TABEL INBOXES
        Inbox::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pesan berhasil disimpan!'
        ]);
    }
}