@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    @include('components/sidebar')

    <main class="flex-1 relative">

        {{-- MODAL OVERLAY --}}
        <div class="fixed inset-0 bg-black/30 z-40 flex items-center justify-center p-4">
            <div class="bg-white w-full max-w-lg rounded-[24px] p-8 shadow-2xl z-50 max-h-[90vh] overflow-y-auto">

                <div class="space-y-4">
                    @csrf

                    {{-- Task Name --}}
                    <div class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 focus-within:border-[#6d3df5] transition">
                        <label class="block text-[10px] text-gray-400 mb-1">Task Name *</label>
                        <input
                            name="task_name"
                            type="text"
                            maxlength="30"
                            placeholder="Enter your Task Max. 30 Character"
                            class="w-full text-sm text-gray-700 outline-none placeholder-gray-300"
                            required
                        >
                    </div>

                    {{-- Deadline + Priority --}}
                    <div class="grid grid-cols-2 gap-3">

                        {{-- Deadline: native date picker --}}
                        <div class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 focus-within:border-[#6d3df5] transition">
                            <label class="block text-[10px] text-gray-400 mb-1">Deadline *</label>
                            <input
                                name="deadline"
                                type="date"
                                class="w-full text-sm text-gray-600 outline-none bg-transparent cursor-pointer"
                                required
                            >
                        </div>

                        {{-- Priority: custom dropdown --}}
                        <div class="relative" x-data="{ open: false, selected: '' }">
                            <div
                                @click="open = !open"
                                class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 cursor-pointer flex items-center justify-between"
                                :class="open ? 'border-[#6d3df5]' : ''"
                            >
                                <div>
                                    <p class="text-[10px] text-gray-400 mb-1">Priority *</p>
                                    <p class="text-sm" :class="selected ? 'text-gray-700' : 'text-gray-300'">
                                        <span x-text="selected || 'Set Priority'"></span>
                                    </p>
                                </div>
                                <i class="ph ph-caret-down text-gray-400 text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </div>
                            <input type="hidden" name="priority" :value="selected" required>
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden">
                                @foreach(['Low', 'Medium', 'High'] as $p)
                                    <div
                                        @click="selected = '{{ $p }}'; open = false"
                                        class="px-4 py-2.5 text-sm text-gray-700 hover:bg-[#f3eeff] hover:text-[#6d3df5] cursor-pointer transition"
                                    >{{ $p }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Time + Status --}}
                    <div class="grid grid-cols-2 gap-3">

                        {{-- Time: native time picker --}}
                        <div class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 focus-within:border-[#6d3df5] transition">
                            <label class="block text-[10px] text-gray-400 mb-1">Time *</label>
                            <input
                                name="time"
                                type="time"
                                class="w-full text-sm text-gray-600 outline-none bg-transparent cursor-pointer"
                                required
                            >
                        </div>

                        {{-- Status: custom dropdown --}}
                        <div class="relative" x-data="{ open: false, selected: '' }">
                            <div
                                @click="open = !open"
                                class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 cursor-pointer flex items-center justify-between"
                                :class="open ? 'border-[#6d3df5]' : ''"
                            >
                                <div>
                                    <p class="text-[10px] text-gray-400 mb-1">Status *</p>
                                    <p class="text-sm" :class="selected ? 'text-gray-700' : 'text-gray-300'">
                                        <span x-text="selected || 'Set Status'"></span>
                                    </p>
                                </div>
                                <i class="ph ph-caret-down text-gray-400 text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
                            </div>
                            <input type="hidden" name="status" :value="selected" required>
                            <div x-show="open" @click.outside="open = false" x-transition
                                class="absolute top-full left-0 right-0 mt-1 bg-white border border-gray-200 rounded-xl shadow-lg z-50 overflow-hidden">
                                @foreach(['Not Started', 'In Progress', 'Done'] as $s)
                                    <div
                                        @click="selected = '{{ $s }}'; open = false"
                                        class="px-4 py-2.5 text-sm text-gray-700 hover:bg-[#f3eeff] hover:text-[#6d3df5] cursor-pointer transition"
                                    >{{ $s }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Sub Task --}}
                    <div class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 focus-within:border-[#6d3df5] transition">
                        <label class="block text-[10px] text-gray-400 mb-1">Sub Task</label>
                        <textarea
                            name="sub_task"
                            rows="3"
                            placeholder="Fill the Sub Task"
                            class="w-full text-sm text-gray-700 outline-none resize-none placeholder-gray-300"
                        ></textarea>
                    </div>

                    {{-- Description --}}
                    <div class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 focus-within:border-[#6d3df5] transition">
                        <label class="block text-[10px] text-gray-400 mb-1">Description</label>
                        <textarea
                            name="description"
                            rows="3"
                            placeholder="Fill the description"
                            class="w-full text-sm text-gray-700 outline-none resize-none placeholder-gray-300"
                        ></textarea>
                    </div>

                    {{-- Notes --}}
                    <div class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 focus-within:border-[#6d3df5] transition">
                        <label class="block text-[10px] text-gray-400 mb-1">Notes</label>
                        <input
                            name="notes"
                            type="text"
                            placeholder="Fill the Notes"
                            class="w-full text-sm text-gray-700 outline-none placeholder-gray-300"
                        >
                    </div>

                    {{-- URL Link --}}
                    <div class="border border-gray-200 rounded-xl px-4 pt-2 pb-3 focus-within:border-[#6d3df5] transition">
                        <label class="block text-[10px] text-gray-400 mb-1">URL Link</label>
                        <input
                            name="url_link"
                            type="url"
                            placeholder="Enter your Link"
                            class="w-full text-sm text-gray-700 outline-none placeholder-gray-300"
                        >
                    </div>

{{-- Actions --}}
<div class="flex items-center justify-between pt-2">

    {{-- BACK --}}
    <a href="{{ url()->previous() }}"
       class="text-[#6d3df5] font-bold text-sm hover:opacity-75 transition">
        Back
    </a>

    {{-- DONE BUTTON --}}
    <form action="{{ route('tasks.updateStatus', $task['id']) }}" method="POST">
        @csrf

        <button type="submit"
            class="bg-[#6d3df5] text-white px-10 py-3 rounded-xl font-bold text-sm shadow-lg hover:opacity-90 transition">
            Mark as Done
        </button>
    </form>

</div>

</div>
            </div>
        </div>

    </main>
</div>

{{-- Alpine.js untuk dropdown --}}
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection