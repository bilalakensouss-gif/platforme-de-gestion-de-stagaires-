<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EntrepriseLoginController extends Controller
{
    // Afficher formulaire login entreprise
    public function showLoginForm()
    {
        return view('auth.login-entreprise');
    }

    // Traiter le login entreprise
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $credentials = [
            'email_contact' => $request->email,
            'password'      => $request->password,
        ];

        if (Auth::guard('entreprise')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->route('entreprise.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email ou mot de passe incorrect.',
        ])->onlyInput('email');
    }

    // Logout entreprise
    public function logout(Request $request)
    {
        Auth::guard('entreprise')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('entreprise.login');
    }
}