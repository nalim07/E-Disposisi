<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\IncomingMails;
use Illuminate\Support\Facades\Auth;

class IncomingMailController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        if ($user->hasRole('admin')) {
            // Admin melihat semua surat masuk
            $incomingMails = IncomingMails::orderBy('received_date', 'desc')->get();
        } elseif ($user->hasRole('pimpinan')) {
            // Pimpinan hanya melihat yang sudah ditindaklanjuti
            $incomingMails = IncomingMails::where('status', 'Sudah Ditindaklanjuti')
                ->orderBy('received_date', 'desc')
                ->get();
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

    public function update(Request $request, IncomingMails $incomingMail)
    {
        $validated = $request->validate([
            'reference_number' => 'sometimes|unique:incoming_mails,reference_number,' . $incomingMail->id,
            'sender' => 'sometimes',
            'subject' => 'sometimes',
            'received_date' => 'sometimes|date',
            'status' => 'sometimes',
            'user_id' => 'sometimes|exists:users,id'
        ]);

        $incomingMail->update($validated);
        return $incomingMail;
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
