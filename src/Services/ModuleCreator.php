<?php

namespace SagarSBhedodkar\LaravelModularRoutes\Services;

use Illuminate\Filesystem\Filesystem;
use RuntimeException;

/**
 * Responsible for creating module scaffolding with default routes and controllers.
 */
class ModuleCreator
{
    protected Filesystem $files;
    protected string $modulesPath;

    public function __construct()
    {
        $this->files = new Filesystem();
        // Production standard: Modules folder with uppercase M
        $this->modulesPath = base_path('modules');
    }

    /**
     * Create a new module with default CRUD routes and controller.
     *
     * @param string $name Module name (PascalCase recommended)
     * @throws RuntimeException if module already exists
     */
    public function create(string $name): void
    {
        $path = "{$this->modulesPath}/{$name}";

        if ($this->files->exists($path)) {
            throw new RuntimeException("Module '{$name}' already exists!");
        }

        // Create folder structure
        $this->files->makeDirectory("{$path}/Routes", 0755, true);
        $this->files->makeDirectory("{$path}/Http/Controllers", 0755, true);

        // Generate API routes
        $this->files->put("{$path}/Routes/api.php", $this->getStub('api', $name));

        // Optional: generate web routes
        $this->files->put("{$path}/Routes/web.php", $this->getStub('web', $name));

        // Generate Controller
        $this->files->put("{$path}/Http/Controllers/{$name}Controller.php", $this->getStub('controller', $name));
    }

    /**
     * Get stub content and replace placeholders.
     *
     * @param string $type Stub type: 'api', 'web', 'controller'
     * @param string $name Module name
     * @return string
     */
    protected function getStub(string $type, string $name): string
    {
        $stubPath = __DIR__ . "/../../stubs/{$type}.stub";

        if (!file_exists($stubPath)) {
            throw new RuntimeException("Stub file for '{$type}' not found at {$stubPath}");
        }

        $content = file_get_contents($stubPath);

        // Replace placeholders
        $content = str_replace('{{ name }}', $name, $content);
        $content = str_replace('{{ name | strtolower }}', strtolower($name), $content);

        return $content;
    }
}
