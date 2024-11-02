<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// OriginRoom.php
class OriginRoom extends Model
{
    protected $fillable = ['patient_id', 'origin_room_date', 'origin_room_name', 'radiology', 'ro_thorax', 'additional_check', 'main_diagnose', 'secondary_diagnose', 'labresult_id', 'intubation_id', 'agd_id', 'ttv_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relasi ke tabel LabResult
    public function labResult()
    {
        return $this->belongsTo(LabResult::class);
    }

    // Relasi ke tabel Intubation
    public function intubation()
    {
        return $this->belongsTo(Intubation::class);
    }

    // Relasi ke tabel AGD
    public function agd()
    {
        return $this->belongsTo(AGD::class);
    }

    // Relasi ke tabel TTV
    public function ttv()
    {
        return $this->belongsTo(TTV::class);
    }
}
