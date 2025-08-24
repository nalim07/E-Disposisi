<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $query = Archive::with('outgoingMail');

            // Handle search functionality
            if ($request->has('q') && $request->q != '') {
                $searchTerm = $request->q;
                $query->whereHas('outgoingMail', function ($outgoingQuery) use ($searchTerm) {
                    $outgoingQuery->where('mail_number', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('purpose', 'LIKE', "%{$searchTerm}%")
                        ->orWhere('subject', 'LIKE', "%{$searchTerm}%");
                });
            }

            $archives = $query->paginate(10);
            return view('archive.index', compact('archives'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat data arsip: ' . $e->getMessage());
        }
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
    public function show($id)
    {
        try {
            $archive = Archive::with('outgoingMail')->findOrFail($id);
            return view('archive.show', compact('archive'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat memuat detail arsip: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Archive $archive)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Archive $archive)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Archive $archive)
    {
        try {
            $result = $archive->delete();

            if ($result) {
                return redirect()->route('arsip.index')->with('success', 'Arsip berhasil dihapus.');
            } else {
                return back()->with('error', 'Gagal menghapus arsip. Silakan coba lagi.');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus arsip: ' . $e->getMessage());
        }
    }

    public function download(Archive $archive)
    {
        try {
            $mail = $archive->outgoingMail;

            if (!$mail) {
                return back()->with('error', 'Data surat tidak ditemukan.');
            }

            if (!$mail->file_path) {
                return back()->with('error', 'File surat tidak ditemukan.');
            }

            if (!Storage::disk('public')->exists($mail->file_path)) {
                return back()->with('error', 'File tidak ditemukan di server.');
            }

            $file = Storage::disk('public')->path($mail->file_path);

            return response()->download($file, $mail->original_name);
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat mengunduh file: ' . $e->getMessage());
        }
    }
}
