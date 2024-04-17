<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Waiting_room extends Model
{
    use HasFactory;

    public $table = "waiting_room";

    public function User(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
