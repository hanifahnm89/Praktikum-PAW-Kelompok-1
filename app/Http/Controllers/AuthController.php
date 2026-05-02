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
            'email'      => 'required|email',
            'password'   => 'required|min:8|confirmed',
        ]);

        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user['email'] === $request->email) {
                return back()->withErrors(['email' => 'Email sudah terdaftar!'])->withInput();
            }
        }

        $fullName = $request->first_name . ' ' . $request->last_name;

        $newUser = [
            'id'         => uniqid(),
            'name'       => $fullName,
            'first_name' => $request->first_name,
            'last_name'  => $request->last_name,
            'email'      => $request->email,
            'password'   => Hash::make($request->password),
        ];

        $users[] = $newUser;
        Storage::put($this->path, json_encode($users, JSON_PRETTY_PRINT));

        return redirect()->route('login')->with('success', 'Berhasil daftar! Silakan login.');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user['email'] === $credentials['email'] && Hash::check($credentials['password'], $user['password'])) {
                
                session(['user' => $user]);

                $request->session()->regenerate();

                return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user['name']);
            }
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