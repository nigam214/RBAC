<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Package Connection
    |--------------------------------------------------------------------------
    |
    | You can set a different database connection for this package. It will set
    | new connection for models Role and Permission. When this option is null,
    | it will connect to the main database, which is set up in database.php
    |
    */

    'connection' => null,

    /*
    |--------------------------------------------------------------------------
    | Slug Separator
    |--------------------------------------------------------------------------
    |
    | Here you can change the slug separator. This is very important in matter
    | of magic method __call() and also a `Slugable` trait. The default value
    | is a dot.
    |
    */

    'separator' => '.',

    /*
    |--------------------------------------------------------------------------
    | Models
    |--------------------------------------------------------------------------
    |
    | If you want, you can replace default models from this package by models
    | you created. Have a look at `NIGAM214\RBAC\Models\Role` model and
    | `NIGAM214\RBAC\Models\Permission` model.
    |
    */

    'models' => [
        'object' => config('auth.providers.users.model'),
        'role' => NIGAM214\RBAC\Models\Role::class,
        'permission' => NIGAM214\RBAC\Models\Permission::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Names
    |--------------------------------------------------------------------------
    |
    | If you want, you can replace default models name with your custom models
    | you created. These model names will affect table names.
    |
    */

    'names' => [
        'object' => 'user',
        'role' => 'role',
        'permission' => 'permission',
    ],

    /*
    |--------------------------------------------------------------------------
    | Roles, Permissions and Allowed "Pretend"
    |--------------------------------------------------------------------------
    |
    | You can pretend or simulate package behavior no matter what is in your
    | database. It is really useful when you are testing you application.
    | Set up what will methods roleIs(), may() and allowed() return.
    |
    */

    'pretend' => [

        'enabled' => false,

        'options' => [
            'roleIs' => true,
            'may' => true,
            'allowed' => true,
        ],

    ],

];
