<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $path = 'users.json';

    private function getUsers() {
        return Storage::exists($this->path) ? json_decode(Storage::get($this->path), true) : [];
    }

    public function register(Request $request) {
        $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email|unique:users,email', // Validasi unik di tabel users
            'password'   => 'required|min:8|confirmed',
        ]);

        // Simpan ke Database menggunakan Eloquent
        \App\Models\User::create([
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'name'       => $request->first_name . ' ' . $request->last_name,
            'email'      => $request->email,
            'password'   => \Hash::make($request->password), // Hashing wajib
        ]);

        return redirect()->route('login')->with('success', 'Berhasil daftar! Silakan login.');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Cari user di database berdasarkan email
        $user = \App\Models\User::where('email', $credentials['email'])->first();

        // Verifikasi password hash
        if ($user && \Hash::check($credentials['password'], $user->password)) {
            // Simpan data user ke session (Manual Auth)
            session(['user' => $user->toArray()]);
            $request->session()->regenerate(); // Regenerasi session untuk keamanan

            return redirect()->route('dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah!'])->withInput();
    }
    public function logout(Request $request) {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        session()->forget('user');

        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}