<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureCustomerAuthenticated
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('pelanggan')->check()) {

            // Kalau request AJAX
            if ($request->expectsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Silakan login terlebih dahulu.'
                ], 401);
            }

            // Kalau request biasa
            return redirect()->back()->with('error', 'Silakan login terlebih dahulu.');
            // ATAU kalau mau ke login page:
            // return redirect()->route('customer.login');
        }

        return $next($request);
    }
}
