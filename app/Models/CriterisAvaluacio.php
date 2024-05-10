<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class CriterisAvaluacio extends Model
{
    use HasFactory;
    protected $table = 'criteris_avaluacio';
    public $timestamps = false;

    protected $fillable = [
        'id', 'ordre', 'descripcio', 'actiu', 'cognom', 'resultats_aprenentatge_id'
       ];

    public function resultatsAprenentatge()
    {
        return $this->belongsTo(ResultatsAprenentatge::class, 'resultats_aprenentatge_id');
    }

    public function rubriques()
    {
        return $this->hasMany(Rubriques::class, 'criteris_avaluacio_id');
    }
}
