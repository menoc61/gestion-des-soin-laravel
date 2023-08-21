<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{

	protected $table = 'billings';

    public function User(){
    	        return $this->hasOne('App\User', 'id', 'user_id');
    }

    
      public function Items(){
    	        return $this->hasMany('App\Billing_item');
    }
}
