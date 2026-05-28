@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-[#1E1E1E] flex items-center justify-center p-6">

    <div class="flex gap-8 items-start">

        <!-- LEFT FORM -->
        <div class="bg-white w-full max-w-7xl rounded-[32px] p-10 shadow-2xl">

            <h2 class="text-3xl font-bold text-primary mb-10">
                Add New Task
            </h2>

            <form action="{{ route('tasks.store') }}" method="POST" class="space-y-5">
                @csrf

                <!-- TASK NAME -->
                <div class="relative">
                    <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                        Task Name *
                    </label>

                    <input
                        type="text"
                        name="task_name"
                        placeholder="Enter your Task Max. 30 Character"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm">
                </div>

                <!-- COURSE -->
                <div class="relative">
                    <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                        Course *
                    </label>

                    <input
                        type="text"
                        name="course"
                        placeholder="Enter Course Name"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm">
                </div>

                <!-- DEADLINE & PRIORITY -->
                <div class="grid grid-cols-2 gap-4">

                    <div class="relative">
                        <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                            Deadline *
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm">
                    </div>

                    <div class="relative">
                        <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                            Priority *
                        </label>

                        <select
                            name="priority"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm bg-white">
                            <option value="">Set Priority</option>
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>
                            <option value="Low">Low</option>
                        </select>
                    </div>

                </div>

                <!-- TIME & STATUS -->
                <div class="grid grid-cols-2 gap-4">

                    <!-- TIME -->
                    <div class="relative">
                        <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                            Time *
                        </label>

                        <input
                            type="time"
                            name="time"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm">
                    </div>

                    <!-- STATUS -->
                    <div class="relative">
                        <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                            Status
                        </label>

                        <select
                            name="status"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm bg-white">
                            <option value="">Set Status</option>
                            <option value="Not Started">Not Started</option>
                            <option value="In Progress">In Progress</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>

                </div>

                <!-- SUB TASK -->
                <div class="relative">
                    <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                        Sub Task
                    </label>

                    <textarea
                        name="sub_task"
                        rows="3"
                        placeholder="Fill the Sub Task"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm resize-none"></textarea>
                </div>

                <!-- DESCRIPTION -->
                <div class="relative">
                    <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="3"
                        placeholder="Fill the description"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm resize-none"></textarea>
                </div>

                <!-- NOTES -->
                <div class="relative">
                    <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                        Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="3"
                        placeholder="Fill the Notes"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm resize-none"></textarea>
                </div>

                <!-- URL -->
                <div class="relative">
                    <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
                        URL Link
                    </label>

                    <input
                        type="text"
                        name="url_link"
                        placeholder="Enter your Link"
                        class="w-full border border-gray-300 rounded-xl px-4 py-3 outline-none text-sm">
                </div>

                <!-- BUTTON -->
                <div class="flex justify-between items-center mt-10">

                    <a href="{{ route('dashboard') }}"
                        class="text-primary font-bold text-sm">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="bg-primary text-white px-10 py-3 rounded-xl font-bold text-sm shadow-lg hover:opacity-90 transition">
                        Add Task
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>
@endsection