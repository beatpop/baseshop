<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * 商品分类
 *
 * @author Alex
 * @package App\Models
 */
class ProductCategory extends Model
{
    //
    protected $table = "product_categories";

    protected $fillable = [];

    public function products()
    {
        return $this->hasMany(Product::class, "product_id");
    }

    public static function getParentName($parentId)
    {
        if (!empty($parentId)) {
            $categoryParent = ProductCategory::find($parentId);
            return $categoryParent->name;
        }
        return null;
    }
}
