@props(['action', 'icon', 'label', 'color' => 'red', 'method' => 'POST'])

<!-- Trigger button -->
<button type="button" x-data x-on:click="$dispatch('open-delete-modal-{{ md5($action) }}')" title="{{ $label }}"
    {{ $attributes->merge([
        'class' => "inline-flex items-center justify-center w-9 h-9 rounded-full text-white bg-{$color}-600 hover:bg-{$color}-700",
    ]) }}>
    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
        <path d="{{ $icon }}" />
    </svg>
</button>

<!-- Modal -->
<div x-data="{ show: false }" x-on:open-delete-modal-{{ md5($action) }}.window="show = true" x-show="show"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" style="display: none;">
    <div class="bg-white p-6 rounded-md w-full max-w-sm shadow-xl">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Konfirmasi Hapus</h2>
        <p class="text-sm text-gray-600 mb-6">Apakah Anda yakin ingin menghapus data ini?</p>

        <div class="flex justify-end gap-2">
            <button x-on:click="show = false" class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-md">
                Batal
            </button>

            <form method="POST" action="{{ $action }}">
                @csrf
                @method($method)
                <button type="submit"
                    class="px-4 py-2 bg-{{ $color }}-600 hover:bg-{{ $color }}-700 text-white rounded-md">
                    Hapus
                </button>
            </form>
        </div>
    </div>
</div>
