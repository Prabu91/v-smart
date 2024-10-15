<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapy extends Model
{
    use HasFactory;

    protected $fillable = [
        'observation_id',
        'therapy_type',
        'preparation_extubation_therapy',
        'nebu_adrenalin',
        'dexamethasone',
    ];

    // Relasi ke tabel Observation
    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
}
