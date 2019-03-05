<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticia';
    protected $primaryKey = 'id';
    /**
     * @var bool
     */
    public $timestamps = false;
    protected $fillable = [
        'titulo',
        'antetitulo',
        'entradilla',
        'noticia',
        'fecha_publicacion',
        'fecha_expiracion',
        'imagen_destacada',
        'imagen1',
        'imagen2'
    ];
}
