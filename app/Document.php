<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Document extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
     public function Patient(){
    	        return $this->hasOne('App\User', 'id', 'user_id');
    }
}
