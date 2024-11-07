<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// OriginRoom.php
class OriginRoom extends Model
{
    protected $fillable = [
        'patient_id', 
        'origin_room_datetime', 
        'origin_room_name', 
        'radiology', 
        'ro_thorax', 
        'additional_check', 
        'main_diagnose', 
        'secondary_diagnose', 
        'labresult_id', 
        'intubation_id', 
        'agd_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    // Relasi ke tabel LabResult
    public function labResult()
    {
        return $this->belongsTo(LabResult::class, 'labresult_id', 'id');
    }

    // Relasi ke tabel Intubation
    public function intubation()
    {
        return $this->belongsTo(Intubation::class, 'intubation_id', 'id');
    }

    // Relasi ke tabel AGD
    public function agd()
    {
        return $this->belongsTo(AGD::class, 'agd_id', 'id');
    }

    
}
