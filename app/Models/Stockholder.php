<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stockholder extends Model
{
    use HasFactory, HasUuids;
    protected $table = "stockholders";
    protected $fillable = [
        "name",
        "sex",
        "dob",
        "email",
        "phoneNumber",
        "address",
        "sharesOwned",
        "investmentDate",
        "prefferedContact",
    ];
}
