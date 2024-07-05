<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use HasFactory, HasUuids;
    protected $table = "verify_users";
    protected $fillable = [
        "token",
        "user_id",
    ];

    public function user()
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
