<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Therapy extends Model
{
    use HasFactory;

    protected $table = 'therapies';

    protected $fillable = [
        'observation_id',
        'preparation_extubation_therapy',
        'excubation_date',
        'excubation',
        'nebu_adrenalin',
        'dexamethasone',
    ];

    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
}

