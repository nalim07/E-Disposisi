<x-app-layout>
    <x-slot name="title">Disposisi</x-slot>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="session('error')" />
        <x-flash-message type="info" :message="session('info')" class="font-medium text-sm text-blue-600" />
    </div>

    <div class="flex bg-primary shadow-sm">
        <div class="py-7 px-6 flex items-center justify-between text-white w-full">
            <!-- Judul dan Tombol Create -->
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" width="37" height="45" viewBox="0 0 37 45" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M23.6564 0.729167C23.6564 0.57722 23.5961 0.431496 23.4886 0.324054C23.3812 0.216611 23.2354 0.15625 23.0835 0.15625H7.04183C5.37041 0.15625 3.76745 0.820218 2.58558 2.00209C1.40371 3.18396 0.739746 4.78692 0.739746 6.45833V38.5417C0.739746 40.2131 1.40371 41.816 2.58558 42.9979C3.76745 44.1798 5.37041 44.8438 7.04183 44.8438H29.9585C31.6299 44.8438 33.2329 44.1798 34.4147 42.9979C35.5966 41.816 36.2606 40.2131 36.2606 38.5417V15.9619C36.2606 15.8099 36.2002 15.6642 36.0928 15.5568C35.9853 15.4493 35.8396 15.389 35.6877 15.389H25.3752C24.9193 15.389 24.4822 15.2079 24.1598 14.8855C23.8375 14.5632 23.6564 14.126 23.6564 13.6702V0.729167ZM25.3752 23.0729C25.831 23.0729 26.2682 23.254 26.5905 23.5763C26.9128 23.8987 27.0939 24.3358 27.0939 24.7917C27.0939 25.2475 26.9128 25.6847 26.5905 26.007C26.2682 26.3293 25.831 26.5104 25.3752 26.5104H11.6252C11.1693 26.5104 10.7322 26.3293 10.4098 26.007C10.0875 25.6847 9.90641 25.2475 9.90641 24.7917C9.90641 24.3358 10.0875 23.8987 10.4098 23.5763C10.7322 23.254 11.1693 23.0729 11.6252 23.0729H25.3752ZM25.3752 32.2396C25.831 32.2396 26.2682 32.4207 26.5905 32.743C26.9128 33.0653 27.0939 33.5025 27.0939 33.9583C27.0939 34.4142 26.9128 34.8513 26.5905 35.1737C26.2682 35.496 25.831 35.6771 25.3752 35.6771H11.6252C11.1693 35.6771 10.7322 35.496 10.4098 35.1737C10.0875 34.8513 9.90641 34.4142 9.90641 33.9583C9.90641 33.5025 10.0875 33.0653 10.4098 32.743C10.7322 32.4207 11.1693 32.2396 11.6252 32.2396H25.3752Z"
                        fill="#F5F5F5" />
                </svg>

                <h1 class="text-3xl font-bold mr-4">Daftar Disposisi</h1>
            </div>
        </div>
    </div>

    {{-- table --}}
    <div class="py-10">
        <div class="w-full">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <x-table-header>
                                No</x-table-header>
                            <x-table-header>
                                Surat Masuk</x-table-header>
                            <x-table-header>
                                Penerima</x-table-header>
                            <x-table-header>
                                Isi Disposisi</x-table-header>
                            <x-table-header>
                                Batas Waktu</x-table-header>
                            <x-table-header>
                                Sifat</x-table-header>
                            <x-table-header class="px-6 py-3">Aksi</x-table-header>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($dispositions as $disposition)
                            <tr>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $loop->iteration }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $disposition->incomingMail->subject }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $disposition->recipient->username }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $disposition->content }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $disposition->deadline }}</x-table-cell>
                                <x-table-cell
                                    class="text-center whitespace-nowrap">{{ $disposition->priority }}</x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    <x-action-button href="{{ route('disposisi.show', $disposition->id) }}"
                                        icon="M1 12.6476C1 12.6476 5 4.64762 12 4.64762C19 4.64762 23 12.6476 23 12.6476C23 12.6476 19 20.6476 12 20.6476C5 20.6476 1 12.6476 1 12.6476ZM12 15.6476C13.6569 15.6476 15 14.3045 15 12.6476C15 10.9908 13.6569 9.64762 12 9.64762C10.3431 9.64762 9 10.9908 9 12.6476C9 14.3045 10.3431 15.6476 12 15.6476Z"
                                        label="Lihat" color="blue" />

                                    <x-action-button href="{{ route('disposisi.edit', $disposition->id) }}"
                                        icon="M1 12.6476C1 12.6476 5 4.64762 12 4.64762C19 4.64762 23 12.6476 23 12.6476C23 12.6476 19 20.6476 12 20.6476C5 20.6476 1 12.6476 1 12.6476ZM12 15.6476C13.6569 15.6476 15 14.3045 15 12.6476C15 10.9908 13.6569 9.64762 12 9.64762C10.3431 9.64762 9 10.9908 9 12.6476C9 14.3045 10.3431 15.6476 12 15.6476Z"
                                        label="Edit" color="yellow" />

                                    <x-form-button :action="route('disposisi.destroy', $disposition->id)"
                                        icon="M6.5 21.9429C5.95 21.9429 5.47917 21.747 5.0875 21.3554C4.69583 20.9637 4.5 20.4929 4.5 19.9429V6.94286H3.5V4.94286H8.5V3.94286H14.5V4.94286H19.5V6.94286H18.5V19.9429C18.5 20.4929 18.3042 20.9637 17.9125 21.3554C17.5208 21.747 17.05 21.9429 16.5 21.9429H6.5ZM16.5 6.94286H6.5V19.9429H16.5V6.94286ZM8.5 17.9429H10.5V8.94286H8.5V17.9429ZM12.5 17.9429H14.5V8.94286H12.5V17.9429Z"
                                        label="Hapus" color="red" method="DELETE" />
                                </x-table-cell>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-5 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <h3 class="text-lg font-medium text-gray-900">Tidak ada data disposisi</h3>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
