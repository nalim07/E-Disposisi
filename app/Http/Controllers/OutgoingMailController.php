<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use App\Models\OutgoingMails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OutgoingMailController extends Controller
{

    public function index(Request $request)
    {
        $user = Auth::user();
        $query = OutgoingMails::query();

        // Handle search functionality
        if ($request->has('q') && $request->q != '') {
            $searchTerm = $request->q;
            $query->where(function($q) use ($searchTerm) {
                $q->where('mail_number', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('purpose', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('subject', 'LIKE', "%{$searchTerm}%");
            });
        }

        if ($user->hasRole('admin')) {
            $outgoingMails = $query->where('status', 'Sudah Ditindaklanjuti')->paginate(5);
        } else {
            $outgoingMails = collect();
        }

        return view('outgoing-mails.index', compact('outgoingMails'));
    }

    public function create()
    {
        return view('outgoing-mails.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mail_number' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'mail_date' => 'required|date',
            'received_date' => 'required|date',
            'file_path' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            $file = $request->file('file_path');

            // Validasi file lebih lanjut untuk mencegah file korup
            if (!$this->isValidFile($file)) {
                return back()->withInput()
                    ->with('error', 'File yang diunggah tidak valid atau korup. Silakan periksa file Anda.');
            }

            // Generate nama file unik untuk mencegah konflik
            $originalName = $file->getClientOriginalName();
            $fileName = time() . '_' . $originalName;
            $storedPath = $file->storeAs('outgoing-mails', $fileName, 'public');

            // Verifikasi file berhasil disimpan
            if (!$storedPath || !Storage::disk('public')->exists($storedPath)) {
                return back()->withInput()
                    ->with('error', 'Gagal menyimpan file. Silakan coba lagi.');
            }

            $outgoingMail = OutgoingMails::create([
                'mail_number' => $request->mail_number,
                'purpose' => $request->purpose,
                'subject' => $request->subject,
                'mail_date' => $request->mail_date,
                'received_date' => $request->received_date,
                'file_path' => $storedPath,
                'original_name' => $originalName,
                'status' => 'Sudah Ditindaklanjuti', // default saat dibuat
            ]);

            if ($outgoingMail) {
                return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil disimpan!');
            } else {
                // Hapus file jika penyimpanan data gagal
                Storage::disk('public')->delete($storedPath);
                return back()->withInput()
                    ->with('error', 'Gagal menyimpan data surat keluar. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            // Hapus file jika terjadi error
            if (isset($storedPath) && Storage::disk('public')->exists($storedPath)) {
                Storage::disk('public')->delete($storedPath);
            }
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan surat keluar: ' . $e->getMessage());
        }
    }

    public function show(OutgoingMails $outgoingMail)
    {
        return view('outgoing-mails.show', compact('outgoingMail'));
    }

    public function edit(OutgoingMails $outgoingMail)
    {
        return view('outgoing-mails.edit', compact('outgoingMail'));
    }

    public function update(Request $request, OutgoingMails $outgoingMail)
    {
        $request->validate([
            'mail_number' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'mail_date' => 'required|date',
            'received_date' => 'required|date',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        try {
            $oldFilePath = $outgoingMail->file_path;
            $fileUpdated = false;

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

                // Generate nama file unik untuk mencegah konflik
                $originalName = $file->getClientOriginalName();
                $fileName = time() . '_' . $originalName;
                $newPath = $file->storeAs('outgoing-mails', $fileName, 'public');

                // Verifikasi file berhasil disimpan
                if (!$newPath || !Storage::disk('public')->exists($newPath)) {
                    // Kembalikan file lama jika penyimpanan file baru gagal
                    if ($oldFilePath) {
                        Storage::disk('public')->move($oldFilePath, $outgoingMail->file_path);
                    }
                    return back()->withInput()
                        ->with('error', 'Gagal menyimpan file baru. Silakan coba lagi.');
                }

                $outgoingMail->file_path = $newPath;
                $outgoingMail->original_name = $originalName;
                $fileUpdated = true;
            }

            $result = $outgoingMail->update([
                'mail_number' => $request->mail_number,
                'purpose' => $request->purpose,
                'subject' => $request->subject,
                'mail_date' => $request->mail_date,
                'received_date' => $request->received_date,
            ]);

            if ($result) {
                $message = $fileUpdated ?
                    'Data surat keluar dan file berhasil diperbarui!' :
                    'Data surat keluar berhasil diperbarui!';
                return redirect()->route('surat-keluar.index')->with('success', $message);
            } else {
                // Kembalikan file lama jika update data gagal
                if ($fileUpdated && $oldFilePath) {
                    Storage::disk('public')->delete($outgoingMail->file_path);
                    $outgoingMail->update(['file_path' => $oldFilePath]);
                }
                return back()->withInput()
                    ->with('error', 'Gagal memperbarui data surat keluar. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            // Kembalikan file lama jika terjadi error
            if ($fileUpdated && $oldFilePath) {
                Storage::disk('public')->delete($outgoingMail->file_path);
                $outgoingMail->update(['file_path' => $oldFilePath]);
            }
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui surat keluar: ' . $e->getMessage());
        }
    }

    public function destroy(OutgoingMails $outgoingMail)
    {
        try {
            // Hapus file jika ada
            if ($outgoingMail->file_path && Storage::disk('public')->exists($outgoingMail->file_path)) {
                $fileDeleted = Storage::disk('public')->delete($outgoingMail->file_path);

                if (!$fileDeleted) {
                    return back()->with('error', 'Gagal menghapus file surat. Silakan coba lagi.');
                }
            }

            $result = $outgoingMail->delete();

            if ($result) {
                return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus!');
            } else {
                return back()->with('error', 'Gagal menghapus surat keluar. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus surat keluar: ' . $e->getMessage());
        }
    }

    // 🔐 Tambahan: arsipkan surat
    public function archive(OutgoingMails $outgoingMail)
    {
        try {
            $outgoingMail->status = 'Arsip';
            $result = $outgoingMail->save();

            if ($result) {
                // Opsional: buat entri di tabel `archives`
                Archive::create([
                    'outgoing_mail_id' => $outgoingMail->id,
                    'archived_by' => Auth::id(),
                    'archived_at' => now(),
                ]);

                return redirect()->back()->with('success', 'Surat berhasil diarsipkan.');
            } else {
                return back()->with('error', 'Gagal mengarsipkan surat. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengarsipkan surat: ' . $e->getMessage());
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
