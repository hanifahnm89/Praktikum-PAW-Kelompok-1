@extends('layouts.app')

@section('content')

<div class="flex min-h-screen bg-gray-50">

    @include('components.sidebar')

    <main class="flex-1 ml-[260px] p-8">

        <div class="bg-white rounded-3xl shadow-sm p-8 max-w-3xl">

            {{-- HEADER --}}
            <div class="flex items-start justify-between mb-8">

                <div>
                    <p class="text-sm text-gray-400 mb-2">
                        {{ $task['course'] ?? '-' }}
                    </p>

                    <h1 class="text-3xl font-bold text-[#1f2937]">
                        {{ $task['title'] ?? 'No Title' }}
                    </h1>
                </div>

                <span class="px-4 py-2 rounded-xl text-sm font-bold
                    {{ ($task['status'] ?? '') == 'Done'
                        ? 'bg-green-100 text-green-600'
                        : 'bg-yellow-100 text-yellow-600' }}">

                    {{ $task['status'] ?? 'Not Started' }}

                </span>

            </div>

            {{-- INFO --}}
            <div class="grid md:grid-cols-2 gap-5 mb-8">

                <div class="bg-gray-50 rounded-2xl p-5">
                    <p class="text-xs text-gray-400 mb-1">Deadline</p>
                    <h3 class="font-bold text-lg text-gray-700">
                        {{ $task['date'] ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-2xl p-5">
                    <p class="text-xs text-gray-400 mb-1">Time</p>
                    <h3 class="font-bold text-lg text-gray-700">
                        {{ $task['time'] ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-2xl p-5">
                    <p class="text-xs text-gray-400 mb-1">Priority</p>
                    <h3 class="font-bold text-lg text-gray-700">
                        {{ $task['priority'] ?? '-' }}
                    </h3>
                </div>

                <div class="bg-gray-50 rounded-2xl p-5">
                    <p class="text-xs text-gray-400 mb-1">Status</p>
                    <h3 class="font-bold text-lg text-gray-700">
                        {{ $task['status'] ?? '-' }}
                    </h3>
                </div>

            </div>

            {{-- ACTION --}}
            <div class="flex items-center justify-between">

                <a href="{{ url()->previous() }}"
                    class="text-[#6d3df5] font-bold hover:underline">
                    ← Back
                </a>

                @if(($task['status'] ?? '') !== 'Done')

                    <form action="{{ route('tasks.updateStatus', $task['id']) }}" method="POST">
                        @csrf

                        <button type="submit"
                            class="bg-[#6d3df5] text-white px-6 py-3 rounded-2xl font-bold hover:opacity-90 transition">

                            Mark as Done

                        </button>
                    </form>

                @endif

            </div>

        </div>

    </main>

</div>

@endsection