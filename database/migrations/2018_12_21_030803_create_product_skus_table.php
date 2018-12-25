<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 商品SKU表
 */
class CreateProductSkusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_skus', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment("产品sku名称");
            $table->string('sku_number')->comment("产品sku编号");
            $table->text('description')->nullable()->comment("sku描述");
            $table->decimal('price', 10)->default(0.00)->comment("价格");
            $table->unsignedInteger('stock')->nullable()->default(0)->comment("库存量");
            $table->unsignedInteger('product_id')->nullable()->comment("所属商品");
            $table->boolean('is_on_sale')->nullable()->default(1)->comment('是否上架');
            $table->string('primary_picture')->nullable()->default('')->comment('商品主图');
            $table->decimal('retail_price', 10)->unsigned()->default(0.00)->comment('零售价格');
            $table->boolean('is_promotion')->nullable()->default(0)->comment("是否促销");
            $table->decimal('promotion_price', 10)->nullable()->unsigned()->default(0.00)->comment('促销价格');
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->comment = "商品sku";
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_skus');
    }
}
