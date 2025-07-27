@props(['paginator'])

@if ($paginator->hasPages())
    @php
        $current = $paginator->currentPage();
        $last = $paginator->lastPage();
        $start = max(1, $current - 2);
        $end = min($last, $current + 2);
    @endphp

    <div class="flex items-center justify-between mt-6">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span
                class="flex items-center px-5 py-2 text-sm text-gray-400 bg-white border rounded-md gap-x-2 cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>Previous</span>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="flex items-center px-5 py-2 text-sm text-gray-700 bg-white border rounded-md gap-x-2 hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                </svg>
                <span>Previous</span>
            </a>
        @endif

        {{-- Page Numbers --}}
        <div class="items-center hidden md:flex gap-x-3">
            {{-- Start ellipsis --}}
            @if ($start > 1)
                <a href="{{ $paginator->url(1) }}"
                    class="px-2 py-1 text-sm text-gray-500 rounded-md hover:bg-gray-100">1</a>
                @if ($start > 2)
                    <span class="px-2 py-1 text-sm text-gray-500">...</span>
                @endif
            @endif

            {{-- Page links --}}
            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $current)
                    <span
                        class="px-2 py-1 text-sm text-blue-500 rounded-md bg-blue-100/60">{{ $i }}</span>
                @else
                    <a href="{{ $paginator->url($i) }}"
                        class="px-2 py-1 text-sm text-gray-500 rounded-md hover:bg-gray-100">{{ $i }}</a>
                @endif
            @endfor

            {{-- End ellipsis --}}
            @if ($end < $last)
                @if ($end < $last - 1)
                    <span class="px-2 py-1 text-sm text-gray-500">...</span>
                @endif
                <a href="{{ $paginator->url($last) }}"
                    class="px-2 py-1 text-sm text-gray-500 rounded-md hover:bg-gray-100">{{ $last }}</a>
            @endif
        </div>

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="flex items-center px-5 py-2 text-sm text-gray-700 bg-white border rounded-md gap-x-2 hover:bg-gray-100">
                <span>Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </a>
        @else
            <span
                class="flex items-center px-5 py-2 text-sm text-gray-400 bg-white border rounded-md gap-x-2 cursor-not-allowed">
                <span>Next</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 rtl:-scale-x-100" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 8.25L21 12m0 0l-3.75 3.75M21 12H3" />
                </svg>
            </span>
        @endif
    </div>
@endif
