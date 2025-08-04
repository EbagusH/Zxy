<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureOtpSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan ada session otp_email
        if (!$request->session()->has('otp_email')) {
            return redirect()->route('login')->with('error', 'Sesi login telah berakhir. Silakan login ulang.');
        }

        return $next($request);
    }
}
