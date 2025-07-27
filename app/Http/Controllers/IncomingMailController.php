<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Models\IncomingMails;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class IncomingMailController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Admin melihat semua surat masuk
            $incomingMails = IncomingMails::orderBy('received_date', 'asc')->paginate(5);
        } elseif ($user->hasRole('pimpinan')) {
            // Pimpinan hanya melihat yang sudah ditindaklanjuti
            $incomingMails = IncomingMails::where('status', 'Sudah Ditindaklanjuti')
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
                $originalName = $file->getClientOriginalName();
                $path = $file->store('surat-masuk', 'public');

                $validated['file_path'] = $path;
                $validated['original_name'] = $originalName; // simpan nama asli
            }

            IncomingMails::create($validated);

            return redirect()->route('surat-masuk.index')
                ->with('success', 'Data berhasil disimpan!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menyimpan data: ' . $e->getMessage());
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

        // Handle file upload jika ada file baru
        if ($request->hasFile('file_path')) {
            // Hapus file lama jika ada
            if ($incomingMail->file_path) {
                Storage::delete($incomingMail->file_path);
            }

            $file = $request->file('file_path')->store('surat-masuk');
            $validated['file_path'] = $file;
            $validated['original_name'] = $request->file('file_path')->getClientOriginalName();
        }

        $incomingMail->update($validated);

        return redirect()->route('surat-masuk.index')->with('success', 'Data surat berhasil diperbarui.');
    }

    public function send(IncomingMails $incomingMail)
    {
        if ($incomingMail->status === 'Belum diteruskan') {
            $incomingMail->update(['status' => 'Sudah Ditindaklanjuti']);
        }

        return redirect()->route('surat-masuk.index');
    }

    public function destroy(IncomingMails $incomingMail)
    {
        $incomingMail->delete();

        return redirect()->route('surat-masuk.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
