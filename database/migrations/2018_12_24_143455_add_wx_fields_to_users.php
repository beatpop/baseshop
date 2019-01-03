<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWxFieldsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("phone", 20)->nullable()->comment("手机");
            $table->string("wx_openid")->nullable()->comment("微信开放id");
            $table->string("wx_unionid")->nullable()->comment("微信unionId");
            $table->string("wx_nick_name", 100)->nullable()->comment("微信用户昵称");
            $table->string("wx_avatar_url")->nullable()->comment("微信用户头像");
            $table->string("wx_gender", 10)->nullable()->comment("微信用户性别");
            $table->string("wx_city", 100)->nullable()->comment("微信用户所在城市");
            $table->string("wx_province", 100)->nullable()->comment("微信用户所在省份");
            $table->string("wx_country", 100)->nullable()->comment("微信用户所在国家");
            $table->string("wx_language")->nullable()->comment("微信用户语言");
            $table->string("login_ip")->nullable()->comment("登录IP");
            $table->string("wx_session_key")->nullable()->comment("微信session_key");
            $table->string("wx_expires_in")->nullable()->comment("微信session_key过期时间");
            $table->string("third_session")->nullable()->comment("服务端session");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn("phone");
            $table->dropColumn("wx_openid");
            $table->dropColumn("wx_unionid");
            $table->dropColumn("wx_nick_name");
            $table->dropColumn("wx_avatar_url");
            $table->dropColumn("wx_gender");
            $table->dropColumn("wx_city");
            $table->dropColumn("wx_province");
            $table->dropColumn("wx_country");
            $table->dropColumn("wx_language");
            $table->dropColumn("login_ip");
            $table->dropColumn("wx_session_key");
            $table->dropColumn("wx_expires_in");
            $table->dropColumn("third_session");
        });
    }
}
