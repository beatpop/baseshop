<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 品牌
 *
 * @author Alex
 * @package App\Models
 */
class Brand extends Model
{
    //
    protected $table = "brands";

    protected $fillable = [];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
