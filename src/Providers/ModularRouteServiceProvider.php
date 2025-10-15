<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Providers;

use Illuminate\Support\ServiceProvider;
use SagarSBhedodkar\LaravelModularRoutes\Support\ModuleLoader;
use SagarSBhedodkar\LaravelModularRoutes\Console\MakeModuleCommand;
use SagarSBhedodkar\LaravelModularRoutes\Console\ListModulesCommand;
use SagarSBhedodkar\LaravelModularRoutes\Console\ClearModulesCacheCommand;

class ModularRouteServiceProvider extends ServiceProvider
{
    /**
     * Register bindings and commands.
     */
    public function register(): void
    {
        $this->app->singleton(ModuleLoader::class, fn() => new ModuleLoader());

        $this->commands([
            MakeModuleCommand::class,
            ListModulesCommand::class,
            ClearModulesCacheCommand::class,
        ]);
    }

    /**
     * Bootstrap module loader after all services are registered.
     */
    public function boot(): void
    {
        app(ModuleLoader::class)->load();
    }
}
