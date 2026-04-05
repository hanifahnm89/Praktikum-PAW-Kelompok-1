@extends('layouts.auth')
@section('title', 'Login')
@section('side_image', asset('images/login-gambar.png')) 

@section('form_content')
    <h1 class="text-3xl font-bold text-gray-800 mb-1">Login</h1>
    <p class="text-gray-400 text-xs mb-8">Login to access your travelwise account</p>

    <x-auth.login-form />

    <p class="text-center mt-6 text-[11px] text-gray-500 font-medium">
        Don't have an account? <a href="/register" class="text-red-500 font-bold">Sign up</a>
    </p>
    
@endsection