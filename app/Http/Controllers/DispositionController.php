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
        try {
            $dispositions = Disposition::with(['incomingMail', 'recipient'])->get();
            return view('disposisi.index', compact('dispositions'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat data disposisi: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(IncomingMails $incomingMail)
    {
        try {
            // Get all roles except admin (as admin typically creates disposisi)
            $roles = Role::where('name', '!=', 'pimpinan')->get();
            return view('disposisi.create', compact('incomingMail', 'roles'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat form disposisi: ' . $e->getMessage());
        }
    }

    public function store(Request $request)
    {
        // First, validate the incoming_mail_id to get the mail date
        $request->validate([
            'incoming_mail_id' => 'required|exists:incoming_mails,id',
        ]);

        // Get the incoming mail to check its date
        $incomingMail = IncomingMails::findOrFail($request->incoming_mail_id);

        // Now validate all fields including custom validation for deadline
        $request->validate([
            'incoming_mail_id' => 'required|exists:incoming_mails,id',
            'recipient_role' => 'required|exists:roles,name',
            'content' => 'required',
            'deadline' => 'required|date|after_or_equal:' . $incomingMail->received_date,
            'priority' => 'required|in:Penting,Biasa,Segera',
            'notes' => 'nullable',
        ], [
            'deadline.after_or_equal' => 'Tanggal batas waktu disposisi tidak boleh sebelum tanggal terima surat.'
        ]);

        try {
            // Find users with the specified role
            $role = Role::findByName($request->recipient_role);
            if (!$role) {
                return redirect()->back()->with('error', 'Role ' . $request->recipient_role . ' tidak ditemukan.');
            }

            $usersWithRole = $role->users;

            // If there are users with this role, we'll assign to the first one
            // In a real application, you might want to implement a more sophisticated assignment logic
            $recipientId = $usersWithRole->first() ? $usersWithRole->first()->id : null;

            if (!$recipientId) {
                return redirect()->back()->with('error', 'Tidak ada pengguna dengan role ' . $request->recipient_role);
            }

            $disposition = Disposition::create([
                'incoming_mail_id' => $request->incoming_mail_id,
                'recipient_id' => $recipientId,
                'content' => $request->content,
                'deadline' => $request->deadline,
                'priority' => $request->priority,
                'notes' => $request->notes,
                'created_by' => Auth::id(),
            ]);

            if ($disposition) {
                $mailUpdated = IncomingMails::where('id', $request->incoming_mail_id)->update([
                    'is_disposed' => true,
                ]);

                if ($mailUpdated) {
                    return redirect()->route('surat-masuk.index')->with('success', 'Disposisi berhasil dibuat dan surat telah ditandai sebagai sudah didisposisi.');
                } else {
                    return redirect()->route('surat-masuk.index')->with('success', 'Disposisi berhasil dibuat namun gagal memperbarui status surat.');
                }
            } else {
                return redirect()->back()->with('error', 'Gagal membuat disposisi. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat membuat disposisi: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $disposition = Disposition::with(['incomingMail', 'recipient', 'creator'])
                ->findOrFail($id);

            return view('disposisi.show', compact('disposition'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat detail disposisi: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $disposition = Disposition::with(['incomingMail', 'recipient', 'creator'])->findOrFail($id);
            return view('disposisi.edit', compact('disposition'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat form edit disposisi: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $disposition = Disposition::findOrFail($id);

            // Validate the request
            $request->validate([
                'notes' => 'nullable|string',
            ]);

            // Update the disposition
            $disposition->notes = $request->notes;

            $result = $disposition->save();

            if ($result) {
                return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil diperbarui.');
            } else {
                return back()->with('error', 'Gagal memperbarui disposisi. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memperbarui disposisi: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $disposition = Disposition::findOrFail($id);
            $result = $disposition->delete();

            if ($result) {
                return redirect()->route('disposisi.index')->with('success', 'Disposisi berhasil dihapus.');
            } else {
                return back()->with('error', 'Gagal menghapus disposisi. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus disposisi: ' . $e->getMessage());
        }
    }
}
