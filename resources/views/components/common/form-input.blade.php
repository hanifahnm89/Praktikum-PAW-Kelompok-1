@props([
    'label',
    'type' => 'text',
    'placeholder' => '',
    'name' => '',
    'value' => ''
])

<div class="relative">
    <label class="absolute -top-3 left-4 bg-white px-2 text-xs text-gray-400 font-medium z-10">
        {{ $label }}
    </label>

    <div class="flex items-center border border-gray-300 rounded-xl focus-within:border-blue-600 transition">
        
        <input
            type="{{ $type }}"
            name="{{ $name }}"
            id="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            class="w-full px-4 py-3 outline-none bg-transparent text-sm rounded-xl"
        >

        @if($type === 'password')
            <button
                type="button"
                onclick="togglePassword('{{ $name }}', this)"
                class="pr-4 text-gray-400"
            >
                <i class="ph ph-eye-slash text-xl"></i>
            </button>
        @endif

    </div>
</div>

<script>
    function togglePassword(id, button) {
        const input = document.getElementById(id);
        const icon = button.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('ph-eye-slash');
            icon.classList.add('ph-eye');
        } else {
            input.type = 'password';
            icon.classList.remove('ph-eye');
            icon.classList.add('ph-eye-slash');
        }
    }
</script>