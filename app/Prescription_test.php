<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Prescription_test extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
        protected $table = 'prescription_tests';


     public function Test(){
    	        return $this->hasOne('App\Test', 'id', 'test_id');
    }
}
