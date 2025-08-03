<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingMails extends Model
{
    protected $table = 'outgoing_mails';

    protected $fillable = [
        'mail_number',
        'purpose',
        'subject',
        'mail_date',
        'received_date',
        'file_path',
        'original_name',
        'status',
    ];

    public function incomingMail()
    {
        return $this->belongsTo(IncomingMails::class);
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    public function archive()
    {
        $this->update([
            'status' => 'archived',
            'archived_at' => now(),
        ]);
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }
}
