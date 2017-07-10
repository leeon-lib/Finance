<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memus', function (Blueprint $table) {
            $table->increments('id')->comment('主键ID');
            $table->char('name', 5)->default('')->comment('菜单名称');
            $table->tinyInteger('parent_id')->unsigned()->default(0)->comment('父级ID');
            $table->string('flag', 32)->default('')->comment('权限标识');
            $table->string('url', 32)->default('')->comment('功能路径');
            $table->string('icon', 16)->default('')->comment('菜单前缀图标');

            $table->softDeletes();
            $table->timestamps();

            $table->index('parent_id', 'idx_parent_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('memus');
    }
}
