<?php

namespace NIGAM214\RBAC\Contracts;

interface RoleHasRelations
{
    /**
     * Role belongs to many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions();

    /**
     * Role belongs to many objects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function objects();

    /**
     * Role belongs to parent role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent();
    /**
     * Roles parent, grand parent, etc.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function ancestors();
    /**
     * Role has many children roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children();

    /**
     * Roles children, grand children, etc.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function descendants();

    /**
     * Attach permission to a role.
     *
     * @param int|\NIGAM214\RBAC\Models\Permission $permission
     * @param bool $granted
     * @return bool|int
     */
    public function attachPermission($permission, $granted = TRUE);

    /**
     * Detach permission from a role.
     *
     * @param int|\NIGAM214\RBAC\Models\Permission $permission
     * @return int
     */
    public function detachPermission($permission);

    /**
     * Detach all permissions.
     *
     * @return int
     */
    public function detachAllPermissions();
}
