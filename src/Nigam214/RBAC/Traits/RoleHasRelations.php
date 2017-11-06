<?php

namespace Nigam214\RBAC\Traits;

trait RoleHasRelations
{
    /**
     * Role belongs to many permissions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function permissions()
    {
        return $this->belongsToMany(config('rbac.rbac.' . $this->rbacName . '.models.permission'))->withTimestamps()->withPivot('granted');
    }

    /**
     * Role belongs to many objects.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function objects()
    {
        return $this->belongsToMany(config('rbac.rbac.' . $this->rbacName . '.models.object'))->withTimestamps();
    }

    /**
     * Role belongs to parent role.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function parent()
    {
        return $this->belongsTo(config('rbac.rbac.' . $this->rbacName . '.models.role'),'parent_id');
    }

    public function ancestors()
    {
        $ancestors = $this->where('id', '=', $this->parent_id)->get();
        while ($ancestors->last() && $ancestors->last()->parent_id !== null)
        {
            $parent = $this->where('id', '=', $ancestors->last()->parent_id)->get();
            $ancestors = $ancestors->merge($parent);
        }
        return $ancestors;
    }


    /**
     * Role has many children roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(config('rbac.rbac.' . $this->rbacName . '.models.role'),'parent_id');
    }

    public function descendants()
    {
        $descendants = $this->where('parent_id', '=', $this->id)->get();

        foreach($descendants as $descendant)
            $descendants = $descendants->merge($descendant->descendants());

        return $descendants;
    }

    /**
     * Attach permission to a role.
     *
     * @param int|\Bican\Roles\Models\Permission $permission
     * @param bool $granted
     * @return bool|int
     */
    public function attachPermission($permission, $granted = true)
    {
        return (!$this->permissions()->get()->contains($permission)) ? $this->permissions()->attach($permission, array('granted' => $granted)) : true;
    }

    /**
     * Detach permission from a role.
     *
     * @param int|\Bican\Roles\Models\Permission $permission
     * @return int
     */
    public function detachPermission($permission)
    {
        return $this->permissions()->detach($permission);
    }

    /**
     * Detach all permissions.
     *
     * @return int
     */
    public function detachAllPermissions()
    {
        return $this->permissions()->detach();
    }
}
