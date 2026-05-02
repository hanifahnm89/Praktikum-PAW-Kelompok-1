<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SettingsController;


Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', function () {
    if (session()->has('user')) return redirect()->route('dashboard');
    return view('auth.login');
})->name('login');


Route::post('/login', [AuthController::class, 'login'])->name('login.check');

Route::get('/register', function () {
    if (session()->has('user')) return redirect()->route('dashboard');
    return view('auth.register');
})->name('register');


Route::post('/login', [AuthController::class, 'login'])->name('login.check');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');


Route::get('/dashboard', function () {
    if (!session()->has('user')) return redirect()->route('login')->with('error', 'Silakan login dulu!');

    $user = session('user');
    $userName = $user['name'] ?? 'Guest';

    $path = 'tasks.json';
    $tasks = Storage::exists($path) ? json_decode(Storage::get($path), true) : [];
    if (!is_array($tasks)) { $tasks = []; }

    $totalTask = count($tasks);
    $completedCount = count(array_filter($tasks, function ($task) {
        return ($task['status'] ?? '') === 'Done';
    }));

    return view('dashboard', compact('userName', 'tasks', 'totalTask', 'completedCount'));
})->name('dashboard');

Route::get('/calendar', [CalendarController::class, 'index'])->name('calendar');

Route::get('/settings', function() {
    if (!session()->has('user')) return redirect()->route('login');
    return app(SettingsController::class)->index();
})->name('settings');

Route::get('/all-task', [TaskController::class, 'index'])->name('all-task');
Route::post('/all-task', [TaskController::class, 'store'])->name('tasks.store');
Route::post('/tasks/update-status/{id}', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');

Route::get('/tasks/create', function () {
    if (!session()->has('user')) return redirect()->route('login');
    return view('tasks.create');
})->name('tasks.create');

Route::get('/tasks/detail', function () {
    return view('tasks.detail');
})->name('tasks.detail');

// Route Logout
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

