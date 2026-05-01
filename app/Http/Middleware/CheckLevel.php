<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
   public function handle(Request $request, Closure $next, string $role): Response
    {
        if (Auth::check() && Auth::user()->level === $role) {
            return $next($request);
        }

        if (Auth::check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        abort(403, 'Anda tidak memiliki akses ke halaman ini. Sesi login Anda telah dihentikan.');
    }
}
