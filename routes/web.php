<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;


Route::get('/', [LandingController::class, 'index'])->name('landing');

Route::get('/login', function () {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.check');

Route::get('/register', function () {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/dashboard', [TaskController::class, 'dashboard'])
    ->name('dashboard');

Route::get('/calendar', [CalendarController::class, 'index'])
    ->name('calendar');

Route::get('/all-task', [TaskController::class, 'index'])
    ->name('all-task');

Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

Route::post('/tasks/update-status/{id}', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');

Route::get('/tasks/search', [TaskController::class, 'search'])
    ->name('tasks.search');

Route::get('/tasks/detail/{id}', [TaskController::class, 'detail'])
    ->name('tasks.detail');

Route::get('/settings', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    return app(SettingsController::class)->index();
})->name('settings');

Route::post('/settings/update', [SettingsController::class, 'update'])
    ->name('settings.update');

Route::post('/password/update', [SettingsController::class, 'updatePassword'])
    ->name('password.update');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('forgot.password');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('forgot.password.post');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');