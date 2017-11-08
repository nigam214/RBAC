<?php

namespace Nigam214\RBAC\Traits;

trait PermissionHasRelations
{
    /**
     * Permission belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(config('rbac.rbac.' . $this->rbacName . '.models.role'))->withTimestamps()->withPivot('granted', config('rbac.owner.id'));
    }

    /**
     * Permission belongs to many objects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function objects()
    {
        return $this->belongsToMany(config('rbac.rbac.' . $this->rbacName . '.models.object'))->withTimestamps()->withPivot('granted', config('rbac.owner.id'));
    }
}
