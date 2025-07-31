<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    protected $fillable = [
        'outgoing_mail_id',
        'archived_by',
        'archived_at',
    ];

    public function archivable()
    {
        return $this->morphTo();
    }

    // Outgoing
    public function outgoingMail()
    {
        return $this->belongsTo(OutgoingMails::class);
    }
}
