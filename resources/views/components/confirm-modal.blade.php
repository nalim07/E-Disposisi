@props([
    'modalId',
    'title' => 'Konfirmasi Tindakan',
    'message' => 'Apakah Anda yakin ingin melanjutkan tindakan ini?',
    'action', // route/url tujuan
    'method' => 'POST',
    'confirmLabel' => 'Ya',
    'cancelLabel' => 'Batal',
    'icon' => '⚠️', // bisa diganti dengan 🗃️ untuk arsip
    'buttonColor' => 'green', // bisa diubah menjadi 'blue', 'red', dsb
])

<div id="{{ $modalId }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md text-center relative">
        <div class="mb-4 text-2xl text-{{ $buttonColor }}-500">
            {{ $icon }}
        </div>
        <h2 class="font-semibold text-lg mb-2">{{ $title }}</h2>
        <p class="text-gray-600 mb-6 text-wrap">{{ $message }}</p>

        <form action="{{ $action }}" method="POST" class="flex justify-center gap-4">
            @csrf
            @method($method)

            <button type="submit"
                class="bg-{{ $buttonColor }}-500 hover:bg-{{ $buttonColor }}-600 text-white text-sm px-5 py-2 rounded-full flex items-center gap-2">
                {{ $confirmLabel }}
            </button>

            <button type="button" onclick="document.getElementById('{{ $modalId }}').classList.add('hidden')"
                class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-5 py-2 rounded-full flex items-center gap-2">
                ✖ {{ $cancelLabel }}
            </button>
        </form>
    </div>
</div>
