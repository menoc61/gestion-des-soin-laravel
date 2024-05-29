<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Rdv_Drug extends Model implements Auditable
{
    use HasFactory;

    use \OwenIt\Auditing\Auditable;

	protected $table = 'rdv__drugs';

     public function Drug(){
    	        return $this->hasOne('App\Drug', 'id', 'drug_id');
    }
}
