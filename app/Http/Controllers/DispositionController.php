<?php

namespace App\Http\Controllers;

use id;
use App\Models\User;
use App\Models\Employee;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Models\IncomingMails;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

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
        // Get all roles except admin (as admin typically creates disposisi)
        $roles = Role::where('name', '!=', 'pimpinan')->get();

        return view('disposisi.create', compact('incomingMail', 'roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'incoming_mail_id' => 'required|exists:incoming_mails,id',
            'recipient_role' => 'required|exists:roles,name',
            'content' => 'required',
            'deadline' => 'required|date',
            'priority' => 'required|in:Penting,Biasa,Segera',
            'notes' => 'nullable',
        ]);

        // Find users with the specified role
        $usersWithRole = Role::findByName($request->recipient_role)->users;

        // If there are users with this role, we'll assign to the first one
        // In a real application, you might want to implement a more sophisticated assignment logic
        $recipientId = $usersWithRole->first() ? $usersWithRole->first()->id : null;

        if (!$recipientId) {
            return redirect()->back()->with('error', 'Tidak ada pengguna dengan role ' . $request->recipient_role);
        }

        Disposition::create([
            'incoming_mail_id' => $request->incoming_mail_id,
            'recipient_id' => $recipientId,
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
        $disposition = Disposition::with(['incomingMail', 'recipient', 'creator'])
            ->findOrFail($id);

        return view('disposisi.show', compact('disposition'));
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
        $disposition = Disposition::findOrFail($id);
        $disposition->delete();

        return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
    }
}
