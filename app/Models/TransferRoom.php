<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferRoom extends Model
{
    protected $fillable = ['patient_id', 'user_id', 'transfer_room_datetime', 'transfer_room_name', 'main_diagnose', 'secondary_diagnose', 'labresult_id', 'lab_culture_data', 'ttv_id'];

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
        return $this->belongsTo(LabResult::class, 'user_id', 'id');
    }

    // Relasi ke tabel TTV
    public function ttv()
    {
        return $this->belongsTo(TTV::class, 'user_id', 'id');
    }
}
