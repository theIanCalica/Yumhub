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
        "seller_id",
        "cuisine_id",
    ];
}
