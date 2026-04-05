@props(['time', 'title', 'course', 'status'])

<div class="bg-white border border-gray-50 p-6 rounded-2xl shadow-sm flex justify-between items-center">
    <div class="flex items-center gap-6">
        <span class="text-gray-400 font-medium">{{ $time }}</span>
        <div class="flex items-center gap-3">
            <div class="bg-primary p-2 rounded-lg text-white">
                <i class="ph ph-microsoft-word-logo"></i>
            </div>
            <div>
                <h4 class="font-bold text-indigo-900">{{ $title }}</h4>
                <p class="text-xs text-gray-300">{{ $course }}</p>
            </div>
        </div>
    </div>
    <span class="bg-red-50 text-red-400 px-4 py-1.5 rounded-full text-[10px] font-bold">{{ $status }}</span>
</div>