<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory, HasUuids;
    protected $table = "articles";
    protected $fillable = [
        "title",
        'content',
        'description',
        'category', //Food Trends,  Cooking Tips, Recipes, Health and Nutrition, Cooking Challenges
        'filePath',
    ];
}
