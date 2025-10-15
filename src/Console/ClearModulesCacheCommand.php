<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Console;

use Illuminate\Console\Command;
use SagarSBhedodkar\LaravelModularRoutes\Support\ModuleLoader;

/**
 * Class ClearModulesCacheCommand
 *
 * Console command to clear all cached module-related data in the application.
 * 
 * In modular Laravel applications, modules often store metadata or route
 * information in cache for faster access. This command ensures that all
 * cached data related to modules is removed, allowing the system to rebuild
 * fresh module data the next time it is accessed.
 *
 * Example usage:
 *   php artisan module:clear-cache
 *
 * Workflow:
 *   1. Invoke the ModuleLoader service.
 *   2. Call the `clearCache` method on the ModuleLoader to purge all cached module data.
 *   3. Output a success message to the console.
 *
 * Dependencies:
 *   - ModuleLoader: Service responsible for managing module loading and cache operations.
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Console
 */
class ClearModulesCacheCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * This is how the command is executed via Artisan.
     *
     * @var string
     */
    protected $signature = 'module:clear-cache';

    /**
     * The console command description.
     *
     * This provides a brief explanation of what the command does,
     * which appears when running `php artisan list` or `php artisan help module:clear-cache`.
     *
     * @var string
     */
    protected $description = 'Clear cached module data.';

    /**
     * Handle the execution of the console command.
     *
     * This method is automatically called when the command is executed.
     * It leverages the ModuleLoader service to remove all cached data.
     *
     * @param ModuleLoader $loader The service responsible for module loading and cache management.
     *
     * @return void
     *
     * Detailed Steps:
     *   1. Call the `clearCache` method on ModuleLoader to purge all cached module data.
     *   2. Provide user feedback in the console indicating the cache has been cleared.
     */
    public function handle(ModuleLoader $loader): void
    {
        // Purge all cached module information to ensure modules are reloaded fresh
        $loader->clearCache();

        // Inform the user that the cache was successfully cleared
        $this->info('✅ Module cache cleared successfully.');
    }
}
