<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    public function archivable()
    {
        return $this->morphTo();
    }
}
