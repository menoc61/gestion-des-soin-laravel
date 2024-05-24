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
}
