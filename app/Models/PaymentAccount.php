<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentAccount extends Model
{
    protected $fillable = [
        'user_id', 'account_id', 'account_name', 
        'account_city', 'currency', 'is_active'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
