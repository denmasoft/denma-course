<?php

namespace App\Entities;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Newsletter extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'newsletter';
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = false;

    public function getPublishedAt(){
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->publishedAt)->format('d/m/Y');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'publishedAt',
        'publishedIn',
        'locality',
        'description',
        'requirements',
        'contract_type',
        'contact'
    ];
}
