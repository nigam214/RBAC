<?php

namespace NIGAM214\RBAC\Models;

use NIGAM214\RBAC\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use NIGAM214\RBAC\Traits\PermissionHasRelations;
use NIGAM214\RBAC\Contracts\PermissionHasRelations as PermissionHasRelationsContract;

class Permission extends Model implements PermissionHasRelationsContract
{
    use Slugable, PermissionHasRelations;

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
