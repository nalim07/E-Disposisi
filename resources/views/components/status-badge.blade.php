@props(['status'])

@php
    $colors = [
        'draft' => 'bg-gray-200 text-gray-800',
        'sent' => 'bg-blue-200 text-blue-800',
        'archived' => 'bg-green-200 text-green-800',
    ];
    $color = $colors[$status] ?? 'bg-gray-200 text-gray-800';
@endphp

<span class="px-2 py-1 rounded-full text-xs font-medium {{ $color }}">
    {{ ucfirst($status) }}
</span>