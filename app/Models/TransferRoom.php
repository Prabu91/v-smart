<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferRoom extends Model
{
    protected $fillable = ['patient_id', 'transfer_room_date', 'transfer_room_name', 'additional_check', 'main_diagnose', 'secondary_diagnose', 'labresult_id', 'agd_id', 'ttv_id'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    
    // Relasi ke tabel LabResult
    public function labResult()
    {
        return $this->belongsTo(LabResult::class);
    }

    // Relasi ke tabel AGD
    public function agd()
    {
        return $this->belongsTo(AGD::class);
    }

    // Relasi ke tabel TTV
    public function ttv()
    {
        return $this->belongsTo(TTV::class);
    }
}
