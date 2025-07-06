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
        'original_name',
        'status',
        'is_disposed',
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
        return $this->hasMany(OutgoingMails::class);
    }

    public function getStatusBadgeAttribute()
    {
        return [
            'Belum diteruskan' => 'bg-yellow-200 text-yellow-800',
            'Sudah Diteruskan' => 'bg-green-200 text-green-800',
        ][$this->status] ?? 'bg-gray-200 text-gray-800';
    }
}
