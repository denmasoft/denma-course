<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'specialty';
    protected $primaryKey = 'ID';

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
        'description',
        'grade',
        'type'
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Study()
    {
        return $this->belongsTo(Grade::class,'grade_ID');
    }
}
