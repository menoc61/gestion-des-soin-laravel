<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
        protected $table = 'tests';

        public function Patient(){
            return $this->hasOne('App\Patient');
    }


        public function Prescription(){
                return $this->hasMany('App\Prescription_test');
        }

}
