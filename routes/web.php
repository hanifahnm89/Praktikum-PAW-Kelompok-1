<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('landing');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

// LOGIN
Route::get('/login', function () {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.check');

// REGISTER
Route::get('/register', function () {
    if (session()->has('user')) {
        return redirect()->route('dashboard');
    }
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.store');

/*
|--------------------------------------------------------------------------
| DASHBOARD
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [TaskController::class, 'dashboard'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| CALENDAR
|--------------------------------------------------------------------------
*/
Route::get('/calendar', [CalendarController::class, 'index'])
    ->name('calendar');

/*
|--------------------------------------------------------------------------
| TASKS
|--------------------------------------------------------------------------
*/

// ALL TASK PAGE
Route::get('/all-task', [TaskController::class, 'index'])
    ->name('all-task');

// CREATE TASK (OPTIONAL PAGE)
Route::get('/tasks/create', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    return view('tasks.create');
})->name('tasks.create');

// STORE TASK (FIXED - ONLY ONE)
Route::post('/tasks', [TaskController::class, 'store'])
    ->name('tasks.store');

// UPDATE STATUS (ONLY ONE VERSION)
Route::post('/tasks/update-status/{id}', [TaskController::class, 'updateStatus'])
    ->name('tasks.updateStatus');

// SEARCH TASK
Route::get('/tasks/search', [TaskController::class, 'search'])
    ->name('tasks.search');

// DETAIL TASK
Route::get('/tasks/detail/{id}', [TaskController::class, 'detail'])
    ->name('tasks.detail');

/*
|--------------------------------------------------------------------------
| SETTINGS
|--------------------------------------------------------------------------
*/
Route::get('/settings', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    return app(SettingsController::class)->index();
})->name('settings');

/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
*/
Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');