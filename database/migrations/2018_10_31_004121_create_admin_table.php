<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('用户名');
            $table->string('password')->comment('密码');
            $table->string('email')->unique()->nullable()->comment('email');
            $table->string('avatar', 128)->nullable()->comment('头像');
            $table->integer('login_count')->default(0)->comment('登录次数');
            $table->string('create_ip')->nullable()->comment('注册ip');
            $table->string('last_login_ip')->nullable()->comment('最后登录IP');
            $table->timestamp('last_actived_at')->nullable()->comment('最后活跃时间');
            $table->tinyInteger('status')->default(1)->comment('状态: 1 正常, 2=>禁止');
            $table->integer('role_id')->nullable()->comment('关联角色');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins');
    }
}
