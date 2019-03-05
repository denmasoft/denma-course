<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'enterprise';
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'social',
        'nif',
        'contact',
        'position',
        'phone',
        'email',
        'approval'
    ];
}
