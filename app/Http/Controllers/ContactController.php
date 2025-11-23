<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show the contact us page.
     */
    public function index()
    {
        // Controller ini akan me-return view 'contact'
        return view('contact');
    }
}