<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Show the locations page.
     */
    public function index()
    {
        // Controller ini akan me-return view 'location'
        return view('location');
    }
}