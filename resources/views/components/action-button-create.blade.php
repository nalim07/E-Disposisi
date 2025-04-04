@props(['href', 'icon', 'label', 'color' => 'blue'])

<a href="{{ $href }}" {{ $attributes->merge([
    'class' => "inline-flex items-center text-white text-xl font-semibold gap-2"
]) }}>
    <svg class="size-7" viewBox="0 0 30 29" fill="currentColor">
        <path d="{{ $icon }}"/>
    </svg>
    {{ $label }}
</a>