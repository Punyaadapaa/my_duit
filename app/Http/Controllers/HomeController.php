<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Tampilkan landing page MyDuit.
     */
    public function index()
    {
        return view('landing');
    }
}
