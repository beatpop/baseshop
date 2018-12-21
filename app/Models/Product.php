<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品
 *
 * @author Alex
 * @package App\Models
 */
class Product extends Model
{
    //
    protected $table = "products";

    protected $fillable = [];

    public function productSkus()
    {
        return $this->hasMany(ProductSku::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, "product_category_product",
            "product_id", "category_id");
    }
}
