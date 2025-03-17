<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ActivityReport extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'activity_report';
    protected $fillable = ['doctor_id', 'user_id', 'observation', 'next_rdv', 'pourboire'];

    //public $dates = ['date'];

    // Relation avec User
    public function User()
    {
        //return $this->belongsTo('App\User', 'id', 'user_id');
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relation avec Drug
    public function drugs()
    {
        return $this->belongsToMany(Drug::class, 'activity_report_drug')->withPivot('amountDrug')->withTimestamps();
    }
    

    public function Doctor()
    {
        return $this->hasOne('App\User', 'id', 'doctor_id');
        //return $this->belongsToMany(User::class, 'appointment_practitioner', 'appointment_id', 'doctor_id');
    }
}
