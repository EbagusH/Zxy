<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Show the login form.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Simpan cookie email jika remember dicentang (30 hari)
            if ($request->has('remember')) {
                cookie()->queue('remembered_email', $request->email, 60 * 24 * 30); // 30 hari
            } else {
                cookie()->queue(cookie()->forget('remembered_email'));
            }

            // Selalu arahkan ke dashboard setelah login berhasil
            return redirect('/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }

    /**
     * Handle logout request.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Arahkan ke halaman home setelah logout
        return redirect('auth/login');
    }
}
