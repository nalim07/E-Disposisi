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
        'status',
        'completed_at',
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
    
    /**
     * Check if the disposition is completed
     */
    public function isCompleted()
    {
        return $this->status === 'completed';
    }
    
    /**
     * Mark the disposition as completed
     */
    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->completed_at = now();
        return $this->save();
    }
    
    /**
     * Get status badge class for styling
     */
    public function getStatusBadgeClassAttribute()
    {
        return [
            'pending' => 'bg-yellow-200 text-yellow-800',
            'in_progress' => 'bg-blue-200 text-blue-800',
            'completed' => 'bg-green-200 text-green-800',
        ][$this->status] ?? 'bg-gray-200 text-gray-800';
    }
}
