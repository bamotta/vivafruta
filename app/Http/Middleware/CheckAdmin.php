<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check()) {
            
            /** @var \App\Models\User $user */
            $user = Auth::user();

            if ($user->role === 'admin') {
                return $next($request);
            }
        }

        // Si llega aquí es porque no es admin
        return redirect('/')->with('error', 'No tienes permisos de administrador.');
    }
}