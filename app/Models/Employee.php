<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'position_id',
        'employee_code',
        'fullname',
        'email',
        'gender',
        'religion',
        'place_of_birth',
        'date_of_birth',
        'address',
        'phone_number',
    ];
    
    public function user()
    {
        return $this->hasOne(User::class, 'employee_id');
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }
}
