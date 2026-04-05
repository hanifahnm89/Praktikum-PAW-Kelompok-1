@extends('layouts.app')

@section('content')
<div class="flex bg-gray-900/50 min-h-screen items-center justify-center p-4">
    <div class="bg-white w-full max-w-2xl rounded-[32px] p-10 shadow-2xl">
        <h2 class="text-3xl font-bold text-primary mb-10">Add New Task</h2>

        <form action="{{ route('dashboard') }}" method="GET" class="space-y-5">
            <x-common.form-input label="Task Name *" placeholder="Enter your Task Max. 30 Character" />
            
           <x-common.form-input label="Course *" placeholder="Enter Course Name" />

            <div class="grid grid-cols-2 gap-4">
                <x-common.form-input label="Deadline *" placeholder="Enter Date" />
                <x-common.form-input label="Priority *" placeholder="Set Priority" />
            </div>

            <div class="grid grid-cols-2 gap-4">
                <x-common.form-input label="Category *" placeholder="Enter Category Max. 3 Character" />
                <x-common.form-input label="Status *" placeholder="Set Status" />
            </div>

            <x-common.form-textarea label="Sub Task" placeholder="Fill the Sub Task" />
            <x-common.form-textarea label="Description" placeholder="Fill the description" />
            <x-common.form-textarea label="Notes" placeholder="Fill the Notes" />
            
            <x-common.form-input label="URL Link" placeholder="Enter your Link" />

            <div class="flex justify-between items-center mt-10">
                <a href="{{ route('dashboard') }}" class="text-primary font-bold text-sm">Cancel</a>
                <button type="submit" class="bg-primary text-white px-10 py-3 rounded-xl font-bold text-sm shadow-lg hover:opacity-90 transition">
                    Add Task
                </button>
            </div>
        </form>
    </div>
</div>
@endsection