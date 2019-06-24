<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique()->comment('权限名称');
            $table->string('route')->nullable()->comment('权限路由');
            $table->string('icon')->nullable()->comment('icon图标');
            $table->integer('parent_id')->default(0)->unsigned()->comment('上级权限');
            $table->tinyInteger('is_hidden')->default(0)->unsigned()->comment('是否隐藏');
            $table->integer('sort')->default(255)->unsigned()->comment('排序');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
    }
}
