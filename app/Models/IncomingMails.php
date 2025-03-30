<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomingMails extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'sender',
        'subject',
        'received_date',
        'status',
        'user_id'
    ];

    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }

    public function outgoingMails()
    {
        return $this->hasMany(OutgoingMails::class);
    }
}
