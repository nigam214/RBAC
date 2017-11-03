<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionObjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $object = config('rbac.names.object');
        $permission = config('rbac.names.permission');
        $object_permission = ($object < $permission) ? "${object}_${permission}" : "${permission}_${object}";
        $objects = str_plural($object);
        $permissions = str_plural($permission);
        Schema::create($object_permission, function (Blueprint $table) use($object, $permission, $objects, $permissions) {
            $table->increments('id');
            $table->integer($permission . '_id')->unsigned()->index();
            $table->foreign($permission . '_id')->references('id')->on($permissions)->onDelete('cascade');
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
        $permission = config('rbac.names.permission');
        $object_permission = ($object < $permission) ? "${object}_${permission}" : "${permission}_${object}";
        Schema::drop($object_permission);
    }
}
