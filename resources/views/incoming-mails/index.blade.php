<x-app-layout>
    <x-slot name="title">Surat Masuk</x-slot>
    <!-- Header Section -->
    <div class="flex bg-primary shadow-sm">
        <div class="py-7 px-6 flex items-center justify-between text-white w-full">
            <!-- Judul dan Tombol Create -->
            <div class="flex items-center gap-3">
                <!-- Logo SVG -->
                <svg class="w-12 h-14" viewBox="0 0 48 55" fill="currentColor">
                    <path
                        d="M8 45.8333C6.9 45.8333 5.95867 45.3849 5.176 44.4881C4.39333 43.5913 4.00133 42.5119 4 41.25V13.75C4 12.4896 4.392 11.411 5.176 10.5142C5.96 9.61737 6.90133 9.1682 8 9.16667H40C41.1 9.16667 42.042 9.61584 42.826 10.5142C43.61 11.4125 44.0013 12.4911 44 13.75V41.25C44 42.5104 43.6087 43.5898 42.826 44.4881C42.0433 45.3865 41.1013 45.8349 40 45.8333H8ZM24 29.7917L40 18.3333V13.75L24 25.2083L8 13.75V18.3333L24 29.7917Z" />
                </svg>

                <h1 class="text-3xl font-bold mr-4">Surat Masuk</h1>

                <!-- Create Button -->
                <x-action-button-create href="{{ route('surat-masuk.create') }}"
                    icon="M15 1.8125C11.5321 1.85318 8.2181 3.20295 5.76575 5.57356C3.3134 7.94417 1.91708 11.1477 1.875 14.5C1.91708 17.8523 3.3134 21.0558 5.76575 23.4264C8.2181 25.7971 11.5321 27.1468 15 27.1875C18.4679 27.1468 21.7819 25.7971 24.2343 23.4264C26.6866 21.0558 28.0829 17.8523 28.125 14.5C28.0829 11.1477 26.6866 7.94417 24.2343 5.57356C21.7819 3.20295 18.4679 1.85318 15 1.8125ZM22.5 15.4062H15.9375V21.75H14.0625V15.4062H7.5V13.5938H14.0625V7.25H15.9375V13.5938H22.5V15.4062Z"
                    label="Tambah Data" />
            </div>

            <!-- Grup Kanan: Form Pencarian -->
            <div class="flex items-center">
                <form action="" method="GET" class="flex bg-[#ECE6F0] rounded-full px-4 py-2">
                    <input type="search" name="q" id="q" placeholder="Ketik untuk mencari data"
                        class="w-72 px-2 py-2 text-base text-gray-800 font-normal border-none bg-transparent focus:ring-0 focus:outline-none"
                        value="{{ request('q') }}" />
                    <button type="submit" class="pr-2 py-2 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M11.25 4.5a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5zM20.25 20.25l-4.5-4.5" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white shadow-sm mt-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <x-table-header>No</x-table-header>
                            <x-table-header>Nomor Surat</x-table-header>
                            <x-table-header>Pengirim</x-table-header>
                            <x-table-header>Perihal</x-table-header>
                            <x-table-header>Tanggal Terima</x-table-header>
                            <x-table-header>Status</x-table-header>
                            <x-table-header>Aksi</x-table-header>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($incomingMails as $incomingMail)
                            <tr>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $loop->iteration }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $incomingMail->mail_number }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $incomingMail->sender }}</x-table-cell>
                                <x-table-cell
                                    class="text-left whitespace-nowrap">{{ $incomingMail->subject }}</x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    {{ $incomingMail->received_date }}
                                </x-table-cell>
                                <x-table-cell>
                                    @role('pimpinan')
                                        @if ($incomingMail->status === 'Sudah Ditindaklanjuti')
                                            <x-status-badge status="Belum Didisposisi" />
                                        @else
                                            <x-status-badge :status="$incomingMail->status" />
                                        @endif
                                    @else
                                        <x-status-badge :status="$incomingMail->status" />
                                    @endrole
                                </x-table-cell>
                                <x-table-cell class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="flex flex-wrap justify-center gap-2">
                                        @role('admin')
                                            {{-- Edit --}}
                                            <x-action-button href="{{ route('surat-masuk.edit', $incomingMail->id) }}"
                                                icon="M5.5 19.6476H6.925L16.7 9.87262L15.275 8.44762L5.5 18.2226V19.6476ZM3.5 21.6476V17.3976L16.7 4.22262C16.9 4.03929 17.1208 3.89762 17.3625 3.79762C17.6042 3.69762 17.8583 3.64762 18.125 3.64762C18.3917 3.64762 18.65 3.69762 18.9 3.79762C19.15 3.89762 19.3667 4.04762 19.55 4.24762L20.925 5.64762C21.125 5.83095 21.2708 6.04762 21.3625 6.29762C21.4542 6.54762 21.5 6.79762 21.5 7.04762C21.5 7.31429 21.4542 7.56845 21.3625 7.81012C21.2708 8.05179 21.125 8.27262 20.925 8.47262L7.75 21.6476H3.5Z"
                                                label="Edit" color="orange" />

                                            {{-- Lihat --}}
                                            <x-action-button href="{{ route('surat-masuk.show', $incomingMail->id) }}"
                                                icon="M1 12.6476C1 12.6476 5 4.64762 12 4.64762C19 4.64762 23 12.6476 23 12.6476C23 12.6476 19 20.6476 12 20.6476C5 20.6476 1 12.6476 1 12.6476ZM12 15.6476C13.6569 15.6476 15 14.3045 15 12.6476C15 10.9908 13.6569 9.64762 12 9.64762C10.3431 9.64762 9 10.9908 9 12.6476C9 14.3045 10.3431 15.6476 12 15.6476Z"
                                                label="Lihat" color="blue" />

                                            {{-- Kirim --}}
                                            <!-- Tombol trigger modal -->
                                            <button type="button" title="Kirim"
                                                onclick="document.getElementById('confirm-send-{{ $incomingMail->id }}').classList.remove('hidden')"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-green-500 hover:bg-green-600 text-white">
                                                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                                    <path
                                                        d="M3 20.9429V4.94286L22 12.9429L3 20.9429ZM5 17.9429L16.85 12.9429L5 7.94286V11.4429L11 12.9429L5 14.4429V17.9429Z" />
                                                </svg>
                                            </button>

                                            <!-- Modalnya -->
                                            <x-confirm-modal modal-id="confirm-send-{{ $incomingMail->id }}"
                                                :action="route('surat-masuk.send', $incomingMail->id)" />

                                            {{-- Hapus --}}
                                            <x-form-button :action="route('surat-masuk.destroy', $incomingMail->id)"
                                                icon="M6.5 21.9429C5.95 21.9429 5.47917 21.747 5.0875 21.3554C4.69583 20.9637 4.5 20.4929 4.5 19.9429V6.94286H3.5V4.94286H8.5V3.94286H14.5V4.94286H19.5V6.94286H18.5V19.9429C18.5 20.4929 18.3042 20.9637 17.9125 21.3554C17.5208 21.747 17.05 21.9429 16.5 21.9429H6.5ZM16.5 6.94286H6.5V19.9429H16.5V6.94286ZM8.5 17.9429H10.5V8.94286H8.5V17.9429ZM12.5 17.9429H14.5V8.94286H12.5V17.9429Z"
                                                label="Hapus" color="red" method="DELETE" />
                                            @elserole('pimpinan')
                                            {{-- Lihat --}}
                                            <x-action-button href="{{ route('surat-masuk.edit', $incomingMail->id) }}"
                                                icon="M5.5 19.6476H6.925L16.7 9.87262L15.275 8.44762L5.5 18.2226V19.6476ZM3.5 21.6476V17.3976L16.7 4.22262C16.9 4.03929 17.1208 3.89762 17.3625 3.79762C17.6042 3.69762 17.8583 3.64762 18.125 3.64762C18.3917 3.64762 18.65 3.69762 18.9 3.79762C19.15 3.89762 19.3667 4.04762 19.55 4.24762L20.925 5.64762C21.125 5.83095 21.2708 6.04762 21.3625 6.29762C21.4542 6.54762 21.5 6.79762 21.5 7.04762C21.5 7.31429 21.4542 7.56845 21.3625 7.81012C21.2708 8.05179 21.125 8.27262 20.925 8.47262L7.75 21.6476H3.5Z"
                                                label="Disposisi" color="orange" />
                                                
                                            <x-action-button href="{{ route('surat-masuk.show', $incomingMail->id) }}"
                                                icon="M1 12.6476C1 12.6476 5 4.64762 12 4.64762C19 4.64762 23 12.6476 23 12.6476C23 12.6476 19 20.6476 12 20.6476C5 20.6476 1 12.6476 1 12.6476ZM12 15.6476C13.6569 15.6476 15 14.3045 15 12.6476C15 10.9908 13.6569 9.64762 12 9.64762C10.3431 9.64762 9 10.9908 9 12.6476C9 14.3045 10.3431 15.6476 12 15.6476Z"
                                                label="Lihat" color="blue" />
                                        @endrole
                                    </div>
                                </x-table-cell>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada data
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            {{-- @if ($incomingMails->hasPages())
                <div class="mt-4">
                    {{ $incomingMails->links() }}
                </div>
            @endif --}}
        </div>
    </div>
</x-app-layout>
