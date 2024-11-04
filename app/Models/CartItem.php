<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory, HasUuids;
    protected $table = "cart_items";
    protected $fillable = [
        'cart_id',
        'food_id',
        'qty',
        'price',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
