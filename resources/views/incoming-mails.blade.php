<x-app-layout>
    <div class="flex bg-primary overflow-hidden shadow-sm justify-start">
        <div class="py-7 px-6 flex items-center gap-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="55" viewBox="0 0 48 55" fill="none">
                <path
                    d="M8 45.8333C6.9 45.8333 5.95867 45.3849 5.176 44.4881C4.39333 43.5913 4.00133 42.5119 4 41.25V13.75C4 12.4896 4.392 11.411 5.176 10.5142C5.96 9.61737 6.90133 9.1682 8 9.16667H40C41.1 9.16667 42.042 9.61584 42.826 10.5142C43.61 11.4125 44.0013 12.4911 44 13.75V41.25C44 42.5104 43.6087 43.5898 42.826 44.4881C42.0433 45.3865 41.1013 45.8349 40 45.8333H8ZM24 29.7917L40 18.3333V13.75L24 25.2083L8 13.75V18.3333L24 29.7917Z"
                    fill="#F5F5F5" />
            </svg>
            <h1 class="text-3xl font-bold">Surat Masuk</h1>
        </div>
        {{-- Table --}}
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mt-6">
            <div class="p-6 bg-white border-b border-gray-200">
                <div class="flex justify-between">
                    <div>
                        <a href="{{ route('surat-masuk.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600">
                            Tambah Surat Masuk
                        </a>
                    </div>
                </div>
                <div class="mt-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor Surat
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Tanggal Surat
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Pengirim
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Perihal
                                </th>
                                <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Aksi
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($incomingMails as $incomingMail)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $incomingMails->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $incomingMail->number }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $incomingMail->date }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $incomingMail->sender }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $incomingMail->subject }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        <a href="{{ route('surat-masuk.edit', $incomingMail->id) }}"
                                            class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        Tidak ada data
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Pagination --}}
        <div class="mt-4">
            {{ $incomingMails->links() }}
        </div>
    </div>
</x-app-layout>
