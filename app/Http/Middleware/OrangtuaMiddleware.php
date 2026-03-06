<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrangtuaMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check() || auth()->user()->role !== 'orangtua') {
            return redirect()->route('web.auth.login')
                ->with('error', 'Silakan login sebagai orang tua untuk mengakses halaman ini.');
        }

        return $next($request);
    }
}
