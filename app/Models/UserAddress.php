<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAddress extends Model
{
    use SoftDeletes;

    protected $table = "user_addresses";

    protected $fillable = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
