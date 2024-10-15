<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TTV extends Model
{
    use HasFactory;

    protected $fillable = [
        'observation_id',
        'td', // Tekanan darah
        'saturasi', // Saturasi oksigen
        'nadi', // Denyut nadi
        'rr', // Respiratory Rate
        'spo2', // SpO2 level
    ];

    // Relasi ke tabel Observation
    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
}
