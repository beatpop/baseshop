<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * 商品分类表
 */
class CreateProductCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 120)->default("")->comment("分类名称");
            $table->string("keywords", 100)->nullable()->default("")->comment("关键词");
            $table->text("description")->nullable()->comment("描述");
            $table->unsignedInteger('parent_id')->unsigned()->nullable()->index('parent_id')->comment('父级分类id');
            $table->tinyInteger('priority')->nullable()->unsigned()->default(50)->comment('排序优先级');
            $table->tinyInteger('is_show')->default(1)->comment('是否展示');
            $table->string('banner_url')->default('')->comment('banner图片url');
            $table->string('icon_url')->nullable()->default('')->comment('分类图标');
            $table->json('img_list')->nullable()->comment('图片地址');
            $table->tinyInteger('level')->default(0)->comment('分类层级');
            $table->string('type')->nullable()->default('')->comment('类别');
            $table->string('alias')->nullable()->default('')->comment('分类别名');
            $table->comment = '商品分类表';
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('product_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_categories');
    }
}
