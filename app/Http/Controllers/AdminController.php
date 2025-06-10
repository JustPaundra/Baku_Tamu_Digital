<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('login');
    }

    // Proses login admin
    public function login(Request $request)
    {
        if ($request->password === 'admin') { // Gantilah dengan autentikasi database jika perlu
            Session::put('is_admin', true);
            return redirect()->route('admin.dashboard');
        }
        return back()->with('error', 'Password salah');
    }

    // Menampilkan dashboard admin
    public function dashboard()
    {
        if (!Session::get('is_admin')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }
        return view('admin');
    }

    // Proses logout admin
    public function logout()
    {
        Session::forget('is_admin');
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }
}
