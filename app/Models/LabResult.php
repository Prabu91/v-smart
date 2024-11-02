<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    use HasFactory;

    protected $table = 'lab_results';

    protected $fillable = [
        'patient_id',
        'hb',
        'leukosit',
        'pcv',
        'trombosit',
        'kreatinin'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}


