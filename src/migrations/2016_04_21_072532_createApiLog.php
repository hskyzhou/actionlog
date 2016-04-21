<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apilogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->comment('接口名');
            $table->integer('uid')->comment('用户uid');
            $table->string('from', 30)->comment('区分android还是ios');
            $table->string('app', 50)->comment('区分来自哪个app应用');
            $table->text('data')->comment('传递给接口的数据');
            $table->string('ip', 16)->comment('IP地址');
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
        Schema::drop('apilogs');
    }
}
