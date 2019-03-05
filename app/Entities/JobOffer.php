<?php

namespace App\Entities;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class JobOffer extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'job_offer';
    protected $primaryKey = 'id';

    /**
     * @var bool
     */
    public $timestamps = false;

    public function getDueDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->due_date)->format('d/m/Y');
    }
    public function getStartDate(){
        return Carbon::createFromFormat('Y-m-d H:i:s',$this->start_date)->format('d/m/Y');
    }
    public function getRequirements(){
        return unserialize($this->requirements);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'requested_job',
        'vacancy',
        'tasks',
        'due_date',
        'contract_type',
        'start_date',
        'duration',
        'locality',
        'hours',
        'salary',
        'requirements'
    ];
}
