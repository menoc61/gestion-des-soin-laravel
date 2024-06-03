<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';

    protected $fillable = [
        'billing_id', 'amount', 'payment_date'
    ];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
}
