<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Extubation extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'user_id',
        'ttv_id',
        'extubation_datetime',
        'preparation_extubation_therapy',
        'extubation',
        'nebulizer',
        'patient_status',
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

    public function ttv()
    {
        return $this->belongsTo(Ttv::class, 'ttv_id', 'id');
    }
}
