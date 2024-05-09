<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipusUsuaris extends Model
{
    use HasFactory;
    protected $table = 'tipus_usuaris';
    public $timestamps = false;
}

