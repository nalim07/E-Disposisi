<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
