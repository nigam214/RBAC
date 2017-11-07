<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (config('rbac.rbac') as $rbacName => $rbac) {
            $permissions = str_plural(config("rbac.rbac.${rbacName}.names.permission"));
            Schema::create($permissions, function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('description')->nullable();
                $table->string('model')->nullable();
                $table->integer(config("rbac.owner.id"))->unsigned();
                $table->foreign(config("rbac.owner.id"))->references('id')->on(str_plural(config("rbac.owner.model")));
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (config('rbac.rbac') as $rbacName => $rbac) {
            $permissions = str_plural(config("rbac.rbac.${rbacName}.names.permission"));
            Schema::drop($permissions);
        }
    }
}
