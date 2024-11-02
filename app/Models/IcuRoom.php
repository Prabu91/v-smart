<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IcuRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'icu_room_date',
        'icu_room_name',
        'ro',
        'ro_post_intubation',
        'blood_culture',
        'labresult_id',
        'intubation_id',
        'agd_id',
        'ttv_id',
    ];

    // Relasi ke tabel Patient
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
