<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extubation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'extubation_datetime',
        'preparation_extubation_therapy',
        'extubation',
        'nebu_adrenalin',
        'dexamethasone',
        'patient_status',
    ];

    // Relasi ke tabel Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
