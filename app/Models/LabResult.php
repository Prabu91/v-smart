<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'observation_id',
        'hb',
        'leukosit',
        'pcv',
        'trombosit',
        'agd',
        'radiology',
        'ro_thorax',
    ];

    // Relasi ke tabel Observation
    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
}

