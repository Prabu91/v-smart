<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'origin_room_date',
        'icu_room_date',
        'transfer_room_date',
    ];

    // Relasi ke tabel Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    // Relasi ke tabel User (siapa yang mengisi observasi)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi satu ke banyak dengan LabResults
    public function labResults()
    {
        return $this->hasMany(LabResult::class);
    }

    // Relasi satu ke banyak dengan VentilatorData
    public function ventilatorData()
    {
        return $this->hasMany(VentilatorData::class);
    }

    // Relasi satu ke banyak dengan Therapies
    public function therapies()
    {
        return $this->hasMany(Therapy::class);
    }

    // Relasi satu ke banyak dengan TTV (Tanda-Tanda Vital)
    public function ttv()
    {
        return $this->hasMany(TTV::class);
    }
}

