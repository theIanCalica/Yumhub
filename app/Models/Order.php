<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory, HasUuids;
    protected $table = "orders";
    protected $fillable = [
        "order_date",
        "user_id",
        "status",
        'mode',
    ];

    public function orderItems()
    {
        return $this->hasMany(Orders_Items::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
