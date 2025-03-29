<?php

namespace App\Http\Controllers;

use App\Models\IncomingMails;
use Illuminate\Http\Request;

class IncomingMailController extends Controller
{
    public function index()
    {
        return IncomingMails::with('user')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_number' => 'required|unique:incoming_mails',
            'sender' => 'required',
            'subject' => 'required',
            'received_date' => 'required|date',
            'status' => 'required',
            'user_id' => 'required|exists:users,id'
        ]);

        return IncomingMails::create($validated);
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
