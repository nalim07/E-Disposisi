@props(['colspan' => 1])

<td {{ $attributes->merge(['class' => 'px-6 py-4 text-sm font-medium text-gray-900']) }} colspan="{{ $colspan }}">
    {{ $slot }}
</td>