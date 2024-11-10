<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ttv extends Model
{
    use HasFactory;

    protected $table = 'ttv';

    protected $fillable = [
        'patient_id',
        'user_id',
        'sistolik',
        'diastolik',
        'suhu',
        'nadi',
        'rr',
        'spo2',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

