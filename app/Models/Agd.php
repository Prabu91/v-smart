<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agd extends Model
{
    use HasFactory;

    protected $table = 'agds';
    
    protected $fillable = ['ph', 'po2', 'pco2', 'spo2'];
}
