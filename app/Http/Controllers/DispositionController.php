<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Models\IncomingMails;

class DispositionController extends Controller
{
    public function kirim(IncomingMails $incomingMail)
    {
        $pimpinan = User::role('pimpinan')->first();

        if (!$pimpinan) {
            return back()->with('error', 'User dengan role pimpinan belum tersedia.');
        }

        Disposition::create([
            'incoming_mail_id' => $incomingMail->id,
            'recipient_id' => $pimpinan->id,
            'deadline' => now()->addDays(3),
            'content' => 'Silakan ditindaklanjuti.',
            'priority' => 'Biasa',
            // 'created_by' => auth()->id(),
        ]);

        $incomingMail->update(['status' => 'Sudah diteruskan']);

        return redirect()->route('surat-masuk.index')->with('success', 'Surat berhasil dikirim ke pimpinan.');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
