<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品sku
 *
 * @author Alex
 * @package App\Models
 */
class ProductSku extends Model
{
    //
    protected $table = "product_skus";

    protected $fillable = [];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
