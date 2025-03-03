<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    
    protected $fillable = ['name', 'no_jkn', 'no_rm', 'no_sep', 'gender', 'tanggal_lahir', 'user_id'];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function originRoom()
    {
        return $this->hasOne(OriginRoom::class, 'patient_id', 'id');
    }

    public function icuDash()
    {
        return $this->hasOne(IcuRoom::class, 'patient_id', 'id');
    }

    public function icuRoom()
    {
        return $this->hasMany(IcuRoom::class, 'patient_id', 'id');
    }

    public function transferRoom()
    {
        return $this->hasOne(TransferRoom::class, 'patient_id', 'id');
    }

    public function intubation()
    {
        return $this->hasOne(Intubation::class, 'patient_id', 'id');
    }

    public function venti()
    {
        return $this->hasMany(Ventilator::class, 'patient_id', 'id');
    }

    public function extubation()
    {
        return $this->hasOne(Extubation::class, 'patient_id', 'id');
    }

}


