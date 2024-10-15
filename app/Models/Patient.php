<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'no_cm',
        'date_of_birth',
        'gender',
    ];

    // Relasi satu ke banyak dengan Observations
    public function observations()
    {
        return $this->hasMany(Observation::class);
    }
}

