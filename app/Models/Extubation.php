<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extubation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'icu_room_date',
        'preparation_extubation_theraphy',
        'extubation',
        'nebu_adrenalin',
        'dexamethasone',
        'main_diagnose',
        'secondary_diagnose',
        'agd_id',
        'ttv_id',
    ];

    // Relasi ke tabel Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
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
