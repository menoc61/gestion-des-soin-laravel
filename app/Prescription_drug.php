<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription_drug extends Model
{

	    protected $table = 'prescription_drugs';

     public function Drug(){
    	        return $this->hasOne('App\Drug', 'id', 'drug_id');
    }
}
