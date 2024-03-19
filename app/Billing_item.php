<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Billing_item extends Model
{
	protected $table = 'billing_items';

    public function Prescripton(){
        return $this->hasOne('App\Prescripton', 'id', 'prescription_id');
}

}
