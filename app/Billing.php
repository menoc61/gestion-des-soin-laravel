<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{

    protected $table = 'billings';

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function UserSessions()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function Prescription(){
        return $this->belongsToMany('App\Prescription','Billing_item');
}
}
