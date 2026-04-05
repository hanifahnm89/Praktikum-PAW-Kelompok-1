<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
})->name('login');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/dashboard', function () {
    return view('dashboard');
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