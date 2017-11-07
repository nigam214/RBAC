<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach (config('rbac.rbac') as $rbacName => $rbac) {
            $roles = str_plural(config("rbac.rbac.${rbacName}.names.role"));
            Schema::create($roles, function (Blueprint $table) use($roles) {
                $table->increments('id');
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('description')->nullable();
                $table->integer('parent_id')->unsigned()->nullable();
                $table->foreign('parent_id')->references('id')->on($roles);
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
            $roles = str_plural(config("rbac.rbac.${rbacName}.names.role"));
            Schema::drop($roles);
        }
    }
}
