<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionSystem extends Model
{
    use HasFactory;
    protected $fillable = [
        'pengaju_id',
        'evaluator_id',
        'tanggal_pengajuan',
        'tema',
        'kategori',
        'text_masalah',
        'file_masalah',
        'analisa',
        'perbaikan',
        'text_evaluasi',
        'file_evaluasi',
    ];

    public function scopeMp($query)
    {
        if(auth()->user()->hasRole('mp')){
            return $query->where('pengaju_id', auth()->user()->id);
        }
    }

    public function pengaju()
    {
        return $this->belongsTo(User::class, 'pengaju_id');
    }

    public function evaluator()
    {
        return $this->belongsTo(User::class, 'evaluator_id');
    }
}
