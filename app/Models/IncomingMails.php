<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IncomingMails extends Model
{
    use HasFactory;

    protected $fillable = [
        'mail_number',
        'sender',
        'subject',
        'mail_date',
        'received_date',
        'file_path',
        'status',
        'created_by',
    ];

    protected $attributes = [
        'status' => 'Belum diteruskan'
    ];

    public function dispositions()
    {
        return $this->hasMany(Disposition::class);
    }

    public function outgoingMails()
    {
        return $this->hasMany(OutgoingMails ::class);
    }
}
