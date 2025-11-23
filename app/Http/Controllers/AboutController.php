<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Show the about us page.
     */
    public function index()
    {
        // Controller ini akan me-return view 'about'
        return view('about');
    }
}