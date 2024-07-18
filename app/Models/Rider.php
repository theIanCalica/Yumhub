<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rider extends Model
{
    use HasFactory, HasUuids;
    protected $table = "riders";
    protected $fillable = [
        "fname",
        "lname",
        "sex",
        "dob",
        "phoneNumber",
        "email",
        "motorModel",
        "hiredDate",
        "employmentStatus",
        "salary",
        "address",
    ];
}
