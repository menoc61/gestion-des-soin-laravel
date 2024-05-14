<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Billing_item extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table = 'billing_items';

    public function Prescripton(){
        return $this->hasOne('App\Prescripton', 'id', 'prescription_id');
}

}
