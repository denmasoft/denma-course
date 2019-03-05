<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class DrivingPermit extends Model
{
    protected $table = 'driving_permit';
    protected $primaryKey = 'id';
    /**
     * @var bool
     */
    public $timestamps = false;
    protected $fillable = [
        'code',
        'description'
    ];
}
