<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
        }

        if (auth()->user()->role !== 'user') {
            abort(403, 'Anda tidak memiliki akses ke halaman user. Hanya user biasa yang dapat mengakses.');
        }

        return $next($request);
    }
}
