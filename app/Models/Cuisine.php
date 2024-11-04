<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuisine extends Model
{
    use HasFactory, HasUuids;
    protected $table = "cuisines";
    protected $fillable = [
        "name",
        "desc",
        "origin",
        "img_url",
    ];

    public function foods()
    {
        return $this->hasMany(Food::class, 'cuisine_id', 'id');
    }
}
