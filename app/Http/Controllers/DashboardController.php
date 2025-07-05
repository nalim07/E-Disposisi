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
        $incomingMailCount = IncomingMails::count();
        $outgoingMailCount = OutgoingMails::count();
        $archiveCount = Archive::count();
        // $dispositionCount = Disposition::count();

        return view('dashboard', compact('incomingMailCount'));
    }
}
