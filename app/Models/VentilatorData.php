<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentilatorData extends Model
{
    use HasFactory;

    protected $table = 'ventilator_data';

    protected $fillable = [
        'observation_id',
        'ttv_id',
        'therapy_type',
        'room_type',
        'change_day',
        'mode_venti',
        'ett_depth',
        'ipl',
        'peep',
        'fio2',
        'rr',
    ];

    public function observation()
    {
        return $this->belongsTo(Observation::class);
    }

    public function ttv()
    {
        return $this->belongsTo(Ttv::class);
    }
}


