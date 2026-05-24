@props(['id', 'task_name', 'course', 'due', 'time', 'status', 'checked' => false])

@php
    $statusClasses = [
        'Not Started' => 'bg-red-100 text-red-400',
        'In Progress' => 'bg-yellow-50 text-yellow-500',
        'Done' => 'bg-green-100 text-green-500'
    ];
@endphp

<tr class="border-b border-gray-50 group hover:bg-gray-50/50 transition">
    <td class="py-6">
        <form action="{{ route('tasks.updateStatus', $id) }}" method="POST">
            @csrf
            <input type="checkbox" 
                {{ $status === 'Done' ? 'checked disabled' : '' }} 
                onchange="this.form.submit()" 
                class="w-4 h-4 accent-primary rounded border-gray-300 cursor-pointer">
        </form>
        </td>
    <td class="py-6 pl-4">
<<<<<<< HEAD
        <a href="{{ route('tasks.detail', $id) }}" class="text-sm font-medium text-gray-700 hover:text-primary hover:underline transition">
            {{ $task_name }}
        </a>
=======
        <a href="{{ route('tasks.detail', ['id' => $id]) }}"
   class="text-sm font-medium text-gray-700 hover:text-primary hover:underline transition">
    {{ $name }}
</a>
>>>>>>> e36a333b9ecb01483c870dce597133429f1d57df
    </td>
    <td class="py-6 text-sm text-gray-500">{{ $course }}</td>
    <td class="py-6 text-sm text-gray-500">{{ $due }}</td>
    <td class="py-6 text-sm text-gray-500">{{ $time }}</td>
    <td class="py-6 text-right">
        <span class="{{ $statusClasses[$status] ?? 'bg-gray-100' }} px-4 py-1.5 rounded-lg text-[10px] font-bold">
            {{ $status }}
        </span>
    </td>
</tr>