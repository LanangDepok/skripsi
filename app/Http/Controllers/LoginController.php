<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        if (Auth::check()) {
            if (Auth::user()->roles->pluck('nama')->contains('Admin')) {
                return redirect()->route('adm.index');
            } else if (Auth::user()->roles->pluck('nama')->contains('Komite')) {
                return redirect()->route('adm.index');
            } else if (Auth::user()->roles->pluck('nama')->contains('Ketua Penguji')) {
                return redirect()->route('dsn.index');
            } else if (Auth::user()->roles->pluck('nama')->contains('Dosen Penguji')) {
                return redirect()->route('dsn.index');
            } else if (Auth::user()->roles->pluck('nama')->contains('Dosen Pembimbing')) {
                return redirect()->route('dsn.index');
            } else if (Auth::user()->roles->pluck('nama')->contains('Mahasiswa')) {
                return redirect()->route('mhs.index');
            }
        } else {
            return view('login');
        }
    }

    public function authenticate(Request $request): RedirectResponse
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->roles->pluck('nama')->contains('Admin')) {
                return redirect()->intended(route('adm.index'));
            } else if (Auth::user()->roles->pluck('nama')->contains('Komite')) {
                return redirect()->intended(route('adm.index'));
            } else if (Auth::user()->roles->pluck('nama')->contains('Ketua Penguji')) {
                return redirect()->intended(route('dsn.index'));
            } else if (Auth::user()->roles->pluck('nama')->contains('Dosen Penguji')) {
                return redirect()->intended(route('dsn.index'));
            } else if (Auth::user()->roles->pluck('nama')->contains('Dosen Pembimbing')) {
                return redirect()->intended(route('dsn.index'));
            } else if (Auth::user()->roles->pluck('nama')->contains('Mahasiswa')) {
                return redirect()->intended(route('mhs.index'));
            }
        }

        return back()->with('error', 'Email atau Password tidak sesuai.');
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
