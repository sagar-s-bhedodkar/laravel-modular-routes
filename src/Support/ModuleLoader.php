<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Support;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use SagarSBhedodkar\LaravelModularRoutes\Exceptions\ModuleNotFoundException;

/**
 * Responsible for scanning modules folder, autoloading classes, and loading routes.
 */
class ModuleLoader
{
    protected string $modulesPath;

    public function __construct()
    {
        $this->modulesPath = base_path('Modules'); // PascalCase folder

        // Dynamic autoloader for Modules namespace
        spl_autoload_register(function ($class) {
            if (str_starts_with($class, 'Modules\\')) {
                $relative = substr($class, 8); // Remove 'Modules\'
                $file = $this->modulesPath . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relative) . '.php';
                if (file_exists($file)) {
                    require_once $file;
                }
            }
        });
    }

    /**
     * Load all module routes automatically.
     */
    public function load(): void
    {
        if (!is_dir($this->modulesPath)) {
            return;
        }

        $modules = glob($this->modulesPath . '/*', GLOB_ONLYDIR);

        foreach ($modules as $moduleDir) {
            $this->loadModuleRoutes($moduleDir);
        }
    }

    /**
     * Load API and Web routes for a single module.
     */
    protected function loadModuleRoutes(string $moduleDir): void
    {
        $moduleName = Str::lower(basename($moduleDir));

        $apiFile = $moduleDir . '/Routes/api.php';
        $webFile = $moduleDir . '/Routes/web.php';

        if (!file_exists($apiFile) && !file_exists($webFile)) {
            throw new ModuleNotFoundException("No route files found for module '{$moduleName}'");
        }

        if (file_exists($apiFile)) {
            Route::prefix("api/{$moduleName}")
                ->middleware('api')
                ->group($apiFile);
        }

        if (file_exists($webFile)) {
            Route::prefix($moduleName)
                ->middleware('web')
                ->group($webFile);
        }
    }

    /**
     * Clear module cache if implemented.
     */
    public function clearCache(): void
    {
        // Future caching logic
    }
}
