<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeMipo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'mipo_setting_id',
        'date',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mipoSetting()
    {
        return $this->belongsTo(MipoSetting::class);
    }
}
