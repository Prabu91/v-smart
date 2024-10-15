<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentilatorData extends Model
{
    use HasFactory;

    protected $fillable = [
        'observation_id',
        'mode_venti',
        'ett_depth',
        'ipl',
        'peep',
        'fio2',
        'rr',
    ];

    // Relasi ke tabel Observation
    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }
}

