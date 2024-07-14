<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory, HasUuids;
    protected $table = "contact_messages";
    protected $fillable = [
        "fname",
        "lname",
        "email",
        "subject",
        "message"
    ];
}
