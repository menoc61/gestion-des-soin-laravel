<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Billing_item extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

	protected $table = 'billing_items';

    public function Appointment(){
        return $this->hasOne('App\Appointment', 'id', 'appointment_id');
}

}
