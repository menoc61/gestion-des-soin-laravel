<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Appointment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'appointments';

    public $dates = ['date'];


    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }
    public function Doctor()
    {
        return $this->hasOne('App\User', 'id', 'doctor_id');
        
    }

    public function praticients()
    {
        return $this->belongsToMany(User::class, 'praticient_appointment', 'appointment_id', 'praticient_id');   
    }

    public function Prescription()
    {
        return $this->hasOne('App\Prescription', 'id', 'prescription_id');
    }

    public function drugs()
    {
        return $this->belongsToMany(Drug::class, 'rdv__drugs', 'appointment_id', 'drug_id');
    }

    public function rdv__drugs()
    {
        return $this->hasMany(Rdv_Drug::class);
    }


    public function Items()
    {
        return $this->hasMany('App\Billing_item');
    }

    // public function billings()
    // {
    //     return $this->belongsToMany(Billing::class, 'billing_items', 'billing_id', 'appointment_id');
    // ->withTimestamps()}
}
