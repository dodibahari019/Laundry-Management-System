<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userRole = Auth::user()->role;

        // Jika role yang login TIDAK ada di list role yg diizinkan
        if (!in_array($userRole, $roles)) {
            // abort(403, 'Anda tidak punya akses ke halaman ini.');
            return redirect()->back()->with('message', 'Akses ditolak');
        }

        return $next($request);
    }
}
