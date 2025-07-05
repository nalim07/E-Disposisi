@props(['sortable' => false, 'direction' => null])

<th {{ $attributes->merge(['class' => 'px-6 py-3 bg-[#D9D9D9] text-center text-[15px] font-bold tracking-wider']) }}>
    {{ $slot }}
</th>
