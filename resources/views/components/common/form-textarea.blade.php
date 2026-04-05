@props(['label', 'placeholder' => '', 'name' => ''])

<div class="relative w-full">
    <label class="absolute -top-2.5 left-4 bg-white px-1.5 text-[11px] text-gray-400 font-medium z-10">{{ $label }}</label>
    <textarea name="{{ $name }}" placeholder="{{ $placeholder }}" 
        class="w-full px-4 py-3 border border-gray-300 rounded-lg outline-none focus:border-blue-600 transition text-sm min-h-[80px] placeholder:text-gray-200"></textarea>
</div>