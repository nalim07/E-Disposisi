<x-app-layout>
    <div class="flex flex-col bg-primary shadow-sm">
        <!-- Header Section -->
        <div class="flex items-center gap-3 px-6 py-7 text-white">
            <svg xmlns="http://www.w3.org/2000/svg" width="49" height="55" viewBox="0 0 49 55" fill="none">
                <path
                    d="M42.9391 16.4367L26.2322 7.34003C25.6931 7.04858 25.1005 6.89705 24.5 6.89705C23.8995 6.89705 23.3069 7.04858 22.7678 7.34003L6.06088 16.4367C5.16127 16.9177 4.40284 17.6683 3.87253 18.6025C3.34222 19.5367 3.06148 20.6167 3.0625 21.7186V41.1892C3.0625 44.446 5.49528 47.0954 8.486 47.0954H40.514C43.5047 47.0954 45.9375 44.446 45.9375 41.1892V21.7186C45.9385 20.6167 45.6578 19.5367 45.1275 18.6025C44.5972 17.6683 43.8387 16.9177 42.9391 16.4367ZM24.1536 10.3585C24.2614 10.3003 24.3799 10.27 24.5 10.27C24.6201 10.27 24.7386 10.3003 24.8464 10.3585L41.0566 19.1821L24.5957 28.1469C24.4879 28.2052 24.3694 28.2355 24.2493 28.2355C24.1292 28.2355 24.0106 28.2052 23.9028 28.1469L7.68975 19.3223L24.1536 10.3585Z"
                    fill="#F5F5F5" />
            </svg>
            <h1 class="text-3xl font-bold">Tambah Surat Keluar</h1>
        </div>
    </div>

    <!-- Form Container -->
    <form method="POST" action="{{ route('surat-keluar.store') }}" enctype="multipart/form-data"
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

                <!-- Tujuan -->
                <div class="space-y-2">
                    <label for="purpose" class="block text-sm font-medium text-gray-700">Tujuan <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="purpose" name="purpose"
                        class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('purpose') border-red-500 @enderror"
                        value="{{ old('purpose') }}" required aria-required="true">
                    @error('purpose')
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
        {{-- <input type="hidden" name="created_by" value="{{ auth()->id() }}"> --}}

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
