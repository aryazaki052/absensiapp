<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function prosesLogin(Request $request)
    {
        if (Auth::guard('karyawan')->attempt([
            'nik' => $request->nik,
            'password' => $request->password,
        ])) {
            return redirect()->intended('/dashboard');
        } else {
            return back()->withErrors(['login' => 'NIK atau password salah'])->withInput();
        }
    }

public function prosesLogout(Request $request)
{
    if (Auth::guard('karyawan')->check()) {
        Auth::guard('karyawan')->logout();

        // Invalidate dan regenerate session untuk keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil');
    }
}
}
