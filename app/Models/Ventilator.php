<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Ventilator extends Model
{
    protected $table = 'ventilators';

    protected $fillable = [
        'patient_id',
        'user_id',
        'venti_datetime',
        'venti_usagetime',
        'mode_venti',
        'ipl',
        'peep',
        'fio2',
        'rr',
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
    
    public function icu()
    {
        return $this->hasMany(IcuRoom::class, 'ventilator_id', 'id');
    }

    public function intubation()
    {
        return $this->hasOne(Intubation::class, 'ventilator_id', 'id');
    }
    
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
