@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <x-sidebar />

    <main class="ml-64 flex-1 p-12">
        <h2 class="text-3xl font-bold text-primary mb-8">Settings</h2>

        <div class="bg-white rounded-[32px] p-10 shadow-sm border border-gray-100">
            <div class="flex gap-10 border-b border-gray-100 mb-10">
                <button class="pb-4 border-b-2 border-primary text-primary font-bold text-sm">Account Setting</button>
                <button class="pb-4 text-gray-400 font-medium text-sm hover:text-gray-600 transition">Login & Security</button>
                <button class="pb-4 text-gray-400 font-medium text-sm hover:text-gray-600 transition">Notifications</button>
            </div>

            <form action="#" method="POST">
                <div class="mb-10">
                    <p class="text-gray-500 text-xs font-bold mb-4">Your Profile Picture</p>
                    <label class="w-28 h-28 border-2 border-dashed border-gray-200 rounded-2xl flex flex-col items-center justify-center cursor-pointer hover:bg-gray-50 transition">
                        <i class="ph ph-image-plus text-3xl text-gray-300 mb-1"></i>
                        <span class="text-[10px] text-gray-300 font-medium text-center px-2">Upload your photo</span>
                        <input type="file" class="hidden">
                    </label>
                </div>

                <div class="grid grid-cols-2 gap-x-8 gap-y-6">
                    <x-common.form-input label="Full name" placeholder="Please enter your full name" />
                    <x-common.form-input label="Username" placeholder="Please enter your username" />
                    
                    <x-common.form-input label="Email" placeholder="Please enter your email" />
                    <x-common.form-input label="Role" placeholder="Please enter your role" />

                    <div class="relative w-full">
                        <label class="absolute -top-2.5 left-4 bg-white px-1.5 text-[11px] text-gray-400 font-medium z-10">Phone number</label>
                        <div class="flex border border-gray-300 rounded-lg overflow-hidden focus-within:border-primary transition">
                            <span class="bg-gray-50 px-4 py-3 text-gray-400 text-sm border-r border-gray-100">+62</span>
                            <input type="text" placeholder="Please enter your phone number" class="w-full px-4 py-3 outline-none text-sm placeholder:text-gray-200">
                        </div>
                    </div>

                    <x-common.form-input label="Country" placeholder="Please enter your country" />
                </div>

                <div class="flex items-center gap-8 mt-12">
                    <button type="submit" class="bg-primary text-white px-10 py-3 rounded-xl font-bold text-sm shadow-lg hover:opacity-90 transition">
                        Update Profile
                    </button>
                    <button type="reset" class="text-gray-400 font-bold text-sm hover:text-gray-600 transition">
                        Reset
                    </button>
                </div>
            </form>
        </div>
    </main>
</div>
@endsection