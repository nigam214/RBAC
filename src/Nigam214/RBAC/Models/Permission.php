<?php

namespace Nigam214\RBAC\Models;

use Nigam214\RBAC\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Nigam214\RBAC\Traits\PermissionHasRelations;
use Nigam214\RBAC\Contracts\PermissionHasRelations as PermissionHasRelationsContract;

class Permission extends Model implements PermissionHasRelationsContract
{
    use Slugable, PermissionHasRelations;

    /**
     * Property to identify rbac name.
     * Should match with one of config('rbac.rbac')
     *
     * @var String
     */
    public $rbacName = "user_role_permission";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'model'];

    /**
     * Create a new model instance.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        if ($connection = config('rbac.connection')) {
            $this->connection = $connection;
        }
    }
}
