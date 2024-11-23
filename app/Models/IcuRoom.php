<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class IcuRoom extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'icu_room_datetime',
        'icu_room_name',
        'icu_room_bednum',
        'ro',
        'ro_post_intubation',
        'blood_culture',
        'labresult_id',
        'ventilator_id',
        'agd_id',
    ];

    protected $keyType = 'string';
    public $incrementing = false;

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke tabel LabResult
    public function labResult()
    {
        return $this->belongsTo(LabResult::class, 'labresult_id', 'id');
    }

    // Relasi ke tabel Intubation
    public function intubation()
    {
        return $this->belongsTo(Intubation::class, 'intubation_id', 'id');
    }

    // Relasi ke tabel AGD
    public function agd()
    {
        return $this->belongsTo(AGD::class, 'agd_id', 'id');
    }
    
}
