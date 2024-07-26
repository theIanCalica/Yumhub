<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders_Items extends Model
{
    use HasFactory, HasUuids;
    protected $table = "orders_items";
    protected $fillable = [
        "order_id",
        "food_id",
        "qty",
    ];
    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}
