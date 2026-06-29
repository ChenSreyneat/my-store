<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayoutItem extends Model
{
    use HasFactory;

    protected $fillable = ['payout_id', 'product_id', 'quantity', 'amount'];

    public function payout()
    {
        return $this->belongsTo(Payout::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
