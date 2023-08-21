<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $table = 'drugs';
    protected $fillable = ['trade_name','generic_name','note'];

    public function Prescription(){
                return $this->hasMany('App\Prescription_drug');
    }

}
