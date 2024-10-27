<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    use HasFactory;

    protected $table = 'lab_results';

    protected $fillable = [
        'observation_id',
        'hb',
        'leukosit',
        'pcv',
        'trombosit',
        'room_type',
        'ph',
        'pco2',
        'po2',
        'radiology',
        'ro_thorax',
    ];

    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
}


