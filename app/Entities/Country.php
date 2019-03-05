<?php

namespace App\Entities;


class Country extends AbstractEntity
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'country';
    protected $primaryKey = 'pk';

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
        'bigname',
        'name',
        'iso3',
        'numcode'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provinces()
    {
        return $this->hasMany(Province::class);
    }
}
