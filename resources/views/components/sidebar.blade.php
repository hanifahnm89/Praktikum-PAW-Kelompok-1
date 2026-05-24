<aside class="w-64 min-h-screen bg-white border-r border-gray-100 p-8 flex flex-col fixed">

    {{-- LOGO --}}
    <div class="flex items-center gap-2 mb-12">
        <img src="{{ asset('images/logo-lumina.png') }}" class="h-8">
    </div>

<<<<<<< HEAD
        @php
            $user = session('user');
        @endphp

        <div class="mb-8">
            <div class="flex items-center gap-3 bg-white rounded-2xl px-2 py-4 w-[220px]">
                <img src="{{ asset('images/user.jpg') }}" 
                    class="w-12 h-12 rounded-full object-cover">

                <div>
                    <h4 class="font-bold text-sm">
                        {{ $user['first_name'] ?? 'User' }}
                    </h4>

                    <p class="text-[10px] text-gray-400">
                        {{ $user['role'] ?? 'Student' }}
                    </p>
                </div>
            </div>
=======
    {{-- PROFILE --}}
    <div class="flex items-center gap-3 mb-10 p-3 bg-gray-50 rounded-2xl">
        <img src="{{ asset('images/ifka.png') }}"
             class="w-12 h-12 rounded-full object-cover">

        <div>
            <h4 class="font-bold text-sm">{{ session('user.name') ?? 'Guest' }}</h4>
            <p class="text-[10px] text-gray-400"> {{ session('user.role') ?? 'Student' }}</p>
>>>>>>> e36a333b9ecb01483c870dce597133429f1d57df
        </div>

    {{-- MENU --}}
    <nav class="space-y-2 flex-1">

        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-4 p-3 rounded-xl transition
           {{ request()->is('dashboard')
                ? 'bg-indigo-50 text-primary font-bold'
                : 'text-gray-400 hover:bg-gray-50' }}">

<<<<<<< HEAD
        <a href="{{ route('tasks.detail') }}" class="flex items-center gap-4 p-3 rounded-xl text-gray-400 hover:bg-gray-50 transition">
        <i class="ph ph-clipboard-text text-xl"></i> 
        <span class="text-sm font-medium">Task</span>
    </a>
=======
            <i class="ph ph-squares-four text-xl"></i>
            <span class="text-sm">Dashboard</span>
        </a>
>>>>>>> e36a333b9ecb01483c870dce597133429f1d57df

        {{-- CALENDAR --}}
        <a href="{{ route('calendar') }}"
           class="flex items-center gap-4 p-3 rounded-xl transition
           {{ request()->is('calendar')
                ? 'bg-indigo-50 text-primary font-bold'
                : 'text-gray-400 hover:bg-gray-50' }}">

            <i class="ph ph-calendar text-xl"></i>
            <span class="text-sm">Calendar</span>
        </a>

        {{-- TASK --}}
        <a href="{{ route('tasks') }}"
           class="flex items-center gap-4 p-3 rounded-xl transition
           {{ request()->is('tasks')
                ? 'bg-indigo-50 text-primary font-bold'
                : 'text-gray-400 hover:bg-gray-50' }}">

            <i class="ph ph-note-pencil text-xl"></i>
            <span class="text-sm">Task</span>
        </a>

        {{-- ALL TASK --}}
        <a href="{{ route('all-task') }}"
           class="flex items-center gap-4 p-3 rounded-xl transition
           {{ request()->is('all-task')
                ? 'bg-indigo-50 text-primary font-bold'
                : 'text-gray-400 hover:bg-gray-50' }}">

            <i class="ph ph-list-checks text-xl"></i>
            <span class="text-sm">All Task</span>
        </a>

        {{-- SETTINGS --}}
        <a href="{{ route('settings') }}"
           class="flex items-center gap-4 p-3 rounded-xl transition
           {{ request()->is('settings')
                ? 'bg-indigo-50 text-primary font-bold'
                : 'text-gray-400 hover:bg-gray-50' }}">

            <i class="ph ph-gear text-xl"></i>
            <span class="text-sm">Settings</span>
        </a>

    </nav>

    {{-- LOGOUT --}}
    <div class="mt-auto pt-6 border-t border-gray-100">

        <a href="{{ route('logout') }}"
           onclick="return confirm('Yakin mau keluar dari Lumina?')"
           class="flex items-center gap-4 p-3 rounded-xl text-red-500 hover:bg-red-50 transition">

            <i class="ph ph-sign-out text-xl"></i>
            <span class="text-sm font-bold">Log out</span>
        </a>

    </div>

</aside>