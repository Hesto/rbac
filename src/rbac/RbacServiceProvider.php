<?php namespace Hesto\Rbac;

/**
 * This file is part of Rbac,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Hesto\Rbac
 */

use Illuminate\Support\ServiceProvider;

class RbacServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        // Publish config files
         $this->publishes([
             __DIR__.'/../config/config.php' => config_path('rbac.php'),
         ]);
        
        // Register blade directives
        $this->bladeDirectives();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRbac();

        $this->registerMigrationCommand();
        $this->registerInstallCommand();

        $this->mergeConfig();
    }

    private function registerMigrationCommand()
    {
        $this->app->singleton('command.hesto.rbac.migration', function ($app) {
            return $app['Hesto\Rbac\Commands\MigrationCommand'];
        });

        $this->commands('command.hesto.rbac.migration');
    }

    private function registerInstallCommand()
    {
        $this->app->singleton('command.hesto.rbac.install', function ($app) {
            return $app['Hesto\Rbac\Commands\RbacInstallCommand'];
        });

        $this->commands('command.hesto.rbac.install');
    }

    /**
     * Register the blade directives
     *
     * @return void
     */
    private function bladeDirectives()
    {
        // Call to Rbac::hasRole
        \Blade::directive('role', function($expression) {
            return "<?php if (\\Rbac::hasRole($expression)) : ?>";
        });

        \Blade::directive('endrole', function($expression) {
            return "<?php endif; // Rbac::hasRole ?>";
        });

        // Call to Rbac::can
        \Blade::directive('permission', function($expression) {
            return "<?php if (\\Rbac::can($expression)) : ?>";
        });

        \Blade::directive('endpermission', function($expression) {
            return "<?php endif; // Rbac::can ?>";
        });

        // Call to Rbac::ability
        \Blade::directive('ability', function($expression) {
            return "<?php if (\\Rbac::ability($expression)) : ?>";
        });

        \Blade::directive('endability', function($expression) {
            return "<?php endif; // Rbac::ability ?>";
        });
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerRbac()
    {
        $this->app->bind('rbac', function ($app) {
            return new Rbac($app);
        });
        
        $this->app->alias('rbac', 'Hesto\Rbac\Rbac');
    }

    /**
     * Merges user's and rbac's configs.
     *
     * @return void
     */
    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'rbac'
        );
    }

    /**
     * Get the services provided.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'command.rbac.migration'
        ];
    }
}
