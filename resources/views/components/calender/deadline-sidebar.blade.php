@props(['time', 'course', 'title'])

<div class="flex gap-4 items-start">
    <span class="font-bold text-gray-800 text-sm mt-1">{{ $time }}</span>
    <div class="w-1 bg-red-500 rounded-full min-h-[40px]"></div>
    <div>
        <p class="text-[10px] text-gray-300 font-bold uppercase tracking-wider">{{ $course }}</p>
        <h4 class="text-gray-400 font-medium text-lg leading-tight">{{ $title }}</h4>
    </div>
</div>