<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MipoSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'value',
    ];

    // format every value to 2 decimal
    public function getValueAttribute($value)
    {
        return round($value, 2);
    }
}
