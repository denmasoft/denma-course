<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
class Concello extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'concello';
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
        'province_pk'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class,'province_pk');
    }
}
