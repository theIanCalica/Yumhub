<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Food extends Model
{
    use HasFactory, HasUuids, Searchable;
    protected $table = "foods";
    protected $fillable = [
        "name",
        "price",
        'restaurant_id',
        "cuisine_id",
        'category_id',
        'filePath',
    ];

    public function searchableAs(): string
    {
        return 'myfoods_index';
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class, "cuisine_id", "id");
    }

    public function cartItems()
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->hasMany(Orders_Items::class);
    }
}
