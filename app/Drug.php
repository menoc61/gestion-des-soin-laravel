<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Drug extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'drugs';
    protected $fillable = ['trade_name','generic_name','note'];

    public function Prescription(){
                return $this->hasMany('App\Prescription_drug');
    }

}
