<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agd extends Model
{
    use HasFactory;

    protected $table = 'agds';
    
    protected $fillable = [ 'patient_id', 'ph', 'po2', 'pco2', 'spo2'];
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}
