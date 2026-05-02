@extends('layouts.auth')
@section('title', 'Register')
@section('side_image', asset('images/register-gambar.png')) 

@section('form_content')
    <h1 class="text-3xl font-bold text-gray-800 mb-1">Register</h1>
    <p class="text-gray-400 text-xs mb-6">Let's get you all set up so you can access your personal account.</p>

    @if($errors->any())
        <div class="bg-red-50 text-red-600 p-3 rounded-xl mb-4 text-[11px] font-medium border border-red-100">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session('success'))
        <div class="bg-green-50 text-green-600 p-3 rounded-xl mb-4 text-[11px] font-medium border border-green-100">
            {{ session('success') }}
        </div>
    @endif

    <x-auth.register-form />

    <p class="text-center mt-4 text-[11px] text-gray-500 font-medium">
        Already have an account? <a href="/login" class="text-red-500 font-bold">Login</a>
    </p>
@endsection