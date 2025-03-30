<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OutgoingMails extends Model
{
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
        return $this->morphOne(Archive::class, 'archivable');
    }
}
