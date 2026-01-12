<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
   /**
 * Handle an incoming request.
 */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user('pelanggan');

        if (!$user) {
            return redirect('/customer-login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!$user->hasVerifiedEmail()) {
            return redirect('/customer-login')->with('error', 'Email Anda belum diverifikasi. Silakan verifikasi email terlebih dahulu.');
        }

        if (!$user->isActive()) {
            return redirect('/customer-login')->with('error', 'Akun Anda tidak aktif. Silakan hubungi admin.');
        }

        return $next($request);
    }
}
