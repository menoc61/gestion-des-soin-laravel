<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Appointment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'appointments';

    public $dates = ['date'];


    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function Doctor()
    {
        return $this->hasOne('App\User', 'id', 'doctor_id');
    }
    public function Prescription()
    {
        return $this->hasOne('App\Prescription', 'id', 'prescription_id');
    }
    public function Drug()
    {
        return $this->belongsToMany('App\Drug', 'rdv__drugs');
    }
}
