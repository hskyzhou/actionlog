<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userlogs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('action', 50)->comment('用户操作行为');
            $table->text('old_data')->comment('修改前数据');
            $table->text('new_data')->comment('修改后数据');
            $table->integer('uid')->comment('操作者');
            $table->string('content')->comment('操作内容');
            $table->string('module', 50)->comment('操作模块');
            $table->string('reset_sql')->comment('重置的sql语句');
            $table->string('group')->comment('日志属于一组');
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
        Schema::drop('userlogs');
    }
}
