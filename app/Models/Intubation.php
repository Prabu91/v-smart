<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intubation extends Model
{
    protected $table = 'intubations';

    protected $fillable = [
        'patient_id',
        'user_id',
        'intubation_datetime',
        'intubation_location',
        'dr_intubation',
        'dr_consultant',
        'therapy_type',
        'mode_venti',
        'depth',
        'diameter',
        'ipl',
        'peep',
        'fio2',
        'rr',
        'ttv_id'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ttv()
    {
        return $this->belongsTo(TTV::class, 'ttv_id', 'id');
    }
}
