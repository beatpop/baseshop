<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_name', 50)->default('')->comment('收件人姓名');
            $table->string('mobile', 60)->default('')->comment('手机号');
            $table->integer('user_id')->unsigned()->nullable()->default(0)->comment('用户id');
            $table->integer('province_id')->default(0)->comment('省市id');
            $table->string('province',100)->nullable()->default('')->comment('省市');
            $table->integer('city_id')->default(0)->comment('区县id');
            $table->string('city',100)->nullable()->default('')->comment('区县/城市');
            $table->integer('district_id')->default(0)->comment('街道id');
            $table->string('district',200)->nullable()->default('')->comment('街道');
            $table->string('address')->nullable()->default('')->comment('详细地址');
            $table->string('post_code')->nullable()->comment('邮政编码');
            $table->tinyInteger('is_default')->nullable()->default(0)->comment('是否默认');
            $table->dateTime('last_used_at')->nullable()->comment('最晚一次使用时间');
            $table->softDeletes()->comment('软删除');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_addresses');
    }
}
