<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    
    protected $fillable = ['name', 'no_jkn'];

    public function originRoom()
    {
        return $this->hasOne(OriginRoom::class);
    }

    public function icuRoom()
    {
        return $this->hasOne(IcuRoom::class);
    }

    public function extubation()
    {
        return $this->hasOne(Extubation::class);
    }
}


