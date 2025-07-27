<x-app-layout>
    <x-slot name="title">Detail Surat - {{ $outgoingMail->mail_number }}</x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center mb-8">Detail Surat</h1>

        <div class="space-y-4">
            <!-- Data Grid -->
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2 font-medium">Nomor Surat</div>
                <div class="col-span-10">: {{ $outgoingMail->mail_number }}</div>

                <div class="col-span-2 font-medium">Pengirim</div>
                <div class="col-span-10">: {{ $outgoingMail->purpose }}</div>

                <div class="col-span-2 font-medium">Perihal</div>
                <div class="col-span-10">: {{ $outgoingMail->subject }}</div>

                <div class="col-span-2 font-medium">Tanggal Surat</div>
                <div class="col-span-10">: {{ $outgoingMail->mail_date }}</div>

                <div class="col-span-2 font-medium">Tanggal Terima</div>
                <div class="col-span-10">: {{ $outgoingMail->received_date }}</div>

                <div class="col-span-2 font-medium">File</div>
                <div class="col-span-10">
                    : <a href="{{ asset('storage/' . $outgoingMail->file_path) }}" class="text-blue-600 hover:underline"
                        target="_blank">
                        {{ $outgoingMail->original_name }}
                    </a>
                </div>

                <div class="col-span-2 font-medium">Status</div>
                <div class="col-span-10">
                    : <span class="px-2 py-1 rounded-full {{ $outgoingMail->status_badge }}">
                        {{ $outgoingMail->status }}
                    </span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-10">
                <!-- Tombol Edit -->
                <a href="{{ route('surat-keluar.edit', $outgoingMail) }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    Edit Surat
                </a>

                <!-- Tombol Hapus -->
                <button type="button" onclick="openModal()"
                    class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                    Hapus Surat
                </button>

                <!-- Modal -->
                <div id="deleteModal"
                    class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
                    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
                        <div class="mt-3 text-center">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">Konfirmasi Hapus</h3>
                            <div class="mt-2 px-7 py-3">
                                <p class="text-sm text-gray-500">
                                    Apakah Anda yakin ingin menghapus surat ini?
                                </p>
                            </div>
                            <div class="items-center px-4 py-3">
                                <form id="deleteForm" method="POST"
                                    action="{{ route('surat-keluar.destroy', $outgoingMail) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="closeModal()"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 mr-2 transition-colors">
                                        Batal
                                    </button>
                                    <button type="submit"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                                        Ya, Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tombol Kembali -->
                <a href="{{ route('surat-keluar.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    // Fungsi Modal
    function openModal() {
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }

    // Tutup modal ketika klik di luar
    window.onclick = function(event) {
        const modal = document.getElementById('deleteModal');
        if (event.target === modal) {
            closeModal();
        }
    }

    // Tutup modal dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>
