<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPayment extends Model
{
    protected $fillable = [
        'order_id', 'user_id', 'payment_method_id', 
        'payment_status_id', 'transaction_id', 'amount', 
        'currency', 'paid_at'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }

    public function account()
    {
        return $this->belongsTo(PaymentAccount::class, 'payment_method_id');
    }
}
