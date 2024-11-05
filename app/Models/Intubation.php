<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intubation extends Model
{
    protected $table = 'intubations';

    protected $fillable = [
        'intubation_location',
        'dr_intubation',
        'dr_consultant',
        'therapy_type',
        'mode_venti',
        'ett_depth',
        'ipl',
        'peep',
        'fio2',
        'rr',
    ];
}
