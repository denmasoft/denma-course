<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Puesto extends Model
{
    protected $table = 'puestos';
    protected $fillable = [
        'nombre',
        'nome'
    ];
}
