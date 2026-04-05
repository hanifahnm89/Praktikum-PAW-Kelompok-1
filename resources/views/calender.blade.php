@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <x-sidebar />

    <main class="ml-64 flex-1 flex">
        <div class="flex-1 p-10 overflow-y-auto">
            <div class="flex items-center gap-4 mb-8">
                <h2 class="text-3xl font-bold text-primary">October 2026</h2>
                <i class="ph ph-caret-down text-primary text-xl mt-1"></i>
            </div>

            <div class="bg-white rounded-[32px] p-6 shadow-sm mb-10 border border-gray-100">
                <img src="{{ asset('images/calender.png') }}" class="w-full">
            </div>

            <div>
                <h3 class="text-2xl font-bold text-gray-800 mb-2">Today’s Task</h3>
                <p class="text-gray-400 font-medium mb-6">Monday, 15 Oct 2026</p>

                <div class="space-y-4">
                    <x-calender.task-item 
                        time="23.59" 
                        title="Laprak KAL" 
                        course="Kecerdasan Artifisial Lanjut" 
                        status="Due Today" />
                    
                    <x-calender.task-item 
                        time="22.00" 
                        title="Project PAW" 
                        course="Pemrograman Aplikasi Web" 
                        status="Due Today" />
                </div>
            </div>
        </div>

        <div class="w-80 bg-white border-l border-gray-100 p-10 shadow-[-10px_0_30px_rgba(0,0,0,0.02)]">
            <div class="flex justify-between items-center mb-10">
                <h3 class="text-xl font-bold text-primary">Upcoming Deadlines</h3>
                <div class="bg-primary p-2 rounded-full text-white">
                    <i class="ph ph-bell-simple text-lg"></i>
                </div>
            </div>

            <p class="text-gray-300 font-bold text-lg mb-8 italic">Today</p>

            <div class="space-y-10">
                <x-calender.deadline-sidebar time="23.59" course="Kecerdasan Artifisial" title="Laprak" />
                <x-calender.deadline-sidebar time="22.00" course="Pengembangan Aplikasi Web" title="Project" />
            </div>
        </div>
    </main>
</div>
@endsection