<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory, HasUuids;
    protected $table = "foods";
    protected $fillable = [
        "name",
        "desc",
        "price",
        'restaurant_id',
        "cuisine_id",
        'category_id',
        'filePath',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cuisine()
    {
        return $this->belongsTo(Cuisine::class, "cuisine_id", "id");
    }
}
