<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory, HasUuids;
    protected $table = "restaurants";
    protected $fillable = [
        'owner_id',
        "name",
        'address',
        'phoneNumber',
        'email',
        'logo_filePath',
        'banner',
        'desc',
        'operatingHours',
    ];
}
