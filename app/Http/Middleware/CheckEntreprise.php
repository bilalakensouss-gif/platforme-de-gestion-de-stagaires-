<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckEntreprise
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth('entreprise')->check()) {
            return redirect()->route('entreprise.login');
        }

        return $next($request);
    }
}