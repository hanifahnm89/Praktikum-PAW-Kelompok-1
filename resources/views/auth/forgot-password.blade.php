@extends('layouts.auth')

@section('content')

<div class="min-h-screen flex items-center justify-center bg-gray-50">

    <div class="bg-white p-10 rounded-3xl shadow-md w-[450px]">

        <h2 class="text-3xl font-bold text-primary mb-2">
            Forgot Password
        </h2>

        <p class="text-gray-400 text-sm mb-8">
            Reset your password
        </p>

        @if(session('error'))
            <div class="mb-4 text-red-500 text-sm">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('forgot.password.post') }}">

            @csrf

            <div class="mb-4">

                <label class="text-sm text-gray-500">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="w-full border rounded-xl px-4 py-3 mt-2"
                    placeholder="Enter your email">

            </div>

            <div class="mb-4">

                <label class="text-sm text-gray-500">
                    New Password
                </label>

                <input
                    type="password"
                    name="new_password"
                    class="w-full border rounded-xl px-4 py-3 mt-2"
                    placeholder="New password">

            </div>

            <div class="mb-6">

                <label class="text-sm text-gray-500">
                    Confirm Password
                </label>

                <input
                    type="password"
                    name="new_password_confirmation"
                    class="w-full border rounded-xl px-4 py-3 mt-2"
                    placeholder="Confirm password">

            </div>

            <button
                type="submit"
                class="w-full bg-primary text-white py-3 rounded-xl font-semibold">

                Reset Password

            </button>

        </form>

    </div>

</div>

@endsection