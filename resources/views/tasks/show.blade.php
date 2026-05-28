@extends('layouts.app')

@section('content')

<div class="p-10">

    <h1 class="text-3xl font-bold mb-6">
        {{ $task['title'] }}
    </h1>

    <div class="space-y-4 text-lg">

        <p>
            <b>Course:</b>
            {{ $task['course'] }}
        </p>

        <p>
            <b>Time:</b>
            {{ $task['time'] }}
        </p>

        <p>
            <b>Date:</b>
            {{ $task['date'] }}
        </p>

    </div>

</div>

@endsection