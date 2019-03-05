<?php

namespace App\Entities;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Carbon\Carbon;

class User extends  Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    use Authenticatable, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lang', 
        'name',
        'pass',
        'surname',
        'sex',
        'birth',
        'email',
        'alias',
        'company',
        'nif',
        'sector',
        'telephone',
        'other_phone',
        'driving_permit',
        'mobile',
        'address',
        'zip',
        'city',
        'country_fk',
        'province_fk',
        'grade',
        'prestacion',
        'country',
        'cif',
        'degree',
        'languages',
        'situation',
        'experience',
        'disability',
        'role_id',
        'status',
        'city_hall',
        'computer_skills',
        'other_courses',
        'specialty',
        'study',
        'job_posts',
        'posts'

    ];
    protected $table = 'user';
    protected $primaryKey = 'pk';

    public function getFullNameAttribute()
    {
        return ucwords($this->name.' '.$this->surname);
    }


    public function setPassAttribute($value)
    {
        if (!empty($value)) {

            $this->attributes['pass'] = \Hash::make($value);
        }
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function country()
    {
        return $this->belongsTo(Country::class,'country_fk');
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class,'province_fk');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class,'role_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'pass', 'remember_token',
    ];
}
