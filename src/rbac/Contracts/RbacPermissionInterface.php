<?php namespace Hesto\Rbac\Contracts;

/**
 * This file is part of Rbac,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Hesto\Rbac
 */

interface RbacPermissionInterface
{
    
    /**
     * Many-to-Many relations with role model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles();
}
