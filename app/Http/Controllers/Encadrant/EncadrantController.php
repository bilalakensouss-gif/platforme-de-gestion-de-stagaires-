<?php

namespace App\Http\Controllers\Encadrant;

use App\Http\Controllers\Controller;

class EncadrantController extends Controller
{
    public function dashboard()
    {
        return view('encadrant.dashboard');
    }
}