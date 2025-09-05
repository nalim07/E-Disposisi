<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

// Test email notification command
Artisan::command('test:email-notification', function () {
    $this->info('Testing email notification to leaders...');
    
    // Get the first incoming mail or create a dummy one for testing
    $incomingMail = \App\Models\IncomingMails::first();
    
    if (!$incomingMail) {
        $this->info('No incoming mail found, creating a dummy one...');
        $incomingMail = \App\Models\IncomingMails::create([
            'mail_number' => 'TEST-001',
            'sender' => 'Test Sender',
            'subject' => 'Test Email Notification',
            'mail_date' => now(),
            'received_date' => now(),
            'status' => 'Belum diteruskan',
            'created_by' => 1 // Assuming admin user ID is 1
        ]);
    }
    
    $this->info('Using incoming mail: ' . $incomingMail->subject);
    
    // Get all users with the "pimpinan" role
    $leaders = \App\Models\User::role('pimpinan')->with('employee')->get();
    
    $this->info('Found ' . $leaders->count() . ' leaders with pimpinan role');
    
    if ($leaders->count() == 0) {
        $this->error('No leaders found with pimpinan role!');
        return;
    }
    
    // For each leader, send email notification
    foreach ($leaders as $leader) {
        $this->info('Processing leader: ' . $leader->username . ' (ID: ' . $leader->id . ')');
        
        // Check if the leader has an employee record with email
        if ($leader->employee) {
            $this->info('Leader has employee record: ' . $leader->employee->fullname . ' (' . $leader->employee->email . ')');
            
            if ($leader->employee->email) {
                // Send email notification
                $this->info('Sending email to: ' . $leader->employee->email);
                
                try {
                    // Use Laravel's mail functionality to send email
                    \Illuminate\Support\Facades\Mail::raw(
                        "🔔 NOTIFIKASI SURAT MASUK 🔔\n\n" .
                        "Ada surat masuk baru yang perlu ditindaklanjuti:\n\n" .
                        "No. Surat: {$incomingMail->mail_number}\n" .
                        "Pengirim: {$incomingMail->sender}\n" .
                        "Perihal: {$incomingMail->subject}\n" .
                        "Tanggal Surat: " . $incomingMail->mail_date->format('d/m/Y') . "\n\n" .
                        "Silakan login ke sistem untuk melihat detail surat.",
                        function ($msg) use ($leader) {
                            $msg->to($leader->employee->email)
                                ->subject('🔔 NOTIFIKASI SURAT MASUK 🔔');
                        }
                    );
                    
                    $this->info('Email sent successfully to: ' . $leader->employee->email);
                } catch (\Exception $e) {
                    $this->error('Failed to send email to ' . $leader->employee->email . ': ' . $e->getMessage());
                    \Illuminate\Support\Facades\Log::error('Failed to send email to ' . $leader->employee->email . ': ' . $e->getMessage());
                }
            } else {
                $this->info('Employee record exists but email is empty for leader: ' . $leader->username);
            }
        } else {
            $this->info('Leader does not have an employee record: ' . $leader->username);
        }
    }
    
    $this->info('Email notification test completed!');
})->purpose('Test email notification to leaders');
