<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permission = config('rbac.names.permission');
        $role = config('rbac.names.role');
        $permission_role = ($permission < $role) ? "${permission}_${role}" : "${role}_${permission}";
        $roles = str_plural($role);
        $permissions = str_plural($permission);
        Schema::create($permission_role, function (Blueprint $table) use($permission, $role, $permissions, $roles) {
            $table->increments('id');
            $table->integer($permission . '_id')->unsigned()->index();
            $table->foreign($permission . '_id')->references('id')->on($permissions)->onDelete('cascade');
            $table->integer($role . '_id')->unsigned()->index();
            $table->foreign($role . '_id')->references('id')->on($roles)->onDelete('cascade');
            $table->boolean('granted')->default(true);
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
        $permission = config('rbac.names.permission');
        $role = config('rbac.names.role');
        $permission_role = ($permission < $role) ? "${permission}_${role}" : "${role}_${permission}";
        Schema::drop($permission_role);
    }
}
