<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $table = 'contract';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nombre',
        'nome'
    ];
}
