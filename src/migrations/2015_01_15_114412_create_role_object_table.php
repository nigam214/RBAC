<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $object = config('rbac.names.object');
        $role = config('rbac.names.role');
        $object_role = ($object < $role) ? "${object}_${role}" : "${role}_${object}";
        $roles = str_plural($role);
        $objects = str_plural($object);
        Schema::create($object_role, function (Blueprint $table) use($role, $object, $roles, $objects) {
            $table->increments('id');
            $table->integer($role . '_id')->unsigned()->index();
            $table->foreign($role . '_id')->references('id')->on($roles)->onDelete('cascade');
            $table->integer($object . '_id')->unsigned()->index();
            $table->foreign($object . '_id')->references('id')->on($objects)->onDelete('cascade');
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
        $object = config('rbac.names.object');
        $role = config('rbac.names.role');
        $object_role = ($object < $role) ? "${object}_${role}" : "${role}_${object}";
        Schema::drop($object_role);
    }
}
