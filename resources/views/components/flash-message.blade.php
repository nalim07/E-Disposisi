@props(['type' => 'success', 'message'])

@if ($message)
    @php
        switch ($type) {
            case 'error':
                $classes = 'bg-red-100 border-red-400 text-red-700';
                $icon = 'M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z';
                break;
            case 'info':
                $classes = 'bg-blue-100 border-blue-400 text-blue-700';
                $icon = 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z';
                break;
            default:
                $classes = 'bg-green-100 border-green-400 text-green-700';
                $icon = 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z';
        }
    @endphp
    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
        class="fixed top-14 right-16 z-50 p-4 rounded-lg border {{ $classes }} shadow-lg transition duration-300 ease-in-out"
        role="alert">
        <div class="flex items-start">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 flex-shrink-0" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}" />
            </svg>
            <div class="flex-1">
                <p class="text-sm font-medium">
                    {{ $message }}
                </p>
            </div>
            <button @click="show = false" class="ml-4 text-gray-500 hover:text-gray-700 focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endif
