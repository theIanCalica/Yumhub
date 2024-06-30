<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory, HasUuids;
    protected $table = "managers";
    protected $fillable = [
        "fname",
        "lname",
        "sex",
        "DOB",
        "phoneNumber",
        "email",
        "hiredDate",
        "employmentStatus",
        "salary",
        "address",
    ];
}
