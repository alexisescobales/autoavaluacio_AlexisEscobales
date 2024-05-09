<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as AuthenticatableUser;
use Illuminate\Notifications\Notifiable;

class Usuaris extends AuthenticatableUser implements Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuaris';
    public $timestamps = false;
    protected $fillable = [
        'nom_usuari', 'contrasenya', 'correu', 'nom', 'cognom', 'tipus_usuaris_id', 'actiu'
    ];

    public function moduls()
    {
        return $this->belongsToMany(Moduls::class, 'usuaris_has_moduls', 'usuaris_id', 'moduls_id');
    }

    public function tipusUsuaris()
    {
        return $this->belongsTo(TipusUsuaris::class, 'tipus_usuaris_id');
    }
}
