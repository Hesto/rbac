<?php

namespace Hesto\Rbac\Commands;

/**
 * This file is part of Rbac,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Hesto\Rbac
 */

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Hesto\Core\Commands\InstallCommand;
use Symfony\Component\Console\Input\InputArgument;

class MigrationCommand extends InstallCommand
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'rbac:migration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a migration following the Rbac specifications.';

    /**
     * Execute the console command.
     *
     * @return array
     */
    public function fire()
    {
        $this->call('make:migration:pivot', [
            'tableOne' => 'roles',
            'tableTwo' => str_plural($this->argument('name')),
        ]);
    }

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of table which should be connected with roles.'],
        ];
    }
}
