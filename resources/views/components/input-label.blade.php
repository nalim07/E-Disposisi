@props(['value'])

<label {{ $attributes->merge(['class' => 'sr-only block font-medium text-sm text-white']) }}>
    {{ $value ?? $slot }}
</label>