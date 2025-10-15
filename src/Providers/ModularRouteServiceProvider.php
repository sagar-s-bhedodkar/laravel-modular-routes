<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Providers;

use Illuminate\Support\ServiceProvider;
use SagarSBhedodkar\LaravelModularRoutes\Support\ModuleLoader;
use SagarSBhedodkar\LaravelModularRoutes\Console\MakeModuleCommand;
use SagarSBhedodkar\LaravelModularRoutes\Console\ListModulesCommand;
use SagarSBhedodkar\LaravelModularRoutes\Console\ClearModulesCacheCommand;

/**
 * Class ModularRouteServiceProvider
 *
 * Service provider for the Laravel Modular Routes package.
 * 
 * Responsibilities:
 *   - Register services and bindings required for module management.
 *   - Register console commands related to module operations.
 *   - Bootstrap and initialize all modules once the application services are ready.
 *
 * Workflow:
 *   1. Registers ModuleLoader as a singleton for dependency injection.
 *   2. Registers module-related Artisan commands:
 *      - make:module
 *      - module:list
 *      - module:clear-cache
 *   3. Boots the ModuleLoader to automatically load all available modules.
 *
 * Usage:
 *   Add this service provider to the `providers` array in `config/app.php` (if not auto-discovered)
 *   to enable modular route loading and commands.
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Providers
 */
class ModularRouteServiceProvider extends ServiceProvider
{
    /**
     * Register application services, bindings, and commands.
     *
     * This method is called before all other service providers' `boot` methods.
     * It is used to bind classes into the service container and register console commands.
     *
     * @return void
     */
    public function register(): void
    {
        // Register ModuleLoader as a singleton to ensure a single shared instance
        $this->app->singleton(ModuleLoader::class, fn() => new ModuleLoader());

        // Register all Artisan commands related to module management
        $this->commands([
            MakeModuleCommand::class,       // Command to create a new module
            ListModulesCommand::class,      // Command to list all available modules
            ClearModulesCacheCommand::class // Command to clear cached module data
        ]);
    }

    /**
     * Bootstrap any application services.
     *
     * This method is called after all service providers have been registered.
     * It is responsible for performing any post-registration bootstrapping tasks.
     *
     * @return void
     */
    public function boot(): void
    {
        // Load all modules using the ModuleLoader singleton
        // This ensures that module routes, controllers, and resources are registered
        app(ModuleLoader::class)->load();
    }
}
