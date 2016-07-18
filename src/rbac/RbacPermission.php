<?php namespace Hesto\Rbac;

/**
 * This file is part of Rbac,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Hesto\Rbac
 */

use Hesto\Rbac\Contracts\RbacPermissionInterface;
use Hesto\Rbac\Traits\RbacPermissionTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class RbacPermission extends Model implements RbacPermissionInterface
{
    use RbacPermissionTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table;

    /**
     * Creates a new instance of the model.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('rbac.permissions_table');
    }

}
