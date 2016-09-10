<?php

namespace Hesto\Rbac;

/**
 * This file is part of Rbac,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Hesto\Rbac
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Hesto\Core\Commands\InstallFilesCommand;

class RbacInstallCommand extends InstallFilesCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rbac:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migrations following the Rbac specifications.';

    /**
     * Execute the console command.
     *
     * @return array
     */
    public function getFiles()
    {
        $migrationsDir = '/database/migrations/';

        return [
            'roles' => [
                'path' => $migrationsDir . date('Y_m_d_His') . '_create_roles_table.php',
                'stub' => __DIR__ . '/../stubs/create_roles_table.stub',
            ],
            'permissions' => [
                'path' => $migrationsDir . date('Y_m_d_His') . '_create_permissions_table.php',
                'stub' => __DIR__ . '/../stubs/create_permissions_table.stub',
            ],
            'permission_role' => [
                'path' => $migrationsDir . date('Y_m_d_His') . '_create_permission_role_pivot_table.php',
                'stub' => __DIR__ . '/../stubs/create_permission_role_pivot_table.stub',
            ]
        ];
    }
}
