@props(['href', 'icon', 'label', 'color' => 'blue'])

<a href="{{ $href }}"
    {{ $attributes->merge([
        'class' => "inline-flex items-center p-2 text-white font-semibold rounded-full shadow-sm bg-{$color}-500 hover:bg-{$color}-600 gap-1",
    ]) }}>
    <svg class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
        <path d="{{ $icon }}" />
    </svg>
    {{ $label }}
</a>
