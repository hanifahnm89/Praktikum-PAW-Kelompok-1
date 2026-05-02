@extends('layouts.app')

@section('content')
<div class="flex">
    @include('components/sidebar')

    <main class="ml-64 flex-1 p-12 bg-white min-h-screen">
        <div class="mb-10">
            <h2 class="text-4xl font-bold text-primary">Hello, {{ session('user')['first_name'] ?? 'Ifka' }}!</h2>
        </div>

        <div class="grid grid-cols-4 gap-6 mb-12">
            <div class="bg-[#F0F2FF] p-8 rounded-[40px] border border-blue-100 group hover:shadow-lg transition-all">
                <p class="text-indigo-900 font-bold mb-2 uppercase text-xs tracking-widest italic">Total Task</p>
                <h3 class="text-6xl font-bold text-indigo-950">{{ count($tasks ?? []) }}</h3>
            </div>

            <div class="bg-[#EFFFF6] p-8 rounded-[40px] border border-green-100 group hover:shadow-lg transition-all">
                <p class="text-emerald-900 font-bold mb-2 uppercase text-xs tracking-widest italic">Completed</p>
                <h3 class="text-6xl font-bold text-emerald-900">
                    {{ collect($tasks ?? [])->where('status', 'Done')->count() }}
                </h3>
            </div>

            <div class="bg-[#FFF9F0] p-8 rounded-[40px] border border-orange-100 group hover:shadow-lg transition-all">
                <p class="text-orange-400 font-bold mb-2 uppercase text-xs tracking-widest italic">In Progress</p>
                <h3 class="text-6xl font-bold text-orange-400">
                    {{ collect($tasks ?? [])->where('status', '!=', 'Done')->count() }}
                </h3>
            </div>

            <div class="bg-[#FFF0F0] p-8 rounded-[40px] border border-red-100 group hover:shadow-lg transition-all">
                <p class="text-red-400 font-bold mb-2 uppercase text-xs tracking-widest italic">Overdue</p>
                <h3 class="text-6xl font-bold text-red-400">0</h3>
            </div>
        </div>

        <div class="mt-16">
            <div class="flex justify-between items-center mb-8">
                <h3 class="text-2xl font-bold text-gray-800">Upcoming Task</h3>
                <div class="flex gap-3">
                    <button onclick="window.location.href='{{ route('all-task') }}'" class="px-6 py-2 bg-gray-50 rounded-full text-xs font-bold text-gray-400 uppercase tracking-wider hover:bg-gray-100 transition">View All Task</button>
                    <button onclick="window.location.href='/tasks/create'" class="px-8 py-2 bg-primary text-white rounded-full text-xs font-bold uppercase shadow-lg hover:scale-105 transition">
                        + New
                    </button>
                </div>
            </div>

            <div class="relative mb-12">
                <i class="ph ph-magnifying-glass absolute left-0 top-1 text-gray-300 text-xl"></i>
                <input type="text" placeholder="Search tasks" class="w-full pl-8 pb-3 border-b border-gray-100 outline-none text-sm text-gray-500 bg-transparent">
            </div>

            @php
            $activeTasks = collect($tasks ?? [])->where('status', '!=', 'Done');
            @endphp

            @if($activeTasks->count() > 0)
                <div class="bg-white rounded-xl overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <tbody class="divide-y divide-gray-50">
                            @foreach($activeTasks as $task)
                            <x-task.table-row 
                                :id="$task['id'] ?? uniqid()" 
                                :name="$task['name'] ?? 'No Title'" 
                                :course="$task['course'] ?? 'No Course'" 
                                :due="$task['due']" 
                                :time="$task['time'] ?? '23.59'" 
                                :status="$task['status']" 
                            />
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="flex flex-col items-center justify-center py-10">
                    <img src="{{ asset('images/done-task.png') }}" class="w-72 mb-8 drop-shadow-2xl" alt="All Done">
                    <p class="text-gray-400 font-medium text-lg">You have completed all your tasks!</p>
                </div>
            @endif
        </div>
    </main>
</div>
@endsection