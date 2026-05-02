<aside class="w-64 min-h-screen bg-white border-r border-gray-100 p-8 flex flex-col fixed">
    <div class="flex items-center gap-2 mb-12">
        <img src="{{ asset('images/logo-lumina.png') }}" class="h-8">
    </div>

    <div class="flex items-center gap-3 mb-10 p-3 bg-gray-50 rounded-2xl">
        <img src="{{ asset('images/ifka.png') }}" class="w-12 h-12 rounded-full object-cover">
        <div>
            <h4 class="font-bold text-sm">ifka</h4>
            <p class="text-[10px] text-gray-400">Student</p>
        </div>
    </div>

<nav class="space-y-2 flex-1">
    <a href="/dashboard" class="flex items-center gap-4 p-3 rounded-xl {{ request()->is('dashboard') ? 'bg-indigo-50 text-primary font-bold' : 'text-gray-400 hover:bg-gray-50' }} transition">
        <i class="ph ph-squares-four text-xl"></i> 
        <span class="text-sm">Dashboard</span>
    </a>

    <a href="{{ route('calendar') }}" class="flex items-center gap-4 p-3 rounded-xl {{ request()->is('calendar') ? 'bg-indigo-50 text-primary font-bold' : 'text-gray-400' }}">
        <i class="ph ph-calendar text-xl"></i> 
        <span class="text-sm">Calendar</span>
    </a>

        <a href="{{ route('tasks.detail') }}" class="flex items-center gap-4 p-3 rounded-xl text-gray-400 hover:bg-gray-50 transition">
        <i class="ph ph-calendar text-xl"></i> 
        <span class="text-sm font-medium">Task</span>
    </a>

    <a href="{{ route('all-task') }}" class="flex items-center gap-4 p-3 rounded-xl {{ request()->is('all-task') ? 'bg-indigo-50 text-primary font-bold' : 'text-gray-400 hover:bg-gray-50' }} transition">
        <i class="ph ph-list-checks text-xl"></i> 
        <span class="text-sm font-medium">All Task</span>
    </a>
    
    <a href="{{ route('settings') }}" class="flex items-center gap-4 p-3 rounded-xl {{ request()->is('settings') ? 'bg-indigo-50 text-primary font-bold' : 'text-gray-400' }}">
        <i class="ph ph-gear text-xl"></i>
        <span class="text-sm">Settings</span>
    </a>
</nav>
<nav class="space-y-2 flex-1">
        </nav>

    <div class="mt-auto pt-6 border-t border-gray-100">
        <a href="{{ route('logout') }}" 
           onclick="return confirm('Yakin mau keluar dari Lumina?')"
           class="flex items-center gap-4 p-3 rounded-xl text-red-500 hover:bg-red-50 transition">
            <i class="ph ph-sign-out text-xl"></i>
            <span class="text-sm font-bold">Log out</span>
        </a>
    </div>
</aside>
</aside>