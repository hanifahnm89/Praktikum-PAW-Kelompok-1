@extends('layouts.app')

@section('content')
<div class="flex">
    @include('components/sidebar')

    <main class="ml-64 flex-1 p-12 bg-white min-h-screen">
        <div class="mb-10">
            <h2 class="text-4xl font-bold text-primary">Hello, {{ session('user')['first_name'] ?? 'Guest' }}!</h2>
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
                    <button onclick="window.location.href='{{ route('all-task') }}'" class="px-6 py-2 bg-white rounded-full text-xs font-bold text-gray-400 uppercase tracking-wider hover:bg-gray-100 transition">View All Task</button>
                    <button onclick="openModal()" class="bg-primary text-white px-4 py-2 rounded-xl">
    + New Task
</button>
                </div>
            </div>

            @php
            $activeTasks = collect($tasks ?? [])->where('status', '!=', 'Done');
            @endphp


            <div class="relative mb-12">
                <i class="ph ph-magnifying-glass absolute left-0 top-1 text-gray-300 text-xl"></i>

                <input
                    type="text"
                    id="dashboardSearch"
                    placeholder="Search tasks"
                    class="w-full pl-8 pb-3 border-b border-gray-100 outline-none text-sm text-gray-500 bg-transparent">
            </div>

            @if($activeTasks->count() > 0)

            <div class="bg-white rounded-xl overflow-hidden">
                <table class="w-full text-left border-collapse">

                    <tbody id="dashboardTaskBody" class="divide-y divide-gray-50">

                        @foreach($activeTasks as $task)
                        <tr class="task-row">

                            <x-task.table-row
                                :id="$task->id"
                                :task_name="$task->task_name"
                                :course="$task->course"
                                :due="$task->due_date"
                                :time="$task->time ?? '23:59'"
                                :status="$task->status" />

                        </tr>
                        @endforeach

                    </tbody>

                </table>
            </div>

            @else

            <div class="flex flex-col items-center justify-center py-20 bg-white rounded-[40px]">

                <img
                    src="{{ asset('images/done-task.png') }}"
                    class="w-64 mb-8 opacity-60">

                <p class="text-gray-400 font-medium text-lg">
                    Hooray! You don't have any assignments yet
                </p>

            </div>

            @endif

            <script>
                document.getElementById('dashboardSearch')
                    .addEventListener('keyup', async function() {

                        let keyword = this.value;

                        let response = await fetch(
                            `/tasks/search?search=${keyword}`
                        );

                        let tasks = await response.json();

                        let body = document.getElementById(
                            'dashboardTaskBody'
                        );

                        body.innerHTML = '';

                        tasks.forEach(task => {

                            if (task.status === 'Done') return;

                            let badgeClass = '';

                            if (task.status === 'Not Started') {

                                badgeClass =
                                    'bg-red-100 text-red-400';

                            } else {

                                badgeClass =
                                    'bg-yellow-50 text-yellow-500';

                            }

                            body.innerHTML += `

                <tr class="border-b border-gray-50 group hover:bg-gray-50/50 transition">

                    <td class="py-6">

                        <input
                            type="checkbox"
                            ${task.status === 'Done' ? 'checked' : ''}

                            class="
                            w-4
                            h-4
                            accent-primary
                            rounded">

                    </td>

                    <td class="py-6 pl-4">

                        <a
                            href="/tasks/detail/${task.id}"

                            class="
                            text-sm
                            font-medium
                            text-gray-700
                            hover:text-primary
                            hover:underline">

                            ${task.task_name}

                        </a>

                    </td>

                    <td class="py-6 text-sm text-gray-500">
                        ${task.course}
                    </td>

                    <td class="py-6 text-sm text-gray-500">
                        ${task.due_date}
                    </td>

                    <td class="py-6 text-sm text-gray-500">
                        ${task.time ?? '23:59'}
                    </td>

                    <td class="py-6 text-right">

                        <span class="
                            ${badgeClass}
                            px-4
                            py-1.5
                            rounded-lg
                            text-[10px]
                            font-bold">

                            ${task.status}

                        </span>

                    </td>

                </tr>

                `;

                        });

                    });
            </script>
            <script>
    function openModal() {
        document.getElementById('taskModal').classList.remove('hidden');
        document.getElementById('taskModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('taskModal').classList.add('hidden');
        document.getElementById('taskModal').classList.remove('flex');
    }
</script>
        </div>
    </main>
</div>
<!-- MODAL OVERLAY -->
<div id="taskModal" class="fixed inset-0 hidden items-center justify-center bg-black/60 z-50">

    <div class="bg-white w-full max-w-3xl rounded-[32px] p-10 shadow-2xl relative">

        <!-- CLOSE -->
        <button onclick="closeModal()" class="absolute top-5 right-6 text-gray-500 text-xl">
            ✕
        </button>

        <h2 class="text-5xl font-bold text-primary mb-8">
            Add New Task
        </h2>

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-5">
            @csrf

            <input type="text" name="task_name" placeholder="Task Name"
                class="w-full border rounded-xl px-4 py-3 text-sm">

            <div class="grid grid-cols-2 gap-4">
                <input type="date" name="due_date"
                    class="border rounded-xl px-4 py-3 text-sm">

                <select name="priority" class="border rounded-xl px-4 py-3 text-sm">
                    <option value="">Priority</option>
                    <option>High</option>
                    <option>Medium</option>
                    <option>Low</option>
                </select>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <input type="time" name="time"
                    class="border rounded-xl px-4 py-3 text-sm">

                <select name="status" class="border rounded-xl px-4 py-3 text-sm">
                    <option value="">Status</option>
                    <option>Not Started</option>
                    <option>In Progress</option>
                    <option>Done</option>
                </select>
            </div>

            <textarea name="description" placeholder="Description"
                class="w-full border rounded-xl px-4 py-7 text-sm"></textarea>

            <textarea name="notes" placeholder="Notes"
                class="w-full border rounded-xl px-4 py-3 text-sm"></textarea>

            <textarea name="URL Link" placeholder="URL Link"
                class="w-full border rounded-xl px-4 py-2 text-sm"></textarea>

            <div class="flex justify-end gap-4 pt-5">

                <button type="button" onclick="closeModal()"
                    class="text-gray-500 font-bold">
                    Cancel
                </button>

                <button type="submit"
                    class="bg-primary text-white px-8 py-3 rounded-xl font-bold">
                    Add Task
                </button>

            </div>

        </form>
    </div>
</div>
@endsection