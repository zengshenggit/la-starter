<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_menus', function (Blueprint $table) {
            $table->id();
            $table->integer('permission_id')
                ->default(0)
                ->comment('权限id')
                ->index();
            $table->integer('pid')
                ->default(0)
                ->comment('父级id')
                ->index();
            $table->string('name', 10)
                ->default('')
                ->comment('名称');
            $table->string('description', 30)
                ->default('')
                ->comment('说明');
            $table->string('icon', 20)
                ->default('')
                ->comment('图标');
            $table->string('route', 20)
                ->default('')
                ->comment('组件路由');
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
        Schema::dropIfExists('permission_menus');
    }
}
