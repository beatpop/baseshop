<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name", 100)->default("")->comment("品牌名称");
            $table->text("description")->nullable()->comment("品牌描述");
            $table->string("img_url")->nullable()->comment("品牌图片地址");
            $table->integer("priority")->default(10)->comment("优先级");
            $table->tinyInteger('is_show')->default(1)->index('is_show')->comment('品牌上下架 1=>显示 0=>下架');
            $table->decimal('floor_price', 10)->nullable()->default(0.00)->comment('品牌显示的最低价');
            $table->boolean('is_new')->nullable()->default(0)->comment('是否是新增品牌');
            $table->comment = '品牌表';
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
}
