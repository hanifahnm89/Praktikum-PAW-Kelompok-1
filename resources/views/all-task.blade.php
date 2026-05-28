@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-white">

    <x-sidebar />

    <main class="ml-64 flex-1 p-12">

        <div class="flex justify-between items-center mb-10">

            <h2 class="text-3xl font-bold text-primary">
                All Task
            </h2>

            <button
                onclick="window.location.href='{{ route('tasks.create') }}';"
                class="bg-indigo-50 text-primary px-6 py-2 rounded-xl text-xs font-bold">

                + New Task

            </button>

        </div>

        <div class="flex justify-between items-end mb-12">

            <div class="relative w-2/3">

                <i class="ph ph-magnifying-glass absolute left-0 top-1 text-gray-300 text-xl"></i>

                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search tasks by name..."

                    class="w-full pl-8 pb-2 border-b border-gray-100 outline-none text-sm text-gray-400 bg-transparent">

            </div>

        </div>

        <table class="w-full text-left" id="taskTable">

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

            <tbody
                id="taskBody"
                class="divide-y divide-gray-50">

                @foreach($tasks as $task)

                <tr>

                    <x-task.table-row

                        :id="$task->id"
                        :task_name="$task->task_name"
                        :course="$task->course"
                        :due="$task->due_date"
                        :time="$task->time ?? '23:59'"
                        :status="$task->status"

                    />

                </tr>

                @endforeach

            </tbody>

        </table>

    </main>

</div>
<script>
document.getElementById('searchInput')
.addEventListener('keyup', async function () {

    let keyword = this.value;

    let response = await fetch(
        `/tasks/search?search=${keyword}`
    );

    let tasks = await response.json();

    let tbody = document.getElementById(
        'taskBody'
    );

    tbody.innerHTML = '';

    tasks.forEach(task => {

        let badgeClass = '';

        if (task.status == 'Done') {

            badgeClass =
                'bg-green-100 text-green-500';

        }

        else if (
            task.status ==
            'Not Started'
        ) {

            badgeClass =
                'bg-red-100 text-red-400';

        }

        else {

            badgeClass =
                'bg-yellow-50 text-yellow-500';

        }

        tbody.innerHTML += `

            <tr class="
                border-b
                border-gray-50
                group
                hover:bg-gray-50/50
                transition">

                <td class="py-6">

                    <input
                        type="checkbox"

                        ${task.status === 'Done'
                            ? 'checked'
                            : ''}

                        class="
                            w-4
                            h-4
                            accent-primary
                            rounded">

                </td>

                <td class="py-6 pl-4">

                    <a href="/tasks/detail/${task.id}"

                        class="
                        text-sm
                        font-medium
                        text-gray-700
                        hover:text-primary
                        hover:underline">

                        ${task.task_name}

                    </a>

                </td>

                <td class="
                    py-6
                    text-sm
                    text-gray-500">

                    ${task.course}

                </td>

                <td class="
                    py-6
                    text-sm
                    text-gray-500">

                    ${task.due_date}

                </td>

                <td class="
                    py-6
                    text-sm
                    text-gray-500">

                    ${task.time ?? '23:59'}

                </td>

                <td class="
                    py-6
                    text-right">

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
@endsection