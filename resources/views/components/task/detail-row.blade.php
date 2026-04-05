@props(['label', 'value', 'isTag' => false, 'color' => 'bg-red-100 text-red-500'])

<div {{ $attributes->merge(['class' => 'bg-white border border-gray-100 p-6 rounded-2xl shadow-sm']) }}>
    <p class="text-gray-300 text-xs font-bold mb-2 uppercase tracking-wider">{{ $label }}</p>
    @if($isTag)
        <span class="{{ $color }} px-3 py-1 rounded-md text-[10px] font-bold">{{ $value }}</span>
    @else
        <p class="text-gray-700 font-medium text-sm">{{ $value }}</p>
    @endif
</div>