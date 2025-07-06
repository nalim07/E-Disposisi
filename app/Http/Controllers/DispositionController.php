<?php

namespace App\Http\Controllers;

use id;
use App\Models\User;
use App\Models\Employee;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Models\IncomingMails;
use Illuminate\Support\Facades\Auth;

class DispositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('disposisi.index', [
            'dispositions' => Disposition::with(['incomingMail', 'recipient'])->get(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(IncomingMails $incomingMail)
    {
        $employees = Employee::with('position')
            ->get()
            ->unique(fn($item) => $item->position->id); // atau $item->position_id


        return view('disposisi.create', compact('incomingMail', 'employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'incoming_mail_id' => 'required|exists:incoming_mails,id',
            'recipient_id' => 'required|exists:users,id',
            'content' => 'required',
            'deadline' => 'required|date',
            'priority' => 'required|in:Penting,Biasa,Segera',
            'notes' => 'nullable',
        ]);

        Disposition::create([
            'incoming_mail_id' => $request->incoming_mail_id,
            'recipient_id' => $request->recipient_id,
            'content' => $request->content,
            'deadline' => $request->deadline,
            'priority' => $request->priority,
            'notes' => $request->notes,
            'created_by' => Auth::id(),
        ]);

        IncomingMails::where('id', $request->incoming_mail_id)->update([
            'is_disposed' => true,
        ]);

        return redirect()->route('surat-masuk.index')->with('success', 'Disposisi berhasil dibuat.');
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
