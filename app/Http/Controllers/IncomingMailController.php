<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\IncomingMails;

class IncomingMailController extends Controller
{
    public function index(): View
    {
        // $incomingMails = IncomingMails::with('user')->get();
        $incomingMails = IncomingMails::latest()->get();
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
            'status' => 'required|in:draft,sent',
            'created_by' => 'required|exists:users,id'
        ]);

        try {
            // Handle file upload
            if ($request->hasFile('file_path')) {
                $path = $request->file('file_path')->store('surat-masuk', 'public');
                $validated['file_path'] = $path;
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
        return $incomingMail->load('dispositions');
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

    public function destroy(IncomingMails $incomingMail)
    {
        $incomingMail->delete();
        return response()->noContent();
    }
}
