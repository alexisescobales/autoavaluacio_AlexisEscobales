<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moduls extends Model
{
    use HasFactory;
    protected $table = 'moduls';
    public $timestamps = false;

    public function resultatsAprenentatge()
    {
        return $this->hasMany(ResultatsAprenentatge::class, 'moduls_id');
    }

    public function usuaris()
    {
        return $this->belongsToMany(Usuaris::class, 'usuaris_has_moduls', 'moduls_id', 'usuaris_id');
    }
}
