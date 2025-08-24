<x-app-layout>
    <x-slot name="title">Arsip</x-slot>

    <!-- Flash Messages -->
    <div class="max-w-7xl mx-auto py-2 px-4 sm:px-6 lg:px-8">
        <x-flash-message type="success" :message="session('success')" />
        <x-flash-message type="error" :message="session('error')" />
        <x-flash-message type="info" :message="session('info')" class="font-medium text-sm text-blue-600" />
    </div>

    <div class="flex bg-primary shadow-sm">
        <div class="py-7 px-6 flex items-center justify-between text-white w-full">
            <!-- Judul dan Tombol Create -->
            <div class="flex items-center space-x-4">
                <!-- Logo SVG -->
                <svg xmlns="http://www.w3.org/2000/svg" width="49" height="55" viewBox="0 0 47 41" fill="none">
                    <path
                        d="M0.108625 14.7289L8.6025 38.7272C8.89264 39.5289 9.68347 40.0939 10.6158 40.0956H44.5825C44.6674 40.0956 44.7506 40.0906 44.8319 40.0806L44.8213 40.0822L44.885 40.0722C44.9409 40.0648 44.9964 40.0547 45.0513 40.0422L45.1185 40.0272C45.1728 40.0139 45.2282 39.9984 45.2849 39.9806L45.3485 39.9589C45.4016 39.94 45.4571 39.9172 45.5148 39.8906L45.5661 39.8672C45.636 39.8337 45.7033 39.7959 45.7678 39.7539L45.7608 39.7589C45.8264 39.7179 45.889 39.6728 45.9483 39.6239L45.9448 39.6256L45.9943 39.5839L46.1128 39.4772L46.1677 39.4206C46.2038 39.3821 46.2381 39.342 46.2703 39.3006L46.3004 39.2656L46.3145 39.2456C46.3546 39.1922 46.3918 39.1367 46.426 39.0789L46.4384 39.0606C46.4751 38.9987 46.5076 38.9347 46.5357 38.8689L46.541 38.8556L46.5534 38.8239C46.5781 38.7661 46.5994 38.7072 46.6171 38.6472C46.6171 38.6272 46.6294 38.6072 46.633 38.5856C46.6459 38.5367 46.6577 38.4845 46.6684 38.4289C46.6684 38.4039 46.6772 38.3789 46.6807 38.3539L46.6949 38.2122C46.6984 38.1656 46.6949 38.1556 46.6949 38.1272V2.09558C46.6949 1.56716 46.4729 1.06022 46.0775 0.685476C45.682 0.310737 45.1452 0.0986635 44.5843 0.0955811L27.6 0.0955811C27.037 0.0955811 26.497 0.306295 26.0988 0.681368C25.7007 1.05644 25.477 1.56515 25.477 2.09558V4.09558H10.6158C10.0528 4.09558 9.51277 4.30629 9.11463 4.68137C8.71648 5.05644 8.49281 5.56515 8.49281 6.09558V12.0956H2.12373C1.78649 12.0959 1.45418 12.1719 1.15432 12.3173C0.854462 12.4627 0.595686 12.6733 0.399422 12.9316C0.203157 13.19 0.075051 13.4887 0.0257121 13.803C-0.0236267 14.1173 0.00722142 14.4381 0.115702 14.7389L0.110394 14.7256L0.108625 14.7289ZM42.4595 4.09558V25.7672L38.1037 13.4589C37.963 13.0607 37.6928 12.7142 37.3315 12.4686C36.9701 12.223 36.5359 12.0908 36.0904 12.0906H12.7389V8.09558H27.6C28.1631 8.09558 28.7031 7.88487 29.1012 7.50979C29.4994 7.13472 29.7231 6.62601 29.7231 6.09558V4.09725L42.4595 4.09558ZM5.06943 16.0956H34.5618L41.6385 36.0956H12.1462L5.06943 16.0956Z"
                        fill="#F5F5F5" />
                </svg>

                <h1 class="text-3xl font-bold mx-4">Arsip</h1>
            </div>

            <!-- Grup Kanan: Form Pencarian -->
            <div class="flex items-center">
                <form action="" method="GET" class="flex bg-[#ECE6F0] rounded-full px-4 py-2">
                    <input type="search" name="q" id="q" placeholder="Ketik untuk mencari data"
                        class="w-72 px-2 py-2 text-base text-gray-800 font-normal border-none bg-transparent focus:ring-0 focus:outline-none"
                        value="{{ request('q') }}" />
                    <button type="submit" class="pr-2 py-2 bg-transparent">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-gray-600">
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
                            <x-table-header>Tanggal</x-table-header>
                            <x-table-header>Aksi</x-table-header>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($archives as $archive)
                            <tr>
                                <x-table-cell class="text-center whitespace-nowrap">{{ $loop->iteration }}
                                </x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    {{ $archive->outgoingMail->mail_number ?? '-' }}</x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    {{ $archive->outgoingMail->purpose ?? '-' }}</x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    {{ $archive->outgoingMail->subject ?? '-' }}</x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    <div class="space-y-1">
                                        <div>Tgl Surat:
                                            {{ $archive->outgoingMail->mail_date ? \Carbon\Carbon::parse($archive->outgoingMail->mail_date)->format('d-m-Y') : '-' }}
                                        </div>
                                        <div>Tgl Arsip:
                                            {{ $archive->archived_at ? \Carbon\Carbon::parse($archive->archived_at)->format('d-m-Y') : '-' }}
                                        </div>
                                    </div>
                                </x-table-cell>
                                <x-table-cell class="text-center whitespace-nowrap">
                                    {{-- Download --}}
                                    <x-action-button href="{{ route('arsip.download', $archive->id) }}"
                                        icon="M11.5 16L6.5 11L7.9 9.55L10.5 12.15V4H12.5V12.15L15.1 9.55L16.5 11L11.5 16ZM5.5 20C4.95 20 4.47917 19.8042 4.0875 19.4125C3.69583 19.0208 3.5 18.55 3.5 18V15H5.5V18H17.5V15H19.5V18C19.5 18.55 19.3042 19.0208 18.9125 19.4125C18.5208 19.8042 18.05 20 17.5 20H5.5Z"
                                        label="Download" color="green" />

                                    {{-- Show --}}
                                    <x-action-button href="{{ route('arsip.show', $archive->id) }}"
                                        icon="M1 12.6476C1 12.6476 5 4.64762 12 4.64762C19 4.64762 23 12.6476 23 12.6476C23 12.6476 19 20.6476 12 20.6476C5 20.6476 1 12.6476 1 12.6476ZM12 15.6476C13.6569 15.6476 15 14.3045 15 12.6476C15 10.9908 13.6569 9.64762 12 9.64762C10.3431 9.64762 9 10.9908 9 12.6476C9 14.3045 10.3431 15.6476 12 15.6476Z"
                                        label="Lihat" color="blue" />
                                </x-table-cell>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                    Tidak ada arsip yang ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

            <!-- Pagination -->
            <x-pagination :paginator="$archives" />
        </div>
    </div>
</x-app-layout>
