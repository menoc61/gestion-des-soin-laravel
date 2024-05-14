<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Prescription_drug extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;

	protected $table = 'prescription_drugs';

     public function Drug(){
    	        return $this->hasOne('App\Drug', 'id', 'drug_id');
    }
}
