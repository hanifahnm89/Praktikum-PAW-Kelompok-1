@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-white">
    <x-sidebar />

    <main class="ml-64 flex-1 p-12">
        <div class="flex justify-between items-center mb-10">
            <h2 class="text-3xl font-bold text-primary">All Task</h2>
            <button onclick="window.location.href='{{ route('tasks.create') }}'" 
                class="bg-indigo-50 text-primary px-6 py-2 rounded-xl text-xs font-bold hover:bg-indigo-100 transition">
                + New Task
            </button>
        </div>

        <div class="flex justify-between items-end mb-12">
            <div class="relative w-2/3">
                <i class="ph ph-magnifying-glass absolute left-0 top-1 text-gray-300 text-xl"></i>
                <input type="text" placeholder="Search tasks" 
                    class="w-full pl-8 pb-2 border-b border-gray-100 outline-none text-sm italic text-gray-400 bg-transparent">
            </div>

            <div class="relative">
                <select class="appearance-none bg-indigo-50 text-primary text-xs font-bold py-3 px-6 pr-12 rounded-xl outline-none border-none">
                    <option>All Courses</option>
                    <option>Kecerdasan Artifisial</option>
                    <option>PAW</option>
                </select>
                <i class="ph ph-caret-down absolute right-4 top-3.5 text-primary"></i>
            </div>
        </div>

        <table class="w-full text-left">
            <thead>
                <tr class="text-primary text-xs font-bold uppercase tracking-wider border-b border-gray-50">
                    <th class="pb-6 w-10"></th>
                    <th class="pb-6 pl-4">Task Name</th>
                    <th class="pb-6">Course</th>
                    <th class="pb-6">Due</th>
                    <th class="pb-6">Time</th>
                    <th class="pb-6 text-right">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50">
            {{-- Loop data dari controller --}}
            @forelse($tasks as $task)
                <x-task.table-row 
                    :id="$task['id'] ?? uniqid()"
                    :name="$task['name'] ?? 'No Name'" 
                    :course="$task['course'] ?? 'No Course'" 
                    :due="$task['due'] ?? '-'" 
                    :time="$task['time'] ?? '23.59'" 
                    :status="$task['status'] ?? 'Not Started'"
                    :checked="($task['status'] ?? '') === 'Done'"
            @empty
                <tr>
                    <td colspan="6" class="py-10 text-center text-gray-400 text-sm italic">
                        Belum ada tugas yang tercatat.
                    </td>
                </tr>
            @endforelse
        </tbody>
        </table>
    </main>
</div>
@endsection