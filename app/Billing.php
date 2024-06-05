<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Billing extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $table = 'billings';

    protected $fillable = [
        'patient_id', 'total_amount', 'remise', 'deposited_amount', 'due_amount', 'payment_mode'
    ];

    public function User()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function UserSessions()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function appointments()
    {
        return $this->belongsToMany('App\Appointment', 'Billing_item');
    }

    // public function appointments()
    // {
    //     return $this->belongsToMany(Appointment::class, 'billing_items', 'appointment_id', 'billing_id');
    // }
}
