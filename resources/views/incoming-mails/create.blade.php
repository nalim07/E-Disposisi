<x-app-layout>
    <div class="flex flex-col bg-primary shadow-sm">
        <!-- Header Section -->
        <div class="flex items-center gap-3 px-6 py-7 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-14" viewBox="0 0 48 55" fill="none">
                <path
                    d="M8 45.8333C6.9 45.8333 5.95867 45.3849 5.176 44.4881C4.39333 43.5913 4.00133 42.5119 4 41.25V13.75C4 12.4896 4.392 11.411 5.176 10.5142C5.96 9.61737 6.90133 9.1682 8 9.16667H40C41.1 9.16667 42.042 9.61584 42.826 10.5142C43.61 11.4125 44.0013 12.4911 44 13.75V41.25C44 42.5104 43.6087 43.5898 42.826 44.4881C42.0433 45.3865 41.1013 45.8349 40 45.8333H8ZM24 29.7917L40 18.3333V13.75L24 25.2083L8 13.75V18.3333L24 29.7917Z"
                    fill="currentColor" />
            </svg>
            <h1 class="text-3xl font-bold">Tambah Surat Masuk</h1>
        </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('surat-masuk.store') }}" enctype="multipart/form-data"
        class="flex flex-col mt-4 gap-8 p-6 bg-white">
        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Kolom Kiri -->
            <div class="space-y-6">
                <!-- Nomor Surat -->
                <div class="space-y-2">
                    <label for="mail_number" class="block text-sm font-medium text-gray-700">Nomor Surat <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="mail_number" name="mail_number"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mail_number') border-red-500 @enderror"
                        value="{{ old('mail_number') }}" required aria-required="true">
                    @error('mail_number')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Pengirim -->
                <div class="space-y-2">
                    <label for="sender" class="block text-sm font-medium text-gray-700">Pengirim <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="sender" name="sender"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sender') border-red-500 @enderror"
                        value="{{ old('sender') }}" required aria-required="true">
                    @error('sender')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Perihal -->
                <div class="space-y-2">
                    <label for="subject" class="block text-sm font-medium text-gray-700">Perihal <span
                            class="text-red-500">*</span></label>
                    <textarea id="subject" name="subject" rows="3"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('subject') border-red-500 @enderror"
                        required aria-required="true">{{ old('subject') }}</textarea>
                    @error('subject')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="space-y-6">
                <!-- Tanggal Surat -->
                <div class="space-y-2">
                    <label for="mail_date" class="block text-sm font-medium text-gray-700">Tanggal Surat <span
                            class="text-red-500">*</span></label>
                    <input type="date" id="mail_date" name="mail_date"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('mail_date') border-red-500 @enderror"
                        value="{{ old('mail_date') }}" required>
                    @error('mail_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tanggal Terima -->
                <div class="space-y-2">
                    <label for="received_date" class="block text-sm font-medium text-gray-700">Tanggal Terima
                        <span class="text-red-500">*</span></label>
                    <input type="date" id="received_date" name="received_date"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('received_date') border-red-500 @enderror"
                        value="{{ old('received_date') }}" required aria-required="true">
                    @error('received_date')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- File Upload -->
                <div class="space-y-2">
                    <label for="file_path" class="block text-sm font-medium text-gray-700">Unggah File <span
                            class="text-red-500">*</span></label>
                    <div
                        class="flex items-center gap-4 p-4 border rounded-lg @error('file_path') border-red-500 @enderror">
                        <input type="file" id="file_path" name="file_path" class="hidden"
                            accept=".pdf,.jpg,.jpeg,.png" required area-required="true">
                        <label for="file_path"
                            class="px-4 py-2 text-white bg-blue-600 rounded-lg cursor-pointer hover:bg-blue-700">
                            Pilih File
                        </label>
                        <span class="text-sm text-gray-500" id="file-name">
                            {{ old('file_path') ?? 'Format: PDF, JPG, PNG (Maks. 2MB)' }}
                        </span>
                    </div>
                    @error('file_path')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Created By (Hidden Input) -->
        <input type="hidden" name="created_by" value="{{ auth()->id() }}">

        <!-- Action Buttons -->
        <div class="flex gap-4 mt-8">
            <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700">
                Simpan
            </button>
            <button type="button" onclick="window.history.back()"
                class="px-6 py-2 text-gray-700 bg-gray-200 rounded-lg shadow hover:bg-gray-300">
                Batal
            </button>
        </div>
    </form>
</x-app-layout>

<script>
    // File upload handler
    document.getElementById('file_path').addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name || 'Format: PDF, JPG, PNG (Maks. 2MB)';
        document.getElementById('file-name').textContent = fileName;
    });
</script>
