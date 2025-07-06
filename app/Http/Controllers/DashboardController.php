<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Disposition;
use Illuminate\Http\Request;
use App\Models\IncomingMails;
use App\Models\OutgoingMails;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->user()->hasRole('pimpinan')) {
            // Khusus untuk pimpinan: hanya hitung surat yang sudah ditindaklanjuti
            $incomingMailCount = IncomingMails::where('is_disposed', false)->where('status', 'Sudah Ditindaklanjuti')->count();
        } else {
            // Untuk admin: hitung semua surat masuk
            $incomingMailCount = IncomingMails::count();
        }

        $outgoingMailCount = OutgoingMails::count();
        $archiveCount = Archive::count();
        $dispositionCount = Disposition::count();

        return view('dashboard', compact(
            'incomingMailCount',
            'incomingMailCount',
            'outgoingMailCount',
            'archiveCount',
            'dispositionCount'
        ));
    }
}
