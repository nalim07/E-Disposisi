<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Models\IncomingMails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class IncomingMailController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $query = IncomingMails::query();

        // Handle search functionality
        if ($request->has('q') && $request->q != '') {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('mail_number', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('sender', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('subject', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($user->hasRole('admin')) {
            // Admin melihat semua surat masuk
            $incomingMails = $query->orderBy('received_date', 'asc')->paginate(5);
        } elseif ($user->hasRole('pimpinan')) {
            // Pimpinan hanya melihat yang sudah ditindaklanjuti
            $incomingMails = $query->where('status', 'Sudah Ditindaklanjuti')
                ->where('is_disposed', false)
                ->orderByDesc('received_date')
                ->paginate(5);
        } else {
            // Role lain tidak mendapat surat masuk
            $incomingMails = collect();
        }

        return view('incoming-mails.index', compact('incomingMails'));
    }

    public function create(): View
    {
        return view('incoming-mails.create');
    }

    // IncomingMailController.php
    public function store(Request $request)
    {
        // Validasi
        $validated = $request->validate([
            'mail_number' => 'required|string|max:255',
            'sender' => 'required|string|max:255',
            'subject' => 'required|string',
            'mail_date' => 'required|date',
            'received_date' => 'required|date|after_or_equal:mail_date',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'created_by' => 'required|exists:users,id'
        ]);

        // Set default status
        $validated['status'] = 'Belum diteruskan';
        // $validated['created_by'] = auth()->user()->id;

        try {
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');

                // Validasi file lebih lanjut untuk mencegah file korup
                if (!$this->isValidFile($file)) {
                    return back()->withInput()
                        ->with('error', 'File yang diunggah tidak valid atau korup. Silakan periksa file Anda.');
                }

                $originalName = $file->getClientOriginalName();

                // Generate nama file unik untuk mencegah konflik
                $fileName = time() . '_' . $originalName;
                $path = $file->storeAs('surat-masuk', $fileName, 'public');

                // Verifikasi file berhasil disimpan
                if (!$path || !Storage::disk('public')->exists($path)) {
                    return back()->withInput()
                        ->with('error', 'Gagal menyimpan file. Silakan coba lagi.');
                }

                $validated['file_path'] = $path;
                $validated['original_name'] = $originalName; // simpan nama asli
            }

            $incomingMail = IncomingMails::create($validated);

            if ($incomingMail) {
                return redirect()->route('surat-masuk.index')
                    ->with('success', 'Surat masuk berhasil ditambahkan!');
            } else {
                // Hapus file jika penyimpanan data gagal
                if (isset($path)) {
                    Storage::disk('public')->delete($path);
                }
                return back()->withInput()
                    ->with('error', 'Gagal menyimpan data surat masuk. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            // Hapus file jika terjadi error
            if (isset($path)) {
                Storage::disk('public')->delete($path);
            }
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan surat masuk: ' . $e->getMessage());
        }
    }

    public function show(IncomingMails $incomingMail)
    {
        return view('incoming-mails.show', compact('incomingMail'));
    }

    public function edit(IncomingMails $incomingMail)
    {
        return view('incoming-mails.edit', compact('incomingMail'));
    }

    public function update(Request $request, IncomingMails $incomingMail)
    {
        $validated = $request->validate([
            'mail_number' => 'required|string|max:255|unique:incoming_mails,mail_number,' . $incomingMail->id,
            'sender' => 'required|string|max:255',
            'subject' => 'required|string|max:500',
            'mail_date' => 'required|date',
            'received_date' => 'required|date',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            $oldFilePath = $incomingMail->file_path;
            $fileUpdated = false;

            // Handle file upload jika ada file baru
            if ($request->hasFile('file_path')) {
                $file = $request->file('file_path');

                // Validasi file lebih lanjut untuk mencegah file korup
                if (!$this->isValidFile($file)) {
                    return back()->withInput()
                        ->with('error', 'File yang diunggah tidak valid atau korup. Silakan periksa file Anda.');
                }

                // Hapus file lama jika ada
                if ($oldFilePath && Storage::disk('public')->exists($oldFilePath)) {
                    Storage::disk('public')->delete($oldFilePath);
                }

                $originalName = $file->getClientOriginalName();
                // Generate nama file unik untuk mencegah konflik
                $fileName = time() . '_' . $originalName;
                $newPath = $file->storeAs('surat-masuk', $fileName, 'public');

                // Verifikasi file berhasil disimpan
                if (!$newPath || !Storage::disk('public')->exists($newPath)) {
                    // Kembalikan file lama jika penyimpanan file baru gagal
                    if ($oldFilePath) {
                        Storage::disk('public')->move($oldFilePath, $incomingMail->file_path);
                    }
                    return back()->withInput()
                        ->with('error', 'Gagal menyimpan file baru. Silakan coba lagi.');
                }

                $validated['file_path'] = $newPath;
                $validated['original_name'] = $originalName;
                $fileUpdated = true;
            }

            $result = $incomingMail->update($validated);

            if ($result) {
                $message = $fileUpdated ?
                    'Data surat dan file berhasil diperbarui.' :
                    'Data surat berhasil diperbarui.';
                return redirect()->route('surat-masuk.index')->with('success', $message);
            } else {
                // Kembalikan file lama jika update data gagal
                if ($fileUpdated && $oldFilePath) {
                    Storage::disk('public')->delete($validated['file_path']);
                    $validated['file_path'] = $oldFilePath;
                    $incomingMail->update(['file_path' => $oldFilePath]);
                }
                return back()->withInput()
                    ->with('error', 'Gagal memperbarui data surat. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            // Kembalikan file lama jika terjadi error
            if ($fileUpdated && $oldFilePath) {
                Storage::disk('public')->delete($validated['file_path'] ?? '');
                $validated['file_path'] = $oldFilePath;
                $incomingMail->update(['file_path' => $oldFilePath]);
            }
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui surat: ' . $e->getMessage());
        }
    }

    public function send(IncomingMails $incomingMail)
    {
        try {
            if ($incomingMail->status === 'Belum diteruskan') {
                $result = $incomingMail->update(['status' => 'Sudah Ditindaklanjuti']);

                if ($result) {
                    return redirect()->route('surat-masuk.index')
                        ->with('success', 'Surat berhasil dikirim untuk ditindaklanjuti.');
                } else {
                    return back()->with('error', 'Gagal mengirim surat. Silakan coba lagi.');
                }
            } else {
                return redirect()->route('surat-masuk.index')
                    ->with('info', 'Surat sudah dalam status ditindaklanjuti.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengirim surat: ' . $e->getMessage());
        }
    }

    public function destroy(IncomingMails $incomingMail)
    {
        try {
            // Delete the associated file if it exists
            if ($incomingMail->file_path && Storage::disk('public')->exists($incomingMail->file_path)) {
                $fileDeleted = Storage::disk('public')->delete($incomingMail->file_path);

                if (!$fileDeleted) {
                    return back()->with('error', 'Gagal menghapus file surat. Silakan coba lagi.');
                }
            }

            $result = $incomingMail->delete();

            if ($result) {
                return redirect()->route('surat-masuk.index')
                    ->with('success', 'Surat masuk berhasil dihapus!');
            } else {
                return back()->with('error', 'Gagal menghapus surat masuk. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus surat: ' . $e->getMessage());
        }
    }

    /**
     * Validasi file untuk mencegah file korup
     */
    private function isValidFile($file)
    {
        // Cek ukuran file
        if ($file->getSize() == 0) {
            return false;
        }

        // Cek tipe mime
        $allowedMimes = ['application/pdf', 'image/jpeg', 'image/png'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            return false;
        }

        // Validasi tambahan berdasarkan ekstensi
        $extension = $file->getClientOriginalExtension();
        switch ($extension) {
            case 'pdf':
                // Cek header PDF
                $header = file_get_contents($file->getPathname(), false, null, 0, 4);
                if ($header !== '%PDF') {
                    return false;
                }
                break;
            case 'jpg':
            case 'jpeg':
                // Cek header JPEG
                $header = file_get_contents($file->getPathname(), false, null, 0, 2);
                if ($header !== "\xFF\xD8") {
                    return false;
                }
                break;
            case 'png':
                // Cek header PNG
                $header = file_get_contents($file->getPathname(), false, null, 0, 8);
                if ($header !== "\x89PNG\r\n\x1A\n") {
                    return false;
                }
                break;
        }

        return true;
    }
}
