<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventilator extends Model
{
    protected $table = 'ventilators';

    protected $fillable = [
        'patient_id',
        'user_id',
        'intubation_id',
        'ttv_id',
        'venti_datetime',
        'therapy_type',
        'mode_venti',
        'depth',
        'diameter',
        'ipl',
        'peep',
        'fio2',
        'rr',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function intubation()
    {
        return $this->belongsTo(Intubation::class, 'intubation_id', 'id');
    }

    public function ttv()
    {
        return $this->belongsTo(TTV::class, 'ttv_id', 'id');
    }
}
