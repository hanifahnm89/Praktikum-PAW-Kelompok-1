@extends('layouts.auth')
@section('title', 'Register')
@section('side_image', asset('images/register-gambar.png')) 

@section('form_content')
    <h1 class="text-3xl font-bold text-gray-800 mb-1">Register</h1>
    <p class="text-gray-400 text-xs mb-6">Let's get you all set up so you can access your personal account.</p>

    <x-auth.register-form />

    <p class="text-center mt-4 text-[11px] text-gray-500 font-medium">
        Already have an account? <a href="/" class="text-red-500 font-bold">Login</a>
    </p>
@endsection