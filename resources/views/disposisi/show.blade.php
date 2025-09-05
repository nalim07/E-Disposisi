<x-app-layout>
    <x-slot name="title">Detail Surat - {{ $disposition }}</x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center mb-8">Detail Surat</h1>

        <div class="space-y-4">
            <!-- Data Grid -->
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2 font-medium">Nomor Surat</div>
                <div class="col-span-10">: {{ $disposition->incomingMail->mail_number }}</div>

                <div class="col-span-2 font-medium">Pengirim</div>
                <div class="col-span-10">: {{ $disposition->incomingMail->sender }}</div>

                <div class="col-span-2 font-medium">Perihal</div>
                <div class="col-span-10">: {{ $disposition->incomingMail->subject }}</div>

                <div class="col-span-2 font-medium">Tanggal Surat</div>
                <div class="col-span-10">: {{ $disposition->incomingMail->mail_date }}</div>

                <div class="col-span-2 font-medium">Tanggal Terima</div>
                <div class="col-span-10">: {{ $disposition->incomingMail->received_date }}</div>

                <div class="col-span-2 font-medium">Isi Disposisi</div>
                <div class="col-span-10">: {{ $disposition->content }}</div>

                <div class="col-span-2 font-medium">Batas Waktu</div>
                <div class="col-span-10">: {{ $disposition->deadline }}</div>

                <div class="col-span-2 font-medium">Sifat</div>
                <div class="col-span-10">: {{ $disposition->priority }}</div>
                
                <div class="col-span-2 font-medium">Status</div>
                <div class="col-span-10">
                    : <span class="px-2 py-1 rounded {{ $disposition->status_badge_class }}">
                        {{ ucfirst(str_replace('_', ' ', $disposition->status)) }}
                    </span>
                    @if($disposition->completed_at)
                        (Selesai pada: {{ $disposition->completed_at->format('d/m/Y H:i') }})
                    @endif
                </div>
                
                @if ($disposition->notes)
                    <div class="col-span-2 font-medium">Catatan</div>
                    <div class="col-span-10">: {{ $disposition->notes }}</div>
                @endif
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-4 mt-10">
                <!-- Tombol Kembali -->
                <a href="{{ route('disposisi.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Kembali
                </a>

                <!-- Tombol Edit -->
                {{-- @can('update', $disposition)
                <a href="{{ route('disposisi.edit', $disposition) }}"
                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    Edit Disposisi
                </a>
            @endcan --}}
                <!-- Tombol Hapus -->
                @can('delete', $disposition)
                    <form action="{{ route('disposisi.destroy', $disposition) }}" method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus disposisi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors">
                            Hapus Disposisi
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>

</x-app-layout>
