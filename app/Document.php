<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
     public function Patient(){
    	        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
