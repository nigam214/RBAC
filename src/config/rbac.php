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
    | Role, Permission and its Assignment Owner
    |--------------------------------------------------------------------------
    |
    | Here you can configure the plugin to use owner tracking for roles,
    | permissions, and its assignment for the object.
    |
    | model: model name of owner, ex. user
    | id: onwer id used in RBAC tables
    |
    */

    'owner' => [
        'model' => 'user',
        'id' => 'owner_id',
    ],

    /*
    |--------------------------------------------------------------------------
    | RBAC: collection of User, Role, and Permission for RBAC
    |--------------------------------------------------------------------------
    |
    | user_role_permission:
    | This is RBAC Name. You can change this name or add more names in the
    | collection. Each User, Role, and Permission Model must have the following:
    | public $rbacName = "user_role_permission"; // Your Given Name
    | Have a look at `Nigam214\RBAC\Models\Role` model and
    | `Nigam214\RBAC\Models\Permission` model.
    |
    | Models:
    | If you want, you can replace default models from this package by models
    | you created. Have a look at `Nigam214\RBAC\Models\Role` model and
    | `Nigam214\RBAC\Models\Permission` model.
    |
    | Names:
    | If you want, you can replace default models name with your custom models
    | you created. These model names will affect table names.
    |
    */

    'rbac' => [
        'user_role_permission' => [
            'models' => [
                'object' => config('auth.providers.users.model'),
                'role' => Nigam214\RBAC\Models\Role::class,
                'permission' => Nigam214\RBAC\Models\Permission::class,
            ],
            'names' => [
                'object' => 'user',
                'role' => 'role',
                'permission' => 'permission',
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Roles, Permissions and Allowed "Pretend"
    |--------------------------------------------------------------------------
    |
    | You can pretend or simulate package behavior no matter what is in your
    | database. It is really useful when you are testing you application.
    | Set up what will methods roleIs(), can() and allowed() return.
    |
    */

    'pretend' => [

        'enabled' => false,

        'options' => [
            'roleIs' => true,
            'can' => true,
            'allowed' => true,
        ],

    ],

];
