<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabResult extends Model
{
    use HasFactory;

    protected $table = 'lab_results';

    protected $fillable = [
        'patient_id',
        'user_id',
        'hb',
        'leukosit',
        'pcv',
        'trombosit',
        'kreatinin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
}


