{{-- resources/views/calendar.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="flex">

    @include('components.sidebar')

    {{-- MAIN --}}
    <main class="flex-1 ml-[260px] p-8 overflow-y-auto">

        {{-- HEADER --}}
        <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
            <div class="flex items-center gap-3">
                <h1 class="text-[38px] font-bold text-[#6d3df5]">
                    {{ $date->format('F Y') }}
                </h1>

                {{-- DROPDOWN BULAN --}}
                <form method="GET">
                    <select
                        name="month"
                        onchange="this.form.submit()"
                        class="border-none bg-transparent text-[#6d3df5] font-bold text-lg focus:ring-0 cursor-pointer">
                        @for($m = 1; $m <= 12; $m++)
                            <option
                                value="{{ $date->year . '-' . str_pad($m, 2, '0', STR_PAD_LEFT) }}"
                                {{ $date->month == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endfor
                    </select>
                </form>
            </div>
        </div>

        <div class="grid xl:grid-cols-[1fr_320px] gap-6">

            {{-- CALENDAR --}}
            <section class="bg-white rounded-[28px] p-6 shadow-sm overflow-hidden">

                {{-- TOOLBAR --}}
                <div class="flex flex-wrap gap-4 items-center justify-between mb-6">

                    <a href="{{ route('calendar') }}"
                        class="px-5 py-2 rounded-full border border-gray-200 text-sm font-semibold text-gray-500 hover:bg-gray-50 transition">
                        Today
                    </a>

                    <div class="flex items-center gap-4">
                        <a href="{{ route('calendar', ['month' => $date->copy()->subMonth()->format('Y-m')]) }}"
                            class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition">
                            <i class="ph ph-caret-left"></i>
                        </a>
                        <span class="font-bold text-gray-700">{{ $date->format('F Y') }}</span>
                        <a href="{{ route('calendar', ['month' => $date->copy()->addMonth()->format('Y-m')]) }}"
                            class="w-10 h-10 rounded-full border border-gray-200 flex items-center justify-center hover:bg-gray-50 transition">
                            <i class="ph ph-caret-right"></i>
                        </a>
                    </div>

                    <div class="flex bg-[#f5f3ff] rounded-full p-1">
                        @foreach(['Year','Week','Month','Day'] as $view)
                            <button type="button"
                                class="px-4 py-2 rounded-full text-xs font-semibold transition-all duration-300
                                    {{ $view === 'Month' ? 'bg-[#6d3df5] text-white shadow-sm' : 'text-gray-500 hover:text-[#6d3df5]' }}">
                                {{ $view }}
                            </button>
                        @endforeach
                    </div>

                </div>

                {{-- HEADER HARI --}}
                <div class="grid grid-cols-7 border border-gray-100 border-b-0 rounded-t-2xl overflow-hidden">
                    @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                        <div class="bg-[#faf8ff] py-4 text-center text-xs font-bold text-[#6d3df5] border-r border-gray-100 last:border-r-0">
                            {{ $day }}
                        </div>
                    @endforeach
                </div>

                {{-- GRID KALENDER --}}
                <div class="grid grid-cols-7 border border-gray-100 border-t-0 rounded-b-2xl overflow-hidden">

                    @for($i = 0; $i < $totalCells; $i++)
                        @php
                            $dayNumber      = $i - $startDay + 1;
                            $isCurrentMonth = $dayNumber > 0 && $dayNumber <= $daysInMonth;
                            $fullDate       = $isCurrentMonth
                                                ? $date->copy()->day($dayNumber)->toDateString()
                                                : null;
                            $isToday        = $isCurrentMonth && $fullDate === now()->toDateString();
                        @endphp

                        <div class="min-h-[100px] p-2 border-r border-b border-gray-100 transition hover:bg-[#faf8ff]
                            {{ $isToday ? 'bg-[#fdf9ff]' : 'bg-white' }}">

                            @if($isCurrentMonth)

                                {{-- Nomor tanggal --}}
                                <span class="block text-xs font-bold mb-1
                                    {{ $isToday ? 'text-[#6d3df5]' : 'text-gray-500' }}">
                                    {{ str_pad($dayNumber, 2, '0', STR_PAD_LEFT) }}
                                </span>

                                {{-- Events --}}
                                @if(isset($events[$fullDate]))
                                    @foreach($events[$fullDate] as $event)
                                        <a href="{{ route('tasks.detail', $event['id']) }}"
                                            class="block rounded-xl p-2 mb-1 border transition hover:scale-[1.02] hover:shadow-md
                                                {{ $isToday ? 'bg-red-50 border-red-200' : 'bg-green-50 border-green-200' }}">

                                            <span class="inline-block px-1.5 py-0.5 rounded text-[9px] font-bold mb-1
                                                {{ $isToday ? 'bg-red-500 text-white' : 'bg-green-500 text-white' }}">
                                                {{ $event['time'] ?? '-' }}
                                            </span>

                                            <p class="text-[11px] font-bold text-gray-700 leading-tight truncate">
                                                {{ $event['title'] ?? 'No Title' }}
                                            </p>

                                            <p class="text-[10px] text-gray-400 truncate">
                                                {{ $event['course'] ?? '-' }}
                                            </p>

                                        </a>
                                    @endforeach
                                @endif

                            @endif

                        </div>

                    @endfor

                </div>

                {{-- TODAY'S TASK --}}
                <div class="mt-10">

                    <h2 class="text-[32px] font-bold text-[#1f2937] mb-2">Today's Task</h2>
                    <p class="text-gray-400 mb-6">{{ now()->format('l, d M Y') }}</p>

                    <div class="flex flex-col gap-4">

                        @forelse($events[now()->toDateString()] ?? [] as $event)

                            <div class="bg-white border border-gray-100 rounded-3xl p-6 shadow-sm hover:shadow-md transition">
                                <div class="flex flex-wrap justify-between items-center gap-4">

                                    <div class="flex items-center gap-4">
                                        <span class="text-lg font-semibold text-[#2342b5]">
                                            {{ $event['time'] ?? '-' }}
                                        </span>
                                        <div class="w-9 h-9 bg-[#2342b5] rounded-lg flex items-center justify-center">
                                            <i class="ph ph-table text-white"></i>
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-[#2342b5] text-lg">
                                                {{ $event['title'] ?? 'No Title' }}
                                            </h4>
                                            <p class="text-gray-400 text-sm">
                                                {{ $event['course'] ?? '-' }}
                                            </p>
                                        </div>
                                    </div>

                                    <span class="bg-red-100 text-red-500 px-5 py-2 rounded-xl text-sm font-bold">
                                        Due Today
                                    </span>

                                </div>
                            </div>

                        @empty

                            <div class="bg-gray-50 border border-dashed border-gray-200 rounded-2xl p-6 text-center text-gray-400">
                                Tidak ada tugas hari ini.
                            </div>

                        @endforelse

                    </div>

                </div>

            </section>

            {{-- RIGHT PANEL --}}
            <aside class="flex flex-col gap-5">

                <div class="bg-white rounded-[28px] p-7 shadow-sm sticky top-8">

                    <div class="flex items-center justify-between mb-8">
                        <h3 class="text-xl font-bold text-[#6d3df5]">Upcoming Deadlines</h3>
                        <button class="w-11 h-11 rounded-full bg-[#6d3df5] flex items-center justify-center shadow-md">
                            <i class="ph ph-bell text-white text-lg"></i>
                        </button>
                    </div>

                    <p class="text-gray-400 font-semibold mb-5">Today</p>

                    <div class="flex flex-col gap-5">

                        @foreach($events as $dateKey => $dayEvents)
                            @foreach($dayEvents as $event)
                                @if($dateKey === now()->toDateString())

                                    <div class="flex gap-4 items-start">
                                        <span class="font-bold text-lg text-[#1f2937] w-14 shrink-0">
                                            {{ $event['time'] ?? '-' }}
                                        </span>
                                        <div class="w-[4px] self-stretch bg-red-500 rounded-full shrink-0"></div>
                                        <div>
                                            <p class="text-gray-400 text-xs">{{ $event['course'] ?? '-' }}</p>
                                            <h4 class="font-bold text-[#1f2937]">{{ $event['title'] ?? 'No Title' }}</h4>
                                        </div>
                                    </div>

                                @endif
                            @endforeach
                        @endforeach

                    </div>

                </div>

            </aside>

        </div>

    </main>

</div>

@endsection