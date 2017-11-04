<?php

namespace Nigam214\RBAC\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Nigam214\RBAC\Exceptions\PermissionDeniedException;

class VerifyPermission
{
    /**
     * @var \Illuminate\Contracts\Auth\Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param \Illuminate\Contracts\Auth\Guard $auth
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param int|string $permissions
     * @return mixed
     * @throws \Nigam214\RBAC\Exceptions\PermissionDeniedException
     */
    public function handle($request, Closure $next, ...$permissions)
    {
        $all = filter_var(array_values(array_slice($permissions, -1))[0], FILTER_VALIDATE_BOOLEAN);
        if ($this->auth->check() && $this->auth->user()->may($permissions, $all)) {
            return $next($request);
        }

        throw new PermissionDeniedException(implode(',', $permissions));
    }
}
