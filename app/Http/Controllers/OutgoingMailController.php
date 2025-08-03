<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use App\Models\OutgoingMails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OutgoingMailController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            $outgoingMails = OutgoingMails::orderBy('created_at', 'desc')->paginate(10);
        } else {
            $outgoingMails = collect(); // Atur sesuai kebutuhan role lainnya
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

        $file = $request->file('file_path');
        $storedPath = $file->store('outgoing-mails', 'public');

        OutgoingMails::create([
            'mail_number' => $request->mail_number,
            'purpose' => $request->purpose,
            'subject' => $request->subject,
            'mail_date' => $request->mail_date,
            'received_date' => $request->received_date,
            'file_path' => $storedPath,
            'original_name' => $file->getClientOriginalName(),
            'status' => 'sudah Ditindaklanjuti', // default saat dibuat
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil disimpan!');
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
        // $mail = OutgoingMails::findOrFail($id);

        $request->validate([
            'mail_number' => 'required|string|max:255',
            'purpose' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'mail_date' => 'required|date',
            'received_date' => 'required|date',
            'file_path' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            if ($outgoingMail->file_path) {
                Storage::disk('public')->delete($outgoingMail->file_path);
            }
            $file = $request->file('file_path');
            $path = $file->store('outgoing-mails', 'public');
            $outgoingMail->file_path = $path;
            $outgoingMail->original_name = $file->getClientOriginalName();
        }

        $outgoingMail->update([
            'mail_number' => $request->mail_number,
            'purpose' => $request->purpose,
            'subject' => $request->subject,
            'mail_date' => $request->mail_date,
            'received_date' => $request->received_date,
        ]);

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui!');
    }

    public function destroy(OutgoingMails $outgoingMail)
    {
        // $mail = OutgoingMails::findOrFail($id);

        if ($outgoingMail->file_path) {
            Storage::disk('public')->delete($outgoingMail->file_path);
        }

        $outgoingMail->delete();

        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus!');
    }

    // 🔐 Tambahan: arsipkan surat
    public function archive(OutgoingMails $outgoingMail)
    {
        $outgoingMail->status = 'Arsip';
        $outgoingMail->save();

        // Opsional: buat entri di tabel `archives`
        Archive::create([
            'outgoing_mail_id' => $outgoingMail->id,
            'archived_by' => Auth::id(),
            'archived_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Surat berhasil diarsipkan.');
    }
}
