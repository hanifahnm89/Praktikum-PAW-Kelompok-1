@extends('layouts.app')

@section('content')
<div class="flex">
    <x-sidebar />
    
    <main class="ml-64 flex-1 p-12 bg-white min-h-screen">
        <div class="mb-10">
            <h2 class="text-4xl font-bold text-primary mb-2">Project Akhir</h2>
            <span class="bg-red-100 text-red-500 px-3 py-1 rounded-md text-[10px] font-bold uppercase">High</span>
        </div>

        <div class="space-y-6 max-w-5xl">
            <x-task.detail-row label="Course" value="Pengembangan Aplikasi Web" />

            <div class="grid grid-cols-2 gap-6">
                <x-task.detail-row label="Deadline" value="24 May" />
                <x-task.detail-row label="Priority" value="High" isTag color="bg-red-100 text-red-500" />
            </div>

            <div class="grid grid-cols-2 gap-6">
                <x-task.detail-row label="Category" value="PAW" />
                <x-task.detail-row label="Status" value="In Progress" isTag color="bg-yellow-50 text-yellow-500" />
            </div>

            <x-task.detail-row label="Description" value="Bikin UIUX" />

            <div class="bg-white border border-gray-100 p-6 rounded-2xl shadow-sm">
                <p class="text-gray-300 text-xs font-bold mb-4 uppercase tracking-wider">Subtask</p>
                <div class="space-y-4">
                    @foreach(['Cari referensi', 'Buat wireframe', 'Submit laporan'] as $sub)
                    <label class="flex items-center gap-3 text-sm text-gray-600 cursor-pointer group">
                        <input type="checkbox" class="w-4 h-4 rounded border-gray-300 accent-primary">
                        <span class="group-hover:text-primary transition">{{ $sub }}</span>
                    </label>
                    @endforeach
                </div>
            </div>

            <x-task.detail-row label="Notes" value="Kerjain duluan" />

            <x-task.detail-row label="URL Link" value=" " class="text-blue-500" />

            <div class="flex justify-end gap-4 mt-12">
                <button class="bg-primary text-white px-10 py-3 rounded-xl font-bold text-xs shadow-lg hover:opacity-90">Edit Task</button>
                <button class="bg-[#6366F1] text-white px-10 py-3 rounded-xl font-bold text-xs shadow-lg hover:opacity-90">Mark Complete</button>
            </div>
        </div>
    </main>
</div>
@endsection