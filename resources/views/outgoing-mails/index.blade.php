<x-app-layout>
    <x-slot name="title">Surat Keluar</x-slot>
    <!-- Header Section -->
    <div class="flex bg-primary shadow-sm">
        <div class="py-7 px-6 flex items-center justify-between text-white w-full">
            <!-- Judul dan Tombol Create -->
            <div class="flex items-center gap-3">
                <!-- Logo SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="55" viewBox="0 0 49 55" fill="none">
                    <path
                        d="M42.9391 16.4367L26.2322 7.34003C25.6931 7.04858 25.1005 6.89705 24.5 6.89705C23.8995 6.89705 23.3069 7.04858 22.7678 7.34003L6.06088 16.4367C5.16127 16.9177 4.40284 17.6683 3.87253 18.6025C3.34222 19.5367 3.06148 20.6167 3.0625 21.7186V41.1892C3.0625 44.446 5.49528 47.0954 8.486 47.0954H40.514C43.5047 47.0954 45.9375 44.446 45.9375 41.1892V21.7186C45.9385 20.6167 45.6578 19.5367 45.1275 18.6025C44.5972 17.6683 43.8387 16.9177 42.9391 16.4367ZM24.1536 10.3585C24.2614 10.3003 24.3799 10.27 24.5 10.27C24.6201 10.27 24.7386 10.3003 24.8464 10.3585L41.0566 19.1821L24.5957 28.1469C24.4879 28.2052 24.3694 28.2355 24.2493 28.2355C24.1292 28.2355 24.0106 28.2052 23.9028 28.1469L7.68975 19.3223L24.1536 10.3585Z"
                        fill="#F5F5F5" />
                </svg>

                <h1 class="text-3xl font-bold mr-4">Surat Keluar</h1>

                <!-- Create Button -->
                @role('admin')
                    <x-action-button-create href="{{ route('surat-keluar.create') }}"
                        icon="M15 1.8125C11.5321 1.85318 8.2181 3.20295 5.76575 5.57356C3.3134 7.94417 1.91708 11.1477 1.875 14.5C1.91708 17.8523 3.3134 21.0558 5.76575 23.4264C8.2181 25.7971 11.5321 27.1468 15 27.1875C18.4679 27.1468 21.7819 25.7971 24.2343 23.4264C26.6866 21.0558 28.0829 17.8523 28.125 14.5C28.0829 11.1477 26.6866 7.94417 24.2343 5.57356C21.7819 3.20295 18.4679 1.85318 15 1.8125ZM22.5 15.4062H15.9375V21.75H14.0625V15.4062H7.5V13.5938H14.0625V7.25H15.9375V13.5938H22.5V15.4062Z"
                        label="Tambah Data" />
                @endrole
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

    <div class="bg-white shadow-sm mt-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <x-table-header>No</x-table-header>
                            <x-table-header>Nomor Surat</x-table-header>
                            <x-table-header>Tujuan</x-table-header>
                            <x-table-header>Perihal</x-table-header>
                            <x-table-header>Tanggal Terima</x-table-header>
                            <x-table-header>Status</x-table-header>
                            <x-table-header>Aksi</x-table-header>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($outgoingMails as $outgoingMail)
                            <tr>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    {{ ($outgoingMails->currentPage() - 1) * $outgoingMails->perPage() + $loop->iteration }}
                                </x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $outgoingMail->mail_number }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $outgoingMail->purpose }}</x-table-cell>
                                <x-table-cell
                                    class="text-left whitespace-nowrap">{{ $outgoingMail->subject }}</x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    {{ $outgoingMail->received_date }}
                                </x-table-cell>
                                <x-table-cell>
                                    <span
                                        class="bg-green-100 text-green-500 px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $outgoingMail->status == 'Arsip' ? 'Arsip' : 'Surat Ditindaklanjuti' }}
                                    </span>
                                </x-table-cell>
                                <x-table-cell class="px-4 py-4 text-sm whitespace-nowrap">
                                    <div class="flex flex-wrap justify-center gap-2">
                                        @role('admin')
                                            {{-- Edit --}}
                                            <x-action-button href="{{ route('surat-keluar.edit', $outgoingMail->id) }}"
                                                icon="M5.5 19.6476H6.925L16.7 9.87262L15.275 8.44762L5.5 18.2226V19.6476ZM3.5 21.6476V17.3976L16.7 4.22262C16.9 4.03929 17.1208 3.89762 17.3625 3.79762C17.6042 3.69762 17.8583 3.64762 18.125 3.64762C18.3917 3.64762 18.65 3.69762 18.9 3.79762C19.15 3.89762 19.3667 4.04762 19.55 4.24762L20.925 5.64762C21.125 5.83095 21.2708 6.04762 21.3625 6.29762C21.4542 6.54762 21.5 6.79762 21.5 7.04762C21.5 7.31429 21.4542 7.56845 21.3625 7.81012C21.2708 8.05179 21.125 8.27262 20.925 8.47262L7.75 21.6476H3.5Z"
                                                label="Edit" color="orange" />

                                            {{-- Lihat --}}
                                            <x-action-button href="{{ route('surat-keluar.show', $outgoingMail->id) }}"
                                                icon="M1 12.6476C1 12.6476 5 4.64762 12 4.64762C19 4.64762 23 12.6476 23 12.6476C23 12.6476 19 20.6476 12 20.6476C5 20.6476 1 12.6476 1 12.6476ZM12 15.6476C13.6569 15.6476 15 14.3045 15 12.6476C15 10.9908 13.6569 9.64762 12 9.64762C10.3431 9.64762 9 10.9908 9 12.6476C9 14.3045 10.3431 15.6476 12 15.6476Z"
                                                label="Lihat" color="blue" />

                                            {{-- Arsip --}}
                                            <button type="button" title="Arsip"
                                                onclick="document.getElementById('confirm-archive-{{ $outgoingMail->id }}').classList.remove('hidden')"
                                                class="inline-flex items-center justify-center w-9 h-9 rounded-full bg-green-500 hover:bg-green-600 text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="25"
                                                    viewBox="0 0 24 25" fill="none">
                                                    <path
                                                        d="M12 18.9429L16 14.9429L14.6 13.5429L13 15.1429V10.9429H11V15.1429L9.4 13.5429L8 14.9429L12 18.9429ZM5 8.94287V19.9429H19V8.94287H5ZM5 21.9429C4.45 21.9429 3.975 21.7512 3.575 21.3679C3.19167 20.9679 3 20.4929 3 19.9429V7.46787C3 7.23454 3.03333 7.00954 3.1 6.79287C3.18333 6.5762 3.3 6.3762 3.45 6.19287L4.7 4.66787C4.88333 4.43454 5.10833 4.25954 5.375 4.14287C5.65833 4.00954 5.95 3.94287 6.25 3.94287H17.75C18.05 3.94287 18.3333 4.00954 18.6 4.14287C18.8833 4.25954 19.1167 4.43454 19.3 4.66787L20.55 6.19287C20.7 6.3762 20.8083 6.5762 20.875 6.79287C20.9583 7.00954 21 7.23454 21 7.46787V19.9429C21 20.4929 20.8 20.9679 20.4 21.3679C20.0167 21.7512 19.55 21.9429 19 21.9429H5ZM5.4 6.94287H18.6L17.75 5.94287H6.25L5.4 6.94287Z"
                                                        fill="white" />
                                                </svg>
                                            </button>

                                            <!-- Modalnya -->
                                            <x-confirm-modal modalId="confirm-archive-{{ $outgoingMail->id }}"
                                                title="Arsipkan Surat"
                                                message="Apakah Anda yakin ingin mengarsipkan surat ini? Surat akan dipindahkan ke arsip dan tidak bisa diubah."
                                                action="{{ route('surat-keluar.archive', $outgoingMail->id) }}"
                                                method="PATCH" confirmLabel="Arsipkan" icon="🗃️" buttonColor="blue" />


                                            {{-- Hapus --}}
                                            <x-form-button :action="route('surat-keluar.destroy', $outgoingMail->id)"
                                                icon="M6.5 21.9429C5.95 21.9429 5.47917 21.747 5.0875 21.3554C4.69583 20.9637 4.5 20.4929 4.5 19.9429V6.94286H3.5V4.94286H8.5V3.94286H14.5V4.94286H19.5V6.94286H18.5V19.9429C18.5 20.4929 18.3042 20.9637 17.9125 21.3554C17.5208 21.747 17.05 21.9429 16.5 21.9429H6.5ZM16.5 6.94286H6.5V19.9429H16.5V6.94286ZM8.5 17.9429H10.5V8.94286H8.5V17.9429ZM12.5 17.9429H14.5V8.94286H12.5V17.9429Z"
                                                label="Hapus" color="red" method="DELETE" />
                                            @elserole('pimpinan')

                                            {{-- Disposisi --}}
                                            <x-action-button href="{{ route('disposisi.create', $outgoingMail->id) }}"
                                                icon="M3 20.9429V4.94286L22 12.9429L3 20.9429ZM5 17.9429L16.85 12.9429L5 7.94286V11.4429L11 12.9429L5 14.4429V17.9429Z"
                                                label="Disposisi" color="orange" />

                                            <x-action-button href="{{ route('surat-keluar.show', $outgoingMail->id) }}"
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
            <x-pagination :paginator="$outgoingMails" />
        </div>
    </div>
</x-app-layout>
