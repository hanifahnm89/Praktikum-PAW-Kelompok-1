<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Storage;


Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/dashboard', function () {
    $user = session('user');
    $userName = $user['name'] ?? 'Guest';

    $path = 'tasks.json';
    $tasks = Storage::exists($path) ? json_decode(Storage::get($path), true) : [];
    
    if (!is_array($tasks)) { 
        $tasks = []; 
    }

    $totalTask = count($tasks);
    $completedCount = count(array_filter($tasks, fn($t) => ($t['status'] ?? '') === 'Done'));

    return view('dashboard', compact('userName', 'tasks', 'totalTask', 'completedCount'));
})->name('dashboard');

Route::get('/all-task', function () {
    return view('all-task');
})->name('all-task');

Route::get('/tasks/create', function () {
    return view('tasks.create');
})->name('tasks.create');

Route::get('/calender', function () {
    return view('calender');
})->name('calender');

Route::get('/all-task', function () {
    return view('all-task');
})->name('all-task');

Route::get('/tasks/detail', function () {
    return view('tasks.detail');
})->name('tasks.detail');

Route::get('/settings', function () {
    return view('settings');
})->name('settings');

Route::get('/all-task', [TaskController::class, 'index'])->name('all-task');
Route::post('/all-task', [TaskController::class, 'store'])->name('tasks.store');
