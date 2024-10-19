<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckVendedorRole
{
    public function handle($request, Closure $next)
    {
    
        if (Auth::check() && Auth::user()->detUsu->rol === 'Vendedor') {
            return $next($request);
        }

        return redirect('/'); // Redirige al usuario si no es vendedor
    }
}