<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observation extends Model
{
    use HasFactory;

    protected $table = 'observations';
    
    protected $fillable = [
        'patient_id',
        'user_id',
        'intubation_dr_id',
        'consultant_dr_id',
        'origin_room_name',
        'origin_room_date',
        'icu_room_name',
        'icu_room_date',
        'transfer_room_name',
        'transfer_room_date',
        'ro',
        'ro_post_incubation',
        'blood_culture',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function intubationDoctor()
    {
        return $this->belongsTo(Doctor::class, 'intubation_dr_id');
    }

    public function consultantDoctor()
    {
        return $this->belongsTo(Doctor::class, 'consultant_dr_id');
    }

    public function ttv()
    {
        return $this->hasMany(Ttv::class);
    }

    public function labResults()
    {
        return $this->hasMany(LabResult::class);
    }

    public function ventilatorData()
    {
        return $this->hasMany(VentilatorData::class);
    }

    public function therapies()
    {
        return $this->hasMany(Therapy::class);
    }
}


