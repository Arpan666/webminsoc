<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Menampilkan halaman login.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Proses Login.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Validasi kredensial (email & password)
        $request->authenticate();

        // 2. Regenerasi session untuk keamanan
        $request->session()->regenerate();

        $user = Auth::user();

        /**
         * ⭐ FIX REDIRECT LOGIC
         * Kita tidak menggunakan intended() untuk Admin agar tidak terjebak 
         * di halaman client (halaman utama) saat sesi habis.
         */
        if ($user && $user->role === 'admin') {
            // Paksa masuk ke Dashboard Filament
            return redirect('/admin');
        }

        // Untuk Client, tetap gunakan intended agar kembali ke halaman terakhir yang dilihat
        return redirect()->intended('/');
    }

    /**
     * Proses Logout.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}