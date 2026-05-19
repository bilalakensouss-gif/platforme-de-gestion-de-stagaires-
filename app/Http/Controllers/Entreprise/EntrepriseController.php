<?php

namespace App\Http\Controllers\Entreprise;

use App\Http\Controllers\Controller;

class EntrepriseController extends Controller
{
    public function dashboard()
    {
        return view('entreprise.dashboard');
    }
}