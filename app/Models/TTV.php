<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttv extends Model
{
    use HasFactory;

    protected $table = 'ttv';

    protected $fillable = [
        'observation_id',
        'td',
        'saturasi',
        'nadi',
        'rr',
        'spo2',
    ];

    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
}

