<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $table = 'doctors';
    
    protected $fillable = [
        'name',
        'specialist'
    ];

    public function intubations()
    {
        return $this->hasMany(Observation::class, 'intubation_dr_id');
    }

    public function consultations()
    {
        return $this->hasMany(Observation::class, 'consultant_dr_id');
    }
}
