<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    protected $table = 'sectores';
    protected $fillable = [
        'nombre',
        'nome'
    ];
    public function users()
    {
        return $this->belongsToMany('User', 'user_sector');
    }
}
