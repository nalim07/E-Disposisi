@props(['href', 'icon', 'label', 'color' => 'blue'])

<a href="{{ $href }}" title="{{ $label }}"
    {{ $attributes->merge([
        'class' => "inline-flex items-center justify-center w-9 h-9 rounded-full bg-{$color}-500 hover:bg-{$color}-600 text-white",
    ]) }}>
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path d="{{ $icon }}" />
    </svg>
</a>
