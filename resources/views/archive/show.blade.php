<x-app-layout>
    <x-slot name="title">
        Detail Arsip - {{ optional($archive->outgoingMail)->mail_number ?? 'Tidak Ada Nomor' }}
    </x-slot>

    <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md">
        <h1 class="text-2xl font-bold text-center mb-8">Detail Arsip Surat</h1>

        <div class="space-y-4">
            <div class="grid grid-cols-12 gap-4">
                <div class="col-span-2 font-medium">Nomor Surat</div>
                <div class="col-span-10">: {{ optional($archive->outgoingMail)->mail_number ?? '-' }}</div>

                <div class="col-span-2 font-medium">Pengirim</div>
                <div class="col-span-10">: {{ optional($archive->outgoingMail)->purpose ?? '-' }}</div>

                <div class="col-span-2 font-medium">Perihal</div>
                <div class="col-span-10">: {{ optional($archive->outgoingMail)->subject ?? '-' }}</div>

                <div class="col-span-2 font-medium">Tanggal Surat</div>
                <div class="col-span-10">:
                    {{ optional($archive->outgoingMail)->mail_date
                        ? \Carbon\Carbon::parse($archive->outgoingMail->mail_date)->format('d-m-Y')
                        : '-' }}
                </div>

                <div class="col-span-2 font-medium">Tanggal Terima</div>
                <div class="col-span-10">:
                    {{ optional($archive->outgoingMail)->received_date
                        ? \Carbon\Carbon::parse($archive->outgoingMail->received_date)->format('d-m-Y')
                        : '-' }}
                </div>

                <div class="col-span-2 font-medium">Tanggal Arsip</div>
                <div class="col-span-10">:
                    {{ $archive->archived_at ? \Carbon\Carbon::parse($archive->archived_at)->format('d-m-Y') : '-' }}
                </div>

                <div class="col-span-2 font-medium">File</div>
                <div class="col-span-10">
                    : @if (optional($archive->outgoingMail)->file_path)
                        <a href="{{ asset('storage/' . $archive->outgoingMail->file_path) }}"
                            class="text-blue-600 hover:underline" target="_blank">
                            {{ $archive->outgoingMail->original_name ?? '-' }}
                        </a>
                    @else
                        -
                    @endif
                </div>

                <div class="col-span-2 font-medium">Status</div>
                <div class="col-span-10">
                    : <span class="px-2 py-1 rounded-full bg-green-100 text-green-800 text-sm">
                        {{ optional($archive->outgoingMail)->status ?? '-' }}
                    </span>
                </div>

                {{-- <div class="col-span-2 font-medium">Catatan Arsip</div>
                <div class="col-span-10">: {{ $archive->note ?? '-' }}</div> --}}
            </div>
            {{-- <pre>{{ dd($archive) }}</pre> --}}

            <!-- Tombol Kembali -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('arsip.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-colors">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
