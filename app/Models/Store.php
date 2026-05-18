<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = ['name', 'logo', 'description', 'phone', 'address', 'email', 'payment_account_id', 'is_active'];

    public function paymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class);
    }

    public function owner()
    {
        return $this->hasOne(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
