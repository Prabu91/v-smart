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
        'dr_consultant'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function ventilators()
    {
        return $this->hasMany(Ventilator::class, 'intubation_id', 'id');
    }
}
