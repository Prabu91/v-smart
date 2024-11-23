<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Patient extends Model
{
    use HasFactory;

    protected $table = 'patients';
    
    protected $fillable = ['name', 'no_jkn', 'no_rm', 'user_id'];

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
        return $this->hasOne(OriginRoom::class);
    }

    public function icuRoom()
    {
        return $this->hasOne(IcuRoom::class);
    }

    public function transferRoom()
    {
        return $this->hasOne(TransferRoom::class);
    }

    public function extubation()
    {
        return $this->hasOne(Extubation::class);
    }

}


