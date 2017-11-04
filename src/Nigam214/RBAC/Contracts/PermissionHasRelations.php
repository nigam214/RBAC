<?php

namespace Nigam214\RBAC\Contracts;

interface PermissionHasRelations
{
    /**
     * Permission belongs to many roles.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();

    /**
     * Permission belongs to many objects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function objects();
}
