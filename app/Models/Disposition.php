<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Disposition extends Model
{
    use HasFactory;

    protected $fillable = [
        'incoming_mail_id',
        'recipient_id',
        'content',
        'deadline',
        'notes',
        'priority',
        'created_by'
    ];

    // Relasi ke surat masuk
    public function incomingMail()
    {
        return $this->belongsTo(IncomingMails::class);
    }

    // Relasi ke user penerima
    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }

    // Relasi ke pembuat disposisi
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Format tanggal deadline
    public function getFormattedDeadlineAttribute()
    {
        return $this->deadline->format('d F Y');
    }

    // Scope untuk disposisi aktif
    public function scopeActive($query)
    {
        return $query->where('deadline', '>=', now());
    }
}
