<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TransferRoom extends Model
{
    protected $fillable = ['patient_id', 'user_id', 'transfer_room_datetime', 'transfer_room_name', 'main_diagnose', 'secondary_diagnose', 'labresult_id', 'lab_culture_data', 'ttv_id'];

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
        return $this->belongsTo(Patient::class);
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

    // Relasi ke tabel TTV
    public function ttv()
    {
        return $this->belongsTo(Ttv::class, 'ttv_id', 'id');
    }
}
