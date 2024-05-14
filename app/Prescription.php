<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Prescription extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'prescriptions';

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function Drug()
    {
        return $this->belongsToMany('App\Drug', 'prescription_drugs');
    }

    public function Test()
    {
        return $this->belongsToMany('App\Test', 'prescription_tests');
    }

    public function Items()
    {
        return $this->hasMany('App\Billing_item');
    }

}
