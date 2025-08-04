<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $archives = Archive::with('outgoingMail')->get();

        return view('archive.index', compact('archives'));
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
        $archive = Archive::with('outgoingMail')->findOrFail($id);

        return view('archive.show', compact('archive'));
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
        $archive->delete();

        return redirect()->route('arsip.index');
    }

    public function download(Archive $archive)
    {
        $mail = $archive->outgoingMail;

        if (!$mail || !$mail->file_path || !Storage::disk('public')->exists($mail->file_path)) {
            return back()->with('error', 'File tidak ditemukan.');
        }

        $file = Storage::disk('public')->path($mail->file_path);

        return response()->download($file, $mail->original_name);
    }
}
