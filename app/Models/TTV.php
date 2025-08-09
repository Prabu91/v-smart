<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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
        'consciousness',
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
        return $this->hasOne(IcuRoom::class, 'ttv_id', 'id');
    }

    public function extubation()
    {
        return $this->hasOne(Extubation::class, 'ttv_id', 'id');
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

