<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    
    protected $fillable = [
        'name',
        'no_cm'
    ];

    public function observations()
    {
        return $this->hasMany(Observation::class);
    }
}


