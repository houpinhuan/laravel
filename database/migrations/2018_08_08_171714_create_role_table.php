<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //建表
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('role_name',20)->notNull();
            $table->text('auth_ids');//权限id集合
            $table->text('auth_ac');//权限控制器和方法组合字符串
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role');
    }
}
