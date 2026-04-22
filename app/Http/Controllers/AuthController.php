<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $path = 'users.json';

    private function getUsers() {
        return Storage::exists($this->path) ? json_decode(Storage::get($this->path), true) : [];
    }

    public function register(Request $request) {
        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user['email'] === $request->email) {
                return back()->with('error', 'Email sudah terdaftar!');
            }
        }

        $newUser = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
        ];

        $users[] = $newUser;
        Storage::put($this->path, json_encode($users, JSON_PRETTY_PRINT));

        return redirect()->route('login')->with('success', 'Berhasil daftar! Silakan login.');
    }

    public function login(Request $request) {
        $users = $this->getUsers();

        foreach ($users as $user) {
            if ($user['email'] === $request->email && Hash::check($request->password, $user['password'])) {

                session(['user' => $user]);
                return redirect()->route('dashboard');
            }
        }

        return back()->with('error', 'Email atau password salah!');
    }

    public function logout() {
        session()->forget('user');
        return redirect()->route('login');
    }
}