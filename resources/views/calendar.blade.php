<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Calendar - Lumina</title>
    @vite('resources/css/app.css')
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
</head>

<body class="bg-[#f7f7fb] font-sans">

@php
    use Carbon\Carbon;

    $date = $date ?? Carbon::now();

    $startOfMonth = $date->copy()->startOfMonth();
    $daysInMonth = $date->daysInMonth;
    $startDay = $startOfMonth->dayOfWeek;
    $totalCells = ceil(($daysInMonth + $startDay) / 7) * 7;
@endphp

@extends('layouts.app')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <x-sidebar />

    <!-- MAIN -->
    <main class="flex-1 px-8 py-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-[38px] font-bold text-[#1f2937]">Calendar</h1>
                <p class="text-sm text-gray-400">Manage your schedule efficiently</p>
            </div>

            <button class="bg-[#6d3df5] text-white px-5 py-3 rounded-2xl text-sm font-medium">
                + Add Task
            </button>
        </div>

        <div class="grid grid-cols-[1fr_320px] gap-6">

            <!-- CALENDAR -->
            <section class="bg-white rounded-[28px] p-6 shadow-sm">

                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-semibold text-[#1f2937]">
                        {{ $date->format('F Y') }}
                    </h2>
                </div>

                <!-- DAYS -->
                <div class="grid grid-cols-7 text-center text-sm text-gray-400 mb-3">
                    <span>Sun</span><span>Mon</span><span>Tue</span>
                    <span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
                </div>

                <!-- CALENDAR GRID -->
                <div class="grid grid-cols-7 gap-3">
                    @for($i = 0; $i < $totalCells; $i++)
                        @php
                            $dayNumber = $i - $startDay + 1;
                            $isCurrentMonth = $dayNumber > 0 && $dayNumber <= $daysInMonth;
                            $fullDate = $isCurrentMonth ? $date->copy()->day($dayNumber)->toDateString() : null;
                            $isToday = $isCurrentMonth && $fullDate == now()->toDateString();
                        @endphp

                        <div class="h-[95px] rounded-2xl p-2
                            {{ $isCurrentMonth ? 'bg-[#fafaff]' : '' }}
                            {{ $isToday ? 'border-2 border-[#6d3df5]' : '' }}">

                            @if($isCurrentMonth)
                                <span class="text-xs font-semibold
                                    {{ $isToday ? 'text-[#6d3df5]' : 'text-[#1f2937]' }}">
                                    {{ $dayNumber }}
                                </span>

                                @if(isset($events[$fullDate]))
                                    @foreach($events[$fullDate] as $event)

                                        <div class="mt-1 text-[10px] p-1 rounded-md
                                            {{ $event->date == now()->toDateString()
                                                ? 'bg-[#ffe5e5] border border-red-400 text-red-600'
                                                : 'bg-[#e7fff0] border border-green-400 text-green-600' }}">

                                            <div class="font-semibold">{{ $event->time }}</div>
                                            <div>{{ $event->title }}</div>
                                            <div class="text-[9px] opacity-70">{{ $event->course }}</div>
                                        </div>

                                    @endforeach
                                @endif
                            @endif
                        </div>
                    @endfor
                </div>

                <!-- TODAY TASK -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Today’s Task</h3>
                    <p class="text-sm text-gray-400 mb-4">
                        {{ now()->format('l, d M Y') }}
                    </p>

                    @foreach($events[now()->toDateString()] ?? [] as $event)
                        <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl mb-3">

                            <div>
                                <p class="text-sm font-semibold text-[#1f2937]">
                                    {{ $event->time }} - {{ $event->title }}
                                </p>
                                <p class="text-xs text-gray-400">{{ $event->course }}</p>
                            </div>

                            <span class="bg-red-100 text-red-500 text-xs px-3 py-1 rounded-xl">
                                Due Today
                            </span>
                        </div>
                    @endforeach
                </div>

            </section>

            <!-- RIGHT PANEL -->
            <aside class="space-y-6">

                <div class="bg-white rounded-[28px] p-6 shadow-sm">
                    <h3 class="text-lg font-semibold mb-4">Upcoming Deadlines</h3>

                    @foreach($events as $dateKey => $dayEvents)
                        @foreach($dayEvents as $event)

                            <div class="mb-4 p-4 rounded-2xl
                                {{ $event->date == now()->toDateString() ? 'bg-[#fff6f6]' : 'bg-[#f7f4ff]' }}">

                                <p class="text-xs text-gray-400">{{ $event->time }}</p>

                                <h4 class="font-semibold mt-1
                                    {{ $event->date == now()->toDateString() ? 'text-[#ff5d73]' : 'text-[#6d3df5]' }}">
                                    {{ $event->title }}
                                </h4>

                                <p class="text-xs text-gray-400">{{ $event->course }}</p>
                            </div>

                        @endforeach
                    @endforeach
                </div>

                <!-- PROGRESS -->
                <div class="bg-[#6d3df5] rounded-[28px] p-6 text-white">
                    <p class="text-sm opacity-80">Today Progress</p>
                    <h2 class="text-4xl font-bold mt-3">75%</h2>

                    <div class="w-full h-3 bg-white/20 rounded-full mt-5">
                        <div class="w-[75%] h-3 bg-white rounded-full"></div>
                    </div>
                </div>

            </aside>

        </div>
    </main>
</div>

</body>
</html>
