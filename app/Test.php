<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Test extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'tests';

    public function Patient()
    {
        return $this->hasOne('App\Patient');
    }

    public function Patient_Test()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function praticien_Test()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function Prescription()
    {
        return $this->hasMany('App\Prescription_test');
    }
}
