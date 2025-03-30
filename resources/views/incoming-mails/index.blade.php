<x-app-layout>
    <div class="flex bg-primary overflow-hidden shadow-sm justify-start">
        <div class="py-7 px-6 flex items-center gap-3 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="55" viewBox="0 0 48 55" fill="none">
                <path
                    d="M8 45.8333C6.9 45.8333 5.95867 45.3849 5.176 44.4881C4.39333 43.5913 4.00133 42.5119 4 41.25V13.75C4 12.4896 4.392 11.411 5.176 10.5142C5.96 9.61737 6.90133 9.1682 8 9.16667H40C41.1 9.16667 42.042 9.61584 42.826 10.5142C43.61 11.4125 44.0013 12.4911 44 13.75V41.25C44 42.5104 43.6087 43.5898 42.826 44.4881C42.0433 45.3865 41.1013 45.8349 40 45.8333H8ZM24 29.7917L40 18.3333V13.75L24 25.2083L8 13.75V18.3333L24 29.7917Z"
                    fill="#F5F5F5" />
            </svg>
            <h1 class="mr-4 text-3xl font-bold">Surat Masuk</h1>

            <a href=""
                class="inline-flex items-center text-white text-xl font-semibold gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 30 29"
                    fill="none">
                    <path
                        d="M15 1.8125C11.5321 1.85318 8.2181 3.20295 5.76575 5.57356C3.3134 7.94417 1.91708 11.1477 1.875 14.5C1.91708 17.8523 3.3134 21.0558 5.76575 23.4264C8.2181 25.7971 11.5321 27.1468 15 27.1875C18.4679 27.1468 21.7819 25.7971 24.2343 23.4264C26.6866 21.0558 28.0829 17.8523 28.125 14.5C28.0829 11.1477 26.6866 7.94417 24.2343 5.57356C21.7819 3.20295 18.4679 1.85318 15 1.8125ZM22.5 15.4062H15.9375V21.75H14.0625V15.4062H7.5V13.5938H14.0625V7.25H15.9375V13.5938H22.5V15.4062Z"
                        fill="#F5F5F5" />
                </svg>
                Tambah Data
            </a>

        </div>
    </div>
    {{-- Table --}}
    <div class="bg-white overflow-hidden shadow-sm mt-6">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="mt-4">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                No
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nomor Surat
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal Surat
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Pengirim
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Perihal
                            </th>
                            <th scope="col"
                                class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href=""
                                    class="inline-flex items-center px-4 py-2 bg-blue-500 text-white font-semibold rounded-md shadow-sm hover:bg-blue-600">
                                    Edit
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="6" class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                Tidak ada data
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    {{-- Pagination --}}
    <div class="mt-4">

    </div>
</x-app-layout>
