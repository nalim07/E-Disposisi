<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutgoingMailController extends Controller
{
    public function index()
    {
        // Logic to retrieve outgoing mails
        return view('outgoing-mails.index');
    }

    public function create()
    {
        // Logic to show form for creating a new outgoing mail
        return view('outgoing-mails.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new outgoing mail
        // Validate and save the data
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil disimpan!');
    }

    public function show($id)
    {
        // Logic to show a specific outgoing mail
        return view('outgoing-mails.show', compact('id'));
    }

    public function edit($id)
    {
        // Logic to show form for editing an existing outgoing mail
        return view('outgoing-mails.edit', compact('id'));
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing outgoing mail
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        // Logic to delete an outgoing mail
        return redirect()->route('surat-keluar.index')->with('success', 'Surat keluar berhasil dihapus!');
    }
}
