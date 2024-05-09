<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuaris extends Model
{
    use HasFactory;
    protected $table = 'usuaris';
    public $timestamps = false;

    public function moduls()
    {
        return $this->belongsToMany(Moduls::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
    }

    public function tipusUsuaris()
    {
        return $this->belongsTo(TipusUsuaris::class, 'tipus_usuaris_id');
    }
}
