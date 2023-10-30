<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'date',
        'time_in',
        'time_out',
        'max_time_in',
        'status',
        'description',
    ];

    // if auth user is mp then show attendance of mp only
    public function scopeMp($query)
    {
        if(auth()->user()->hasRole('mp')){
            return $query->where('user_id', auth()->user()->id);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
