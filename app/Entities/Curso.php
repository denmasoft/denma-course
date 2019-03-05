<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    public function sectores()
    {
    	return $this->belongsToMany('App\Entities\Sector', 'curso_sector', 'curso_id', 'sector_id');
    }
    public function puestos()
    {
    	return $this->belongsToMany('App\Entities\Puesto', 'curso_puesto', 'curso_id', 'puesto_id');
    }
    public function users()
    {
    	return $this->belongsToMany('App\Entities\User', 'curso_user', 'curso_id', 'pk');
    }
}
