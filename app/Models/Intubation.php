<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Intubation extends Model
{
    protected $table = 'intubations';

    protected $fillable = [
        'patient_id',
        'user_id',
        'ttv_pre_id',
        'ttv_post_id',
        'ventilator_id',
        'intubation_datetime',
        'intubation_location',
        'dr_intubation',
        'dr_consultant',
        'intubation_type',
        'ett_diameter',
        'ett_depth',
        'tc_diameter',
        'tc_type',
        'pre_intubation',
        'post_intubation',
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

    public function venti()
    {
        return $this->belongsTo(Ventilator::class, 'ventilator_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ttv()
    {
        return $this->belongsTo(Ttv::class, 'ttv_id', 'id');
    }

    public function ttvPre()
    {
        return $this->belongsTo(Ttv::class, 'ttv_pre_id');
    }

    public function ttvPost()
    {
        return $this->belongsTo(Ttv::class, 'ttv_post_id');
    }
}
