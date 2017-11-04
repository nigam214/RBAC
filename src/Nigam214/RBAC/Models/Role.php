<?php

namespace Nigam214\RBAC\Models;

use Nigam214\RBAC\Traits\Slugable;
use Illuminate\Database\Eloquent\Model;
use Nigam214\RBAC\Traits\RoleHasRelations;
use Nigam214\RBAC\Contracts\RoleHasRelations as RoleHasRelationsContract;

class Role extends Model implements RoleHasRelationsContract
{
    use Slugable, RoleHasRelations;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'slug', 'description', 'parent_id'];

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
