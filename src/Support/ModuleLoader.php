<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use SagarSBhedodkar\LaravelModularRoutes\Exceptions\ModuleNotFoundException;

/**
 * Class ModuleLoader
 *
 * Service responsible for:
 *   - Scanning the modules directory.
 *   - Dynamically autoloading module classes.
 *   - Loading API and Web routes for each module.
 *
 * Responsibilities:
 *   - Ensure modular routes are automatically registered in the application.
 *   - Provide a centralized way to manage modules, including future caching logic.
 *
 * Notes:
 *   - Expects modules to reside under the `Modules` directory (PascalCase).
 *   - Each module should have its own Routes folder with `api.php` and/or `web.php`.
 *
 * Example usage:
 *   $loader = new ModuleLoader();
 *   $loader->load();           // Load all module routes
 *   $loader->clearCache();     // Clear cached module data (future implementation)
 *
 * @package SagarSBhedodkar\LaravelModularRoutes\Support
 */
class ModuleLoader
{
    /**
     * Absolute path to the modules directory.
     *
     * @var string
     */
    protected string $modulesPath;

    /**
     * ModuleLoader constructor.
     *
     * Initializes the modules path and sets up a dynamic autoloader
     * for classes under the `Modules` namespace.
     */
    public function __construct()
    {
        // Set modules directory path (PascalCase folder as per convention)
        $this->modulesPath = base_path('Modules');

        // Dynamic autoloader to automatically include PHP classes under Modules namespace
        spl_autoload_register(function ($class) {
            if (str_starts_with($class, 'Modules\\')) {
                // Remove 'Modules\' prefix to get relative path
                $relative = substr($class, 8);

                // Convert namespace separators to directory separators
                $file = $this->modulesPath
                    . DIRECTORY_SEPARATOR
                    . str_replace('\\', DIRECTORY_SEPARATOR, $relative) 
                    . '.php';

                // Include the file if it exists
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        });
    }

    /**
     * Load all module routes automatically.
     *
     * Steps:
     *   1. Check if the modules directory exists.
     *   2. Scan the directory for all subdirectories (each representing a module).
     *   3. Load routes for each module using `loadModuleRoutes`.
     *
     * @return void
     */
    public function load(): void
    {
        if (!is_dir($this->modulesPath)) {
            // No modules directory found; exit silently
            return;
        }

        // Get all directories (modules) under the modules path
        $modules = glob($this->modulesPath . '/*', GLOB_ONLYDIR);

        // Iterate through each module and load its routes
        foreach ($modules as $moduleDir) {
            $this->loadModuleRoutes($moduleDir);
        }
    }

    /**
     * Load API and Web routes for a single module.
     *
     * @param string $moduleDir Absolute path to the module directory
     *
     * Steps:
     *   1. Determine the module name (lowercase).
     *   2. Check for existence of `api.php` and `web.php` route files.
     *   3. Throw ModuleNotFoundException if no routes exist.
     *   4. Register API routes under "api/{moduleName}" with `api` middleware.
     *   5. Register Web routes under "{moduleName}" with `web` middleware.
     *
     * @throws ModuleNotFoundException
     */
    protected function loadModuleRoutes(string $moduleDir): void
    {
        $moduleName = Str::lower(basename($moduleDir));

        $apiFile = $moduleDir . '/Routes/api.php';
        $webFile = $moduleDir . '/Routes/web.php';

        // Ensure at least one route file exists
        if (!file_exists($apiFile) && !file_exists($webFile)) {
            throw new ModuleNotFoundException("No route files found for module '{$moduleName}'");
        }

        // Register API routes if api.php exists
        if (file_exists($apiFile)) {
            Route::prefix("api/{$moduleName}")
                ->middleware('api')
                ->group($apiFile);
        }

        // Register Web routes if web.php exists
        if (file_exists($webFile)) {
            Route::prefix($moduleName)
                ->middleware('web')
                ->group($webFile);
        }
    }

    /**
     * Clear module cache (future implementation).
     *
     * Currently a placeholder for clearing cached module metadata, routes, or other
     * module-related data. Could be integrated with caching systems like Laravel Cache.
     *
     * @return void
     */
    public function clearCache(): void
    {
        // Future caching logic
    }
}
