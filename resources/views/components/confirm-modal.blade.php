@props([
    'modalId',
    'title' => 'Konfirmasi Pengiriman',
    'message' => 'Apakah Anda yakin ingin mengirim surat ini ke pimpinan? Setelah dikirim, surat tidak dapat diubah.',
    'action', // route atau url action
    'method' => 'PATCH',
    'confirmLabel' => 'Kirim',
    'cancelLabel' => 'Batal',
])

<div id="{{ $modalId }}" class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 hidden">
    <div class="bg-white p-6 rounded-lg shadow-xl w-full max-w-md text-center relative">
        <div class="mb-4 text-red-500 text-2xl">
            ⚠️
        </div>
        <h2 class="font-semibold text-lg mb-2">{{ $title }}</h2>
        <p class="text-gray-600 mb-6 text-wrap">{{ $message }}</p>

        <form action="{{ $action }}" method="POST" class="flex justify-center gap-4">
            @csrf
            @method($method)

            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white text-sm px-5 py-2 rounded-full flex items-center gap-2">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                    <path
                        d="M3 20.9429V4.94286L22 12.9429L3 20.9429ZM5 17.9429L16.85 12.9429L5 7.94286V11.4429L11 12.9429L5 14.4429V17.9429Z" />
                </svg>
                {{ $confirmLabel }}
            </button>

            <button type="button" onclick="document.getElementById('{{ $modalId }}').classList.add('hidden')"
                class="bg-gray-500 hover:bg-gray-600 text-white text-sm px-5 py-2 rounded-full flex items-center gap-2">
                ✖ {{ $cancelLabel }}
            </button>
        </form>
    </div>
</div>
