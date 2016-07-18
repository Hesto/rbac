<?php namespace Hesto\Rbac;

/**
 * This file is part of Rbac,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Hesto\Rbac
 */

use Hesto\Rbac\Contracts\RbacRoleInterface;
use Hesto\Rbac\Traits\RbacRoleTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class RbacRole extends Model implements RbacRoleInterface
{
    use RbacRoleTrait;

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
        $this->table = Config::get('rbac.roles_table');
    }

}
