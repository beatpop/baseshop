<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('brand_id')->unsigned()->nullable()->default(null)->index('brand_id')->comment('品牌id');
            $table->string('product_number', 60)->default('')->comment('商品编号');
            $table->string('name', 120)->default('')->comment('商品名称');
            $table->integer('amount')->unsigned()->default(0)->index('amount')->comment('商品库存量');
            $table->string('keywords')->default('')->comment('商品关键词');
            $table->string('brief')->nullable()->default('')->comment('商品摘要');
            $table->longText('description')->nullable()->comment('商品描述');
            $table->boolean('is_on_sale')->default(1)->comment('是否上架');
            $table->smallInteger('priority')->unsigned()->default(100)->index('priority')->comment('商品排序');
            $table->boolean('is_delete')->default(0)->comment('商品删除状态 0 正常 1已删除');
            $table->decimal('original_price', 10)->unsigned()->default(0.00)->comment('原价');
            $table->decimal('extra_price', 10)->unsigned()->default(0.00)->comment('附加价格');
            $table->decimal('freight_price', 10)->unsigned()->default(0.00)->comment('运费');
            $table->boolean('is_new')->default(0)->comment("是否新品");
            $table->string('unit', 45)->default('')->comment('商品单位');
            $table->string('primary_picture')->default('')->comment('商品主图');
            $table->json('picture_list')->nullable()->comment('商品列表图');
            $table->decimal('retail_price', 10)->unsigned()->default(0.00)->comment('零售价格');
            $table->integer('sell_volume')->nullable()->unsigned()->default(0)->comment('销售量');
            $table->integer('primary_product_id')->unsigned()->default(0)->comment('主sku　product_id');
            $table->decimal('unit_price', 10)->unsigned()->default(0.00)->comment('单位价格，单价');
            $table->boolean('is_promotion')->nullable()->default(0)->comment("是否促销");
            $table->decimal('promotion_price', 10)->nullable()->unsigned()->default(0.00)->comment('促销价格');
            $table->text('promotion_description')->nullable()->comment('促销描述');
            $table->boolean('is_limited')->default(0)->comment('是否限购');
            $table->decimal('limited_number', 10)->nullable()->unsigned()->default(0.00)->comment('限购数量');
            $table->boolean('is_hot')->default(0)->comment('是否推荐');
            $table->comment = '商品表';
            $table->timestamps();

            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
