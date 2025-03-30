<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
