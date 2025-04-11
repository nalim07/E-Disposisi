@props(['status'])

@php
    $color = $colors[$status] ?? 'bg-yellow-100 text-yellow-500';
@endphp

<span class="px-2 py-1 rounded-full text-xs font-medium {{ $color }}">
    {{ ucfirst($status) }}
</span>