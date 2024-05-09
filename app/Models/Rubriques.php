<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rubriques extends Model
{
    use HasFactory;
    protected $table = 'rubriques';
    public $timestamps = false;

    public function criterisAvaluacio()
    {
        return $this->belongsTo(CriterisAvaluacio::class, 'criteris_avaluacio_id');
    }
}
