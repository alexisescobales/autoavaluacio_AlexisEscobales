<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultatsAprenentatge extends Model
{
    use HasFactory;
    protected $table = 'resultats_aprenentatge';
    public $timestamps = false;

    protected $fillable = [
        'id', 'ordre', 'descripcio', 'actiu', 'moduls_id'
    ];

    public function moduls()
    {
        return $this->belongsTo(Moduls::class, 'moduls_id');
    }

    public function criterisAvaluacio()
    {
        return $this->hasMany(CriterisAvaluacio::class, 'resultats_aprenentatge_id');
    }
}
