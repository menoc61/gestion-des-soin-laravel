<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Spatie\Permission\Models\Role;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use Notifiable;
    use HasRoles;
    use HasFactory;
    use HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'users';

    protected $fillable = [
        'name', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Patient(){
        return $this->hasOne('App\Patient');
    }

    public function roleUser(){
        return $this->hasOne('Spatie\Permission\Models\Role', 'id', 'role_id');
    }

    public function getNameAttribute($value)
    {
        return strtoupper($value);
    }

      public function Billings(){
                return $this->hasMany('App\Billing');
    }

    public function Test_Patient(){
        return $this->hasMany('App\Test');
    }

    public function Appointment(){
        return $this->hasMany('App\Appointment');
    }

}
